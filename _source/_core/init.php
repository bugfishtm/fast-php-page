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
	*/ if(!is_array($object)) { 
		@http_response_code(404); echo "No hardlinking! If this error persist try to reinstall this software by deleting settings.php in the websites root folder!"; exit(); 
	}
	
	// Define Defaults
	define("_HIVE_CREATOR_", 'Powered by <a href="https://github.com/bugfishtm" rel="noopener" target="_blank">Bugfish</a> Fast-PHP Framework!');
	
	// Includes and Requirements
	foreach (glob($object["path"]."/_framework/classes/x_*.php") as $filename) { if(@basename($filename) == "index.php") { continue; } require_once $filename;}
	foreach (glob($object["path"]."/_framework/functions/x_*.php") as $filename) { if(@basename($filename) == "index.php") { continue; } require_once $filename;}
	foreach (glob($object["path"]."/_core/_lib/lib.*.php") as $filename) { if(@basename($filename) == "index.php") { continue; } require_once $filename;}	
	
	// Instance Settings
	if(file_exists($object["path"]."/internal.php")) { require_once($object["path"]."/internal.php"); 
	} else { hive_error_full("Wrong Document Root", "ERROR", "Please reinstall this software by deleting settings.php in the root folder!<br />The path variable is not set correctly, so internal.php could not be found.", true, 503);}	
	
	// Start Session
	session_start();	

	// Constants
	$object["prefix"]						= @$mysql["prefix"];
	define("_HIVE_PREFIX_", 				@$mysql["prefix"]);
	define("_HIVE_COOKIE_", 				@$object["cookie"]);
	define("_HIVE_PATH_", 					@$object["path"]);
	define('_HIVE_PATH_PRIVATE_', 			@$object["path"]."/_restricted");
	define('_HIVE_PATH_FILE_GLOB_', 		@$object["path"]."/_restricted/__file/");
	define('_HIVE_PATH_FILE_GLOBCACHE_', 	@$object["path"]."/_restricted/__cache/");
	define('_HIVE_PATH_PUBLIC_', 			@$object["path"]."/_public");	

	// Default Table Constants
	define("_TABLE_LOG_", 				$object["prefix"]."sys_log");
	define("_TABLE_LOG_IP_", 			$object["prefix"]."sys_ip");
	define("_TABLE_LOG_JS_", 			$object["prefix"]."sys_js");
	define("_TABLE_LOG_CURL_", 			$object["prefix"]."sys_curl");
	define("_TABLE_LOG_MAIL_", 			$object["prefix"]."sys_mail");
	define("_TABLE_LOG_BENCHMARK_", 	$object["prefix"]."sys_benchmark");
	define("_TABLE_LOG_MYSQL_", 		$object["prefix"]."sys_mysql");
	define("_TABLE_LOG_REFERER_", 		$object["prefix"]."sys_referer");
	define("_TABLE_LOG_VISIT_", 		$object["prefix"]."sys_hitcounter");
	define("_TABLE_USER_", 				$object["prefix"]."sys_user");
	define("_TABLE_USER_SESSION_",		$object["prefix"]."sys_user_session");
	define("_TABLE_USER_PERM_",			$object["prefix"]."sys_user_perm");
	define("_TABLE_USER_GROUP_",		$object["prefix"]."sys_user_group");
	define("_TABLE_USER_GROUP_PERM_",	$object["prefix"]."sys_user_group_perm");
	define("_TABLE_USER_GROUP_LINK_",	$object["prefix"]."sys_user_group_link");
	define("_TABLE_VAR_", 				$object["prefix"]."sys_var");
	define("_TABLE_LANG_",				$object["prefix"]."sys_lang");
	define("_TABLE_FILE_",				$object["prefix"]."sys_file");
	define("_TABLE_FILE_FOLDER_",		$object["prefix"]."sys_file_folder");
	define("_TABLE_MAIL_TPL_",			$object["prefix"]."sys_template_mail");
	define("_TABLE_API_", 				$object["prefix"]."sys_api");

	// Internal.php Executions for hive mode
	if($hive_mode_override) { define("_HIVE_MODE_DEFAULT_", $hive_mode_override); } else { define("_HIVE_MODE_DEFAULT_", $hive_mode_default); } unset($hive_mode_default);
	if($hive_mode_override) { if(_HIVE_ALLOW_ADMIN_) {define("_HIVE_MODE_ARRAY_", array($hive_mode_override, _HIVE_ADMIN_SITE_));} else {define("_HIVE_MODE_ARRAY_", array($hive_mode_override));} } 
		elseif(@is_array(@$hive_mode_array)) { if(_HIVE_ALLOW_ADMIN_) { array_push($hive_mode_array, _HIVE_ADMIN_SITE_); define("_HIVE_MODE_ARRAY_", $hive_mode_array);} else {define("_HIVE_MODE_ARRAY_", $hive_mode_array);} } 
	if(!$hive_mode_override) {	
		$directory = $object["path"]."/_site";
		$folders = array();
		if (is_dir($directory)) {
			$contents = scandir($directory);
			foreach ($contents as $item) {
				$itemPath = $directory . '/' . $item;
				if (is_dir($itemPath) && !in_array($item, array('.', '..', "__internal"))) {
					$folders[] = $item;
				}
			}
		} if(_HIVE_ALLOW_ADMIN_) {define("_HIVE_MODE_ARRAY_", $folders);} 
		else {
			if (($key = array_search(_HIVE_ADMIN_SITE_, $folders)) !== false) { 
				unset($folders[$key]);
			} define("_HIVE_MODE_ARRAY_", $folders);
		} 	 
	} unset($hive_mode_array); unset($directory);	unset($folders); unset($contents); unset($key);	
	//////////////////////////////////////////////////////////////////////////////////////////
	// Switch _HIVE_MODE_
	//////////////////////////////////////////////////////////////////////////////////////////
	if(!isset($_SESSION[_HIVE_COOKIE_."hive_mode"])) { @$_SESSION[_HIVE_COOKIE_."hive_mode"] = _HIVE_MODE_DEFAULT_; }		
	if(@is_string(@$_SESSION[_HIVE_COOKIE_."hive_mode"]) AND  @in_array(@$_SESSION[_HIVE_COOKIE_."hive_mode"], @_HIVE_MODE_ARRAY_)) {
	} else {  
		$_SESSION[_HIVE_COOKIE_."hive_mode"] = _HIVE_MODE_DEFAULT_;
	}			
	if(is_array(_HIVE_MOD_FETCH_) AND !$hive_mode_override) {
		$found_new = false;
		$found_url = false;
		if(is_array(_HIVE_MOD_FETCH_)) { 
			foreach(_HIVE_MOD_FETCH_ as $key => $value) {
				if( strpos($_SERVER['HTTP_HOST'], $value["url"]) > -1)  {
					$found_new = $value["mode"];		
					$found_url = $value["mode"];		
				}					
			}
		}
		if(!$found_new) { hive_error_full("ERROR", "Runtime", "Site Mode could not be determined by URL!", true, 503); }
		else {
			$_SESSION[_HIVE_COOKIE_."hive_mode"] = $found_new;
			define("_HIVE_URL_", $found_url."/");
		}
	}		
	// Override _HIVE_MODE_
	if($hive_mode_override AND $_SESSION[_HIVE_COOKIE_."hive_mode"] != $hive_mode_override) {
		if(_HIVE_ALLOW_ADMIN_ AND $_SESSION[_HIVE_COOKIE_."hive_mode"] == _HIVE_ADMIN_SITE_) {
		} elseif(!_HIVE_ALLOW_ADMIN_ AND $_SESSION[_HIVE_COOKIE_."hive_mode"] == _HIVE_ADMIN_SITE_) {
			$_SESSION[_HIVE_COOKIE_."hive_mode"] = $hive_mode_override;
		} else {
			$_SESSION[_HIVE_COOKIE_."hive_mode"] = $hive_mode_override;
		}
	} unset($hive_mode_override);  define("_HIVE_MODE_", $_SESSION[_HIVE_COOKIE_."hive_mode"]);	
	
	// Current Site Related
	define('_HIVE_SITE_PATH_', 			$object["path"]."/_site/"._HIVE_MODE_."/");	
	define('_HIVE_SITE_COOKIE_', 		_HIVE_COOKIE_."_"._HIVE_MODE_);	
	define('_HIVE_SITE_PREFIX_', 		_HIVE_PREFIX_."_"._HIVE_MODE_."_");	
	
	// Inject Site Pre Options if there are any
	if(file_exists($object["path"]."/_site/"._HIVE_MODE_."/_config/config_pre.php")) { require_once($object["path"]."/_site/"._HIVE_MODE_."/_config/config_pre.php"); }		

	// Get Site Mode Library Files
	foreach (glob($object["path"]."/_site/"._HIVE_MODE_."/_lib/lib.*.php") as $filename) { if(@basename($filename) == "index.php") { continue; } require_once $filename;}		

	// Get Site Mode Library Files
	foreach (glob($object["path"]."/_site/"._HIVE_MODE_."/_box/box.*.php") as $filename) { if(@basename($filename) == "index.php") { continue; } require_once $filename;}		

	// Get Site Mode Library Files
	foreach (glob($object["path"]."/_site/"._HIVE_MODE_."/_procedure/procedure.*.php") as $filename) { if(@basename($filename) == "index.php") { continue; } require_once $filename;}			
		
	// MySQL Initializations
	$object["mysql"] = new x_class_mysql(@$mysql["host"], @$mysql["user"], @$mysql["pass"], @$mysql["db"], @$mysql["port"]);	
	if ($object["mysql"]->lasterror != false) { $object["mysql"]->displayError(true, 503); }		
	$object["mysql"]->log_config(_TABLE_LOG_MYSQL_, _HIVE_MODE_);		
	foreach (glob(_HIVE_PATH_."/_core/_mysql/mysql.*.php") as $filename){ if(@basename($filename) == "index.php") { continue; } 
	if(!$object["mysql"]->table_exists($object["prefix"].@substr(@basename($filename), 6, -4))) {
		require_once($filename);
		$object["mysql"]->free_all();
	}}			
	$object["mysql"]->benchmark_config(true, $object["cookie"]);
	unset($mysql);
	
	// Classes Initializations
	$object["debug"] 		= 	new x_class_debug();
	$object["eventbox"] 	= 	new x_class_eventbox($object["cookie"]);
	$object["curl"] 		= 	new x_class_curl();	
	$object["benchmark"] 	= 	new x_class_benchmark($object["mysql"], _TABLE_LOG_BENCHMARK_, _HIVE_MODE_);	
	$object["crypt"] 		= 	new x_class_crypt();	
	$object["zip"] 			= 	new x_class_zip();		
	$object["var"] 			= 	new x_class_var($object["mysql"], _TABLE_VAR_, _HIVE_MODE_);	 
	$object["log"] 			= 	new x_class_log($object["mysql"], _TABLE_LOG_, _HIVE_MODE_);	
	$object["api"] 			= 	new x_class_api($object["mysql"], _TABLE_API_, _HIVE_MODE_);	
	$object["hitcounter"] 	= 	new x_class_hitcounter($object["mysql"], _TABLE_LOG_VISIT_, $object["cookie"], _HIVE_MODE_);		
	//$object["files"] 		= 	new x_class_files($object["mysql"], _TABLE_FILE_, _TABLE_FILE_FOLDER_, _HIVE_MODE_, _HIVE_PATH_PRIVATE_."/"._HIVE_MODE_."/_files/", _HIVE_PATH_PRIVATE_."/"._HIVE_MODE_."/_files/_cache/");
		
	/* Set Up The Rel URL as Configured in Settings.php */	
	if(!defined("_HIVE_URL_")) { 
		define("_HIVE_URL_", $object["url"]); 
	}
	$object["url"] = _HIVE_URL_;	 
	define('_HIVE_URL_REL_', x_getRelativeFolderFromURL(_HIVE_URL_));

	// Instance Settings
	if(file_exists($object["path"]."/_site/"._HIVE_MODE_."/_config/config.php")) { require_once($object["path"]."/_site/"._HIVE_MODE_."/_config/config.php"); }	
	else { 	/* hive_error_full("Runtime", "ERROR", "Relative Websites config.php File not found!", true, 503); */ }	
	
	// Define Default Headers for Mails
	if(!defined("_SMTP_MAILS_HEADER_")) {
		define("_SMTP_MAILS_HEADER_", '<!doctype html><html><head><meta name="viewport" content="width=device-width, initial-scale=1.0"/><meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /><style>body { background-color: #121212; font-family: sans-serif; -webkit-font-smoothing: antialiased; font-size: 14px; line-height: 1.4; margin: 0; padding: 0; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; } .content { background: #FFFFFF; box-sizing: border-box; display: block; margin: 0 auto; max-width: 580px; padding: 10px; border-radius: 5px; margin-top: 15px;  }  .footer { clear: both; margin-top: 10px; text-align: center; width: 100%; color: #000000; font-size: 12px; text-align: center;  }  h1, h2, h3, h4 { color: #000000; font-family: sans-serif; font-weight: 400; line-height: 1.4; margin: 0; margin-bottom: 30px; }  h1 { font-size: 35px; font-weight: 300; text-align: center; text-transform: capitalize; }  a { color: blue; text-decoration: none; } hr { border: 0; border-bottom: 1px solid #242424; margin: 20px 0; }  @media only screen and (max-width: 620px) { div.content { margin-top: 2vw !important; margin-left: 2vw !important; margin-right: 2vw !important;}}</style></head><body><div class="content">');
	}
	if(!defined("_SMTP_MAILS_FOOTER_")) {
		define("_SMTP_MAILS_FOOTER_", '</div></body></html>');
	}
	// Init Current Site Build Number
	if(!defined("_HIVE_BUILD_")) { define('_HIVE_BUILD_', "0"); }
	$object["var"]->setup("_HIVE_BUILD_ACTIVE_", _HIVE_BUILD_, "Current Installed Database Build Number");	
	
	// Some Variables
	if(!defined("_HIVE_URL_GET_")) { define('_HIVE_URL_GET_', array("fp2_l1", "fp2_l2", "fp2_l3", "fp2_l4", "fp2_l5")); }
	if(!defined("_HIVE_CURL_LOGGING_")) { define('_HIVE_CURL_LOGGING_', false); }
	if(!defined("_HIVE_URL_SEO_")) { define("_HIVE_URL_SEO_", false); }
	if(!defined("_HIVE_TITLE_SPACER_")) { define("_HIVE_TITLE_SPACER_", " - "); }
	if(!defined("_UPDATER_CODE_")) { define("_UPDATER_CODE_", false); }
	if(!defined("_CRON_ONLY_CLI_")) { define("_CRON_ONLY_CLI_", true); }
	if(!defined("_HIVE_CSRF_TIME_")) { define("_HIVE_CSRF_TIME_", 600); }
	if(!defined("_HIVE_HTACCESS_REFRESH_")) { define("_HIVE_HTACCESS_REFRESH_", false); }
	if(!defined("_HIVE_HTACCESS_HTTPS_FORWARD_")) { define("_HIVE_HTACCESS_HTTPS_FORWARD_", false); }
	if(!defined("_HIVE_HTACCESS_WRITE_")) { define("_HIVE_HTACCESS_WRITE_", false); }
	if(!defined("_HIVE_HTACCESS_WWW_FORWARD_")) { define("_HIVE_HTACCESS_WWW_FORWARD_", false); }
	if(!defined("_TINYMCE_PLUGINS_")) { define("_TINYMCE_PLUGINS_", "preview importcss searchreplace autolink directionality visualblocks visualchars fullscreen image link media codesample table charmap pagebreak nonbreaking anchor advlist lists wordcount help charmap quickbars emoticons code"); }
	if(!defined("_TINYMCE_MENU_BAR_")) { define("_TINYMCE_MENU_BAR_", "file edit view insert format table help"); }
	if(!defined("_TINYMCE_TOOL_BAR_")) { define("_TINYMCE_TOOL_BAR_", "undo redo | bold italic underline strikethrough | blocks fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent | numlist bullist | image media link"); }
	
	// Curl Class Logging Setup
	$object["curl"]->logging($object["mysql"], _HIVE_CURL_LOGGING_, true, _TABLE_LOG_CURL_, _HIVE_MODE_);	
	
	// Load Relative Site Modes Tables
	foreach (glob($object["path"]."/_site/"._HIVE_MODE_."/_mysql/mysql.*.php") as $filename){ 
	if(@basename($filename) == "index.php") { continue; } 
	if(!$object["mysql"]->table_exists($object["prefix"].substr(basename($filename), 6, -4))) {
		require_once($filename);
		$object["mysql"]->free_all();
	}}	
 
	/* CGet Current URL Data */
	if(!_HIVE_URL_SEO_) { define('_HIVE_URL_CUR_',     array(@$_GET[_HIVE_URL_GET_[0]], @$_GET[_HIVE_URL_GET_[1]], @$_GET[_HIVE_URL_GET_[2]], @$_GET[_HIVE_URL_GET_[3]], @$_GET[_HIVE_URL_GET_[4]])); } else {  $tmp = explode("/", @$_GET[_HIVE_URL_SEO_]);define('_HIVE_URL_CUR_', array(@$tmp[0], @$tmp[1], @$tmp[2], @$tmp[3], @$tmp[4]));}
	  
	/* MySQL Debug Mode? */
	if(defined("_HIVE_MYSQL_DEBUG_")) { if(_HIVE_MYSQL_DEBUG_) { $object["mysql"]->stop_on_error(); } }
	if(defined("_HIVE_MYSQL_DEBUG_")) { if(_HIVE_MYSQL_DEBUG_) { $object["mysql"]->display_on_error(); } } else { define("_HIVE_MYSQL_DEBUG_", false); }					
			
	/* Apply PHP Debug */
	if(defined("_HIVE_PHP_DEBUG_")) { if(_HIVE_PHP_DEBUG_ == true) { @ini_set('display_errors', 1); @ini_set('display_startup_errors', 1); @error_reporting(E_ALL);	
	} else { @ini_set('display_errors', 0); @ini_set('display_startup_errors', 0); } } else { @ini_set('display_errors', 1); @ini_set('display_startup_errors', 1); define("_HIVE_PHP_DEBUG_", false); } 
	if(defined("_HIVE_PHP_MODS_")) { if(is_array(@_HIVE_PHP_MODS_)) { foreach(_HIVE_PHP_MODS_ as $key => $value) { $object["debug"]->required_php_module($value, true); } } }		
		else { define("_HIVE_PHP_MODS_", array()); }		     
	    
	// Classes Initializations	
	$object["var"]->init_constant();			
	if(!defined("_HIVE_IP_LIMIT_")) { define("_HIVE_IP_LIMIT_", false); }
	
	// IPBL Setup
	$object["ipbl"] = new x_class_ipbl($object["mysql"], _TABLE_LOG_IP_, _HIVE_IP_LIMIT_);			
	$object["referer"] = new x_class_referer($object["mysql"], _TABLE_LOG_REFERER_, $object["url"]);	
	
	// Referer Setup
	if(!defined("_HIVE_REFERER_")) { define("_HIVE_REFERER_", false); }	
	if(_HIVE_REFERER_) 	{ $object["referer"]->execute(_HIVE_MODE_); }
	
	// Redis
	if(!defined("_REDIS_")) { define("_REDIS_", false); }
	if(_REDIS_) { $object["redis"] = new x_class_redis(_REDIS_HOST_, _REDIS_PORT_, _REDIS_PREFIX_); }		
	
	// SMTP Mail Settings
	if(!defined("_SMTP_HOST_")) { define("_SMTP_HOST_", 			$smtp["_SMTP_HOST_"]); } # Mail Host Server
	if(!defined("_SMTP_PORT_")) { define("_SMTP_PORT_", 			$smtp["_SMTP_PORT_"]); } # Mail Server Port
	if(!defined("_SMTP_AUTH_")) { define("_SMTP_AUTH_", 			$smtp["_SMTP_AUTH_"]); } # can be ssl/tls/false
	if(!defined("_SMTP_USER_")) { define("_SMTP_USER_", 			$smtp["_SMTP_USER_"]); } # Username to Login (can be false)
	if(!defined("_SMTP_PASS_")) { define("_SMTP_PASS_", 			$smtp["_SMTP_PASS_"]); } # Password to Login (can be false)
	if(!defined("_SMTP_INSECURE_")) { define("_SMTP_INSECURE_", 			true); }
	if(!defined("_SMTP_DEBUG_")) { define("_SMTP_DEBUG_", 			0); }
	if(!defined("_SMTP_MAILS_IN_HTML_")) { define("_SMTP_MAILS_IN_HTML_", 			true); }
	if(!defined("_SMTP_SENDER_MAIL_")) { define("_SMTP_SENDER_MAIL_", 			$smtp["_SMTP_USER_"]); }
	if(!defined("_SMTP_SENDER_NAME_")) { define("_SMTP_SENDER_NAME_", 			$smtp["_SMTP_USER_"]); }
	unset($smtp);		
	$object["mail"] = new x_class_mail(_SMTP_HOST_, _SMTP_PORT_, _SMTP_AUTH_, _SMTP_USER_, _SMTP_PASS_, _SMTP_SENDER_MAIL_, _SMTP_SENDER_NAME_);
	$object["mail"]->initReplyTo(_SMTP_SENDER_MAIL_, _SMTP_SENDER_NAME_);
	$object["mail"]->change_default_template(_SMTP_MAILS_HEADER_, _SMTP_MAILS_FOOTER_);		
	$object["mail"]->all_default_html(_SMTP_MAILS_IN_HTML_);	
	$object["mail"]->smtpdebuglevel(_SMTP_DEBUG_);	
	$object["mail"]->allow_insecure_ssl_connections(_SMTP_INSECURE_);
	$object["mail"]->logging($object["mysql"], _TABLE_LOG_MAIL_, false, _HIVE_MODE_);		
	
	// Mail Template Settings
	$object["mail_template"] = new x_class_mail_template($object["mysql"], _TABLE_MAIL_TPL_, _HIVE_MODE_);
	$object["mail_template"]->set_header(_SMTP_MAILS_HEADER_);
	$object["mail_template"]->set_footer(_SMTP_MAILS_FOOTER_);			
	$object["mail_template"]->setup("_RECOVER_", "Recover Account",  "You have requested a password reset. <br />Click here: <a href='_ACTION_URL_'>Link</a>", "Email template for recovering registered users. This template is sent when users request a new password through the 'forgot password' function. An substitution is set to provide the user with a link.", false);
	$object["mail_template"]->setup("_MAIL_CHANGE_", "Mail Change Confirmation",  "You have requested a mail change. <br />Click here: <a href='_ACTION_URL_'>Link</a><br />This will confirm your new changes!",  "Email template for changes in registered user emails. This template is sent when the user changes their primary email or when it is changed in general. An substitution is set to provide the user with a link.", false);
	$object["mail_template"]->setup("_ACTIVATE_", "Activate your Account",  "You need to active your account. <br />Click here: <a href='_ACTION_URL_'>Link</a>", "Email template for activating registered users. This template is sent when users or company employees are created. An substitution is set to provide the user with a link.", false);	
	
	// User Init	
	define("_USER_MAIL_PRIMARY_", true); # True - User Login is Mail | false - User Login is Username
	if(!defined("_USER_MULTI_LOGIN_")) { define("_USER_MULTI_LOGIN_", false); }
	if(!defined("_USER_REC_DROP_")) { define("_USER_REC_DROP_", true); }
	if(!defined("_USER_MAX_SESSION_")) { define("_USER_MAX_SESSION_", 7); }
	if(!defined("_USER_TOKEN_TIME_")) { define("_USER_TOKEN_TIME_", 300); }
	if(!defined("_USER_PF_SIGNS_")) { define("_USER_PF_SIGNS_", 7); }
	if(!defined("_USER_PF_CAPSIGNS_")) { define("_USER_PF_CAPSIGNS_", 1); }
	if(!defined("_USER_PF_SMSIGNS_")) { define("_USER_PF_SMSIGNS_", 1); }
	if(!defined("_USER_PF_SPSIGNS_")) { define("_USER_PF_SPSIGNS_", 0); }
	if(!defined("_USER_PF_NUMSIGNS_")) { define("_USER_PF_NUMSIGNS_", 1); }
	if(!defined("_USER_AUTOBLOCK_")) { define("_USER_AUTOBLOCK_", false); }
	if(!defined("_USER_WAIT_COUNTER_")) { define("_USER_WAIT_COUNTER_", 60); }
	if(!defined("_USER_LOG_SESSIONS_")) { define("_USER_LOG_SESSIONS_", true); }
	if(!defined("_USER_LOG_IP_")) { define("_USER_LOG_IP_", false); }	
	$object["user"] = new x_class_user($object["mysql"], _TABLE_USER_, _TABLE_USER_SESSION_, _HIVE_COOKIE_, "admin@admin.local", "changeme", 1); 	
	$object["user"]->multi_login(_USER_MULTI_LOGIN_);	
	$object["user"]->login_recover_drop(_USER_REC_DROP_);	
	if(_USER_MAIL_PRIMARY_) { $object["user"]->login_field_mail(); }
	else { $object["user"]->login_field_user(); }
	if(_USER_MAIL_PRIMARY_) { $object["user"]->mail_unique(true); $object["user"]->user_unique(false); }
	else { $object["user"]->mail_unique(false); $object["user"]->user_unique(true); }
	$object["user"]->log_ip(_USER_LOG_IP_);
	$object["user"]->log_activation(_USER_LOG_SESSIONS_);
	$object["user"]->log_session(_USER_LOG_SESSIONS_);
	$object["user"]->log_recover(_USER_LOG_SESSIONS_);
	$object["user"]->log_mail_edit(_USER_LOG_SESSIONS_);
	$object["user"]->wait_activation_min(_USER_WAIT_COUNTER_);
	$object["user"]->wait_recover_min(_USER_WAIT_COUNTER_);
	$object["user"]->wait_mail_edit_min(_USER_WAIT_COUNTER_);
	$object["user"]->autoblock(_USER_AUTOBLOCK_);
	$object["user"]->min_activation(_USER_TOKEN_TIME_);
	$object["user"]->min_recover(_USER_TOKEN_TIME_);
	$object["user"]->min_mail_edit(_USER_TOKEN_TIME_);
	$object["user"]->sessions_days(_USER_MAX_SESSION_);
	$object["user"]->cookies_use(true);
	$object["user"]->cookies_days(_USER_MAX_SESSION_);	
	$object["user"]->passfilter(_USER_PF_SIGNS_, _USER_PF_CAPSIGNS_, _USER_PF_SMSIGNS_, _USER_PF_SPSIGNS_, _USER_PF_NUMSIGNS_);	
	$object["user"]->groups(_TABLE_USER_GROUP_, _TABLE_USER_GROUP_LINK_);		
	$object["user"]->init();		

	// User Permissions
	$object["perm_user"] 	= 	new x_class_perm($object["mysql"], _TABLE_USER_PERM_, _HIVE_MODE_);
	$object["perm_group"] 	= 	new x_class_perm($object["mysql"], _TABLE_USER_GROUP_PERM_, _HIVE_MODE_);
	
	// Create Permission Item for Current User
	$object["user_perm"] = $object["perm_user"]->item($object["user"]->user_id);		
	
	// Prepare Arrays for User Groups and Permissions
	$object["user_group"] = array();
	$tmp = $object["mysql"]->select("SELECT * FROM "._TABLE_USER_GROUP_LINK_." WHERE fk_user = '".@$object["user"]->user_id."'", true);
	if(is_array($tmp)) {
		foreach($tmp AS $key => $value) {
			$tmp2 = $object["perm_group"]->item($value["fk_group"]);
			$tmp = $object["mysql"]->select("SELECT * FROM "._TABLE_USER_GROUP_." WHERE id = '".$value["fk_group"]."'", false);
			$tmp["perm_obj"] = $tmp2;
			array_push($object["user_group"], $tmp);
			unset($tmp2);}
	} unset($tmp);	
	
	// Language Initializations	
	if(!defined("_HIVE_LANG_DB_")) { define("_HIVE_LANG_DB_", false); }
	if(!defined("_HIVE_LANG_ARRAY_")) { define("_HIVE_LANG_ARRAY_", array()); }
	if(!defined("_HIVE_LANG_DEFAULT_")) { define("_HIVE_LANG_DEFAULT_", false); }
	if(_HIVE_LANG_DB_ == false) { 
		if(isset($_SESSION[_HIVE_SITE_COOKIE_."hive_language"])) {
			if(in_array($_SESSION[_HIVE_SITE_COOKIE_."hive_language"], _HIVE_LANG_ARRAY_)) {
				
			} else { $_SESSION[_HIVE_SITE_COOKIE_."hive_language"] = _HIVE_LANG_DEFAULT_; }
		} else { $_SESSION[_HIVE_SITE_COOKIE_."hive_language"] = _HIVE_LANG_DEFAULT_; }
		if($object["user"]->user_loggedIn) {
			if(@in_array(@$object["user"]->user["user_lang"], _HIVE_LANG_ARRAY_)) {
				$_SESSION[_HIVE_SITE_COOKIE_."hive_language"] = $object["user"]->user["user_lang"];
			}
		} $object["lang"] = new x_class_lang(false, false, false, false, _HIVE_SITE_PATH_."/_lang/".@$_SESSION[_HIVE_SITE_COOKIE_."hive_language"]); define("_HIVE_LANG_", $_SESSION[_HIVE_SITE_COOKIE_."hive_language"]);		
	} else {
		if(isset($_SESSION[_HIVE_SITE_COOKIE_."hive_language"])) {
			if(in_array($_SESSION[_HIVE_SITE_COOKIE_."hive_language"], _HIVE_LANG_ARRAY_)) {
			} else { $_SESSION[_HIVE_SITE_COOKIE_."hive_language"] = _HIVE_LANG_DEFAULT_; }
		} else { $_SESSION[_HIVE_SITE_COOKIE_."hive_language"] = _HIVE_LANG_DEFAULT_;}
		if($object["user"]->user_loggedIn) {
			if(@in_array(@$object["user"]->user["user_lang"], _HIVE_LANG_ARRAY_)) {
				$_SESSION[_HIVE_SITE_COOKIE_."hive_language"] = $object["user"]->user["user_lang"];
			}
		} $object["lang"] = new x_class_lang($object["mysql"], _TABLE_LANG_, @$_SESSION[_HIVE_SITE_COOKIE_."hive_language"], _HIVE_MODE_, false); define("_HIVE_LANG_", $_SESSION[_HIVE_SITE_COOKIE_."hive_language"]);
	}	
	
	// Theme Initializations	
	if(!defined("_HIVE_THEME_ARRAY_")) { define("_HIVE_THEME_ARRAY_", array()); }
	if(!defined("_HIVE_THEME_DEFAULT_")) { define("_HIVE_THEME_DEFAULT_", false); }
	if(!defined("_HIVE_THEME_COLOR_DEFAULT_")) { define("_HIVE_THEME_COLOR_DEFAULT_", "#FFFF00"); }
	if(isset($_SESSION[_HIVE_SITE_COOKIE_."hive_theme"])) {
		if(@in_array(@$_SESSION[_HIVE_SITE_COOKIE_."hive_theme"], _HIVE_THEME_ARRAY_)) {
			//define("_HIVE_THEME_", @$_SESSION[_HIVE_SITE_COOKIE_."hive_theme"]);
		} else { $_SESSION[_HIVE_SITE_COOKIE_."hive_theme"] = _HIVE_THEME_DEFAULT_; }
	} else { $_SESSION[_HIVE_SITE_COOKIE_."hive_theme"] = _HIVE_THEME_DEFAULT_; }
	if($object["user"]->user_loggedIn) {
		if(@in_array(@$object["user"]->user["user_theme"], @_HIVE_THEME_ARRAY_)) {
			$_SESSION[_HIVE_SITE_COOKIE_."hive_theme"] = $object["user"]->user["user_theme"];
		}
	} define("_HIVE_THEME_", $_SESSION[_HIVE_SITE_COOKIE_."hive_theme"]);
	
	// Color Initializations	
	if(isset($_SESSION[_HIVE_SITE_COOKIE_."hive_color"])) {
		//define("_HIVE_COLOR_", @$_SESSION[_HIVE_SITE_COOKIE_."hive_color"]);
	} else { $_SESSION[_HIVE_SITE_COOKIE_."hive_color"] = _HIVE_THEME_COLOR_DEFAULT_; }
	if($object["user"]->user_loggedIn) {
		if(@strlen($object["user"]->user["user_color"]) > 3) {
			$_SESSION[_HIVE_SITE_COOKIE_."hive_color"] = $object["user"]->user["user_color"];
		}
	} define("_HIVE_COLOR_", $_SESSION[_HIVE_SITE_COOKIE_."hive_color"]);	
	
	// Sitemap Spawn for Site
	if(!defined("_HIVE_ROBOT_SPAWN_")) { define("_HIVE_ROBOT_SPAWN_", false); }
	if(!defined("_HIVE_SITEMAP_URL_")) { define("_HIVE_SITEMAP_URL_", false); }
	if(_HIVE_ROBOT_SPAWN_ == 1) {
		if(_HIVE_SITEMAP_URL_) { $url = "Sitemap: "._HIVE_SITEMAP_URL_."\r\n"; } else { $url = "";}
		if(!file_exists($object["path"]."/robots.txt")) {
			file_put_contents($object["path"]."/robots.txt", "".$url."User-Agent: *
Disallow: "._HIVE_URL_REL_."/_api/*
Disallow: "._HIVE_URL_REL_."/_core/*
Disallow: "._HIVE_URL_REL_."/_site/*
Disallow: "._HIVE_URL_REL_."/_restricted/*
Disallow: "._HIVE_URL_REL_."/_framework/*
Disallow: "._HIVE_URL_REL_."/updater.php
Disallow: "._HIVE_URL_REL_."/installer.php
Disallow: "._HIVE_URL_REL_."/developer.php");
		}		
	}
	if(_HIVE_ROBOT_SPAWN_ == 2) {
		if(_HIVE_SITEMAP_URL_) { $url = "Sitemap: "._HIVE_SITEMAP_URL_."\r\n"; } else { $url = "";}
		if(!file_exists($object["path"]."/robots.txt")) {
			file_put_contents($object["path"]."/robots.txt", "".$url."User-Agent: *\r\nDisallow: /\r\n");
		} unset($url);
	}	
	
	## Create Main HtAccess 
	if(!file_exists($object["path"]."/.htaccess") AND _HIVE_HTACCESS_WRITE_) {
		
	if(_HIVE_HTACCESS_HTTPS_FORWARD_) { $https = "## HTTP -> HTTPS Rewrite
	RewriteCond %{HTTPS} !=on
	RewriteRule ^ https://%{HTTP_HOST}%{REQUEST_URI} [L,R=301]"; } else { $https = ""; }
	
	if(_HIVE_HTACCESS_REFRESH_) { $refresh = "## Caching Tags mod_expires
	<IfModule mod_expires.c>
	  ExpiresActive On
	   ExpiresByType image/jpeg \"access plus 1 year\"
	   ExpiresByType image/gif \"access plus 1 year\"
	   ExpiresByType image/png \"access plus 1 year\"
	   ExpiresByType image/webp \"access plus 1 year\"
	   ExpiresByType image/svg+xml \"access plus 1 year\"
	   ExpiresByType image/x-icon \"access plus 1 year\" 
	 
	   ExpiresByType video/webm \"access plus 1 year\"
	   ExpiresByType video/mp4 \"access plus 1 year\"
	   ExpiresByType video/mpeg \"access plus 1 year\"

	   ExpiresByType font/ttf \"access plus 1 year\"
	   ExpiresByType font/otf \"access plus 1 year\"
	   ExpiresByType font/woff \"access plus 1 year\"
	   ExpiresByType font/woff2 \"access plus 1 year\"
	   ExpiresByType application/font-woff \"access plus 1 year\"

	   ExpiresByType text/css \"access plus 1 month\"
	   ExpiresByType text/javascript \"access plus 1 month\"
	   ExpiresByType application/javascript \"access plus 1 month\"

	   ExpiresByType application/pdf \"access plus 1 month\"
	   ExpiresByType image/vnd.microsoft.icon \"access plus 1 year\"
	</IfModule>"; } else { $refresh = ""; }	

	if(_HIVE_HTACCESS_WWW_FORWARD_) { $www = "## WWW -> Non WWW Rewrite
	RewriteCond %{HTTP_HOST} ^www\.(.*)$ [NC]
	RewriteRule ^(.*)$ https://%1/$1 [R=301,L]"; } else { $www = ""; }	

	if(_HIVE_URL_SEO_) { $seo = "## SEO Url Rewrite
	RewriteBase /
	RewriteCond %{REQUEST_FILENAME} !-f
	RewriteCond %{REQUEST_FILENAME} !-d
	RewriteRule ^(.*)$ index.php?"._HIVE_URL_SEO_."=$1 [L,QSA]"; 
	} else { $seo = ""; }		
	
	// Write HTAccess Now
	file_put_contents($object["path"]."/.htaccess", "# FP2 Generated HTAccess File
	## Changes will be persistent!
	
	## Enable Rewriting
	RewriteEngine On
	
	".$https."
	
	".$www."
	
	".$refresh."
	
	".$seo."
	
	## Disable Directory Browsing
	Options -Indexes

	## Lock Files
	<Files \"settings.php\">  
	  Order Allow,Deny
	  Deny from all
	</Files>
	<Files \".htaccess\">  
	  Order Allow,Deny
	  Deny from all
	</Files>
	<Files \"internal.php\">  
	  Order Allow,Deny
	  Deny from all
	</Files>

	## Error Pages
	ErrorDocument 400 "._HIVE_URL_REL_."/_core/_error/error.400.php
	ErrorDocument 401 "._HIVE_URL_REL_."/_core/_error/error.401.php
	ErrorDocument 403 "._HIVE_URL_REL_."/_core/_error/error.403.php
	ErrorDocument 404 "._HIVE_URL_REL_."/_core/_error/error.404.php
	ErrorDocument 500 "._HIVE_URL_REL_."/_core/_error/error.500.php
	ErrorDocument 503 "._HIVE_URL_REL_."/_core/_error/error.503.php
	
	## Lock Folders (multiple seperator is |)
	RewriteRule ^(_restricted) - [F,L]");}	 
	unset($seo);
	unset($www);
	unset($refresh);
	unset($https);

	// Inject Site Post Options if there are any
	if(file_exists(_HIVE_SITE_PATH_."/_config/config_post.php")) { require_once(_HIVE_SITE_PATH_."/_config/config_post.php"); }	
	if(is_dir(_HIVE_SITE_PATH_)) {
		$scan = scandir(_HIVE_SITE_PATH_);
		foreach($scan as $file) {
		   if (file_exists(_HIVE_SITE_PATH_."/_config/config_global.php") AND $file != "." AND $file != "..") {
				require_once(_HIVE_SITE_PATH_."/_config/config_global.php");
		   }
		} unset($scan);  
	}
	
	if(!defined("_HIVE_SITE_URL_")) { define('_HIVE_SITE_URL_', _HIVE_URL_); }
	if(!defined("_HIVE_TITLE_")) { define('_HIVE_TITLE_', "Site"); }
	if(!defined("_UPDATER_TITLE_")) { define("_UPDATER_TITLE_", _HIVE_TITLE_); }
	if(!defined("_CAPTCHA_FONT_PATH_")) { define("_CAPTCHA_FONT_PATH_", false); }
	if(!defined("_CAPTCHA_WIDTH_")) { define("_CAPTCHA_WIDTH_", "200"); }
	if(!defined("_CAPTCHA_HEIGHT_")) { define("_CAPTCHA_HEIGHT_", "70"); }
	if(!defined("_CAPTCHA_LINES_")) { define("_CAPTCHA_LINES_", mt_rand(5, 12)); }
	if(!defined("_CAPTCHA_CODE_")) { define("_CAPTCHA_CODE_", mt_rand(1000, 9999)); }
	if(!defined("_CAPTCHA_SQUARES_")) { define("_CAPTCHA_SQUARES_", mt_rand(5, 12)); }
	if(!defined("_CAPTCHA_COLORS_")) { define("_CAPTCHA_COLORS_", false); }