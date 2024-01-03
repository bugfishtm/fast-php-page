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
	$varx = array();
	
	// _administrator
	$varx["rname"] 			= "_administrator";
	$varx["version"] 		= "1.10";
	$varx["build"] 			= "100";
	$varx["description"] 	= "The FP2 Administrator Template is a comprehensive resource designed for seamless integration with the Admin Switch Mode Functionality or for direct incorporation into personal projects. Packed with an extensive array of sections dedicated to administration and diverse functions, this template serves as a robust toolkit for administrative purposes within the CMS (Content Management System). Its rich collection of features and functionalities are readily available for immediate use, allowing for effortless implementation and customization. Whether utilized alongside the Admin Switch Mode or copied and adapted for individual projects, this template offers an abundance of pre-designed sections tailored for streamlined administration, making it an invaluable asset for developers seeking to expedite the creation of feature-rich administrative interfaces. Included in this Module is this Modules Documentation! You can also find documentations at https://bugfishtm.github.io!";
	$varx["name"] 			= "FP2 Administrator";
	$varx["license"] 		= "GPLv3";
	$varx["autor"] 			= "Jan-Maurice Dahlmanns";
	$varx["pseudo"] 		= "Bugfish";
	$varx["mail"] 			= "requests@bugfish.eu";
	$varx["website"] 		= "www.bugfish.eu";
	array_push($var, $varx);
	
	// _example-simple
	$varx["rname"] 			= "_example-simple";
	$varx["version"] 		= "1.10";
	$varx["build"] 			= "100";
	$varx["description"] 	= "The FP2 Simple Example Template is a foundational tool designed to facilitate straightforward website development within this CMS (Content Management System). Tailored for simplicity, this template serves as a starting point for testing and implementing the most basic solutions offered by the CMS. It provides a clear and uncomplicated framework, perfect for users seeking to explore the fundamental functionalities and build a minimalistic yet functional website. By offering a simplified approach, this template serves as an ideal playground for beginners or those looking to grasp the core features of the CMS, enabling them to create uncomplicated websites efficiently and effectively. Included in this Module is this Modules Documentation! You can also find documentations at https://bugfishtm.github.io!";
	$varx["name"] 			= "FP2 Simple Example";
	$varx["license"] 		= "GPLv3";
	$varx["autor"] 			= "Jan-Maurice Dahlmanns";
	$varx["pseudo"] 		= "Bugfish";
	$varx["mail"] 			= "requests@bugfish.eu";
	$varx["website"] 		= "www.bugfish.eu";
	array_push($var, $varx);
	
	// _example-complex
	$varx["rname"] 			= "_example-complex";
	$varx["version"] 		= "1.10";
	$varx["build"] 			= "100";
	$varx["description"] 	= "The FP2 Complex Example Template stands as an advanced demonstration platform, specifically designed to test and showcase intricate dashboard themes and sophisticated functionalities within this CMS (Content Management System). This template serves as an in-depth exploration of the CMS's capabilities, offering a complex dashboard theme that highlights the system's versatility and advanced features. It provides an environment to test and experiment with intricate functionalities, aiming to unveil the system's full potential. Through this complex example, users can delve deeper into the CMS's advanced features, gaining insights and practical knowledge to leverage these capabilities effectively. This template is a valuable resource for developers and users seeking to explore and harness the more intricate and powerful aspects of the CMS for creating sophisticated and high-performing web applications or interfaces. Included in this Module is this Modules Documentation! You can also find documentations at https://bugfishtm.github.io!";
	$varx["name"] 			= "FP2 Complex Example";
	$varx["license"] 		= "GPLv3";
	$varx["autor"] 			= "Jan-Maurice Dahlmanns";
	$varx["pseudo"] 		= "Bugfish";
	$varx["mail"] 			= "requests@bugfish.eu";
	$varx["website"] 		= "www.bugfish.eu";
	array_push($var, $varx);
	
	// _example-site
	$varx["rname"] 			= "_example-site";
	$varx["version"] 		= "1.10";
	$varx["build"] 			= "100";
	$varx["description"] 	= "The FP2 Site Example Template serves as an illustrative showcase, presenting an extensive array of functionalities and comprehensive configuration examples within this CMS (Content Management System). This template goes beyond the surface, delving into the deeper capabilities of the CMS, offering a comprehensive view of its functionalities. It provides detailed configurations that showcase the full spectrum of features, guiding users through intricate settings and demonstrating how to maximize the CMS's potential. This exemplar template aims to serve as a valuable resource for users seeking a more profound understanding of the CMS, offering practical examples and in-depth configurations to aid in building robust and highly functional websites or applications. Included in this Module is this Modules Documentation! You can also find documentations at https://bugfishtm.github.io!";
	$varx["name"] 			= "FP2 Site Module Example";
	$varx["license"] 		= "GPLv3";
	$varx["autor"] 			= "Jan-Maurice Dahlmanns";
	$varx["pseudo"] 		= "Bugfish";
	$varx["mail"] 			= "requests@bugfish.eu";
	$varx["website"] 		= "www.bugfish.eu";
	array_push($var, $varx);

	// _documentation
	$varx["rname"] 			= "_documentation";
	$varx["version"] 		= "1.02";
	$varx["build"] 			= "100";
	$varx["description"] 	= "This site module holds the FP2 / Raid CMS Documentation! You can also find documentations at https://bugfishtm.github.io!";
	$varx["name"] 			= "Documentation";
	$varx["license"] 		= "GPLv3";
	$varx["autor"] 			= "Jan-Maurice Dahlmanns";
	$varx["pseudo"] 		= "Bugfish";
	$varx["mail"] 			= "requests@bugfish.eu";
	$varx["website"] 		= "www.bugfish.eu";
	array_push($var, $varx);


	// _framework-documentation
	$varx["rname"] 			= "_framework-documentation";
	$varx["version"] 		= "2.4";
	$varx["build"] 			= "100";
	$varx["description"] 	= "This site module holds the bugfish framework documentation! You can also find documentations at https://bugfishtm.github.io!";
	$varx["name"] 			= "Framework Documentation";
	$varx["license"] 		= "GPLv3";
	$varx["autor"] 			= "Jan-Maurice Dahlmanns";
	$varx["pseudo"] 		= "Bugfish";
	$varx["mail"] 			= "requests@bugfish.eu";
	$varx["website"] 		= "www.bugfish.eu";
	array_push($var, $varx);
	
	// Output
	if(!$hasbeen) { echo serialize($var); }