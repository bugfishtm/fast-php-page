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
	*/ if(!is_array($object)) { http_response_code(404); Header("Location: ../"); exit(); }
	#####################################################################################
	## Website Settings
	#####################################################################################
		# Build Number for Updates
		define('_HIVE_BUILD_',  				"200"); 
		# Website Title for Tabs and More
		define('_HIVE_TITLE_',  				"FP²"); 
		# Title Spacer for Tabs in Browser
		define('_HIVE_TITLE_SPACER_',  			" - "); 
		# Show PHP Errors on website? (true/false)
		define('_HIVE_PHP_DEBUG_',  			true); 
		# Array with needed PHP Modules, if not existant error is shown (example: array("mysqli", "mbstring", "gd")) 
		define('_HIVE_PHP_MODS_',  				array()); 
		# Stop and Show MySQL Errors on Page if Happening? (Will always be logged in x_log_mysql table!) (true/false)
		define('_HIVE_MYSQL_DEBUG_',  			true); 
		
	#####################################################################################
	## URL Settings
	#####################################################################################
		# URL of this Page // Setting can be Overwritten as from settings.php
		# This is only needed for multi site purposes and if automatically fetching per browser url
		# is deactivated
		//define('_HIVE_URL_',  					$object["url"]); 
		
	#####################################################################################
	## URL Navigation Settings
	#####################################################################################
		// STRING - GET VARIABLE SEO IN HTACCESS  | 0 - No SEO URLs Using
		define('_HIVE_URL_SEO_',  				false);  
		# Only neeed if _HIVE_URL_SEO_ == false [Name for Get Location Variables]
		define('_HIVE_URL_GET_', 				array("site", "second", false, false, false)); 
		#_HIVE_URL_CUR_ Contains current url elements
		#_HIVE_URL_REL_ Relative Folder Path
		
	#####################################################################################
	## Language Settings
	#####################################################################################
		define("_HIVE_LANG_DEFAULT_", 			"gb"); # Array with Default Language
		define("_HIVE_LANG_ARRAY_", 			array("gb", "de")); # Array with valid Languages
		define("_HIVE_LANG_DB_", 				false); # False = Use Language Files in SITE/_lang / True = Use Language Database
		#_HIVE_LANG_ Contains current choosen Language
		
	#####################################################################################
	## Theme/Color Settings
	#####################################################################################
		define("_HIVE_THEME_DEFAULT_", 			"default"); # Default Used Theme
		define("_HIVE_THEME_ARRAY_", 			array("default", "green", "purple", "orange", "dynamic")); # Array with valid Themes
		define("_HIVE_THEME_COLOR_DEFAULT_", 	"#FFFF00"); # Default Color for Dynamic Theme Colors
		#_HIVE_THEME_ Contains current choosen theme
		#_HIVE_COLOR_ Contains current choosen theme

	#####################################################################################
	## Permission Settings
	#####################################################################################	
		# Here you can add permissions which can than be setup in the administrator panel!
		//$object["set"]["permission"] = array(
		//		array("perm_ident", "Permission Title", "Permission Description"),
		//		array("perm_ident1", "Permission Title", "Permission Description"),
		//		array("perm_ident2", "Permission Title", "Permission Description"));

	#####################################################################################
	## Mail Settings (Only needed if you use Mail Functionalities!)
	#####################################################################################
		# Default Sender Mail Adr
		//define("_SMTP_SENDER_MAIL_", 	"");
		# Default Sender Mail Name
		//define("_SMTP_SENDER_NAME_", 	"");
		# All Mails sended as HTML? (false/true)
		//define("_SMTP_MAILS_IN_HTML_", 	true); 
		# Mail Debug Mode (0, 1, 2, 3) - Use 0 for Production as this will result Debug Output on site!
		//define("_SMTP_DEBUG_", 			0); 
		# Default Header for Mails
		//define("_SMTP_MAILS_HEADER_", 	""); 
		# Default Footer for Mails
		//define("_SMTP_MAILS_FOOTER_", 	""); 
		# Allow insecure SSL Connections? (true/false)
		//define("_SMTP_INSECURE_", 		true); 
		# SMTP Host // Setting can be Overwritten as from settings.php
		//define("_SMTP_HOST_", 			true); 
		# SMTP Port // Setting can be Overwritten as from settings.php
		//define("_SMTP_PORT_", 			true); 
		# SMTP Auth (ssl/tls/false) // Setting can be Overwritten as from settings.php
		//define("_SMTP_AUTH_", 			true); 
		# SMTP Username // Setting can be Overwritten as from settings.php
		//define("_SMTP_USER_", 			true); 
		# SMTP Password // Setting can be Overwritten as from settings.php
		//define("_SMTP_PASS_", 			true); 
		
	#####################################################################################
	## Redis Settings (Only needed if you use Redis Functionalities!)
	#####################################################################################
		# Redis Activated? False/True
		//define("_REDIS_", 				false); 
		# Redis Host
		//define("_REDIS_HOST_", 			false); 
		# Redis Port
		//define("_REDIS_PORT_", 			false); 
		# Redis Prefix
		//define("_REDIS_PREFIX_", 		false); 
		
	#####################################################################################
	## Captcha Settings (Only needed if you want to change these default settings!)
	#####################################################################################
		# Random Code for Captcha
		//define("_CAPTCHA_CODE_", 		mt_rand(1000, 9999)); 
		# Count of Lines in Captcha
		//define("_CAPTCHA_LINES_", 		mt_rand(5, 10)); 
		# Count of Squares in Captcha
		//define("_CAPTCHA_SQUARES_", 	mt_rand(5, 10)); 
		# Captcha Height Image
		//define("_CAPTCHA_HEIGHT_", 		"70"); 
		# Captcha Width Image
		//define("_CAPTCHA_WIDTH_", 		"200"); 
		# Colors for Captcha (Optional, can be false)
		//define("_CAPTCHA_COLORS_", 		false); 
		# If false Default Font will be used.
		//define("_CAPTCHA_FONT_PATH_", 	false); 
		
	#####################################################################################
	## TinyMCE Settings (Only needed if you want to change these default settings!)
	#####################################################################################
		# TinyMCE Plugins
		//define("_TINYMCE_PLUGINS_", "preview importcss searchreplace autolink directionality visualblocks visualchars fullscreen image link media codesample table charmap pagebreak nonbreaking anchor advlist lists wordcount help charmap quickbars emoticons code");
		# TinyMCE Menu Bar
		//define("_TINYMCE_MENU_BAR_", "file edit view insert format table help");
		# TinyMCE Tool Bar
		//define("_TINYMCE_TOOL_BAR_", "undo redo | bold italic underline strikethrough | blocks fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent | numlist bullist | image media link");