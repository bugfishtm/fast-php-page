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
		// Operations
		$csrf = new x_class_csrf(_HIVE_SITE_COOKIE_."csrf");
		
		// Div with Top Margin for Elements!
		echo "<div class='xfpe_margintop15px'></div>";
		
		// Display the Information Box!
		hive__dashboard_alert_info("Explore the Site Module Data Sections: Discover the various data sections crafted by our site modules. While currently showcasing the existing data segments, stay tuned as we work towards enhancing this page, offering greater control and customization options over these data sections in the near future.");


		$directory = _HIVE_PATH_."/_site";
		$folders = array();$first = true;
		if (is_dir($directory)) {
			$contents = scandir($directory);
			foreach ($contents as $item) {
				$itemPath = $directory . '/' . $item;
				if (is_dir($itemPath) && !in_array($item, array('.', '..', "__internal"))) {
					array_push($folders, $item);
				}
			}
		}
		
		$newarra = array();
		$array = $object["mysql"]->select("SELECT * FROM "._TABLE_VAR_." WHERE descriptor = '_HIVE_BUILD_ACTIVE_'", true);
		if(is_array($array)) {
			foreach( $array as $key => $value) {
				array_push($newarra, $value["section"]);
			}
		}
		
		$f = false;
		if(is_array($newarra)) {
			foreach( $newarra as $key => $value) {
				if(in_array($value, $folders)) { continue;}
				if(!$f) { $class = ""; } else { $class = "xfpe_margintop15px"; } 
				hive__dashboard_box_start("<font color='red'>[LOST]</font> ". $value, "min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800 dark:text-gray-200 ".$class."");
					$f = true;
				hive__dashboard_box_end();
			}
		}		
		
		if(is_array($newarra)) {
			foreach( $newarra as $key => $value) {
				if(!in_array($value, $folders)) { continue;}
				if(!$f) { $class = ""; } else { $class = "xfpe_margintop15px"; } 
				hive__dashboard_box_start("<font color='lime'>[ACTIVE]</font> ". $value, "min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800 dark:text-gray-200 ".$class."");
					echo "<div class='flex flex-col flex-wrap mb-0 space-y-4 md:flex-row md:items-end md:space-x-4'>";
				
				
				
				
				
				
					echo "</div>";
				hive__dashboard_box_end();
			}
		}		
	}