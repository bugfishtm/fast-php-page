<?php
	/* Site Module Script Handling Configuration 	*/
	define('_HIVE_MOD_CHANGES_', true); // Allow the /developer.php File to be used for development and Site Mode Changes?
	define('_HIVE_ALLOW_TOOLS_', true); // Allow the use of files in _core/_tools folder for development?
	define('_HIVE_ALLOW_ADMIN_', true); // Enable the Internal Administration Frontend?	
	$hive_mode_override = false; //Override Site Mode to use only one + Admin Switch Area If _HIVE_ALLOW_ADMIN_ is activated | False - No Override | String - Site Module to Overwritte 
	//define("_HIVE_SERVER_", "https://www.bugfish.eu"); // Store and Update Server
	define("_HIVE_SERVER_", "https://www.bugfish.eu"); // Store and Update Server
	define('_HIVE_ADMIN_SITE_', "_administrator"); # You can change the Administrator Site // Not Recommended [Works if _HIVE_ALLOW_ADMIN_ activated!]
	$hive_mode_default = "_administrator"; // Default Site mode to use:
	$hive_mode_array = false; //Fetch From Available Site Modules Folders in _site = false OR array("mod1", "mod1", "mod1"); (Set to false to use HIVE_MODE_FETCH_
	define('_HIVE_MOD_FETCH_',   false); # False to Disable by URL Site Mode Determination //  ARRAY to enable URL Site Mode Determination array(array("url" => "sub.bugfish.de", "mode" => "sbtm"), array("url" => "bugfish.de", "mode" => "btm"),array("url" => "bugfish-github.de", "mode" => "bg"))