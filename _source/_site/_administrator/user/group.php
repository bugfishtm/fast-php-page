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
	if(!hive__access($object, "admin_user", false) AND $object["user"]->user["user_initial"] != 1) {
		define("_INT_SHOW_ACCESS_", "true");
	} else {		
		if(is_numeric(@$_GET["id"])) {
				
			////////////////////////////////////////////////////////////////
			// View Editing
			////////////////////////////////////////////////////////////////				
			
			// Edit Operation
			if(is_numeric(@$_POST["form_id_group"])) {
				if($object["csrf"]->check($_POST["form_csrf"])) {
					$bind[0]["value"] = @$_POST["form_group_name"];
					$bind[0]["type"] = "s";
					$object["mysql"]->query("UPDATE "._TABLE_USER_GROUP_." SET group_name = ? WHERE id = '".$_POST["form_id_group"]."'", $bind);
					$bind[0]["value"] = @$_POST["form_group_descr"];
					$bind[0]["type"] = "s";
					$object["mysql"]->query("UPDATE "._TABLE_USER_GROUP_." SET group_description = ? WHERE id = '".$_POST["form_id_group"]."'", $bind);
					
					// Add Rights
					$object["perm_group"]->clear_perms($_POST["form_id_group"]);
					if(is_array(@$_POST["multiselectsortable_value_right"])) {
						foreach($_POST["multiselectsortable_value_right"] AS $key => $value) {
							$isin = false;
							if(is_array($object["set"]["permission"])){
								foreach($object["set"]["permission"] AS $keyx => $valuex) {
									if($valuex[0] == $value) { $isin = true; }
								}
							}								
							if($isin) {
								$object["perm_group"]->add_perm($_POST["form_id_group"], $value);
							}
						}
					}					
					
					$object["log"]->info("Item 'Group' with ID: ".@$_GET["id"]." has been edited by UID: ".$object["user"]->user_id."");
					$object["eventbox"]->warning("The group has been edited!");
				} else { $object["eventbox"]->error("Form expired! Please try again!"); }
			}
			
			// Delete Operation
			if(is_numeric(@$_POST["form_id_dgroup"])) {
				if($object["csrf"]->check($_POST["form_csrf"])) {		
					$object["mysql"]->query("DELETE FROM "._TABLE_USER_GROUP_." WHERE id = '".@$_POST["form_id_dgroup"]."'");
					$object["mysql"]->query("DELETE FROM "._TABLE_USER_GROUP_LINK_." WHERE fk_group = '".@$_POST["form_id_dgroup"]."'");
					$object["mysql"]->query("DELETE FROM "._TABLE_USER_GROUP_PERM_." WHERE ref = '".@$_POST["form_id_dgroup"]."'");
					$object["log"]->info("Item 'Group' with ID: ".@$_GET["id"]." has been deleted by UID: ".$object["user"]->user_id."");
					$object["eventbox"]->ok("The group has been deleted!");
				} else { $object["eventbox"]->error("Form expired! Please try again!"); }
			}

			
			$ar = $object["mysql"]->select("SELECT * FROM "._TABLE_USER_GROUP_." WHERE id = '".$_GET["id"]."'", false);
			if(is_array($ar)) { 
				// Div with Top Margin for Elements!
				echo "<div class='xfpe_margintop15px'></div>";
		


				// Display the Operations Bar!
				hive__dashboard_box_start("Edit Group", "min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800 dark:text-gray-200"); ?>
				<form method="post" action="<?php echo _HIVE_URL_REL_."/?"._HIVE_URL_GET_[0]."="._HIVE_URL_CUR_[0]."&"._HIVE_URL_GET_[1]."="._HIVE_URL_CUR_[1]."&id=".$_GET["id"].""; ?>">
					
					<label class="block text-sm">
						<span class="text-gray-700 dark:text-gray-400">Group Name</span>
						<input class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-primary-bugfish dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="Group Name" value="<?php echo htmlentities($ar["group_name"]); ?>" name="form_group_name">
					</label>
				
					<label class="block mt-4 text-sm">
						<span class="text-gray-700 dark:text-gray-400">Group Description</span>
						<textarea class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-textarea focus:border-purple-400 focus:outline-none focus:shadow-primary-bugfish dark:focus:shadow-outline-gray" rows="3" placeholder="Group Description" name="form_group_descr"><?php echo htmlspecialchars($ar["group_description"]); ?></textarea>
					</label>

					<label class="block mt-4 text-sm">
						<span class="text-gray-700 dark:text-gray-400">Group Permission</span><br />
					<select class="multiselectsortable_value_right" id="multiselectsortable_value_right" name="multiselectsortable_value_right" multiple><?php
						if(is_array($ar)) {
							if(is_array($object["set"]["permission"])) {
								$curperms = $object["mysql"]->select("SELECT * FROM "._TABLE_USER_GROUP_PERM_." WHERE ref = ".$ar["id"]."", false);  
								if(is_array($curperms)) { $curperms = unserialize($curperms["content"]); }
								if(is_array($curperms)) {  
									foreach($curperms as $key => $value) {
										$descr = "";
										$isin = false;
										if(is_array($object["set"]["permission"])) {
											foreach($object["set"]["permission"] as $keyx => $valuex) {
												if($valuex[0] == $value) { $isin = true; $descr = $valuex[2]; $tt = $valuex[1]; }
											}		
										}												
										if($isin) { echo '<option value="'.htmlentities($value).'" selected><b>'.htmlspecialchars($tt).'</b> - '.htmlspecialchars($descr).'</option>'; }
									}	
									foreach($object["set"]["permission"] as $key => $value) {
										$used = false;
										if(is_array($curperms)) {
											foreach($curperms as $keyx => $valuex) {
												if($valuex == $value[0]) { $used = true; }
											}		
										}
										if(!$used) { echo '<option value="'.htmlentities($value[0]).'"><b>'.htmlspecialchars($value[1]).'</b> - '.htmlspecialchars($value[2]).'</option>'; }
									}									
								} else {
									if(is_array($object["set"]["permission"])) {
										foreach($object["set"]["permission"] as $key => $value) {
											echo '<option value="'.htmlentities($value[0]).'"><b>'.htmlspecialchars($value[1]).'</b> - '.htmlspecialchars($value[2]).'</option>';
										}
									}
								}								
							}	else { 
								if(is_array($object["set"]["permission"])) {
									foreach($object["set"]["permission"] as $key => $value) {
										echo '<option value="'.htmlentities($value[0]).'"><b>'.htmlspecialchars($value[1]).'</b> - '.htmlspecialchars($value[2]).'</option>';
									}
								}
							}								
						} else { 
							if(is_array($object["set"]["permission"])) {
								foreach($object["set"]["permission"] as $key => $value) {
									echo '<option value="'.htmlentities($value[0]).'"><b>'.htmlspecialchars($value[1]).'</b> - '.htmlspecialchars($value[2]).'</option>';
								}
							}
						}								
					?></select>	
					</label>
					<script>				  
						jQuery(function($){$('.multiselectsortable_value_right').bugfish_sortselect({rid:56});})							  
					</script>	
							
					<br />
					<?php 	hive__dashboard_button_icright("Edit Group", "bx bx-edit", "yellow", "black", "submit");
				echo "<input type='hidden' name='form_csrf' value='".$object["csrf"]->get()."'>";
				echo "<input type='hidden' name='form_id_group' value='".$_GET["id"]."'>";
				echo "</form>";
				hive__dashboard_box_end();	
				
	
				// Display the Operations Bar!
				hive__dashboard_box_start("Delete Group", "min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800 dark:text-gray-200 xfpe_margintop15px");	
				?> <form method="post" action="<?php echo _HIVE_URL_REL_."/?"._HIVE_URL_GET_[0]."="._HIVE_URL_CUR_[0]."&"._HIVE_URL_GET_[1]."="._HIVE_URL_CUR_[1]."&id=".$_GET["id"].""; ?>"><?php
				hive__dashboard_button_icright("Delete Group", "bx bx-delete", "red", "white", "submit"); 
				echo "<input type='hidden' name='form_csrf' value='".$object["csrf"]->get()."'>";
				echo "<input type='hidden' name='form_id_dgroup' value='".$_GET["id"]."'>";
				echo "</form>";
				hive__dashboard_box_end();	
				
				hive__dashboard_box_start("Members", "min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800 dark:text-gray-200 xfpe_margintop15px");		
				$ar = $object["mysql"]->select("SELECT fk_user FROM "._TABLE_USER_GROUP_LINK_." WHERE fk_group = '".$_GET["id"]."'", true);
				if(is_array($ar)) {
					foreach($ar as $key => $value) {
						$x = @$object["user"]->get($ar[$key]["fk_user"]);
						if(!is_array($x)) { continue; }
						$ar[$key]["fk_user"] = "<a href='"."./?"._HIVE_URL_GET_[0]."=user&"._HIVE_URL_GET_[1]."=profile&id=".$x["id"].""."'>".$x["id"]."</a>";
						$ar[$key]["fk_user_mail"] = @htmlspecialchars(@$x["user_mail"]);
					}

					// Create Table Object
					$tbl = new x_class_table($object["mysql"], _TABLE_USER_GROUP_LINK_, "table");	
					$tbl->spawn_table(array(array("name" => "User-ID"),
									array("name" => "User-Mail")), $ar, false, false, false, false, "display");	
				} else { hive__dashboard_alert_warning("No members!");}
				hive__dashboard_box_end();
			} else {
				// Div with Top Margin for Elements!
				echo "<div class='xfpe_margintop15px'></div>";
				// Display the Information Box!
				hive__dashboard_alert_warning("The group you tried to edit does not exist!");
			}
		} else {
			////////////////////////////////////////////////////////////////
			// View the List
			////////////////////////////////////////////////////////////////
			
			////////////////////////////////////////////////////////////////
			// Variables
			////////////////////////////////////////////////////////////////
			$title_general 	= "User Group";
			$trts_general 	= "id as gid, group_name, group_description, id";
			$item_general 	= "User Group";
			$text_general 	= "Streamline group administration effortlessly. Organize, modify, and oversee user groups with ease, ensuring optimal access control and efficient collaboration within your platform.";
			$table_general 	= _TABLE_USER_GROUP_;
			$table_title   	= array(array("name" => "GID"),
									array("name" => "Name"),
									array("name" => "Description"));
			
			// Create Table Object
			$tbl = new x_class_table($object["mysql"], $table_general, "table");
			
			// Table Edit Arrays and Create
			$tbl->config_rel_url("./?"._HIVE_URL_GET_[0]."="._HIVE_URL_CUR_[0]."&"._HIVE_URL_GET_[1]."="._HIVE_URL_CUR_[1]."");		
			$create_ar  = array();
			$create_ar[0]["field_name"] 	= "group_name";
			$create_ar[0]["field_ph"] 		= "Group Name";
			$create_ar[0]["field_type"] 	= "string";
			$create_ar[0]["field_classes"] 	= "block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input";
			$create_ar[1]["field_name"] 	= "group_description";
			$create_ar[1]["field_ph"] 		= "Group Description";
			$create_ar[1]["field_type"] 	= "text";
			$create_ar[1]["field_classes"] 	= "block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-textarea focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray";
			$tbl->config_array($create_ar, false);	
			
			// Delete Item Operations
			//$output1 =  $tbl->exec_delete();
			//if($output1 == "deleted") { $object["eventbox"]->warning("The item has been deleted!"); 
			//							$object["log"]->info("Item '".$item_general."' with ID: ".@$_POST["x_class_table_exec_deletetable"]." has been deleted by UID: ".$object["user"]->user_id."");}
			//if($output1 == "csrf") { $object["eventbox"]->error("Form expired! Please try again!");}

			// Delete Operations
			$output1 =  $tbl->exec_create();
			if($output1 == "created") { $object["eventbox"]->warning("The item has been created!"); 
										$object["log"]->info("Item '".$item_general."' with ID: ".@$object["mysql"]->insert_id()." has been created by UID: ".$object["user"]->user_id."");}
			if($output1 == "csrf") { $object["eventbox"]->error("Form expired! Please try again!");}
		
			////////////////////////////////////////////////////////////////
			// Get Table Values
			////////////////////////////////////////////////////////////////
			$value_array = $object["mysql"]->select("SELECT ".$trts_general." FROM ".$table_general."", true);
			if(is_array($value_array)) {
				foreach($value_array as $key => $value) {
					$value_array[$key]["group_name"] = @htmlspecialchars($value_array[$key]["group_name"]);
					$value_array[$key]["gid"] = "<a href='"."./?"._HIVE_URL_GET_[0]."=user&"._HIVE_URL_GET_[1]."=group&id=".$value_array[$key]["gid"].""."'>".@htmlspecialchars($value_array[$key]["gid"])."</a>";
					$value_array[$key]["group_description"] = @htmlspecialchars($value_array[$key]["group_description"]);
				}
			}

			// Div with Top Margin for Elements!
			echo "<div class='xfpe_margintop15px'></div>";
			
			// Display the Information Box!
			hive__dashboard_alert_info($text_general);

			hive__dashboard_box_start("Add Group", "min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800");
			$tbl->spawn_create("Create Group", "flex items-center justify-between px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-primary-bugfish border border-transparent rounded-lg 	active:bg-primary-bugfish hover:bg-primary-bugfish focus:outline-none focus:shadow-primary-bugfish force-white-focus");
			hive__dashboard_box_end();
			
			// Display the Table!
			hive__dashboard_box_start($title_general ." Listing", "min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800 xfpe_margintop15px");
			$tbl->spawn_table($table_title, $value_array, false, false, false, "Action", "display");
			hive__dashboard_box_end();
		}
	}