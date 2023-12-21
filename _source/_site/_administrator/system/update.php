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
		hive__dashboard_alert_info("Enhance Your Platform's Foundation - Seamlessly update the core version of your website's foundation. Access the latest advancements and improvements, ensuring your platform stays at the forefront of innovation and functionality. Here you can check if a new Core Version for your Instance is available! Checking will be done with FP² instance called as descripted in internal.php setup. You cannot automatically update here, you need to download the update manually and overwritte the files with the new update. Caution is advised. It is always recommended to install the latest core version!");


		$output = x_curl_gettext(_HIVE_SERVER_."/_api/update.php") ;	
		if(is_string($output)) {
			if($output = @unserialize($output)) {
				if(@is_array($output)) {
					$realoutput = $output;
				} 
			} 
		} 
		
		if(file_exists(_HIVE_PATH_."/_core/version.php")) {
			$x = array();
			if(file_exists(_HIVE_PATH_."/_core/version.php")) { require_once(_HIVE_PATH_."/_core/version.php"); }
			if(@is_array(@$x)) { 
				hive__dashboard_box_start("<b>Core Information</b> " , "min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800 dark:text-gray-200 ");
				echo "<div class='xfpe_maxwidth100pct'>";
				echo "<table class='xfpe_textbreakall'>";
				echo "<tbody class='bg-white divide-y dark:divide-gray-700 dark:bg-gray-800'>";
				foreach($x as $key => $value) {
				if($key == "version") { $version = $value; }
					echo "<tr>";
					echo '<td class="px-4 py-3 font-semibold">'.@htmlspecialchars(@ucfirst($key)).'</td> <td class="xfpe_textbreakall"><div style="white-space: normal; word-break: keep-all;">'.@htmlspecialchars(@$value).'</div></td>';
					echo "</tr>";
				}
				echo "</tbody>";
				echo "</table>";
				echo "</div>";
				hive__dashboard_box_end(); }
		} else {
			hive__dashboard_alert_danger("The core system version file at _core/version.php has not been found!");
		}
		
		if(@is_array(@$realoutput)) { 
			hive__dashboard_box_start("<b>Update Server</b> " , "min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800 dark:text-gray-200 xfpe_margintop15px ");
			echo "<div class='xfpe_maxwidth100pct'>";
			echo "<table class='xfpe_textbreakall'>";
			echo "<thead>";
				echo "<tr class='text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800'>";
					echo "<th class='px-4 py-3'>Key</th>";
					echo "<th class='px-4 py-3'>Value</th>";
				echo "</tr>";
			echo "</thead>";
			echo "<tbody class='bg-white divide-y dark:divide-gray-700 dark:bg-gray-800'>";
			foreach($realoutput as $key => $value) {
				echo "<tr>";
				if($key == "version") { $newversion = $value; }
				echo '<td class="px-4 py-3 font-semibold">'.ucfirst($key).'</td> <td class="xfpe_textbreakall"><div style="white-space: normal; word-break: keep-all;">'.$value.'</div></td>';
				echo "</tr>";
			}
			echo "</tbody>";
			echo "</table>";
			echo "</div>";
			hive__dashboard_box_end();
		}

		require_once(_HIVE_PATH_."/_core/version.php");
		if(@$newversion) {
			hive__dashboard_box_start(false , "min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800 dark:text-gray-200 xfpe_margintop15px");
			if($newversion != $version) {
				hive__dashboard_alert_warning("<font color='black'>A new build is available! <br />Check this projects Github Page to download the latest release.</font>");echo "Current Server URL:<br /> "._HIVE_SERVER_."/_api/update.php"."";
			} else {
				hive__dashboard_alert_success("You are up to date!");
				echo "Current Server URL:<br /> "._HIVE_SERVER_."/_api/update.php"."";
			}
			hive__dashboard_box_end();
		} else {
			hive__dashboard_box_start(false , "min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800 dark:text-gray-200 xfpe_margintop15px");
			echo "<font color='red'>Error fetching Update Information!</font><br /><br />Current Server URL:<br /> "._HIVE_SERVER_."/_api/update.php"."";
			hive__dashboard_box_end();
		}
	}