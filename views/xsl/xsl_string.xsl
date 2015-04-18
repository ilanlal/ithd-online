<?xml version="1.0" encoding="UTF-8"?>

<xsl:stylesheet version="1.0" extension-element-prefixes="func" xmlns:xsl="http://www.w3.org/1999/XSL/Transform" xmlns:string="http://symphony-cms.com/functions" xmlns:_string="http://symphony-cms.com/functions" xmlns:func="http://exslt.org/functions">
<!--
     #String utility functions (yes, functions)

     	version:  1.03
     	author:   Simon de Turck
     	email:    simon@zimmen.com


     To use these functions add the string namespace to your master (or wherever you feel it suits best) stylesheet and import this utility. Add the namespace `xmlns:string="http://symphony-cms.com/functions"` to all stylesheets where you want to use these functions.

     *This utility uses some **EXSLT** that is supported in libxslt 1.0.19 and later*

     Usage:

     ####Convert string to lowercase:
     	<xsl:value-of select="string:lower-case([selector])" />

     ######example:
     	<xsl:value-of select="string:lower-case('ABC')" />

     	abc

     ####Convert string to uppercase:
     	<xsl:value-of select="string:upper-case([selector])" />

     ######example:
     	<xsl:value-of select="string:upper-case('abc')" />

     	ABC

     ####Capitalize string:
     	<xsl:value-of select="capitalize([selector])" />
     	<xsl:value-of select="ucfirst([selector])" /> (alias)

     ######example:
     	<xsl:value-of select="capitalize('the t in this sentence is capitalized!')" />

         The t in this sentence is capitalized!

     ####Capitalize each word in a string:
     	<xsl:value-of select="capitalize-words([selector])" />
     	<xsl:value-of select="ucall([selector])" /> (alias)

     ######example:
     	<xsl:value-of select="capitalize-words('all words in this sentence are capitalized!')" />

         All Words In This Sentence Are Capitalized !

     ####Replace in string:
     	<xsl:value-of select="string:replace([selector],[needle],[replace])" />

     ######example:
     	<xsl:value-of select="string:replace('a b c',' ',' to the ')" />

     	a to the b to the c

     ####Split a string (returns a nodeset):
     	<xsl:copy-of select="string:split([selector][,[delimiter],[rootnodename],[nodename]])" />

     - Default delimiter: ','
     - Default rootnodename: 'nodeset'
     - Default nodename: 'node'

     ######example 1:
     	<xsl:copy-of select="string:split('a,b,c')" />

     	<nodeset>
         	<node>a</node>
         	<node>b</node>
         	<node>c</node>
     	</nodeset>

     ######example 2:
     	<xsl:copy-of select="string:split('book1#book2#book3','#','bookstore','book')" />

     	<bookstore>
     		<book>book1</book>
     		<book>book2</book>
     		<book>book3</book>
     	</bookstore>

     ######example 3:
     	<xsl:copy-of select="string:split('item1#item2#item3','#','ul','li')" />

     	<ul>
     		<li>book1</li>
     	    <li>book2</li>
     	    <li>book3</li>
     	</ul>

     ####Count occurrences of a string in a string:
     **To count elements (lets say `<a href>`'s in your text fields) you should use `count(text/*/a)` instead.**

     	<xsl:value-of select="string:substring-count([needle],[haystack])" />

     ######example
     	<xsl:value-of select="string:substring-count('the quick brown fox jumps over the lazy dog','the')" />

     	2
     -->
<!-- Convert string to lowercase -->
    <func:function name="string:lower-case">
        <xsl:param name="in"/>
        <func:result select="translate($in,'ABCDEFGHIJKLMNOPQRSTUVWXYZÀÈÌÒÙÁÉÍÓÚÝÂÊÎÔÛÃÑÕÄËÏÖÜŸÅÆŒÇÐØ','abcdefghijklmnopqrstuvwxyzàèìòùáéíóúýâêîôûãñõäëïöüÿåæœçðø')"/>
    </func:function>
<!-- Convert string to uppercase -->
    <func:function name="string:upper-case">
        <xsl:param name="in"/>
        <func:result select="translate($in,'abcdefghijklmnopqrstuvwxyzàèìòùáéíóúýâêîôûãñõäëïöüÿåæœçðø','ABCDEFGHIJKLMNOPQRSTUVWXYZÀÈÌÒÙÁÉÍÓÚÝÂÊÎÔÛÃÑÕÄËÏÖÜŸÅÆŒÇÐØ')"/>
    </func:function>
<!-- Capitalize first letter in string -->
    <func:function name="string:capitalize">
        <xsl:param name="in"/>
        <func:result>
            <xsl:copy-of select="string:upper-case(substring($in, 1, 1))"/>
            <xsl:copy-of select="string:lower-case(substring($in, 2))"/>
        </func:result>
    </func:function>
<!-- Alias for capitalize string -->
    <func:function name="string:ucfirst">
        <xsl:param name="in"/>
        <func:result>
            <xsl:value-of select="string:capitalize($in)"/>
        </func:result>
    </func:function>
<!-- Capitalize all words in string -->
    <func:function name="string:capitalize-words">
        <xsl:param name="in"/>
        <func:result>
            <xsl:value-of select="_string:grabword($in,' ')"/>
        </func:result>
    </func:function>
    <func:function name="_string:grabword">
        <xsl:param name="haystack"/>
        <xsl:param name="needle"/>
        <func:result>
            <xsl:choose>
                <xsl:when test="contains($haystack, $needle)">
                    <xsl:value-of select="concat(string:capitalize(substring-before($haystack, $needle)),$needle)"/>
                    <xsl:copy-of select="_string:grabword(substring-after($haystack, $needle),$needle)"/>
                </xsl:when>
                <xsl:otherwise>
                    <xsl:value-of select="concat(string:capitalize($haystack), $needle)"/>
                </xsl:otherwise>
            </xsl:choose>
        </func:result>
    </func:function>
<!-- Replace a string within a string (or find the needle in the haystack and replace it) -->
    <func:function name="string:replace">
        <xsl:param name="in"/>
        <xsl:param name="needle"/>
        <xsl:param name="replace" select="''"/>
        <func:result>
            <xsl:choose>
                <xsl:when test="contains($in, $needle)">
                    <xsl:value-of select="substring-before($in, $needle)"/>
                    <xsl:value-of select="$replace"/>
                    <xsl:value-of select="string:replace(substring-after($in, $needle),$needle,$replace)"/>
                </xsl:when>
                <xsl:otherwise>
                    <xsl:value-of select="$in"/>
                </xsl:otherwise>
            </xsl:choose>
        </func:result>
    </func:function>
<!-- Splits a string and returns a nodeset -->
    <func:function name="string:split">
        <xsl:param name="in"/>
        <xsl:param name="delim" select="','"/>
        <xsl:param name="rootnode" select="'nodeset'"/>
        <xsl:param name="nodename" select="'node'"/>
        <func:result>
            <xsl:element name="{$rootnode}">
                <xsl:copy-of select="_string:createnodes($in,$delim,$nodename)"/>
            </xsl:element>
        </func:result>
    </func:function>
    <func:function name="_string:createnodes">
        <xsl:param name="haystack"/>
        <xsl:param name="needle"/>
        <xsl:param name="nodename" select="'node'"/>
        <func:result>
            <xsl:choose>
                <xsl:when test="contains($haystack, $needle)">
                    <xsl:element name="{$nodename}">
                        <xsl:value-of select="substring-before($haystack, $needle)"/>
                    </xsl:element>
                    <xsl:copy-of select="_string:createnodes(substring-after($haystack, $needle),$needle,$nodename)"/>
                </xsl:when>
                <xsl:otherwise>
                    <xsl:element name="{$nodename}">
                        <xsl:value-of select="$haystack"/>
                    </xsl:element>
                </xsl:otherwise>
            </xsl:choose>
        </func:result>
    </func:function>
<!--Count occurrences of a string in a string-->
    <func:function name="string:substring-count">
        <xsl:param name="haystack"/>
        <xsl:param name="needle"/>
        <func:result>
            <xsl:choose>
                <xsl:when test="contains($haystack, $needle) and $haystack and $needle">
                    <xsl:variable name="count">
                        <xsl:copy-of select="string:substring-count(substring-after($haystack, $needle), $needle)"/>
                    </xsl:variable>
                    <xsl:value-of select="$count + 1"/>
                </xsl:when>
                <xsl:otherwise>0</xsl:otherwise>
            </xsl:choose>
        </func:result>
    </func:function>
</xsl:stylesheet>
