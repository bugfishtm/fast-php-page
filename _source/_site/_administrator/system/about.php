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
		hive__dashboard_alert_info("Discover the Current Website and Backend Versions - Unveiling the technological core of our platform. Explore detailed version information for both the website and backend, showcasing our commitment to the latest advancements in technology. Here you can see some informations about the current used site module and the core module!");

		hive__dashboard_box_start("<b>Core Module Informations</b> " , "min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800 dark:text-gray-200 ");
		hive__dashboard_alert_warning("You can check for Core updates in the 'System->Update' Section of this Administrator Interface!");
		if(file_exists(_HIVE_PATH_."/_core/version.php")) {
			$lines = file(_HIVE_PATH_."/_core/version.php", FILE_IGNORE_NEW_LINES);
			if(is_array($lines)) {
				foreach($lines as $key_one => $value_one) {
					if(substr($value_one, 0, 1) != "#") { continue; }
					echo "<small>".$value_one."</small>";
					echo "<br />";
				}
			}
		} else {
			echo '<font color="red">No version.php file found!</font>';
		}
		hive__dashboard_box_end();

		hive__dashboard_box_start("<b>Site Module Informations:</b> ". _HIVE_MODE_ , "min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800 dark:text-gray-200 xfpe_margintop15px");
		hive__dashboard_alert_warning("Information about this current visible administrator/site Module!");
		if(file_exists(_HIVE_SITE_PATH_."/version.php")) {
			$lines = file(_HIVE_SITE_PATH_."/version.php", FILE_IGNORE_NEW_LINES);
			if(is_array($lines)) {
				foreach($lines as $key_one => $value_one) {
					if(substr($value_one, 0, 1) != "#") { continue; }
					echo "<small>".$value_one."</small>";
					echo "<br />";
				}
			}
		} else {
			echo '<font color="red">No version.php file found!</font>';
		}
		hive__dashboard_box_end();



		hive__dashboard_box_start("Bugfish Framework Informations", "min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800 dark:text-gray-200 xfpe_margintop15px");
		hive__dashboard_alert_warning("Information about the integrated Bugfish Framework!");
		$info = new x_class_version();
		echo "<b>Version:</b><br />" .$info->version."<br />" ;
		echo "<br /><b>Autor:</b><br />" .$info->autor."<br />";
		echo "<br /><b>Contact:</b><br />" .$info->contact."<br />" ;
		echo "<br /><b>Website:</b><br />" .$info->website."<br />" ;
		echo "<br /><b>Github:</b><br />" .$info->github."<br />" ;
		hive__dashboard_box_end();
		
	}