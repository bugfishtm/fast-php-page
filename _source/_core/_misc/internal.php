<?php
	/* 
		 _               __ _    _    ___ __  __ ___ 
		| |__ _  _ __ _ / _(_)__| |_ / __|  \/  / __|
		| '_ \ || / _` |  _| (_-< ' \ (__| |\/| \__ \
		|_.__/\_,_\__, |_| |_/__/_||_\___|_|  |_|___/
				  |___/                              

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
		
		File Description:
			Internal File to load data out of ruleset.cfg and supply with default
			values if ruleset.php does not contain specific settings.
	*/
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
	if(!defined("_HIVE_ALLOW_TOKEN_")) { define('_HIVE_ALLOW_TOKEN_', true);	 }
	if(!defined("_HIVE_ADMIN_SITE_")) { define('_HIVE_ADMIN_SITE_', "_administrator");	 }
	if(!@$hive_mode_default) { $hive_mode_default = "_administrator"; }
	if(!defined("_HIVE_MOD_FETCH_")) { define('_HIVE_MOD_FETCH_',   false); }
	if(!@$hive_mode_override) { $hive_mode_override = false; }
	if(!is_array(@$hive_mode_array)) { $hive_mode_array = false; }	
	if(!defined("_HIVE_SERVER_")) { define("_HIVE_SERVER_", array("https://store.bugfish.eu")); }
	if(!defined("_HIVE_SERVER_CORE_")) { define("_HIVE_SERVER_CORE_", "https://store.bugfish.eu"); }
	if(defined("_HIVE_COOKIE_DOMAIN_")) { ini_set('session.cookie_domain', _HIVE_COOKIE_DOMAIN_); }