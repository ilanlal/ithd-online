<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0"
				xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
				xmlns:fo="http://www.w3.org/1999/XSL/Format">
	
	<xsl:template mode="grid-header-rows" match="cols">
		<tr class="grid-head">
			<th class="col-action cell-head">
				<span>@</span>
			</th>
			<th class="col-action cell-head">
				<span><input type="checkbox" id="check_all" /></span>
			</th>
			<xsl:for-each select="col">
				<th class="cell-head">
					<span>
						<xsl:attribute name="style">
							<xsl:value-of select="concat('width:', @width)" />
						</xsl:attribute> 
						<xsl:value-of select="@display_name" />
					</span>
				</th>
				<th class="col-saperator">
					<span></span>
				</th>
			</xsl:for-each>
		</tr>
	</xsl:template>
</xsl:stylesheet>


