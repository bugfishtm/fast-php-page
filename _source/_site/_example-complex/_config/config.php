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
	if(!is_array($object)) { @http_response_code(404); Header("Location: ../"); exit(); }
	// URL Site Settings
	define('_HIVE_TITLE_', 					"FP²");
	define('_HIVE_URL_SEO_', 				false);
	define('_HIVE_URL_GET_', 				array("site", "second", false, false, false));
	// Theme Site Settings
	define("_HIVE_THEME_DEFAULT_", 			"default");
	define("_HIVE_THEME_ARRAY_", 			array("default", "green", "purple", "orange", "dynamic"));
	define("_HIVE_THEME_COLOR_DEFAULT_", 	"#ff5707"); 
	// Language Site Settings
	define("_HIVE_LANG_DEFAULT_", 			"gb"); 
	define("_HIVE_LANG_ARRAY_", 			array("gb", "de"));
	define("_HIVE_LANG_DB_", 				false); 
	## Navigation Settings
		// First Sub Menue (Used in Dashboard Themes)
		$sub = array();
		$sub[0]["nav_title"] = "Item";  # Nav Item Name
		$sub[1]["nav_title"] = "Login";  # Nav Item Name
		$sub[0]["nav_loc"] 	= hive_get_url_rel(array("first_loc", "secloc", false));
		$sub[1]["nav_loc"] 	= hive_get_url_rel(array("login", false, false));
		$sub[0]["nav_img"] = "bx bx-shower";  # Box Icon Image Class
		$sub[1]["nav_img"] = "bx bx-reflect-horizontal";  # Box Icon Image Class
		$sub[0]["nav_sub"] = false;   # Has Submenue?
		$sub[1]["nav_sub"] = false;	   # Has Submenue?
		$sub[0]["nav_act"] = "secloc";	   # Has Submenue?
		$sub[1]["nav_act"] = false;	   # Has Submenue?
		// Main Menue (Used in Dashboard Themes)	
		$object["nav"] = array();
		$object["nav"][0]["nav_title"] = "General";
		$object["nav"][1]["nav_title"] = "Charts";
		$object["nav"][2]["nav_title"] = "Forms";
		$object["nav"][3]["nav_title"] = "Tables";
		$object["nav"][4]["nav_title"] = "Submenue";
		$object["nav"][0]["nav_loc"] 	= hive_get_url_rel(array("general", false, false));
		$object["nav"][1]["nav_loc"] 	= hive_get_url_rel(array("charts", false, false));
		$object["nav"][2]["nav_loc"] 	= hive_get_url_rel(array("forms", false, false));
		$object["nav"][3]["nav_loc"] 	= hive_get_url_rel(array("tables", false, false));
		$object["nav"][4]["nav_loc"] 	= hive_get_url_rel(array("submenue", false, false));
		$object["nav"][0]["nav_img"] = "bx bx-shower";
		$object["nav"][1]["nav_img"] = "bx bx-reflect-horizontal";
		$object["nav"][2]["nav_img"] = "bx bxl-postgresql";
		$object["nav"][3]["nav_img"] = "bx bxs-cable-car";
		$object["nav"][4]["nav_img"] = "bx bxs-lemon";
		$object["nav"][0]["nav_sub"] = false;
		$object["nav"][1]["nav_sub"] = false;
		$object["nav"][2]["nav_sub"] = false;
		$object["nav"][3]["nav_sub"] = false;
		$object["nav"][4]["nav_sub"] = $sub;	
		$object["nav"][0]["nav_act"] = "general";
		$object["nav"][1]["nav_act"] = "charts";
		$object["nav"][2]["nav_act"] = "forms";
		$object["nav"][3]["nav_act"] = "tables";
		$object["nav"][4]["nav_act"] = "first_loc";	
		// Profile Sub Menue (Used in Dashboard Themes)
		$pfm = array();
		$pfm[0]["nav_title"] = "Profile"; # Profile Sub Menue Item Title
		$pfm[1]["nav_title"] = "Logout";  # Profile Sub Menue Item Title
		$pfm[0]["nav_loc"] 	= hive_get_url_rel(array("profile", false, false, false, false));
		$pfm[1]["nav_loc"] 	= hive_get_url_rel(array("logout", false, false, false, false));
		$pfm[0]["nav_img"] = "bx bx-shower";  # Box Icon Image Class
		$pfm[1]["nav_img"] = "bx bx-reflect-horizontal"; # Box Icon Image Class