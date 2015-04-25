<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0"
				xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
				xmlns:fo="http://www.w3.org/1999/XSL/Format">

	<xsl:import href="../../../xsl_string.xsl" />
	<xsl:import href="grid-columns-group.xslt" />
	<xsl:import href="grid-head.xslt" />
	<xsl:import href="grid-rows.xslt" />
  
	<xsl:output method="html"/>
	<xsl:template match="grid">
		<div class="grid-buttons">
			<input type="button" name="delete" value="New">
				<xsl:attribute name="onclick">
					<xsl:value-of select="concat('newRecord(`',@new_url,'`)')" />
				</xsl:attribute> 
			</input>
			<input type="button" name="delete" value="Delete" onclick="deleteSelectedRecords(this)" />
			<input type="button" name="refresh" value="Refresh">
				<xsl:attribute name="onclick">
					<xsl:value-of select="concat('refresh(`',@id,'`)')" />
				</xsl:attribute> 
			</input>
			<input type="hidden" name="gird_id">
				<xsl:attribute name="value">
					<xsl:value-of select="@id" />
				</xsl:attribute> 
			</input>
		</div>
		<table class="grid">
			<xsl:attribute name="id">
				<xsl:value-of select="@id" />
			</xsl:attribute> 
			<!--<xsl:apply-templates mode="grid-columns" select="cols" />-->
			<thead>
				<xsl:apply-templates mode="grid-header-rows" select="cols" />
			</thead>
			<tbody class="grid-body">
				<xsl:apply-templates mode="grid-rows" select="rows" />
			</tbody>
		</table>
	</xsl:template>
</xsl:stylesheet>