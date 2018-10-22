<?php
// Clicky plugin, https://github.com/datenstrom/yellow-plugins/tree/master/clicky
// Copyright (c) 2013-2018 Datenstrom, https://datenstrom.se
// This file may be used and distributed under the terms of the public license.

class YellowClicky
{
	const VERSION = "0.7.2";
	var $yellow;			//access to API
	
	// Handle initialisation
	function onLoad($yellow)
	{
		$this->yellow = $yellow;
		$this->yellow->config->setDefault("clickyID", "");
	}
	
	// Handle page extra HTML data
	function onExtra($name)
	{
		$output = NULL;
		if($name=="footer")
		{
			$siteId = $this->yellow->config->get("clickyID");
			if (empty(!$siteId)) $siteId = $this->yellow->config->get("clickyID");
	// js code is inline
			$output = "<script>\n";
			$output .= "var clicky_site_ids = clicky_site_ids || []; clicky_site_ids.push(".strencode($siteId)."); (function() {	var s = document.createElement('script');	s.type = 'text/javascript'; s.async = true; s.src = '//static.getclicky.com/js'; ( document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0] ).appendChild( s ); })();\n";
			$output .= "</script>\n";
		}
		return $output;
	}
}

$yellow->plugins->register("clicky", "YellowClicky", YellowClicky::VERSION);
?>
