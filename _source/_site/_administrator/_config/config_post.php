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
	*/ if(!is_array($object)) { @http_response_code(404); Header("Location: ../"); exit(); }
	#####################################################################################
	## Dashboard Theme Language Menue (Needed if using Complex Theme)
	#####################################################################################	
	///////////////////////////////////////////////////////////////////
	// Navigation Sub Menue Settings
	///////////////////////////////////////////////////////////////////
	$sub_file = array();
	$sub_file[0]["nav_title"] = $object["lang"]->translate("m_files_list"); 
	$sub_file[1]["nav_title"] = $object["lang"]->translate("m_files_list"); 
	$sub_file[0]["nav_sub"] = false;   
	$sub_file[1]["nav_sub"] = false;	 
	$sub_file[0]["nav_loc"] = hive_get_url_rel(array("file", "folder", false));
	$sub_file[1]["nav_loc"] = hive_get_url_rel(array("file", "list", false));  
	$sub_file[0]["nav_img"] = ""; 
	$sub_file[1]["nav_img"] = ""; 
	$sub_file[0]["nav_act"] = "folder";
	$sub_file[1]["nav_act"] = "list";
	$sub_backend = array();
	$sub_backend[0]["nav_title"] = $object["lang"]->translate("m_backend_constant"); 
	$sub_backend[1]["nav_title"] = $object["lang"]->translate("m_backend_template"); 
	$sub_backend[2]["nav_title"] = $object["lang"]->translate("m_backend_token"); 
	$sub_backend[0]["nav_sub"] = false;   
	$sub_backend[1]["nav_sub"] = false;	 
	$sub_backend[2]["nav_sub"] = false;	 
	$sub_backend[0]["nav_loc"] = hive_get_url_rel(array("backend", "constants", false));
	$sub_backend[1]["nav_loc"] = hive_get_url_rel(array("backend", "mailtemplates", false));  
	$sub_backend[2]["nav_loc"] = hive_get_url_rel(array("backend", "apitoken", false));  
	$sub_backend[0]["nav_img"] = ""; 
	$sub_backend[1]["nav_img"] = ""; 
	$sub_backend[2]["nav_img"] = ""; 
	$sub_backend[0]["nav_act"] = "constants";
	$sub_backend[1]["nav_act"] = "mailtemplates";
	$sub_backend[2]["nav_act"] = "apitoken";
	$sub_logging = array();
	$sub_logging[0]["nav_title"] = $object["lang"]->translate("m_logging_mysql"); 
	$sub_logging[1]["nav_title"] = $object["lang"]->translate("m_logging_curl"); 
	$sub_logging[2]["nav_title"] = $object["lang"]->translate("m_logging_visits"); 
	$sub_logging[3]["nav_title"] = $object["lang"]->translate("m_logging_blacklist"); 
	$sub_logging[4]["nav_title"] = $object["lang"]->translate("m_logging_referer"); 
	$sub_logging[5]["nav_title"] = $object["lang"]->translate("m_logging_benchmark"); 
	$sub_logging[6]["nav_title"] = $object["lang"]->translate("m_logging_javascript"); 
	$sub_logging[7]["nav_title"] = $object["lang"]->translate("m_logging_mail"); 
	$sub_logging[8]["nav_title"] = $object["lang"]->translate("m_logging_logging"); 
	$sub_logging[0]["nav_sub"] = false;   
	$sub_logging[1]["nav_sub"] = false;	 
	$sub_logging[2]["nav_sub"] = false;	 
	$sub_logging[3]["nav_sub"] = false;	 
	$sub_logging[4]["nav_sub"] = false;	 
	$sub_logging[5]["nav_sub"] = false;	 
	$sub_logging[6]["nav_sub"] = false;	 
	$sub_logging[7]["nav_sub"] = false;	 
	$sub_logging[8]["nav_sub"] = false;	 
	$sub_logging[0]["nav_loc"] = hive_get_url_rel(array("logging", "mysql", false));
	$sub_logging[1]["nav_loc"] = hive_get_url_rel(array("logging", "curl", false));  
	$sub_logging[2]["nav_loc"] = hive_get_url_rel(array("logging", "visits", false));  
	$sub_logging[3]["nav_loc"] = hive_get_url_rel(array("logging", "blacklist", false));  
	$sub_logging[4]["nav_loc"] = hive_get_url_rel(array("logging", "referer", false));  
	$sub_logging[5]["nav_loc"] = hive_get_url_rel(array("logging", "benchmark", false));  
	$sub_logging[6]["nav_loc"] = hive_get_url_rel(array("logging", "js", false));  
	$sub_logging[7]["nav_loc"] = hive_get_url_rel(array("logging", "mail", false));  
	$sub_logging[8]["nav_loc"] = hive_get_url_rel(array("logging", "logging", false));  
	$sub_logging[0]["nav_img"] = ""; 
	$sub_logging[1]["nav_img"] = ""; 
	$sub_logging[2]["nav_img"] = ""; 
	$sub_logging[3]["nav_img"] = ""; 
	$sub_logging[4]["nav_img"] = ""; 
	$sub_logging[5]["nav_img"] = ""; 
	$sub_logging[6]["nav_img"] = ""; 
	$sub_logging[7]["nav_img"] = ""; 
	$sub_logging[8]["nav_img"] = ""; 
	$sub_logging[0]["nav_act"] = "mysql";
	$sub_logging[1]["nav_act"] = "curl";
	$sub_logging[2]["nav_act"] = "visits";
	$sub_logging[3]["nav_act"] = "blacklist";
	$sub_logging[4]["nav_act"] = "referer";
	$sub_logging[5]["nav_act"] = "benchmark";
	$sub_logging[6]["nav_act"] = "js";
	$sub_logging[7]["nav_act"] = "mail";
	$sub_logging[8]["nav_act"] = "logging";
	$sub_user = array();
	$sub_user[0]["nav_title"] = $object["lang"]->translate("m_user_list"); 
	$sub_user[1]["nav_title"] = $object["lang"]->translate("m_user_group"); 
	$sub_user[2]["nav_title"] = $object["lang"]->translate("m_user_session"); 
	$sub_user[0]["nav_sub"] = false;   
	$sub_user[1]["nav_sub"] = false;	 
	$sub_user[2]["nav_sub"] = false;	  
	$sub_user[0]["nav_loc"] = hive_get_url_rel(array("user", "user", false));
	$sub_user[1]["nav_loc"] = hive_get_url_rel(array("user", "group", false));  
	$sub_user[2]["nav_loc"] = hive_get_url_rel(array("user", "session", false));  
	$sub_user[0]["nav_img"] = ""; 
	$sub_user[1]["nav_img"] = ""; 
	$sub_user[2]["nav_img"] = ""; 
	$sub_user[0]["nav_act"] = "user";
	$sub_user[1]["nav_act"] = "group";
	$sub_user[2]["nav_act"] = "session";
	$sub_system = array();
	$sub_system[0]["nav_title"] = $object["lang"]->translate("m_system_core"); 
	$sub_system[1]["nav_title"] = $object["lang"]->translate("m_system_site"); 
	$sub_system[2]["nav_title"] = $object["lang"]->translate("m_system_store"); 
	$sub_system[3]["nav_title"] = $object["lang"]->translate("m_system_modules"); 
	$sub_system[4]["nav_title"] = $object["lang"]->translate("m_system_about"); 
	$sub_system[0]["nav_sub"] = false;   
	$sub_system[1]["nav_sub"] = false;	 
	$sub_system[2]["nav_sub"] = false;	  
	$sub_system[3]["nav_sub"] = false;	  
	$sub_system[4]["nav_sub"] = false;	  
	$sub_system[0]["nav_loc"] = hive_get_url_rel(array("system", "update", false));
	$sub_system[1]["nav_loc"] = hive_get_url_rel(array("system", "updatesite", false));
	$sub_system[2]["nav_loc"] = hive_get_url_rel(array("system", "store", false));  
	$sub_system[3]["nav_loc"] = hive_get_url_rel(array("system", "modules", false));  
	$sub_system[4]["nav_loc"] = hive_get_url_rel(array("system", "about", false));  
	$sub_system[0]["nav_img"] = ""; 
	$sub_system[1]["nav_img"] = ""; 
	$sub_system[2]["nav_img"] = ""; 
	$sub_system[3]["nav_img"] = ""; 
	$sub_system[4]["nav_img"] = ""; 
	$sub_system[0]["nav_act"] = "update";
	$sub_system[1]["nav_act"] = "updatesite";
	$sub_system[2]["nav_act"] = "store";
	$sub_system[3]["nav_act"] = "modules";
	$sub_system[4]["nav_act"] = "about";
	///////////////////////////////////////////////////////////////////
	// Navigation Main Menue Settings
	///////////////////////////////////////////////////////////////////
	$object["nav"] = array();
	$object["nav"][0]["nav_title"] = $object["lang"]->translate("m_start");
	$object["nav"][1]["nav_title"] = $object["lang"]->translate("m_files");
	$object["nav"][2]["nav_title"] = $object["lang"]->translate("m_backend");
	$object["nav"][3]["nav_title"] = $object["lang"]->translate("m_logging");
	$object["nav"][4]["nav_title"] = $object["lang"]->translate("m_user");
	$object["nav"][5]["nav_title"] = $object["lang"]->translate("m_system");
	$object["nav"][0]["nav_img"] = "bx bxs-dashboard";
	$object["nav"][1]["nav_img"] = "bx bx-file";
	$object["nav"][2]["nav_img"] = "bx bx-desktop";
	$object["nav"][3]["nav_img"] = "bx bx-notepad";
	$object["nav"][4]["nav_img"] = "bx bx-user";
	$object["nav"][5]["nav_img"] = "bx bx-cog";
	$object["nav"][0]["nav_sub"] = false;
	$object["nav"][1]["nav_sub"] = false;
	$object["nav"][2]["nav_sub"] = $sub_backend;
	$object["nav"][3]["nav_sub"] = $sub_logging;
	$object["nav"][4]["nav_sub"] = $sub_user;	
	$object["nav"][5]["nav_sub"] = $sub_system;	
	$object["nav"][0]["nav_act"] = "start";
	$object["nav"][1]["nav_act"] = "file";
	$object["nav"][2]["nav_act"] = "backend";
	$object["nav"][3]["nav_act"] = "logging";
	$object["nav"][4]["nav_act"] = "user";	
	$object["nav"][5]["nav_act"] = "system";
	$object["nav"][0]["nav_loc"] 	= hive_get_url_rel(array("start", false, false));
	$object["nav"][1]["nav_loc"] 	= hive_get_url_rel(array("file", false, false));
	$object["nav"][2]["nav_loc"] 	= hive_get_url_rel(array("backend", "constants", false));
	$object["nav"][3]["nav_loc"] 	= hive_get_url_rel(array("logging", "mysql", false));
	$object["nav"][4]["nav_loc"] 	= hive_get_url_rel(array("user", "user", false));
	$object["nav"][5]["nav_loc"] 	= hive_get_url_rel(array("system", "update", false));
	///////////////////////////////////////////////////////////////////
	// Navigation Profile Menue Settings
	///////////////////////////////////////////////////////////////////
	$pfm = array();
	$pfm[0]["nav_title"] = $object["lang"]->translate("m_profile_view"); # Profile Sub Menue Item Title
	$pfm[1]["nav_title"] = $object["lang"]->translate("m_profile_switch");  # Profile Sub Menue Item Title
	$pfm[2]["nav_title"] = $object["lang"]->translate("m_profile_logout");  # Profile Sub Menue Item Title
	$pfm[0]["nav_loc"] 	= hive_get_url_rel(array("user", "profile", false, false, false));
	$pfm[1]["nav_loc"] 	= hive_get_url_rel(array("user", "switch", false, false, false));
	$pfm[2]["nav_loc"] 	= hive_get_url_rel(array("user", "logout", false, false, false));
	$pfm[0]["nav_img"] = "bx bx-user";  # Box Icon Image Class
	$pfm[1]["nav_img"] = "bx bx-reflect-horizontal"; # Box Icon Image Class
	$pfm[2]["nav_img"] = "bx bx-door-open"; # Box Icon Image Class	
	// Array for Language in topbar Changer
	$lang_ar = array();
	//$lang_ar[0]["current_ident"] = _HIVE_LANG_;
	$lang_ar[0]["current_img"] = _HIVE_URL_REL_."/_core/_vendor/country-flags-icons/png/"._HIVE_LANG_.".png";
	$lang_ar[0]["ident"] = "gb";
	$lang_ar[0]["img"] = _HIVE_URL_REL_."/_core/_vendor/country-flags-icons/png/gb.png";
	$lang_ar[0]["name"] = "English";
	//$lang_ar[1]["ident"] = "de";
	//$lang_ar[1]["img"] = _HIVE_URL_REL_."/_core/_vendor/country-flags-icons/png/de.png";
	//$lang_ar[1]["name"] = "Deutsch";