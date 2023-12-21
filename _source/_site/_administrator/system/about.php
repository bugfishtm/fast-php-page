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

		if(file_exists(_HIVE_PATH_."/_core/version.php")) {
			$x = array();
			if(file_exists(_HIVE_PATH_."/_core/version.php")) { require_once(_HIVE_PATH_."/_core/version.php"); }
			if(@is_array(@$x)) { 
				hive__dashboard_box_start("<b>Core Information</b> " , "min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800 dark:text-gray-200 ");
				echo "<div class='xfpe_maxwidth100pct'>";
				echo "<table class='xfpe_textbreakall'>";
				echo "<tbody class='bg-white divide-y dark:divide-gray-700 dark:bg-gray-800'>";
				foreach($x as $key => $value) {
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
		
		if(file_exists(_HIVE_SITE_PATH_."/version.php")) {
			$x = array();
			if(file_exists(_HIVE_PATH_."/_site/"._HIVE_MODE_."/version.php")) { require_once(_HIVE_PATH_."/_site/"._HIVE_MODE_."/version.php"); }
			if(@is_array(@$x)) { 
				hive__dashboard_box_start("<b>Current Site Information</b> " , "min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800 dark:text-gray-200 xfpe_margintop15px ");
				echo "<div class='xfpe_maxwidth100pct'>";
				echo "<table class='xfpe_textbreakall'>";
				echo "<tbody class='bg-white divide-y dark:divide-gray-700 dark:bg-gray-800'>";
				foreach($x as $key => $value) {
					echo "<tr>";
					echo '<td class="px-4 py-3 font-semibold">'.@htmlspecialchars(@ucfirst($key)).'</td> <td class="xfpe_textbreakall"><div style="white-space: normal; word-break: keep-all;">'.@htmlspecialchars(@$value).'</div></td>';
					echo "</tr>";
				}
				echo "</tbody>";
				echo "</table>";
				echo "</div>";
				hive__dashboard_box_end(); }
		} else {
			hive__dashboard_alert_danger("The site module version file at _site/"._HIVE_MODE_."/version.php has not been found!");
		}

		$info = new x_class_version();
		hive__dashboard_box_start("<b>Framework Information</b> " , "min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800 dark:text-gray-200 xfpe_margintop15px ");
		echo "<div class='xfpe_maxwidth100pct'>";
		echo "<table class='xfpe_textbreakall'>";
		echo "<tbody class='bg-white divide-y dark:divide-gray-700 dark:bg-gray-800'>";

			echo "<tr>";
			echo '<td class="px-4 py-3 font-semibold">Version</td> <td class="xfpe_textbreakall"><div style="white-space: normal; word-break: keep-all;">'.$info->version.'</div></td>';
			echo "</tr>";
			echo "<tr>";
			echo '<td class="px-4 py-3 font-semibold">Autor</td> <td class="xfpe_textbreakall"><div style="white-space: normal; word-break: keep-all;">'.$info->autor.'</div></td>';
			echo "</tr>";
			echo "<tr>";
			echo '<td class="px-4 py-3 font-semibold">Contact</td> <td class="xfpe_textbreakall"><div style="white-space: normal; word-break: keep-all;">'.$info->contact.'</div></td>';
			echo "</tr>";
			echo "<tr>";
			echo '<td class="px-4 py-3 font-semibold">Website</td> <td class="xfpe_textbreakall"><div style="white-space: normal; word-break: keep-all;">'.$info->website.'</div></td>';
			echo "</tr>";
			echo "<tr>";
			echo '<td class="px-4 py-3 font-semibold">Github</td> <td class="xfpe_textbreakall"><div style="white-space: normal; word-break: keep-all;">'.$info->github.'</div></td>';
			echo "</tr>";
			echo "<tr>";
			echo '<td class="px-4 py-3 font-semibold">License</td> <td class="xfpe_textbreakall"><div style="white-space: normal; word-break: keep-all;">GPLv3</div></td>';
			echo "</tr>";
		
		echo "</tbody>";
		echo "</table>";
		echo "</div>";
		hive__dashboard_box_end();
	}