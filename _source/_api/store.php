<?php
	/* 	__________ ____ ___  ___________________.___  _________ ___ ___  
		\______   \    |   \/  _____/\_   _____/|   |/   _____//   |   \ 
		 |    |  _/    |   /   \  ___ |    __)  |   |\_____  \/    ~    \
		 |    |   \    |  /\    \_\  \|     \   |   |/        \    Y    /
		 |______  /______/  \______  /\___  /   |___/_______  /\___|_  / 
				\/                 \/     \/                \/       \/  	
							www.bugfish.eu
							
	    Bugfish Fast PHP Page Framework
		Copyright (C) 2024 Jan Maurice Dahlmanns [Bugfish]

		This program is free software: you can redistribute it and/or modify
		it under the terms of the GNU General Public License as published by
		the Free Software Foundation, either version 3 of the License, or
		(at your option) any later version.

		This program is distributed in the hope that it will be useful,
		but WITHOUT ANY WARRANTY; without even the implied warranty of
		MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
		GNU General Public License for more details.

		You should have received a copy of the GNU General Public License
		along with this program.  If not, see <https://www.gnu.org/licenses/>.
	*/
	if(!is_array(@$object)) { 
		if(file_exists("../settings.php")) { require_once("../settings.php"); $hasbeen = false; } else { @http_response_code(404); echo "error"; exit(); }
	} else { $hasbeen = true; }
	
	// Init Array
	$var = array();
	
	// _administrator
	$var[0]["rname"] 		= "_administrator";
	$var[0]["version"] 		= "100";
	$var[0]["build"] 		= $var[0]["version"];
	$var[0]["description"] 	= "FP2 Administrator Template to use side by side with Admin Switch Mode Functionality or to copy and paste for your own projects! A lot of sections for administration and functions are included in here!";
	$var[0]["name"] 		= "FP2 Administrator";
	$var[0]["license"] 		= "GPLv3";
	$var[0]["autor"] 		= "Jan-Maurice Dahlmanns";
	$var[0]["pseudo"] 		= "Bugfish";
	$var[0]["mail"] 		= "requests@bugfish.eu";
	$var[0]["website"] 		= "www.bugfish.eu";
	
	// _example-simple
	$var[1]["rname"] 		= "_example-simple";
	$var[1]["version"] 		= "100";
	$var[1]["build"] 		= $var[1]["version"];
	$var[1]["description"] 	= "FP2 Simple Example Template to test simplest solution website development with this CMS.";
	$var[1]["name"] 		= "FP2 Simple Example";
	$var[1]["license"] 		= "GPLv3";
	$var[1]["autor"] 		= "Jan-Maurice Dahlmanns";
	$var[1]["pseudo"] 		= "Bugfish";
	$var[1]["mail"] 		= "requests@bugfish.eu";
	$var[1]["website"] 		= "www.bugfish.eu";
	
	// _example-complex
	$var[2]["rname"] 		= "_example-complex";
	$var[2]["version"] 		= "100";
	$var[2]["build"] 		= $var[2]["version"];
	$var[2]["description"] 	= "FP2 Complex Example Template, to test and demonstrate a complex dashboard theme and more advanced functionalities of this CMS.";
	$var[2]["name"] 		= "FP2 Complex Example";
	$var[2]["license"] 		= "GPLv3";
	$var[2]["autor"] 		= "Jan-Maurice Dahlmanns";
	$var[2]["pseudo"] 		= "Bugfish";
	$var[2]["mail"] 		= "requests@bugfish.eu";
	$var[2]["website"] 		= "www.bugfish.eu";
	
	// _example-site
	$var[3]["rname"] 		= "_example-site";
	$var[3]["version"] 		= "100";
	$var[3]["build"] 		= $var[3]["version"];
	$var[3]["description"] 	= "FP2 Site Example Template, to demonstrate deeper functionalities and full configuration examples for this CMS.";
	$var[3]["name"] 		= "FP2 Site Module Example";
	$var[3]["license"] 		= "GPLv3";
	$var[3]["autor"] 		= "Jan-Maurice Dahlmanns";
	$var[3]["pseudo"] 		= "Bugfish";
	$var[3]["mail"] 		= "requests@bugfish.eu";
	$var[3]["website"] 		= "www.bugfish.eu";
	
	// _documentation
	$var[4]["rname"] 		= "_documentation";
	$var[4]["version"] 		= "100";
	$var[4]["build"] 		= $var[4]["version"];
	$var[4]["description"] 	= "FP2 Documentation page which can also be found at www.bugfish-github.de!";
	$var[4]["name"] 		= "FP2 Documentation";
	$var[4]["license"] 		= "Private";
	$var[4]["autor"] 		= "Jan-Maurice Dahlmanns";
	$var[4]["pseudo"] 		= "Bugfish";
	$var[4]["mail"] 		= "requests@bugfish.eu";
	$var[4]["website"] 		= "www.bugfish.eu";
	
	// _frameworkdocs
	$var[5]["rname"] 		= "_frameworkdocs";
	$var[5]["version"] 		= "100";
	$var[5]["build"] 		= $var[5]["version"];
	$var[5]["description"] 	= "This module lets you view the Bugfish Framework Documentation!";
	$var[5]["name"] 		= "Bugfish Framework Documentation";
	$var[5]["license"] 		= "Private";
	$var[5]["autor"] 		= "Jan-Maurice Dahlmanns";
	$var[5]["pseudo"] 		= "Bugfish";
	$var[5]["mail"] 		= "requests@bugfish.eu";
	$var[5]["website"] 		= "www.bugfish.eu";
	
	// Output
	if(!$hasbeen) { echo serialize($var); }