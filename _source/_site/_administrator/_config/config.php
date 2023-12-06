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
	///////////////////////////////////////////////////////////////////
	// HIVE Build Number
	///////////////////////////////////////////////////////////////////
	define('_HIVE_BUILD_',  				"100"); 
	///////////////////////////////////////////////////////////////////
	// Required PHP Modules
	///////////////////////////////////////////////////////////////////
	define('_HIVE_PHP_MODS_',  				array("curl", "zip", "gd")); 
	///////////////////////////////////////////////////////////////////
	// Site SEO URLs?
	///////////////////////////////////////////////////////////////////
	define('_HIVE_URL_SEO_', 				false);
	///////////////////////////////////////////////////////////////////
	// Site Get Location Names
	///////////////////////////////////////////////////////////////////
	define('_HIVE_URL_GET_', 				array("fpa_l1", "fpa_l2", "fpa_l3", "fpa_l4", "fpa_l5"));
	///////////////////////////////////////////////////////////////////
	// Theme Settings
	///////////////////////////////////////////////////////////////////
	define("_HIVE_THEME_DEFAULT_", 			"dynamic");
	define("_HIVE_THEME_ARRAY_", 			array("dynamic"));
	define("_HIVE_THEME_COLOR_DEFAULT_", 	"#ff5707");
	#####################################################################################
	## Permission Settings
	#####################################################################################	
		# Here you can add permissions which can than be setup in the administrator panel!
		$object["set"]["permission"] = array(
				array("admin_user", "User Management", "Can manage, edit and create users!"),
				array("admin_backend", "Backend Management", "Can manage backend functionalities!"),
				array("admin_logging", "Logging Management", "Can manage logging functionalities!"),
				array("admin_files", "Files Management", "Can manage, edit and create files!"),
				array("admin_system", "System Management", "Can manage system functionalities!"));
	///////////////////////////////////////////////////////////////////
	// Site Title
	///////////////////////////////////////////////////////////////////
	$object["var"]->setup("_HIVE_TITLE_", "Administrator", "The websites Title!");
	$object["var"]->setup("_HIVE_TITLE_SPACER_", " - ", "The websites Title Space for Tabs and more!");
	///////////////////////////////////////////////////////////////////
	// Mail Configuration
	///////////////////////////////////////////////////////////////////
	$object["var"]->setup("_SMTP_SENDER_MAIL_", "example@example", "Default Sender Mail Adr");		# 
	$object["var"]->setup("_SMTP_SENDER_NAME_", "Max Mustermann", "Default Sender Mail Name");		# 
	$object["var"]->setup("_SMTP_MAILS_IN_HTML_", "1", "All Mails sended as HTML? (1/0)");		# 
	$object["var"]->setup("_SMTP_DEBUG_", "0", "Mail Debug Mode (0, 1, 2, 3) - Use 0 for Production as this will result Debug Output on site!");
	$object["var"]->setup("_SMTP_MAILS_HEADER_", '<!doctype html><html><head><meta name="viewport" content="width=device-width, initial-scale=1.0"/><meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /><style>body { background-color: #121212; font-family: sans-serif; -webkit-font-smoothing: antialiased; font-size: 14px; line-height: 1.4; margin: 0; padding: 0; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; } .content { background: #FFFFFF; box-sizing: border-box; display: block; margin: 0 auto; max-width: 580px; padding: 10px; border-radius: 5px; margin-top: 15px;  }  .footer { clear: both; margin-top: 10px; text-align: center; width: 100%; color: #000000; font-size: 12px; text-align: center;  }  h1, h2, h3, h4 { color: #000000; font-family: sans-serif; font-weight: 400; line-height: 1.4; margin: 0; margin-bottom: 30px; }  h1 { font-size: 35px; font-weight: 300; text-align: center; text-transform: capitalize; }  a { color: blue; text-decoration: none; } hr { border: 0; border-bottom: 1px solid #242424; margin: 20px 0; }  @media only screen and (max-width: 620px) { div.content { margin-top: 2vw !important; margin-left: 2vw !important; margin-right: 2vw !important;}}</style></head><body><div class="content">', "Default Header for Mails");
	$object["var"]->setup("_SMTP_MAILS_FOOTER_", '</div></body></html>', "Default Footer for Mails");
	$object["var"]->setup("_SMTP_INSECURE_", "1", "Allow insecure SSL Connections? (1/0)");	
	$object["var"]->setup("_SMTP_HOST_", "0", "SMTP Host");		
	$object["var"]->setup("_SMTP_PORT_", "0", "SMTP Port");
	$object["var"]->setup("_SMTP_AUTH_", "ssl", "SMTP Auth (ssl/tls/false)");
	$object["var"]->setup("_SMTP_USER_", "example@example", "SMTP Username");	
	$object["var"]->setup("_SMTP_PASS_", "", "SMTP Password");		
	///////////////////////////////////////////////////////////////////
	// Site Configuration
	///////////////////////////////////////////////////////////////////
	$object["var"]->setup("_HIVE_URL_", $object["url"], "URL where this page is visible");		
	$object["var"]->setup("_HIVE_PHP_DEBUG_", "1", "Show PHP Errors on website? (1/0)");		
	$object["var"]->setup("_HIVE_MYSQL_DEBUG_", "0", "Stop and Show MySQL Errors on Page if Happening? (Will always be logged in x_log_mysql table!) 1/0");		
	///////////////////////////////////////////////////////////////////
	// Lang Configuration
	///////////////////////////////////////////////////////////////////
	define("_HIVE_LANG_DEFAULT_", 			"gb"); # Array with Default Language
	define("_HIVE_LANG_ARRAY_", 			array("gb")); # Array with valid Languages
	define("_HIVE_LANG_DB_", 				false); # False = Use Language Files in SITE/_lang / True = Use  Language Database
	///////////////////////////////////////////////////////////////////
	// Captcha Configuration
	///////////////////////////////////////////////////////////////////
	define("_CAPTCHA_CODE_", 		mt_rand(1000, 9999)); 
	define("_CAPTCHA_COLORS_", 		false); 
	$object["var"]->setup("_CAPTCHA_LINES_", "7", "Count of Lines in Captcha");
	$object["var"]->setup("_CAPTCHA_SQUARES_", "7", "Count of Squares in Captcha");
	$object["var"]->setup("_CAPTCHA_HEIGHT_", "70", "Captcha Height Image");
	$object["var"]->setup("_CAPTCHA_WIDTH_", "200", "Captcha Width Image");
	$object["var"]->setup("_CAPTCHA_FONT_PATH_", "0", "If false Default Font will be used.");
	///////////////////////////////////////////////////////////////////
	// Redis Configuration
	///////////////////////////////////////////////////////////////////
	$object["var"]->setup("_REDIS_", "0", "Redis Activated? 1/0");
	$object["var"]->setup("_REDIS_HOST_", "localhost", "Redis Host");
	$object["var"]->setup("_REDIS_PORT_", "6379", "Redis Port");
	$object["var"]->setup("_REDIS_PREFIX_", $object["prefix"], " Redis Prefix");
	///////////////////////////////////////////////////////////////////
	// Tinymce Configuration
	///////////////////////////////////////////////////////////////////
	$object["var"]->setup("_TINYMCE_PLUGINS_", "preview importcss searchreplace autolink directionality visualblocks visualchars fullscreen image link media codesample table charmap pagebreak nonbreaking anchor advlist lists wordcount help charmap quickbars emoticons code", "TinyMCE Plugins");
	$object["var"]->setup("_TINYMCE_MENU_BAR_", "file edit view insert format table help", "TinyMCE Menu Bar");
	$object["var"]->setup("_TINYMCE_TOOL_BAR_", "undo redo | bold italic underline strikethrough | blocks fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent | numlist bullist | image media link", "TinyMCE Tool Bar");
	///////////////////////////////////////////////////////////////////
	// More Configuration
	///////////////////////////////////////////////////////////////////
	$object["var"]->setup("_HIVE_CURL_LOGGING_", "1", "Log CURL Class Requests? (1/0)");
	$object["var"]->setup("_HIVE_IP_LIMIT_", "100000", "Block IPs after X Failures");
	$object["var"]->setup("_HIVE_REFERER_", "0", "Log Referers? (1/0)");
	$object["var"]->setup("_HIVE_CSRF_TIME_", "2000", "Default CSRF Code Valid Time in Seconds	");
	$object["var"]->setup("_CRON_ONLY_CLI_", "1", "1 - Only Cronjob Execution from Command Line | 0 - Allow Cronjob Execution in Browser");
	///////////////////////////////////////////////////////////////////
	// Updater Configuration
	///////////////////////////////////////////////////////////////////
	$object["var"]->setup("_UPDATER_TITLE_", "Administrator", " Title for the Updater on this Site");
	$object["var"]->setup("_UPDATER_CODE_", "0", " Code needed for Update? (can be false)	");
	///////////////////////////////////////////////////////////////////
	// HTAccess
	///////////////////////////////////////////////////////////////////
	$object["var"]->setup("_HIVE_HTACCESS_WRITE_", "0", "1 - Create HTAccess | 0 - Do Not Create HTAccess");
	$object["var"]->setup("_HIVE_HTACCESS_HTTPS_FORWARD_", "0", "1 - Forward to HTTPS | 0 - Not Forward");
	$object["var"]->setup("_HIVE_HTACCESS_WWW_FORWARD_", "0", "1 - Forward to HTTPS | 0 - Not Forward");
	$object["var"]->setup("_HIVE_HTACCESS_REFRESH_", "0", "1 - REFRESH MODULE | 0 - Not Refresh Module");
	$object["var"]->setup("_HIVE_SITEMAP_URL_", "0", "URL of the Sitemap for Current Site to include in Robots");
	$object["var"]->setup("_HIVE_ROBOT_SPAWN_", "0", " 1 - Allow All | 2 - Allow nothing");
	///////////////////////////////////////////////////////////////////
	// User Settings
	///////////////////////////////////////////////////////////////////
	$object["var"]->setup("_USER_MAX_SESSION_", "7", "Maximum Days Sessions/Cookies are Valid");	
	$object["var"]->setup("_USER_TOKEN_TIME_", "300", "Time in Minutes token out of Activation Mails are Valid");	
	$object["var"]->setup("_USER_AUTOBLOCK_", "0", " Block Users after X Fail Logins (can be false)");	
	$object["var"]->setup("_USER_WAIT_COUNTER_", "10", "Time in Minutes User has to wait between Requests (anti flood)");	
	$object["var"]->setup("_USER_LOG_SESSIONS_", "1", "Log old sessions? (Logins, Recoverys, Activations, Mail Changes) (1/0)");	
	$object["var"]->setup("_USER_LOG_IP_", "0", "Log User IPs in Database (1/0)");	
	$object["var"]->setup("_USER_REC_DROP_", "1", "1 - Remove Recovery Keys after user Succesfully Logged In | 0 - Preserve Keys");	
	$object["var"]->setup("_USER_MULTI_LOGIN_", "0", "1 - Allow Multi Login  | 0 - Disable Multi Login (old session logout)");	
	$object["var"]->setup("_USER_PF_SIGNS_", "7", " Passwordfilter: Min Signs");	
	$object["var"]->setup("_USER_PF_CAPSIGNS_", "1", "Passwordfilter: Min Capital Signs");	
	$object["var"]->setup("_USER_PF_SMSIGNS_", "1", "Passwordfilter: Min Small Signs");	
	$object["var"]->setup("_USER_PF_SPSIGNS_", "0", "Passwordfilter: Min Special Signs");	
	$object["var"]->setup("_USER_PF_NUMSIGNS_", "1", "  Passwordfilter: Min Numeric Signs");	