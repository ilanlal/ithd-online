<?php

Class GridView {

    public $template_name;
    public $base_xsl_file;
    public $xml_data;
    public $current_page_number;

    public function __construct(Base_Grid_Control $grid_control,$template_name, $current_page_number = 1) {
        $this->template_name = $template_name;
        $this->current_page_number = $current_page_number;
		$this->xml_data = $grid_control->get_xml();
		if(filter_input(INPUT_GET, "mod") === "xml") {
			echo($this->xml_data->asXML());
			die();
		}
        $this->base_xsl_file = $_SERVER['DOCUMENT_ROOT'] . "/views/xsl/templates/grids/" . $this->template_name . "/grid.xslt";
    }

    public function render() {
        $xsl = new DomDocument;
        $xsl->load($this->base_xsl_file);

        $xp = new XsltProcessor();
        $xp->registerPHPFunctions();
        $xp->importStylesheet($xsl);

        $params = [
            'template_name' => $this->template_name
            , 'current_page_number' => $this->current_page_number
        ];

        foreach ($params as $key => $val) {
            $xp->setParameter('', $key, $val);
        }
        
        $grid_html ="";
        if (($grid_html = $xp->transformToXML($this->xml_data))!==FALSE) {
            echo $grid_html;
        } else {
            trigger_error('XSL transformation failed.', E_USER_ERROR);
        } 
    }
}
