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
	##########################################################################################
	// intial Rules for this CMS
	// To run standalone or in normal CMS mode with Administrator Interface
	// File will NOT get overwritten with core updates
	// File WILL be overwritten by _administrator modules if this file gets updated 
	// to fit certain purposes.
	// If you are not updating this file in an administrator interface or using this cms 
	// to deploy standalone websites you can use this file for setup without an admninistrator interface.
	##########################################################################################	
	##########################################################################################	
	##########################################################################################	
	# IMPORTANT!!!!!!
	# Change File name to cfg_ruleset.php if you want to edit something here!
	# This file is optional and only executed if it exists.
	##########################################################################################	
	##########################################################################################	
	##########################################################################################
	// Enable the Internal Administration Backend? - Important for Standalone pages!
	##########################################################################################	
	// define('_HIVE_ALLOW_ADMIN_', true);
	# You can change the Administrator Site Module for the Switch Functionality
	// define('_HIVE_ADMIN_SITE_', "_administrator");
	
	##########################################################################################
	// Setting Types to fetch Site Mode - Important for Standalone pages!
	##########################################################################################
	// Default Site mode to use:	
	// $hive_mode_default = "_administrator";
		
	##########################################################################################
	// You can use your own update and store server by using the _site/_internal/_store folder!
	// Only change if you know what you are doing!
	// Otherwhise Core Updates and Store in the Administrator Site Module wont work...
	// It is recommended to leave the default update server.
	// But you can provide the url to your own store (running on an instance of this cms which comes with it)
	##########################################################################################	
	//define("_HIVE_SERVER_", "https://www.bugfish.eu");
	
	##########################################################################################
	// 1 / Yes - 0 / No // Display Errors before Startup procedure? (and warnings)
	##########################################################################################
	// define('_HIVE_PHP_DISPLAY_ERROR_ON_START_', 1); 
	
	##########################################################################################
	// PHP Logfile Location to Write (false to leave default)
	##########################################################################################
	// define('_HIVE_PHP_LOG_PATH_', $object["path"]."/_internal/php_error.log");
	// define('_HIVE_PHP_LOG_PATH_', false);

	##########################################################################################
	// Default Public Folder
	##########################################################################################	
	// define('_HIVE_PATH_PUBLIC_', @$object["path"]."/_public");

	##########################################################################################
	// Default Private Folder
	##########################################################################################	
	// define('_HIVE_PATH_PRIVATE_', @$object["path"]."/_restricted");
	
	##########################################################################################
	// Default Internal Folder
	##########################################################################################	
	// define('_HIVE_PATH_INTERNAL_', @$object["path"]."/_internal");
	
	##########################################################################################
	// Allow the use of /developer.php?
	##########################################################################################		
	// define('_HIVE_MOD_CHANGES_', false); 
	
	##########################################################################################
	// Allow the use of files in _core/_tools folder for development?
	##########################################################################################		
	// define('_HIVE_ALLOW_TOOLS_', false);
	
	##########################################################################################	
	// Installer Options
	##########################################################################################	
	// define("_INSTALLER_TITLE_", 		"Installation");
	// define("_INSTALLER_COOKIE_", 	"fp2_");
	// define("_INSTALLER_PREFIX_", 	"fp2_");
	// define("_INSTALLER_CODE_", 		false);