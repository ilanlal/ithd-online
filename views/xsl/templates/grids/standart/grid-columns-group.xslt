<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0"
				xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
				xmlns:fo="http://www.w3.org/1999/XSL/Format">
	
	<xsl:template mode="grid-columns" match="cols">
		
		<colgroup>
			<col class="col-action" />
			<col class="col-action" />
			<xsl:for-each select="col">
				<col class="col-data">
					<xsl:attribute name="style">
						<xsl:value-of select="concat('width:', @width)" />
					</xsl:attribute> 
				</col>
				<col class="col-saperator" />
			</xsl:for-each>
		</colgroup>
	</xsl:template>
</xsl:stylesheet>