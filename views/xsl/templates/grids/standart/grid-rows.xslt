<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0"
				xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
				xmlns:fo="http://www.w3.org/1999/XSL/Format">
	
	<xsl:template mode="grid-rows" match="rows">
    
		<xsl:for-each select="row">
			<tr>
				<xsl:attribute name="id">
					<xsl:value-of select="@id" />
				</xsl:attribute> 
				<td class="col-info">
					<input type="hidden" 
						   name="id">
						<xsl:attribute name="value">
							<xsl:value-of select="@id" />
						</xsl:attribute> 
					</input>
					<input type="hidden" 
						   name="delete_url">
						<xsl:attribute name="value">
							<xsl:value-of select="@delete_url" />
						</xsl:attribute> 
					</input>
				</td>
				<td class="col-icon">
					<a target="_blank">
						<xsl:attribute name="href">
							<xsl:value-of select="@open_url" />
						</xsl:attribute> 
						<img src="/views/img/edit.png" />
					</a>
				</td>
				<td class="col-selector">
					<input type="checkbox">
						<xsl:attribute name="onchange">
							<xsl:value-of select="concat('selectRow(this,`',@id,'`)')" />
						</xsl:attribute> 
					</input>
				</td>
				<xsl:for-each select="cell">
					<td class="cell-values">
						<xsl:variable name="name" select="@name" />
						<span>
							<xsl:attribute name="style">
								<xsl:value-of select="concat('width:', //grid/cols/col[@schema_name=$name]/@width)" />
							</xsl:attribute> 
							<xsl:value-of select="." />
						</span>	
					</td>
					<td class="col-saperator">
						<span></span>
					</td>
				</xsl:for-each>
			</tr>
		</xsl:for-each>
	</xsl:template>
</xsl:stylesheet>


