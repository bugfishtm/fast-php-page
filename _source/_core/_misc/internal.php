<?php
	if(@$object["path"]) { if(file_exists(@$object["path"]."/cfg_ruleset.php")) { require_once($object["path"]."/cfg_ruleset.php"); } } else { Header("Location: ../"); }	
	if(!defined("_HIVE_PHP_DISPLAY_ERROR_ON_START_")) { define('_HIVE_PHP_DISPLAY_ERROR_ON_START_', 0); }
	if(!defined("_HIVE_PHP_LOG_PATH_")) { define('_HIVE_PHP_LOG_PATH_', false); }
	if(!defined("_HIVE_PATH_PUBLIC_")) { define('_HIVE_PATH_PUBLIC_', @$object["path"]."/_public"); }
	if(!defined("_HIVE_PATH_PRIVATE_")) { define('_HIVE_PATH_PRIVATE_', @$object["path"]."/_restricted"); }	
	if(!defined("_HIVE_PATH_INTERNAL_")) { define('_HIVE_PATH_INTERNAL_', @$object["path"]."/_internal"); }
	if(!defined("_HIVE_MOD_CHANGES_")) { define('_HIVE_MOD_CHANGES_', false); }
	if(!defined("_HIVE_ALLOW_TOOLS_")) { define('_HIVE_ALLOW_TOOLS_', false); }
	if(!defined("_HIVE_MAINTENANCE_")) { define('_HIVE_MAINTENANCE_', false); }
	if(!defined("_HIVE_ALLOW_ADMIN_")) { define('_HIVE_ALLOW_ADMIN_', true);	 }
	if(!defined("_HIVE_ADMIN_SITE_")) { define('_HIVE_ADMIN_SITE_', "_administrator");	 }
	if(!@$hive_mode_default) { $hive_mode_default = "_administrator"; }
	if(!defined("_HIVE_MOD_FETCH_")) { define('_HIVE_MOD_FETCH_',   false); }
	if(!@$hive_mode_override) { $hive_mode_override = false; }
	if(!is_array(@$hive_mode_array)) { $hive_mode_array = false; }	
	if(!defined("_HIVE_SERVER_")) { define("_HIVE_SERVER_", array("https://www.bugfish.eu")); }
	if(!defined("_HIVE_SERVER_CORE_")) { define("_HIVE_SERVER_CORE_", "https://www.bugfish.eu"); }