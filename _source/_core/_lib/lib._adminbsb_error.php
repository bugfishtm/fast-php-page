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
	if(!is_array(@$object)) { Header("Location: ../"); exit(); }
	#############################################################################################################################################
	// Error Elements
	#############################################################################################################################################
	function hive__adminbsb_404($object, $text = "The requested page does not exist.", $title = "<h2>ERROR 404</h2>", $mainclass = "", $headerclass = "", $bodyclass = "") { 
		if($headerclass == false) { $headerclass = ""; }
		if($bodyclass == false) { $bodyclass = ""; }
		if($mainclass == false) { $mainclass = ""; }
		return hive__adminbsb_box($text, $title, $mainclass, $headerclass, $bodyclass); }	
	function hive__adminbsb_401($object, $text = "You do not have permission to view this page! :(", $title = "ERROR 401", $mainclass = "", $headerclass = "", $bodyclass = "") { 
		if($headerclass == false) { $headerclass = ""; }
		if($bodyclass == false) { $bodyclass = ""; }
		if($mainclass == false) { $mainclass = ""; }
		return hive__adminbsb_box($text, $title, $mainclass, $headerclass, $bodyclass); }		