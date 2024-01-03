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
		$csrf = new x_class_csrf(_HIVE_SITE_COOKIE_."csrf");
		echo "<div class='xfpe_margintop15px'></div>";
		
		// Display the Information Box!
		hive__dashboard_alert_info("Explore and Download New Site Modules - Discover an array of cutting-edge modules to expand your website's capabilities. Browse, download, and integrate innovative tools to elevate your site's functionality and user experience effortlessly. Here you can download Site Modules of the store which has been declared in the internal.php conf file Fp2 Instance. You can download Site Modules here, which will than be listed as 'templates' in the Modules section. There you can deploy new downloaded modules!");

		$output = x_curl_gettext(_HIVE_SERVER_."/_api/store.php");		
		if(is_string($output)) {
			if($output = @unserialize($output)) {
				if(@is_array($output)) {
					$realoutput = $output;
				} 
			} 
		} 
			
		if(@$_POST["hive_submit_mod_dl"]) {
			if($csrf->check(@$_POST["hive_submit_mod_csrf"])) {
				if(is_array(@$realoutput[@$_POST["hive_submit_mod_dl_id"]])) {
					$zip = new ZipArchive;
					$filenamenew = @$_POST["hive_submit_mod_rname"]."-".@$_POST["hive_submit_mod_rv"]."-".@$_POST["hive_submit_mod_rb"].".zip";
					if(file_exists(_HIVE_PATH_."/_site/__internal/_cache/".@$filenamenew."")) {
						unlink(_HIVE_PATH_."/_site/__internal/_cache/".@$filenamenew."");
					}
					@x_curl_getfile(_HIVE_SERVER_."/_api/_site/".@$filenamenew."", _HIVE_PATH_."/_site/__internal/_cache/".@$filenamenew."");
					
					if(is_dir(_HIVE_PATH_."/_site/__internal/_downloaded/".@$_POST["hive_submit_mod_rname"]) AND @trim(@$_POST["hive_submit_mod_rname"]) != "") {
						@x_rmdir(_HIVE_PATH_."/_site/__internal/_downloaded/".@$_POST["hive_submit_mod_rname"]);
					}
					if(file_exists(_HIVE_PATH_."/_site/__internal/_downloaded/".@$_POST["hive_submit_mod_rname"]) AND @trim(@$_POST["hive_submit_mod_rname"]) != "") {
						@unlink(_HIVE_PATH_."/_site/__internal/_downloaded/".@$_POST["hive_submit_mod_rname"]);
					}
					if ($zip->open(_HIVE_PATH_."/_site/__internal/_cache/".@$filenamenew."") === TRUE) {
						$zip->extractTo(_HIVE_PATH_."/_site/__internal/_downloaded/");
						$zip->close();
						@rename(_HIVE_PATH_."/_site/__internal/_downloaded/".@$_POST["hive_submit_mod_rname"], _HIVE_PATH_."/_site/__internal/_downloaded/".substr($filenamenew, 0, -4));
						$object["eventbox"]->ok("Module has been downloaded and can be applied on the Modules section.");
						unlink(_HIVE_PATH_."/_site/__internal/_cache/".@$filenamenew."");
						$object["log"]->info("Module with Key: ".@$filenamenew." has been downloaded by UID: ".$object["user"]->user_id."");
					} else {
						@unlink(_HIVE_PATH_."/_site/__internal/_cache/".@$filenamenew."");
						$object["eventbox"]->error("Module could not be downloaded.");
					}				
				} else { $object["eventbox"]->error("Module could not be downloaded."); }
		} else { $object["eventbox"]->error("Form expired! Please try again."); }}
		
		
			if(@is_array(@$realoutput)) {
				$found = false;
				foreach($realoutput as $key => $value) {
					if($key == 0) { $class = ""; } else { $class = "xfpe_margintop15px"; } 
					$found = true;
					hive__dashboard_box_start("<b>". @htmlspecialchars(@$value["name"])."</b> [<b>Version</b> ".@htmlspecialchars(@$value["version"])."] [<b>Build</b> ".@htmlspecialchars(@$value["build"])."]" , "min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800 dark:text-gray-200 ".$class."");
					
						echo "<form method='post' action='./?"._HIVE_URL_GET_[0]."="._HIVE_URL_CUR_[0]."&"._HIVE_URL_GET_[1]."="._HIVE_URL_CUR_[1]."'>";
					echo '<div style="display: none;">';
					echo "<b>Creator</b> ".@htmlspecialchars(@$value["autor"])." ";
					if(@trim(@$value["website"]) != "") { echo "<br /><b>Website</b> ".@htmlspecialchars(@$value["website"])." ";  }
					if(@trim(@$value["license"]) != "") { echo " [".@htmlspecialchars(@$value["license"])."]"; }
					echo "<br /><img src='"._HIVE_SERVER_."/_api/_site/".$value["rname"].".png' style='max-width: 200px;'>";
					
					
					echo "<br><b>Description</b><br> ".$value["description"]."<br />";
							echo "<input type='hidden' name='hive_submit_mod_dl' value='1'>";
							echo "<input type='hidden' name='hive_submit_mod_rname' value='".$value["rname"]."'>";
							echo "<input type='hidden' name='hive_submit_mod_rv' value='".$value["version"]."'>";
							echo "<input type='hidden' name='hive_submit_mod_rb' value='".$value["build"]."'>";
							echo "<input type='hidden' name='hive_submit_mod_csrf' value='".$csrf->get()."'>";
							echo "<input type='hidden' name='hive_submit_mod_dl_id' value='".$key."'>";
						echo "</div>";
							echo '<button type="button" class="flex items-center justify-between px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-primary-bugfish border border-transparent rounded-lg active:bg-primary-bugfish hover:bg-primary-bugfish focus:outline-none focus:shadow-primary-bugfish force-white-focus xfpe_floatleft" onclick="$(this).prev().toggle();">Maximize / Minimize</button> ';
							hive__dashboard_button_icright("Download", "bx bx-download", "lime", "black", "submit", "", "hive_submit_mod_a_delete");
						echo "</form>";
					hive__dashboard_box_end();
				}
				if(!$found) {
					hive__dashboard_box_start("<b>Error</b> " , "min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800 dark:text-gray-200");
					echo "<font color='red'>Connection to Store failed or store is empty!<br />Store URL: "._HIVE_SERVER_."</font>";
					hive__dashboard_box_end();
				}
			} else {
				hive__dashboard_box_start("<b>Error</b> " , "min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800 dark:text-gray-200");
				echo "<font color='red'>Connection to Store failed or store is empty!<br />Store URL: "._HIVE_SERVER_."</font>";
				hive__dashboard_box_end();
			}
	}