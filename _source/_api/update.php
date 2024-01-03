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
	
	// Core Update Informations
	$var["rname"] 			= "_core";
	$var["version"] 		= "1.02";
	$var["build"] 			= "100";
	$var["description"] 	= "This stands as the official FP2 Core Version, encompassing all files within the '_core' directory of this website. Please note that files within this folder and scripts in the root website directory might be replaced upon updating the core version. You can also find documentations at https://bugfishtm.github.io!";
	$var["name"] 			= "FP2 Core";
	$var["license"] 		= "GPLv3";
	$var["autor"] 			= "Jan-Maurice Dahlmanns";
	$var["pseudo"] 			= "Bugfish";
	$var["mail"] 			= "requests@bugfish.eu";
	$var["website"] 		= "www.bugfish.eu";
	
	// Output
	if(!$hasbeen) { echo serialize($var); }