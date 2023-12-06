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
	if(!is_array($object)) { @http_response_code(404); Header("Location: ../"); exit(); } 
	if(!hive__access($object, "admin_system", false) AND $object["user"]->user["user_initial"] != 1) {
		define("_INT_SHOW_ACCESS_", "true");
	} else {	
		// Div with Top Margin for Elements!
		echo "<div class='xfpe_margintop15px'></div>";
		
		// Display the Information Box!
		hive__dashboard_alert_info("Enhance Your Platform's Foundation - Seamlessly update the current site module version of your website's foundation. Access the latest advancements and improvements, ensuring your platform stays at the forefront of innovation and functionality. You cannot automatically update here, but with the store and Module Manager. Be cautios, this can go wrong. Caution is advised as files may get overwritten, or old site mod name will not be choosen from store. You may need to rename the new deployed site module to your current named site module if updating from store, because it will use a generated site module name and database constants are stored unter your site modules name!");

		hive__dashboard_box_start("<b>Current Site Informations</b> " , "min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800 dark:text-gray-200 ");

		$output = x_curl_gettext(_HIVE_SERVER_."/_api/store.php") ;	
		if(is_string($output)) {
			if($output = @unserialize($output)) {
				if(@is_array($output)) {
					$realoutput = $output;
				} 
			} 
		} 
		require_once(_HIVE_SITE_PATH_."/version.php");
		if(file_exists(_HIVE_SITE_PATH_."/version.php")) {
			$lines = file(_HIVE_SITE_PATH_."/version.php", FILE_IGNORE_NEW_LINES);
			if(is_array($lines)) {
				foreach($lines as $key_one => $value_one) {
					if(substr($value_one, 0, 1) != "#") { continue; }
					echo "<small>".$value_one."</small>";
					echo "<br />";
				}
			}
			
			if(@is_array(@$realoutput)) { 
				foreach($realoutput as $key => $value) {
					if($value["rname"] != $mod_id) { continue; }
				hive__dashboard_box_end();
				hive__dashboard_box_start("<b>Latest Site Informations</b> " , "min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800 dark:text-gray-200 xfpe_margintop15px");
				foreach($value as $keyx => $valuex) {
					if($keyx == "version") { $newversion = $valuex; }
					echo ''.ucfirst($keyx).': '.$valuex.'<br />';
				}
				}
			}
		} else {
			echo '<font color="red">No version.php file found!</font>';
			
			if(@is_array(@$realoutput)) { 
				foreach($realoutput as $key => $value) {
					hive__dashboard_box_end();
					hive__dashboard_box_start("<b>Latest Site Informations</b> " , "min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800 dark:text-gray-200 xfpe_margintop15px");
						if($key == "version") { $newversion = $value; }
						echo ''.ucfirst($key).': '.$value.'<br />';
				}
			}
		}
		hive__dashboard_box_end();

		
		if(@$newversion) {
			hive__dashboard_box_start(false , "min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800 dark:text-gray-200 xfpe_margintop15px");
			if($newversion > $version) {
				hive__dashboard_alert_warning("<font color='yellow'>A new build is available! <br />Check this projects Github Page to download the latest release.</font>");echo "<br /><br />Current Server URL:<br /> "._HIVE_SERVER_."/_api/update.php"."";
			} else {
				hive__dashboard_alert_success("You are up to date!");
				echo "<br />Current Server URL:<br /> "._HIVE_SERVER_."/_api/update.php"."";
			}
			hive__dashboard_box_end();
		} else {
			hive__dashboard_box_start(false , "min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800 dark:text-gray-200 xfpe_margintop15px");
			echo "<font color='red'>Error fetching Update Information!</font><br /><br />Current Server URL:<br /> "._HIVE_SERVER_."/_api/update.php"."";
			hive__dashboard_box_end();
		}
	}