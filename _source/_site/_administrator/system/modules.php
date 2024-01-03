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
		
		
		if(@$_POST["hive_submit_mod_s_sw"]) {
			if($csrf->check(@$_POST["hive_submit_mod_csrf"])) {
				$_SESSION[_HIVE_COOKIE_."hive_mode"] = @$_POST["hive_submit_mod_s_sw_name"];
				echo "<script>window.location.href= window.location.href;</script>";
			} else { $object["eventbox"]->error("Form expired! Please try again."); }}
		if(@$_POST["hive_submit_mod_a_disable"]) {
			if($csrf->check(@$_POST["hive_submit_mod_csrf"])) {
			if(!is_dir(_HIVE_PATH_."/_site/__internal/_deactivated/".@$_POST["hive_submit_mod_a_disable_name"])) {
				rename(_HIVE_PATH_."/_site/".@$_POST["hive_submit_mod_a_disable_name"], _HIVE_PATH_."/_site/__internal/_deactivated/".@$_POST["hive_submit_mod_a_disable_name"]);
				$object["eventbox"]->ok("Site Module has been deactivated.");
				$object["log"]->info("Active Module with Name: '".@$_POST["hive_submit_mod_a_disable_name"]."' has been deactivated by UID: ".$object["user"]->user_id."");
			} else { $object["eventbox"]->error("There is already another Site Module installed with that name!"); }
			} else { $object["eventbox"]->error("Form expired! Please try again."); }}
		if(@$_POST["hive_submit_mod_a_delete"]) {
			if($csrf->check(@$_POST["hive_submit_mod_csrf"])) {
				x_rmdir(_HIVE_PATH_."/_site/".@$_POST["hive_submit_mod_a_delete_name"]);
				$object["eventbox"]->ok("Site Module has been deleted.");
				$object["log"]->info("Active Module with Name: '".@$_POST["hive_submit_mod_a_delete_name"]."' has been deleted by UID: ".$object["user"]->user_id."");
			} else { $object["eventbox"]->error("Form expired! Please try again."); }}	
			
			
		if(@$_POST["hive_submit_mod_i_rename"]) {
			if($csrf->check(@$_POST["hive_submit_mod_csrf"])) {
			if(@trim(@$_POST["hive_submit_mod_i_rename_newname"]) != "") {
				
			if(!is_dir(_HIVE_PATH_."/_site/__internal/_deactivated/".@$_POST["hive_submit_mod_i_rename_newname"])) {
				rename( _HIVE_PATH_."/_site/__internal/_deactivated/".@$_POST["hive_submit_mod_i_rename_name"],  _HIVE_PATH_."/_site/__internal/_deactivated/".@$_POST["hive_submit_mod_i_rename_newname"]);
				$object["eventbox"]->ok("Site Module has been renamed.");
				$object["log"]->info("Rename Module with Name: '".@$_POST["hive_submit_mod_i_deploy_name"]."' has been renamed by UID: ".$object["user"]->user_id."");
				
				
			} else { $object["eventbox"]->error("There is already another Site Module installed with that name!"); }
			} else { $object["eventbox"]->error("You need to enter a new name!"); }
			} else { $object["eventbox"]->error("Form expired! Please try again."); }}
		if(@$_POST["hive_submit_mod_i_deploy"]) {
			if($csrf->check(@$_POST["hive_submit_mod_csrf"])) {
			if(!is_dir(_HIVE_PATH_."/_site/".@$_POST["hive_submit_mod_i_deploy_name"])) {
				rename( _HIVE_PATH_."/_site/__internal/_deactivated/".@$_POST["hive_submit_mod_i_deploy_name"], _HIVE_PATH_."/_site/".@$_POST["hive_submit_mod_i_deploy_name"]);
				$object["eventbox"]->ok("Site Module has been activated.");
				$object["log"]->info("Inactive Module with Name: '".@$_POST["hive_submit_mod_i_deploy_name"]."' has been activated by UID: ".$object["user"]->user_id."");
			} else { $object["eventbox"]->error("There is already another Site Module installed with that name!"); }
			} else { $object["eventbox"]->error("Form expired! Please try again."); }}
		if(@$_POST["hive_submit_mod_i_delete"]) {
			if($csrf->check(@$_POST["hive_submit_mod_csrf"])) {
				x_rmdir(_HIVE_PATH_."/_site/__internal/_deactivated/".@$_POST["hive_submit_mod_i_delete_name"]);
				$object["eventbox"]->ok("Site Module has been deleted.");
				$object["log"]->info("Inactive Module with Name: '".@$_POST["hive_submit_mod_i_delete_name"]."' has been deleted by UID: ".$object["user"]->user_id."");
			} else { $object["eventbox"]->error("Form expired! Please try again."); }}	

		if(@$_POST["hive_submit_mod_d_deploy"]) {
			if($csrf->check(@$_POST["hive_submit_mod_csrf"])) {
				$deploy_name = mt_rand(1000, 9999);
				while(is_dir(_HIVE_PATH_."/_site/".$deploy_name)) { $deploy_name = mt_rand(1000, 9999); }
				x_copy_directory( _HIVE_PATH_."/_site/__internal/_downloaded/".@$_POST["hive_submit_mod_d_deploy_name"]."/", _HIVE_PATH_."/_site/".$deploy_name);
				$object["log"]->info("Template Module with Name: '".@$_POST["hive_submit_mod_d_deploy_name"]."' has been deployed to Site: '".$deploy_name."' by UID: ".$object["user"]->user_id."");
				$object["eventbox"]->ok("Site Module has been deployed!");
			} else { $object["eventbox"]->error("Form expired! Please try again."); }}
		if(@$_POST["hive_submit_mod_d_delete"]) {
			if($csrf->check(@$_POST["hive_submit_mod_csrf"])) {
				x_rmdir(_HIVE_PATH_."/_site/__internal/_downloaded/".@$_POST["hive_submit_mod_d_delete_name"]);
				$object["eventbox"]->ok("Site Module has been deleted.");
				$object["log"]->info("Template Module with Name: '".@$_POST["hive_submit_mod_d_delete_name"]."' has been deleted by UID: ".$object["user"]->user_id."");
			} else { $object["eventbox"]->error("Form expired! Please try again."); }}			
		
		// Div with Top Margin for Elements!
		echo "<div class='xfpe_margintop15px'></div>";
		
		// Display the Information Box!
		hive__dashboard_alert_info("Easily initialize and review the status and versions of various site modules. Keep track of functionalities, versions, and their operational status for seamless management and monitoring. Here you can activate, deactivate and deploy new site modules! Be cautios to not delete any site modules by accident! This can have unforseen consequences on running websites!");
		hive__dashboard_alert_success("Active Site Modules:");
		$directory = _HIVE_PATH_."/_site";
		$folders = array();$first = true;
		if (is_dir($directory)) {
			$contents = scandir($directory);
			foreach ($contents as $item) {
				$itemPath = $directory . '/' . $item;
				if (is_dir($itemPath) && !in_array($item, array('.', '..', "__internal"))) {
					if($first) { $first = false; $class = ""; } else { $class = "xfpe_margintop15px"; } 
					hive__dashboard_box_start("<font color='lime'>[ACTIVE]</font> ". basename($itemPath) , "min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800 dark:text-gray-200  ".$class."");
					echo "<div style='display: none;'>";
					if(file_exists($itemPath."/version.php")) {
						require_once($itemPath."/version.php");
						if(@is_array(@$x)) { 
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
						 }
					} else {
						echo '<font color="red">No version.php file found!</font>';
					}
					echo "<br /><small>You can switch back to Admin Interface by executing /_core/admin_switch.php!<br />This will lead you back to the default Admin Panel declared in internal.php setup!</small>";
					echo "<br /><b>Caution:</b> If you delete a site Module, all its files in the /_site/ folder will be deleted as well.";
					echo "</div>";
					echo "<div class='flex flex-col flex-wrap mb-0 space-y-4 md:flex-row md:items-end md:space-x-4'>";
						echo "<div class='space-x-6'>";
							echo '<button type="button" class="flex items-center justify-between px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-primary-bugfish border border-transparent rounded-lg active:bg-primary-bugfish hover:bg-primary-bugfish focus:outline-none focus:shadow-primary-bugfish force-white-focus" onclick="$(this).parent().parent().prev().toggle();">Maximize / Minimize</button> ';
						echo "</div>";
						echo "<form method='post' action='./?"._HIVE_URL_GET_[0]."="._HIVE_URL_CUR_[0]."&"._HIVE_URL_GET_[1]."="._HIVE_URL_CUR_[1]."'>";
						echo "<div class='space-x-6'>";
							hive__dashboard_button_icright("Deactivate", "bx bx-stop", "yellow", "black", "submit", "", "hive_submit_mod_a_disable");
							echo "<input type='hidden' name='hive_submit_mod_a_disable' value='1'>";
							echo "<input type='hidden' name='hive_submit_mod_csrf' value='".$csrf->get()."'>";
							echo "<input type='hidden' name='hive_submit_mod_a_disable_name' value='".basename($itemPath)."'>";
						echo "</div>";
						echo "</form>";
						echo "<form method='post' action='./?"._HIVE_URL_GET_[0]."="._HIVE_URL_CUR_[0]."&"._HIVE_URL_GET_[1]."="._HIVE_URL_CUR_[1]."'>";
						echo "<div class='space-x-6'>";
							hive__dashboard_button_icright("Delete", "bx bxs-radiation", "red", "white", "submit", "", "hive_submit_mod_a_delete");
							echo "<input type='hidden' name='hive_submit_mod_a_delete' value='1'>";
							echo "<input type='hidden' name='hive_submit_mod_csrf' value='".$csrf->get()."'>";
							echo "<input type='hidden' name='hive_submit_mod_a_delete_name' value='".basename($itemPath)."'>";
						echo "</div>";
						echo "</form>";
						echo "<form method='post' action='./?"._HIVE_URL_GET_[0]."="._HIVE_URL_CUR_[0]."&"._HIVE_URL_GET_[1]."="._HIVE_URL_CUR_[1]."'>";
						echo "<div class='space-x-6'>";
							hive__dashboard_button_icright("Switch To", "bx bx-play", "lime", "black", "submit", "", "hive_submit_mod_s_sw");
							echo "<input type='hidden' name='hive_submit_mod_s_sw' value='1'>";
							echo "<input type='hidden' name='hive_submit_mod_csrf' value='".$csrf->get()."'>";
							echo "<input type='hidden' name='hive_submit_mod_s_sw_name' value='".basename($itemPath)."'>";
						echo "</div>";
						echo "</form>";
					echo "</div>";
					hive__dashboard_box_end();
				}
			}
		}
		
		echo "<div class='xfpe_margintop15px'></div>";
		$directory = _HIVE_PATH_."/_site/__internal/_deactivated";
		$folders = array();
		if (is_dir($directory)) {
			$contents = scandir($directory);
			foreach ($contents as $item) {
				$itemPath = $directory . '/' . $item;
				if (is_dir($itemPath) && !in_array($item, array('.', '..', "__internal"))) {
					hive__dashboard_box_start("<font color='red'>[INACTIVE]</font> ". basename($itemPath) , "min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800 dark:text-gray-200 xfpe_margintop15px");
					echo "<div style='display: none;'>";
					if(file_exists($itemPath."/version.php")) {
						require_once($itemPath."/version.php");
						if(@is_array(@$x)) { 
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
						 }
					} else {
						echo '<font color="red">No version.php file found!</font>';
					}
					echo "<br /><b>Caution:</b> If you delete a site Module, all its files in the /_site/ folder will be deleted as well.";
					echo "</div>";
					
						echo "<form method='post' action='./?"._HIVE_URL_GET_[0]."="._HIVE_URL_CUR_[0]."&"._HIVE_URL_GET_[1]."="._HIVE_URL_CUR_[1]."'>";

							echo "<small><font color='red'>CAUTION! If you change the site modules name, old data may not be related anymore! Check the data section for lost data site module section names.</font></small><br />";
							echo '<input type="text" name="hive_submit_mod_i_rename_newname" class="xfpe_floatleft" style="color: black;height: 35px; border-radius: 5px; padding: 2px;" placeholder="New Site Modules Name">';
							hive__dashboard_button_icright("Rename", "bx bx-edit", "yellow", "black", "submit", "", "hive_submit_mod_i_rename");
							echo "<input type='hidden' name='hive_submit_mod_i_rename' value='1'>";
							echo "<input type='hidden' name='hive_submit_mod_csrf' value='".$csrf->get()."'>";
							echo "<input type='hidden' name='hive_submit_mod_i_rename_name' value='".basename($itemPath)."'>";

						echo "</form>";
					echo "<div class='flex flex-col flex-wrap mb-0 space-y-4 md:flex-row md:items-end md:space-x-4'>";
						echo "<div class='space-x-6'>";
							echo '<button type="button" class="flex items-center justify-between px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-primary-bugfish border border-transparent rounded-lg active:bg-primary-bugfish hover:bg-primary-bugfish focus:outline-none focus:shadow-primary-bugfish force-white-focus" onclick="$(this).parent().parent().prev().prev().toggle();">Maximize / Minimize</button> ';
						echo "</div>";
						echo "<form method='post' action='./?"._HIVE_URL_GET_[0]."="._HIVE_URL_CUR_[0]."&"._HIVE_URL_GET_[1]."="._HIVE_URL_CUR_[1]."'>";
						echo "<div class='space-x-6'>";
							hive__dashboard_button_icright("Activate", "bx bx-play", "lime", "black", "submit", "", "hive_submit_mod_i_deploy");
							echo "<input type='hidden' name='hive_submit_mod_i_deploy' value='1'>";
							echo "<input type='hidden' name='hive_submit_mod_csrf' value='".$csrf->get()."'>";
							echo "<input type='hidden' name='hive_submit_mod_i_deploy_name' value='".basename($itemPath)."'>";
						echo "</div>";
						echo "</form>";
						echo "<form method='post' action='./?"._HIVE_URL_GET_[0]."="._HIVE_URL_CUR_[0]."&"._HIVE_URL_GET_[1]."="._HIVE_URL_CUR_[1]."'>";
						echo "<div class='space-x-6'>";
							hive__dashboard_button_icright("Delete", "bx bxs-radiation", "red", "white", "submit", "", "hive_submit_mod_i_delete");
							echo "<input type='hidden' name='hive_submit_mod_i_delete' value='1'>";
							echo "<input type='hidden' name='hive_submit_mod_csrf' value='".$csrf->get()."'>";
							echo "<input type='hidden' name='hive_submit_mod_i_delete_name' value='".basename($itemPath)."'>";
						echo "</div>";
						echo "</form>";
					echo "</div>";
					hive__dashboard_box_end(); 
				}
			}
		}
		
		echo "<div class='xfpe_margintop15px'></div>";
		$directory = _HIVE_PATH_."/_site/__internal/_downloaded";
		$folders = array();
		if (is_dir($directory)) {
			$contents = scandir($directory);
			foreach ($contents as $item) {
				$itemPath = $directory . '/' . $item;
				if (is_dir($itemPath) && !in_array($item, array('.', '..', "__internal"))) {
					hive__dashboard_box_start("<font color='lightblue'>[TEMPLATE]</font> ". basename($itemPath) , "min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800 dark:text-gray-200 xfpe_margintop15px");
					echo "<div style='display: none;'>";
					if(file_exists($itemPath."/version.php")) {
						require_once($itemPath."/version.php");
						if(@is_array(@$x)) { 
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
						 }
					} else {
						echo '<font color="red">No version.php file found!</font>';
					}
					echo "</div>";
					echo "<div class='flex flex-col flex-wrap mb-0 space-y-4 md:flex-row md:items-end md:space-x-4'>";
						echo "<div class='space-x-6'>";
							echo '<button type="button" class="flex items-center justify-between px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-primary-bugfish border border-transparent rounded-lg active:bg-primary-bugfish hover:bg-primary-bugfish focus:outline-none focus:shadow-primary-bugfish force-white-focus" onclick="$(this).parent().parent().prev().toggle();">Maximize / Minimize</button> ';
						echo "</div>";
						echo "<form method='post' action='./?"._HIVE_URL_GET_[0]."="._HIVE_URL_CUR_[0]."&"._HIVE_URL_GET_[1]."="._HIVE_URL_CUR_[1]."'>";
						echo "<div class='space-x-6'>";
							hive__dashboard_button_icright("Deploy", "bx bx-play", "lime", "black", "submit", "", "hive_submit_mod_d_deploy");
							echo "<input type='hidden' name='hive_submit_mod_d_deploy' value='1'>";
							echo "<input type='hidden' name='hive_submit_mod_csrf' value='".$csrf->get()."'>";
							echo "<input type='hidden' name='hive_submit_mod_d_deploy_name' value='".basename($itemPath)."'>";
						echo "</div>";
						echo "</form>";
						echo "<form method='post' action='./?"._HIVE_URL_GET_[0]."="._HIVE_URL_CUR_[0]."&"._HIVE_URL_GET_[1]."="._HIVE_URL_CUR_[1]."'>";
						echo "<div class='space-x-6'>";
							hive__dashboard_button_icright("Delete", "bx bxs-radiation", "red", "white", "submit", "", "hive_submit_mod_d_delete");
							echo "<input type='hidden' name='hive_submit_mod_d_delete' value='1'>";
							echo "<input type='hidden' name='hive_submit_mod_csrf' value='".$csrf->get()."'>";
							echo "<input type='hidden' name='hive_submit_mod_d_delete_name' value='".basename($itemPath)."'>";
						echo "</div>";
						echo "</form>";
					echo "</div>";
					hive__dashboard_box_end();
				}
			}
		}
	}