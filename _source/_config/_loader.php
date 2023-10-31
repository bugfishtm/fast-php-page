<?php 
	/* 	
		@@@@@@@   @@@  @@@   @@@@@@@@  @@@@@@@@  @@@   @@@@@@   @@@  @@@  
		@@@@@@@@  @@@  @@@  @@@@@@@@@  @@@@@@@@  @@@  @@@@@@@   @@@  @@@  
		@@!  @@@  @@!  @@@  !@@        @@!       @@!  !@@       @@!  @@@  
		!@   @!@  !@!  @!@  !@!        !@!       !@!  !@!       !@!  @!@  
		@!@!@!@   @!@  !@!  !@! @!@!@  @!!!:!    !!@  !!@@!!    @!@!@!@!  
		!!!@!!!!  !@!  !!!  !!! !!@!!  !!!!!:    !!!   !!@!!!   !!!@!!!!  
		!!:  !!!  !!:  !!!  :!!   !!:  !!:       !!:       !:!  !!:  !!!  
		:!:  !:!  :!:  !:!  :!:   !::  :!:       :!:      !:!   :!:  !:!  
		 :: ::::  ::::: ::   ::: ::::   ::        ::  :::: ::   ::   :::  
		:: : ::    : :  :    :: :: :    :        :    :: : :     :   : :  
		   ____         _     __                      __  __         __           __  __
		  /  _/ _    __(_)__ / /    __ _____  __ __  / /_/ /  ___   / /  ___ ___ / /_/ /
		 _/ /  | |/|/ / (_-</ _ \  / // / _ \/ // / / __/ _ \/ -_) / _ \/ -_|_-</ __/_/ 
		/___/  |__,__/_/___/_//_/  \_, /\___/\_,_/  \__/_//_/\__/ /_.__/\__/___/\__(_)  
								  /___/                           
		Bugfish Framework - Skeleton / MIT License
		// Autor: Jan-Maurice Dahlmanns (Bugfish)
		// Website: www.bugfish.eu 
	*/
	if(!@is_array(@$object)) { @http_response_code(404); echo "No hardlinking!"; exit();}
	
	// Includes
	foreach (glob($object["path"]."/_framework/classes/x_*.php") as $filename) {require_once $filename;}
	foreach (glob($object["path"]."/_framework/functions/x_*.php") as $filename) {require_once $filename;}	
	foreach (glob($object["path"]."/_core/_lib/lib.*.php") as $filename) {require_once $filename;}	
	
	// Constants
	$object["prefix"]	= $mysql["prefix"];
	define("_HIVE_PREFIX_", 			$mysql["prefix"]);
	define("_HIVE_COOKIE_", 			$object["cookie"]);
	define("_HIVE_PATH_", 				$object["path"]);
	define('_HIVE_PATH_PRIVATE_', 		$object["path"]."/_restricted");
	define('_HIVE_PATH_PUBLIC_', 		$object["path"]."/_public");	
	define("_HIVE_URL_", 				$object["url"]);
	
	// Start Session
	session_start();
	
	// Get Site Mode
	require_once($object["path"]."/_config/config.mode.php");
	
	// Default Table Constants
	define("_TABLE_LOG_REFERER_", 		$object["prefix"]."x_log_referer");
	define("_TABLE_LOG_MYSQL_", 		$object["prefix"]."x_log_mysql");
	define("_TABLE_LOG_IP_", 			$object["prefix"]."x_log_ip");
	define("_TABLE_LOG_VISIT_", 		$object["prefix"]."x_log_hitcounter");
	define("_TABLE_LOG_", 				$object["prefix"]."x_log");
	define("_TABLE_LOG_MAIL_", 			$object["prefix"]."x_log_mail");
	define("_TABLE_API_", 				$object["prefix"]."x_table_api");
	define("_TABLE_VAR_", 				$object["prefix"]."x_var");
	define("_TABLE_USER_", 				$object["prefix"]."x_user");
	define("_TABLE_USER_SESSION_",		$object["prefix"]."x_user_session");
	define("_TABLE_USER_PERM_",			$object["prefix"]."x_user_perm");
	define("_TABLE_USER_GROUP_",		$object["prefix"]."x_user_group");
	define("_TABLE_USER_GROUP_PERM_",	$object["prefix"]."x_user_group_perm");
	define("_TABLE_USER_GROUP_LINK_",	$object["prefix"]."x_user_group_link");
	define("_TABLE_MAIL_TPL_",			$object["prefix"]."x_mail_template");
	define("_TABLE_LANG_",				$object["prefix"]."x_lang");

	// MySQL Initializations
	$object["mysql"] = new x_class_mysql(@$mysql["host"], @$mysql["user"], @$mysql["pass"], @$mysql["db"], @$mysql["port"]);
	if ($object["mysql"]->lasterror != false) { 
		@http_response_code(503); 
		require_once(_HIVE_PATH_."/_core/_error/error.mysql.html"); 
		exit(); 
	}		
	$object["mysql"]->log_config(_TABLE_LOG_MYSQL_, _HIVE_MODE_);	
	foreach (glob(_HIVE_PATH_."/_core/_mysql/*.sql.php") as $filename){ 
		if(!$object["mysql"]->table_exists($object["prefix"].substr(basename($filename), 0, -8))) {
			require_once($filename);
			$object["mysql"]->free_all();
		}}		
	$object["mysql"]->benchmark_config(true, $object["cookie"]);
	unset($mysql);	

	// Classes Initializations
	$object["debug"] = 			new x_class_debug();
	$object["eventbox"] = 		new x_class_eventbox($object["cookie"]);
	$object["curl"] = 			new x_class_curl();	
	$object["crypt"] = 			new x_class_crypt();	
	$object["zip"] = 			new x_class_zip();	
	$object["var"] = 			new x_class_var($object["mysql"], _TABLE_VAR_, _HIVE_MODE_);	 
	$object["log"] = 			new x_class_log($object["mysql"], _TABLE_LOG_, _HIVE_MODE_);	
	$object["api"] = 			new x_class_api($object["mysql"], _TABLE_API_, _HIVE_MODE_);	
	$object["hitcounter"] = 	new x_class_hitcounter($object["mysql"], _TABLE_LOG_VISIT_, $object["cookie"]);	
	$object["mail_template"] = 	new x_class_mail_template($object["mysql"], _TABLE_MAIL_TPL_, _HIVE_MODE_);

		/* Set Up The Rel URL as Configured in Settings.php */
	if(strrpos($object["url"], '/') > 3) { define('_HIVE_URL_REL_', substr($object["url"], strrpos($object["url"], '/') + 1)); } 
		else { define('_HIVE_URL_REL_', "");  }
		
	// Instance Settings
	if(file_exists($object["path"]."/_site/"._HIVE_MODE_."/config.php")) { require_once($object["path"]."/_site/"._HIVE_MODE_."/config.php"); }
	else { 	@http_response_code(503); 
			require_once($object["path"]."/_core/_error/error.relconf.html"); 
			exit();}
	$object["var"]->setup("_HIVE_BUILD_ACTIVE_", "1", "Current Installed Database Build Number");
	foreach (glob($object["path"]."/_site/"._HIVE_MODE_."/_mysql/*.sql.php") as $filename){ 
		if(!$object["mysql"]->table_exists($object["prefix"].substr(basename($filename), 0, -8))) {
			require_once($filename);
			$object["mysql"]->free_all();
		}}		
	/* Classes New */
	define('_HIVE_URL_CUR_',     array(@$_GET[_HIVE_URL_GET_[0]], @$_GET[_HIVE_URL_GET_[1]], @$_GET[_HIVE_URL_GET_[2]], @$_GET[_HIVE_URL_GET_[3]], @$_GET[_HIVE_URL_GET_[4]])); 
		
	/* MySQL Debug Mode? */
	if(_HIVE_MYSQL_DEBUG_) { $object["mysql"]->stop_on_error(); }
	if(_HIVE_MYSQL_DEBUG_) { $object["mysql"]->display_on_error(); }	

	/* Apply PHP Debug */
	if(_HIVE_PHP_DEBUG_ == true) { @ini_set('display_errors', 1); @ini_set('display_startup_errors', 1); @error_reporting(E_ALL);	
	} else { @ini_set('display_errors', 0); @ini_set('display_startup_errors', 0); }
	if(is_array(@_HIVE_PHP_MODS_)) { foreach(_HIVE_PHP_MODS_ as $key => $value) { $object["debug"]->required_php_module($value, true); } }
	
	// Classes Initializations	
	$object["var"]->init_constant();
	$object["ipbl"] = 			new x_class_ipbl($object["mysql"], _TABLE_LOG_IP_, _HIVE_IP_LIMIT_);
	$object["referer"] = 		new x_class_referer($object["mysql"], _TABLE_LOG_REFERER_, $object["url"]);	
		if(_HIVE_IP_REFERER_) 	{ $object["referer"]->execute(); }
	if(_REDIS_) { $object["redis"] = new x_class_redis(_REDIS_HOST_, _REDIS_PORT_, _REDIS_PREFIX_); }
	
	// Mail Init
	$object["mail"] = new x_class_mail(_SMTP_HOST_, _SMTP_PORT_, _SMTP_AUTH_, _SMTP_USER_, _SMTP_PASS_, _SMTP_SENDER_MAIL_, _SMTP_SENDER_NAME_);
	$object["mail"]->initReplyTo(_SMTP_SENDER_MAIL_, _SMTP_SENDER_NAME_);
	$object["mail"]->all_default_html(_SMTP_MAILS_IN_HTML_);	
	$object["mail"]->smtpdebuglevel(_SMTP_DEBUG_);	
	$object["mail"]->change_default_template(_SMTP_MAILS_HEADER_, _SMTP_MAILS_FOOTER_);	
	$object["mail"]->allow_insecure_ssl_connections(_SMTP_INSECURE_);
	$object["mail"]->logging($object["mysql"], _TABLE_LOG_MAIL_, false, _HIVE_MODE_);	
	
	// Mail Template Settings
	$object["mail_template"] = new x_class_mail_template($object["mysql"], _TABLE_MAIL_TPL_, _HIVE_MODE_);
	$object["mail_template"]->set_header(_SMTP_MAILS_HEADER_);
	$object["mail_template"]->set_footer(_SMTP_MAILS_FOOTER_);
	$object["mail_template"]->setup("_TPL_RECOVER_", "Recover Subject",  "Recover Content", "Email template for recovering registered users. This template is sent when users request a new password through the 'forgot password' function. An substitution is set to provide the user with a link.", false);
	$object["mail_template"]->setup("_TPL_MAIL_CHANGE_", "Mail Change Subject",  "Mail Change Content",  "Email template for changes in registered user emails. This template is sent when the user changes their primary email or when it is changed in general. An substitution is set to provide the user with a link.", false);
	$object["mail_template"]->setup("_TPL_ACTIVATE_", "Activate Subject",  "Activate Content", "Email template for activating registered users. This template is sent when users or company employees are created. An substitution is set to provide the user with a link.", false);

	// User Init	
	$object["user"] = new x_class_user($object["mysql"], _TABLE_USER_, _TABLE_USER_SESSION_, _HIVE_COOKIE_, "admin@admin.local", "changeme", 1); 	
	$object["user"]->multi_login(false);	
	$object["user"]->login_recover_drop(true);
	$object["user"]->login_field_mail();
	$object["user"]->mail_unique(true);
	$object["user"]->user_unique(false);
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
	$object["user"]->passfilter(10, 1, 1, 0, 1);	
	$object["user"]->groups(_TABLE_USER_GROUP_, _TABLE_USER_GROUP_LINK_);		
	$object["user"]->init();		
	
	// Language Initializations	
	if(_HIVE_LANG_DB_ == false) { 
		if(isset($_SESSION[$object["cookie"]._HIVE_MODE_."hive_language"])) {
			if(in_array($_SESSION[$object["cookie"]._HIVE_MODE_."hive_language"], _HIVE_LANG_ARRAY_)) {
				$object["lang"] = new x_class_lang(false, false, false, false, $object["path"]."/_site/"._HIVE_MODE_."/_lang/".@$_SESSION[$object["cookie"]._HIVE_MODE_."hive_language"]); define("_HIVE_LANG_", @$_SESSION[$object["cookie"]._HIVE_MODE_."hive_language"]);
			} else { $_SESSION[$object["cookie"]._HIVE_MODE_."hive_language"] = _HIVE_LANG_DEFAULT_; $object["lang"] = new x_class_lang(false, false, false, false, $object["path"]."/_site/"._HIVE_MODE_."/_lang/"._HIVE_LANG_DEFAULT_); define("_HIVE_LANG_", _HIVE_LANG_DEFAULT_); }
		} else { $_SESSION[$object["cookie"]._HIVE_MODE_."hive_language"] = _HIVE_LANG_DEFAULT_; $object["lang"] = new x_class_lang(false, false, false, false, $object["path"]."/_site/"._HIVE_MODE_."/_lang/"._HIVE_LANG_DEFAULT_); define("_HIVE_LANG_", _HIVE_LANG_DEFAULT_);}
		
	} else {
		if(isset($_SESSION[$object["cookie"]._HIVE_MODE_."hive_language"])) {
			if(in_array($_SESSION[$object["cookie"]._HIVE_MODE_."hive_language"], _HIVE_LANG_ARRAY_)) {
				$object["lang"] = new x_class_lang($object["mysql"], _TABLE_LANG_, @$_SESSION[$object["cookie"]._HIVE_MODE_."hive_language"], _HIVE_MODE_, false); define("_HIVE_LANG_", @$_SESSION[$object["cookie"]._HIVE_MODE_."hive_language"]);
			} else { $_SESSION[$object["cookie"]._HIVE_MODE_."hive_language"] = _HIVE_LANG_DEFAULT_; $object["lang"] = new x_class_lang($object["mysql"], _TABLE_LANG_, @$_SESSION[$object["cookie"]._HIVE_MODE_."hive_language"], _HIVE_MODE_, false); define("_HIVE_LANG_", _HIVE_LANG_DEFAULT_); }
		} else { $_SESSION[$object["cookie"]._HIVE_MODE_."hive_language"] = _HIVE_LANG_DEFAULT_; $object["lang"] = new x_class_lang($object["mysql"], _TABLE_LANG_, @$_SESSION[$object["cookie"]._HIVE_MODE_."hive_language"], _HIVE_MODE_, false); define("_HIVE_LANG_", _HIVE_LANG_DEFAULT_);}
			
	}
	// Theme Initializations	
	if(isset($_SESSION[$object["cookie"]._HIVE_MODE_."hive_theme"])) {
		if(in_array($_SESSION[$object["cookie"]._HIVE_MODE_."hive_theme"], _HIVE_THEME_ARRAY_)) {
			define("_HIVE_THEME_", @$_SESSION[$object["cookie"]._HIVE_MODE_."hive_theme"]);
		} else { $_SESSION[$object["cookie"]._HIVE_MODE_."hive_theme"] = _HIVE_THEME_DEFAULT_; define("_HIVE_THEME_", _HIVE_THEME_DEFAULT_); }
	} else { $_SESSION[$object["cookie"]._HIVE_MODE_."hive_theme"] = _HIVE_THEME_DEFAULT_; define("_HIVE_THEME_", _HIVE_THEME_DEFAULT_);}

	// Color Initializations	
	if(isset($_SESSION[$object["cookie"]._HIVE_MODE_."hive_color"])) {
		define("_HIVE_COLOR_", @$_SESSION[$object["cookie"]._HIVE_MODE_."hive_color"]);
	} else { $_SESSION[$object["cookie"]._HIVE_MODE_."hive_color"] = _HIVE_THEME_COLOR_DEFAULT_; define("_HIVE_COLOR_", _HIVE_THEME_COLOR_DEFAULT_);}
	
	// Sitemap Spawn for Site
	if(_HIVE_ROBOT_SPAWN_ == 1) {
		if(_HIVE_SITEMAP_URL_) { $url = _HIVE_SITEMAP_URL_."\r\n"; } else { $url = "";}
		if(!file_exists($object["path"]."/robots.txt")) {
			file_put_contents($object["path"]."/robots.txt", "".$url."User-Agent: *
Disallow: /_vendor/*
Disallow: /_core/*
Disallow: /_cron/*
Disallow: /_config/*
Disallow: /_config/*
Disallow: /updater.php
Disallow: /installer.php
Disallow: /mod_change.php
Disallow: /lang_change.php
Disallow: /theme_change.php
Disallow: /color_change.php
Disallow: /testing.php
");
		}		
	}
	if(_HIVE_ROBOT_SPAWN_ == 2) {
		if(_HIVE_SITEMAP_URL_) { $url = _HIVE_SITEMAP_URL_."\r\n"; } else { $url = "";}
		if(!file_exists($object["path"]."/robots.txt")) {
			file_put_contents($object["path"]."/robots.txt", "".$url."User-Agent: *
Disallow: /	
");
		}
	}	
	
	## Create Main HtAccess 
		if(!file_exists($object["path"]."/.htaccess")) {
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
	if(_HIVE_HTACCESS_SEO_) { $seo = "## SEO Url Rewrite
	RewriteBase /
	RewriteCond %{REQUEST_FILENAME} !-f
	RewriteCond %{REQUEST_FILENAME} !-d
	RewriteRule ^(.*)$ index.php?"._HIVE_HTACCESS_SEO_."=$1 [L,QSA]"; } else { $seo = ""; }	
			file_put_contents($object["path"]."/.htaccess", "## Enable Rewriting
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

## Error Pages
ErrorDocument 400 /_error/error.400.html
ErrorDocument 401 /_error/error.401.html
ErrorDocument 403 /_error/error.403.html
ErrorDocument 404 /_error/error.404.html
ErrorDocument 500 /_error/error.500.html
ErrorDocument 503 /_error/error.503.html

## Lock Folders
RewriteRule ^(_restricted|_config) - [F,L]

");
		}	