<?php
	if(!is_array($object)) { @http_response_code(404); echo "No hardlinking!"; exit(); }
	# Configuration File for Specific Page
	
	// Site Options	
		define('_HIVE_TITLE_',  			"Bugfish");
		define('_HIVE_TITLE_SPACER_',  		" - ");
		define('_HIVE_PHP_DEBUG_',  		true);
		define('_HIVE_PHP_MODS_',  			false);
		define('_HIVE_MYSQL_DEBUG_',  		false);		
		define('_HIVE_CSRF_TIME_',  		false);		
		
	//URL Options
		define('_HIVE_URL_SEO_',  		false);
		define('_HIVE_URL_GET_', 		array("site", false, false, false, false)); # Only neeed if _HIVE_URL_SEO_ == false
		define('_HIVE_URL_START_', 		array(false, false, false, false, false)); # Only neeed if _HIVE_URL_SEO_ == false
		#_HIVE_URL_CUR_ Contains current url elements
		#_HIVE_URL_REL_ Relative Folder Path
	
	// Theme Change Options
		define("_HIVE_THEME_CHANGE_", 	true);	
		define("_HIVE_THEME_COLOR_CHANGE_", true);	
		define("_HIVE_THEME_ARRAY_", 	array("default", "orange", "purple", "green"));
		define("_HIVE_THEME_DEFAULT_", 	"default");
		define("_HIVE_THEME_COLOR_DEFAULT_", false);
		#_HIVE_THEME_ Contains current choosen theme
		#_HIVE_COLOR_ Contains current choosen theme
	
	// Build Options
		define("_HIVE_BUILD_", 					"120");
		
	// Ip Logging and Blacklisting
		define("_HIVE_IP_LIMIT_", 				false);
		define("_HIVE_IP_REFERER_", 			false);
	
	// HTAccess Options
		define("_HIVE_HTACCESS_HTTPS_FORWARD_",	false); // 1 - Forward to HTTPS | 0 - Not Forward
		define("_HIVE_HTACCESS_WWW_FORWARD_", 	false); // 1 - Forward to HTTPS | 0 - Not Forward
		define("_HIVE_HTACCESS_REFRESH_", 		false); // 1 - REFRESH MODULE | 0 - Not Refresh Module
		define("_HIVE_HTACCESS_SEO_", 			false); // STRING - GET VARIABLE (XFP IS "x32rnx")  | 0 - Not Refresh Module

	// Sitemap/Robot Options
		define("_HIVE_SITEMAP_PATH_", 	false);
		define("_HIVE_SITEMAP_URL_", 	false);
		define("_HIVE_ROBOT_SPAWN_", 	false); 	// 1 - Allow All | 2 - Allow nothing

	// Language Options
		define("_HIVE_LANG_DEFAULT_", 	"en");
		define("_HIVE_LANG_ARRAY_", 	array("en", "de"));
		define("_HIVE_LANG_CHANGE_", 	true);	
		define("_HIVE_LANG_DB_", 		false); # false = file mode / true = db mode	
		#_HIVE_LANG_ Contains current choosen Language
	
	// SMTP Settings
		define("_SMTP_HOST_", 			false);
		define("_SMTP_PORT_", 			false);
		define("_SMTP_AUTH_", 			false);
		define("_SMTP_USER_", 			false);
		define("_SMTP_PASS_", 			false);
		define("_SMTP_SENDER_MAIL_", 	false);
		define("_SMTP_SENDER_NAME_", 	false);
		define("_SMTP_MAILS_IN_HTML_", 	false);
		define("_SMTP_DEBUG_", 			false);
		define("_SMTP_MAILS_HEADER_", 	false);
		define("_SMTP_MAILS_FOOTER_", 	false);
		define("_SMTP_INSECURE_", 		false);	
	
	// User Settings
		define("_USER_MAX_SESSION_", 	false);
		define("_USER_TOKEN_TIME_", 	false);
		define("_USER_AUTOBLOCK_", 		false);
		define("_USER_WAIT_COUNTER_", 	false);
		define("_USER_LOG_SESSIONS_", 	false);
		define("_USER_LOG_IP_", 		false);	
	
	// Redis Settings
		define("_REDIS_", 				false); # Redis Activated?
		define("_REDIS_HOST_", 			false);
		define("_REDIS_PORT_", 			false);
		define("_REDIS_PREFIX_", 		false);	
	
	// Captcha Setup
		define("_CAPTCHA_CODE_", 		false);
		define("_CAPTCHA_LINES_", 		false);
		define("_CAPTCHA_SQUARES_", 	false);
		define("_CAPTCHA_HEIGHT_", 		false);
		define("_CAPTCHA_WIDTH_", 		false);
		define("_CAPTCHA_COLORS_", 		false);
	
	// Updater Setup
		define("_INSTALLER_TITLE_", 	"Dashboard Theme");
		define("_INSTALLER_PRODUCT_", 	"Dashboard Theme");
		define("_INSTALLER_CODE_", 		"whiterabbit"); // Can be false // Code for Updates
		
	/* Set Up The NAV */
		$sub = array();
		$sub[0]["nav_title"] = "General";
		$sub[1]["nav_title"] = "Charts";
		$sub[0]["nav_loc"] 	= hive_get_url_rel(array("general", false, false));
		$sub[1]["nav_loc"] 	= hive_get_url_rel(array("charts", false, false));
		$sub[0]["nav_img"] = "bx bx-shower";
		$sub[1]["nav_img"] = "bx bx-reflect-horizontal";
		$sub[0]["nav_sub"] = false;
		$sub[1]["nav_sub"] = false;
	
	/* Set Up The NAV */
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
	
