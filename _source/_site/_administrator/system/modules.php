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
					hive__dashboard_box_start("". basename($itemPath) , "min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800 dark:text-gray-200  ".$class."");
					if(file_exists($itemPath."/version.php")) {
						$lines = file($itemPath."/version.php", FILE_IGNORE_NEW_LINES);
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
					echo "<br /><small>You can switch back to Admin Interface by executing /_core/admin_switch.php!<br />This will lead you back to the default Admin Panel declared in internal.php setup!</small>";
					echo "<br /><b>Caution:</b> If you delete a site Module, all its files in the /_site/ folder will be deleted as well.";
					echo "<div class='flex flex-col flex-wrap mb-4 space-y-4 md:flex-row md:items-end md:space-x-4'>";
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
		
		hive__dashboard_alert_warning("Deactivated Site Modules:");
		$directory = _HIVE_PATH_."/_site/__internal/_deactivated";
		$folders = array();
		if (is_dir($directory)) {
			$contents = scandir($directory);
			foreach ($contents as $item) {
				$itemPath = $directory . '/' . $item;
				if (is_dir($itemPath) && !in_array($item, array('.', '..', "__internal"))) {
					hive__dashboard_box_start("". basename($itemPath) , "min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800 dark:text-gray-200 xfpe_margintop15px");
					if(file_exists($itemPath."/version.php")) {
						$lines = file($itemPath."/version.php", FILE_IGNORE_NEW_LINES);
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
					echo "<br /><b>Caution:</b> If you delete a site Module, all its files in the /_site/ folder will be deleted as well.";
					echo "<div class='flex flex-col flex-wrap mb-4 space-y-4 md:flex-row md:items-end md:space-x-4'>";
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
		
		hive__dashboard_alert_info("Site Module Templates:");
		$directory = _HIVE_PATH_."/_site/__internal/_downloaded";
		$folders = array();
		if (is_dir($directory)) {
			$contents = scandir($directory);
			foreach ($contents as $item) {
				$itemPath = $directory . '/' . $item;
				if (is_dir($itemPath) && !in_array($item, array('.', '..', "__internal"))) {
					hive__dashboard_box_start("". basename($itemPath) , "min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800 dark:text-gray-200 xfpe_margintop15px");
					if(file_exists($itemPath."/version.php")) {
						$lines = file($itemPath."/version.php", FILE_IGNORE_NEW_LINES);
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
					echo "<div class='flex flex-col flex-wrap mb-4 space-y-4 md:flex-row md:items-end md:space-x-4'>";
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