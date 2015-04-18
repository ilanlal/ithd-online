<?php

class GridColumn {
    public $display_name,$schema_name,$type,$format,$width;
	public function __construct($display_name=NULL,$schema_name=NULL,$type=NULL,$format=NULL,$width=NULL) {
		$this->display_name = $display_name;
		$this->schema_name = $schema_name;
		$this->type = $type;
		$this->format = $format;
		$this->width = $width;
	}
}
