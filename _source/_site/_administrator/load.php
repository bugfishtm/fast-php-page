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
	*/	 if(!is_array($object)) { @http_response_code(404); Header("Location ../"); exit(); }
	//////////////////////////////////////////////////////////////////////////////
	// Show Login if not Logged In
	//////////////////////////////////////////////////////////////////////////////
	if((!$object["user"]->user_loggedIn OR @trim(_HIVE_URL_CUR_[0]) == "") AND (@trim(_HIVE_URL_CUR_[0]) != "login_recover" AND @trim(_HIVE_URL_CUR_[0]) != "login_mail_change")) { $csrf_key = "login_auth"; $object["add_nav_title"] = ""; $object["add_top_title"] = ""; $object["add_head_title"] = "Login";
																			if(!defined("_INT_SHOW_LOGIN_")) { define("_INT_SHOW_LOGIN_", 1); }}
	
	//////////////////////////////////////////////////////////////////////////////
	// Start Page if no Page Selected
	//////////////////////////////////////////////////////////////////////////////
	if($object["user"]->user_loggedIn AND @trim(_HIVE_URL_CUR_[0]) == "") { Header("Location: ".hive_get_url_rel(array("start", false, false, false, false))); exit();}
	
	//////////////////////////////////////////////////////////////////////////////
	// Login Areas - Titles
	//////////////////////////////////////////////////////////////////////////////
	$csrf_key = "";
	if(!defined("_INT_SHOW_ACCESS_")) {
		switch(_HIVE_URL_CUR_[0]) {
			//////////////////////////////////////////////////////////////////////////////
			//////////////////////////////////////////////////////////////////////////////
			//////////////////////////////////////////////////////////////////////////////
			//////////////////////////////////////////////////////////////////////////////
			// Add more Titles non-secure Sites here if required!
			//////////////////////////////////////////////////////////////////////////////
			//////////////////////////////////////////////////////////////////////////////
			//////////////////////////////////////////////////////////////////////////////
			//////////////////////////////////////////////////////////////////////////////
			// case "login_activate": 		$csrf_key = "login_activate"; $object["add_nav_title"] = ""; $object["add_top_title"] = ""; $object["add_head_title"] = "Activate User"; break;
			// case "login_register": 		$csrf_key = "login_register"; $object["add_nav_title"] = ""; $object["add_top_title"] = ""; $object["add_head_title"] = "Register User"; break;
			case "login_recover": 		$csrf_key = "login_recover"; $object["add_nav_title"] = ""; $object["add_top_title"] = ""; $object["add_head_title"] = "Recover User"; break;
			case "login_mail_change": 	$csrf_key = "login_mail_change"; $object["add_nav_title"] = ""; $object["add_top_title"] = ""; $object["add_head_title"] = "Active New Mail";  break;
			case "login_auth": 			$csrf_key = "login_auth"; $object["add_nav_title"] = ""; $object["add_top_title"] = ""; $object["add_head_title"] = "Login";  break;
		};	
	}
	
	//////////////////////////////////////////////////////////////////////////////
	// Secure Areas - Titles
	//////////////////////////////////////////////////////////////////////////////
	if($object["user"]->user_loggedIn AND !defined("_INT_SHOW_FOUND_") AND !defined("_INT_SHOW_LOGIN_") AND !defined("_INT_SHOW_ACCESS_")) {	
		switch(_HIVE_URL_CUR_[0]) {
			//////////////////////////////////////////////////////////////////////////////
			//////////////////////////////////////////////////////////////////////////////
			//////////////////////////////////////////////////////////////////////////////
			//////////////////////////////////////////////////////////////////////////////
			// Add more Titles here if required!
			//////////////////////////////////////////////////////////////////////////////
			//////////////////////////////////////////////////////////////////////////////
			//////////////////////////////////////////////////////////////////////////////
			//////////////////////////////////////////////////////////////////////////////
			//////////////////////////////////////////////////////////////////////////////
			// Start Related Titles and Operations	
			//////////////////////////////////////////////////////////////////////////////
			case false: case "": case NULL: Header("Location: /".hive_get_url_rel(array("start", false, false, false, false))); exit(); break;
			case "start": $csrf_key = "start"; $object["add_nav_title"] = _HIVE_TITLE_; $object["add_top_title"] = "Start"; $object["add_head_title"] = "Start"; break;
			// File Related Titles	
			case "file":
				$csrf_key = "file"; $object["add_nav_title"] = _HIVE_TITLE_; $object["add_top_title"] = "Files"; $object["add_head_title"] = "Files";
				break;	
			// Backend Related Titles	
			case "backend":
				switch(_HIVE_URL_CUR_[1]) {
					case "constants": $csrf_key = "backend_constant"; $object["add_nav_title"] = _HIVE_TITLE_; $object["add_top_title"] = "Constants"; $object["add_head_title"] = "Constants"; break;
					case "mailtemplates": $csrf_key = "backend_mailtemplates"; $object["add_nav_title"] = _HIVE_TITLE_; $object["add_top_title"] = "Mail-Templates"; $object["add_head_title"] = "Mail-Templates"; break;
					case "apitoken": $csrf_key = "backend_apitoken"; $object["add_nav_title"] = _HIVE_TITLE_; $object["add_top_title"] = "API-Token"; $object["add_head_title"] = "API-Token"; break;
				};		
				break;		
			// Logging Related Titles	
			case "logging":
				switch(_HIVE_URL_CUR_[1]) {
					case "mysql": $csrf_key = "logging_mysql"; $object["add_nav_title"] = _HIVE_TITLE_; $object["add_top_title"] = "MySQL"; $object["add_head_title"] = "MySQL"; break;
					case "curl": $csrf_key = "logging_curl"; $object["add_nav_title"] = _HIVE_TITLE_; $object["add_top_title"] = "Curl"; $object["add_head_title"] = "Curl"; break;
					case "visits": $csrf_key = "logging_visits"; $object["add_nav_title"] = _HIVE_TITLE_; $object["add_top_title"] = "Visits"; $object["add_head_title"] = "Visits"; break;
					case "blacklist": $csrf_key = "logging_blacklist"; $object["add_nav_title"] = _HIVE_TITLE_; $object["add_top_title"] = "Blacklist"; $object["add_head_title"] = "Blacklist"; break;
					case "referer": $csrf_key = "logging_referer"; $object["add_nav_title"] = _HIVE_TITLE_; $object["add_top_title"] = "Referer"; $object["add_head_title"] = "Referer"; break;
					case "benchmark": $csrf_key = "logging_benchmark"; $object["add_nav_title"] = _HIVE_TITLE_; $object["add_top_title"] = "Benchmark"; $object["add_head_title"] = "Benchmark"; break;
					case "js": $csrf_key = "logging_js"; $object["add_nav_title"] = _HIVE_TITLE_; $object["add_top_title"] = "Javascript"; $object["add_head_title"] = "Javascript"; break;
					case "mail": $csrf_key = "logging_mail"; $object["add_nav_title"] = _HIVE_TITLE_; $object["add_top_title"] = "Mail"; $object["add_head_title"] = "Mail"; break;
					case "logging": $csrf_key = "logging_logging"; $object["add_nav_title"] = _HIVE_TITLE_; $object["add_top_title"] = "Logging"; $object["add_head_title"] = "Logging"; break;
				};		
				break;		
			// User Related Titles		
			case "user":	
				switch(_HIVE_URL_CUR_[1]) {
					case "profile": $csrf_key = "user_profile"; $object["add_nav_title"] = _HIVE_TITLE_; $object["add_top_title"] = "Profile"; $object["add_head_title"] = "Profile"; break;
					case "switch": $csrf_key = "user_switch"; $object["add_nav_title"] = _HIVE_TITLE_; $object["add_top_title"] = "Switch"; $object["add_head_title"] = "Switch"; break;
					case "logout": $object["user"]->logout(); $object["eventbox"]->ok("You have been logged out!"); @Header("Location: /".hive_get_url_rel(array("start", false, false, false, false))); exit(); break;
					case "user": $csrf_key = "user_user"; $object["add_nav_title"] = _HIVE_TITLE_; $object["add_top_title"] = "Users"; $object["add_head_title"] = "Users"; break;
					case "group": $csrf_key = "user_group"; $object["add_nav_title"] = _HIVE_TITLE_; $object["add_top_title"] = "Groups"; $object["add_head_title"] = "Groups"; break;
					case "session": $csrf_key = "user_session"; $object["add_nav_title"] = _HIVE_TITLE_; $object["add_top_title"] = "Sessions"; $object["add_head_title"] = "Sessions"; break;
				};	
				break;		
			// System Related Titles	
			case "system":	
				switch(_HIVE_URL_CUR_[1]) {
					case "update": $csrf_key = "system_update"; $object["add_nav_title"] = _HIVE_TITLE_; $object["add_top_title"] = "Core Update"; $object["add_head_title"] = "Core Update"; break;
					case "updatesite": $csrf_key = "system_updatesite"; $object["add_nav_title"] = _HIVE_TITLE_; $object["add_top_title"] = "Site Update"; $object["add_head_title"] = "Site Update"; break;
					case "store": $csrf_key = "system_store"; $object["add_nav_title"] = _HIVE_TITLE_; $object["add_top_title"] = "Store"; $object["add_head_title"] = "Store"; break;
					case "about": $csrf_key = "system_about"; $object["add_nav_title"] = _HIVE_TITLE_; $object["add_top_title"] = "About"; $object["add_head_title"] = "About"; break;
					case "modules": $csrf_key = "system_modules"; $object["add_nav_title"] = _HIVE_TITLE_; $object["add_top_title"] = "Modules"; $object["add_head_title"] = "Modules"; break;
				};	
				break;	
		}; 	
	}	
	
	//////////////////////////////////////////////////////////////////////////////
	// Default CSRF Key
	//////////////////////////////////////////////////////////////////////////////
	$object["csrf"] = new x_class_csrf(_HIVE_SITE_COOKIE_.$csrf_key);	
	
	//////////////////////////////////////////////////////////////////////////////
	// Start Variables
	//////////////////////////////////////////////////////////////////////////////
	$object["add_head_theme"] 			= "dark"; # Dark/ Light
	$object["add_nav_button_title"] 	= false;
	$object["add_nav_button_url"] 		= false;
	$object["add_topbar_search"] 		= false;
	$object["add_head_ext"] 			= '<link rel="icon" type="image/x-icon" href="'._HIVE_URL_REL_.'/_core/_image/favicon.ico">';
	$object["add_topbar_theme"] 		= true;
	$object["add_topbar_image"] 		= _HIVE_URL_REL_."/_core/_image/user_image.png";
	
	//////////////////////////////////////////////////////////////////////////////
	// Start Elements
	//////////////////////////////////////////////////////////////////////////////
	if(!@$object["add_head_title"]) { $object["add_head_title"] = "Error";}
	hive__dashboard_header($object, $object["add_head_title"], @$object["add_head_ext"], @$object["add_head_theme"]);
	if($object["user"]->user_loggedIn) { hive__dashboard_nav($object, $object["add_nav_title"], $object["add_nav_button_url"]); }
	hive__dashboard_start($object);
	if($object["user"]->user_loggedIn) { hive__dashboard_topbar($object, $pfm, $object["add_topbar_theme"], $object["add_topbar_search"], $object["add_top_title"], $object["add_topbar_image"], $lang_ar); }
	hive__dashboard_content_start($object);
	
	//////////////////////////////////////////////////////////////////////////////
	// Login Areas Selection - Require
	//////////////////////////////////////////////////////////////////////////////
	if(!defined("_INT_SHOW_ACCESS_")) {
		switch(_HIVE_URL_CUR_[0]) {
			//////////////////////////////////////////////////////////////////////////////
			//////////////////////////////////////////////////////////////////////////////
			//////////////////////////////////////////////////////////////////////////////
			//////////////////////////////////////////////////////////////////////////////
			// Add more Pages non-secure Sites here if required!
			//////////////////////////////////////////////////////////////////////////////
			//////////////////////////////////////////////////////////////////////////////
			//////////////////////////////////////////////////////////////////////////////
			//////////////////////////////////////////////////////////////////////////////
			//case "login_activate": require_once(_HIVE_SITE_PATH_."/login/activate.php"); if(!defined("_INT_SHOW_FOUND_")) { define("_INT_SHOW_FOUND_", 1); } break;
			//case "login_register": require_once(_HIVE_SITE_PATH_."/login/register.php"); if(!defined("_INT_SHOW_FOUND_")) { define("_INT_SHOW_FOUND_", 1); } break;
			case "login_recover": require_once(_HIVE_SITE_PATH_."/login/recover.php"); if(!defined("_INT_SHOW_FOUND_")) { define("_INT_SHOW_FOUND_", 1); } break;
			case "login_mail_change": require_once(_HIVE_SITE_PATH_."/login/mail_change.php"); if(!defined("_INT_SHOW_FOUND_")) { define("_INT_SHOW_FOUND_", 1); } break;
			case "login_auth": if(!defined("_INT_SHOW_LOGIN_")) { define("_INT_SHOW_LOGIN_", 1); } break;
		};	
	}
	
	//////////////////////////////////////////////////////////////////////////////
	// Secured User Areas - Require
	//////////////////////////////////////////////////////////////////////////////
	if($object["user"]->user_loggedIn AND !defined("_INT_SHOW_FOUND_") AND !defined("_INT_SHOW_LOGIN_") AND !defined("_INT_SHOW_ACCESS_")) {
		switch(_HIVE_URL_CUR_[0]) {
			//////////////////////////////////////////////////////////////////////////////
			//////////////////////////////////////////////////////////////////////////////
			//////////////////////////////////////////////////////////////////////////////
			//////////////////////////////////////////////////////////////////////////////
			// Add more Pages here if required!
			//////////////////////////////////////////////////////////////////////////////
			//////////////////////////////////////////////////////////////////////////////
			//////////////////////////////////////////////////////////////////////////////
			//////////////////////////////////////////////////////////////////////////////
			//case false: case "":  break;
			case "start": require_once(_HIVE_SITE_PATH_."/start.php"); if(!defined("_INT_SHOW_FOUND_")) { define("_INT_SHOW_FOUND_", 1); } break;
			// File Related Pages
			case "file":
				require_once(_HIVE_SITE_PATH_."/file/file.php"); if(!defined("_INT_SHOW_FOUND_")) { define("_INT_SHOW_FOUND_", 1); }
				break;		
			// Backend Related Pages			
			case "backend":
				switch(_HIVE_URL_CUR_[1]) {
					case "constants": require_once(_HIVE_SITE_PATH_."/backend/constants.php"); if(!defined("_INT_SHOW_FOUND_")) { define("_INT_SHOW_FOUND_", 1); } break;
					case "mailtemplates": require_once(_HIVE_SITE_PATH_."/backend/mailtemplates.php"); if(!defined("_INT_SHOW_FOUND_")) { define("_INT_SHOW_FOUND_", 1); } break;
					case "apitoken": require_once(_HIVE_SITE_PATH_."/backend/apitoken.php"); if(!defined("_INT_SHOW_FOUND_")) { define("_INT_SHOW_FOUND_", 1); } break;
				}; break;		
			// Logging Related Pages
			case "logging":
				switch(_HIVE_URL_CUR_[1]) {
					case "mysql": require_once(_HIVE_SITE_PATH_."/logging/mysql.php"); if(!defined("_INT_SHOW_FOUND_")) { define("_INT_SHOW_FOUND_", 1); } break;
					case "curl": require_once(_HIVE_SITE_PATH_."/logging/curl.php"); if(!defined("_INT_SHOW_FOUND_")) { define("_INT_SHOW_FOUND_", 1); } break;
					case "visits": require_once(_HIVE_SITE_PATH_."/logging/visits.php"); if(!defined("_INT_SHOW_FOUND_")) { define("_INT_SHOW_FOUND_", 1); } break;
					case "blacklist": require_once(_HIVE_SITE_PATH_."/logging/blacklist.php"); if(!defined("_INT_SHOW_FOUND_")) { define("_INT_SHOW_FOUND_", 1); } break;
					case "referer": require_once(_HIVE_SITE_PATH_."/logging/referer.php"); if(!defined("_INT_SHOW_FOUND_")) { define("_INT_SHOW_FOUND_", 1); } break;
					case "benchmark": require_once(_HIVE_SITE_PATH_."/logging/benchmark.php"); if(!defined("_INT_SHOW_FOUND_")) { define("_INT_SHOW_FOUND_", 1); } break;
					case "js": require_once(_HIVE_SITE_PATH_."/logging/js.php"); if(!defined("_INT_SHOW_FOUND_")) { define("_INT_SHOW_FOUND_", 1); } break;
					case "mail": require_once(_HIVE_SITE_PATH_."/logging/mail.php"); if(!defined("_INT_SHOW_FOUND_")) { define("_INT_SHOW_FOUND_", 1); } break;
					case "logging": require_once(_HIVE_SITE_PATH_."/logging/logging.php"); if(!defined("_INT_SHOW_FOUND_")) { define("_INT_SHOW_FOUND_", 1); } break;
				}; break;	
			// User Related Pages
			case "user":	
				switch(_HIVE_URL_CUR_[1]) {
					case "profile": require_once(_HIVE_SITE_PATH_."/user/profile.php"); if(!defined("_INT_SHOW_FOUND_")) { define("_INT_SHOW_FOUND_", 1); } break;
					case "switch": require_once(_HIVE_SITE_PATH_."/user/switch.php"); if(!defined("_INT_SHOW_FOUND_")) { define("_INT_SHOW_FOUND_", 1); } break;
					case "logout": require_once(_HIVE_SITE_PATH_."/user/logout.php"); if(!defined("_INT_SHOW_FOUND_")) { define("_INT_SHOW_FOUND_", 1); } break;
					case "user": require_once(_HIVE_SITE_PATH_."/user/user.php"); if(!defined("_INT_SHOW_FOUND_")) { define("_INT_SHOW_FOUND_", 1); } break;
					case "group": require_once(_HIVE_SITE_PATH_."/user/group.php"); if(!defined("_INT_SHOW_FOUND_")) { define("_INT_SHOW_FOUND_", 1); } break;
					case "session": require_once(_HIVE_SITE_PATH_."/user/session.php"); if(!defined("_INT_SHOW_FOUND_")) { define("_INT_SHOW_FOUND_", 1); } break;
				}; break;	
			// System Related Pages
			case "system":	
				switch(_HIVE_URL_CUR_[1]) {
					case "update": require_once(_HIVE_SITE_PATH_."/system/update.php"); if(!defined("_INT_SHOW_FOUND_")) { define("_INT_SHOW_FOUND_", 1); } break;
					case "updatesite": require_once(_HIVE_SITE_PATH_."/system/updatesite.php"); if(!defined("_INT_SHOW_FOUND_")) { define("_INT_SHOW_FOUND_", 1); } break;
					case "store": require_once(_HIVE_SITE_PATH_."/system/store.php"); if(!defined("_INT_SHOW_FOUND_")) { define("_INT_SHOW_FOUND_", 1); } break;
					case "modules": require_once(_HIVE_SITE_PATH_."/system/modules.php"); if(!defined("_INT_SHOW_FOUND_")) { define("_INT_SHOW_FOUND_", 1); } break;
					case "about": require_once(_HIVE_SITE_PATH_."/system/about.php"); if(!defined("_INT_SHOW_FOUND_")) { define("_INT_SHOW_FOUND_", 1); } break;
				}; break;	
		};		
	}
	
	//////////////////////////////////////////////////////////////////////////////
	// Special Areas
	//////////////////////////////////////////////////////////////////////////////
		if(defined("_INT_SHOW_LOGIN_") AND !defined("_INT_SHOW_FOUND_") AND !$object["user"]->user_loggedin) {
			// Display Login Page if Required
			require_once(_HIVE_SITE_PATH_."/login/auth.php");
		} elseif(!defined("_INT_SHOW_FOUND_")) {
			// Display No Found Page if Required
			hive__dashboard_404($object);
		} elseif(defined("_INT_SHOW_ACCESS_")) {
			// Display No Access Page if Required
			hive__dashboard_401($object);
		}
	
	//////////////////////////////////////////////////////////////////////////////
	// Finalize
	//////////////////////////////////////////////////////////////////////////////
		// End Dashboard Content
		hive__dashboard_content_end($object);
		
		// End Dashboard Main
		hive__dashboard_end($object);
		
		// Show EventBox Classes Objects if required
		$object["eventbox"]->show("Close");
		
		// Show Cookiebanner if required
		x_cookieBanner(_HIVE_SITE_COOKIE_);
		
		// Display Footer and End Website
		hive__dashboard_footer($object, _HIVE_CREATOR_);