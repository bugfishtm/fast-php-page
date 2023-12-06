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
		if(@$_GET["add"] == "true") { 
			////////////////////////////////////////////////////////////////
			// View Creating
			////////////////////////////////////////////////////////////////		
			if(@$_POST["form_add_user"] == "add") {
				if($object["csrf"]->check($_POST["form_csrf"])) {
					if(@$_POST["form_user_act"]) { 
						// User needs self activation with Mail and Password Set
						$result = $object["user"]->addUser(@trim(@$_POST["form_user_mail"]), @trim(@$_POST["form_user_mail"]), mt_rand(100000, 9999999), 1, 0);		
						if($result) {
							$result = $object["user"]->recover_request($_POST["form_user_mail"]);			
							if ($result == 1) {
								$object["mail_template"]->set_template("_ACTIVATE_");	
								$object["mail_template"]->add_substitution("_ACTION_URL_", "https://" . _HIVE_SITE_URL_ . "/?"._HIVE_URL_GET_[0]."=login_recover&rec_token=" . $object["user"]->mail_ref_token . "&rec_user=" . $object["user"]->mail_ref_user . ""); 
								$title = $object["mail_template"]->get_subject(true);
								$content = $object["mail_template"]->get_content(true);								
								$object["mail"]->send($object["user"]->mail_ref_receiver, $object["user"]->mail_ref_receiver, $title, $content);
								$object["eventbox"]->warning("The user has been created and an activation mail has been send!"); 
							} else { $object["eventbox"]->warning("The user has been created, but an unknown error occured while trying to send activation mail!"); }
						} else { $object["eventbox"]->warning("A user with that mail already existst!"); }
					} else {
						// User will be activated automatically
						$result = $object["user"]->addUser(@trim(@$_POST["form_user_mail"]), @trim(@$_POST["form_user_mail"]), mt_rand(100000, 9999999), 1, 1);	
						if($result == 1) {
							$object["log"]->info("Item 'User' with ID: ".@$object["mysql"]->insert_id()." has been created by UID: ".$object["user"]->user_id."");
							$object["eventbox"]->warning("The user has been created!");
						} else { $object["eventbox"]->warning("A user with that mail already existst!"); }
					}
				} else { $object["eventbox"]->error("Form expired! Please try again!"); }
			}

			// Div with Top Margin for Elements!
			echo "<div class='xfpe_margintop15px'></div>";
		
			// Display the Operations Bar!
			hive__dashboard_box_start("Add new User", "min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800 dark:text-gray-200"); ?>
			<form method="post" action="<?php echo _HIVE_URL_REL_."/?"._HIVE_URL_GET_[0]."="._HIVE_URL_CUR_[0]."&"._HIVE_URL_GET_[1]."="._HIVE_URL_CUR_[1]."&add=true"; ?>">
				<label class="block text-sm">
					<span class="text-gray-700 dark:text-gray-400">User Mail</span>
					<input class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-primary-bugfish dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="User Mail" name="form_user_mail">
				</label>
				
				<label class="flex items-center dark:text-gray-400 xfpe_margintop15px">
                  <input type="checkbox" class="text-bugfish-primary-600 form-checkbox focus:border-purple-400 focus:outline-none focus:shadow-primary-bugfish dark:focus:shadow-outline-gray " name="form_user_act">
                  <span class="ml-2">
                    User needs to confirm Mail and set own password?<br />Otherwhise user will be activated automatically and needs to restore a password, or you need to set one as administrator!
                  </span>
                </label>						
					
			<br />		
			<?php hive__dashboard_button_icright("Add User", "bx bx-plus", "lime", "black", "submit");
			echo "<input type='hidden' name='form_csrf' value='".$object["csrf"]->get()."'>";
			echo "<input type='hidden' name='form_add_user' value='add'>";
			echo "</form>";
			hive__dashboard_box_end();	
		} else {
			////////////////////////////////////////////////////////////////
			// View the List
			////////////////////////////////////////////////////////////////
			
			////////////////////////////////////////////////////////////////
			// Variables
			////////////////////////////////////////////////////////////////
			$title_general 	= "User";
			$trts_general 	= "id as gid, user_mail, user_confirmed, user_blocked, id";
			$item_general 	= "User";
			$text_general 	= "Streamline users administration effortlessly. Organize, modify, and oversee users with ease, ensuring optimal access control and efficient collaboration within your platform.";
			$table_general 	= _TABLE_USER_;
			$table_title   	= array(array("name" => "UID"),
									array("name" => "Mail"));
			
			// Create Table Object
			$tbl = new x_class_table($object["mysql"], $table_general, "table");
			
			// Table Edit Arrays and Create
			$tbl->config_rel_url("./?"._HIVE_URL_GET_[0]."="._HIVE_URL_CUR_[0]."&"._HIVE_URL_GET_[1]."="._HIVE_URL_CUR_[1]."");		
			
			// Delete Item Operations
			$output1 =  $tbl->exec_delete();
			if($output1 == "deleted") { $object["eventbox"]->warning("The item has been deleted!"); 
										$object["log"]->info("Item '".$item_general."' with ID: ".@$_POST["x_class_table_exec_deletetable"]." has been deleted by UID: ".$object["user"]->user_id."");}
			if($output1 == "csrf") { $object["eventbox"]->error("Form expired! Please try again!");}

		
			////////////////////////////////////////////////////////////////
			// Get Table Values
			////////////////////////////////////////////////////////////////
			$value_array = $object["mysql"]->select("SELECT ".$trts_general." FROM ".$table_general."", true);
			if(is_array($value_array)) {
				foreach($value_array as $key => $value) {
					$value_array[$key]["user_mail"] = @htmlspecialchars($value_array[$key]["user_mail"]);
					$value_array[$key]["gid"] = "<a href='"."./?"._HIVE_URL_GET_[0]."=user&"._HIVE_URL_GET_[1]."=profile&id=".$value_array[$key]["id"].""."'>".@htmlspecialchars($value_array[$key]["id"])."</a>";
					if($value_array[$key]["user_confirmed"] == 1) { $tmp = "<small><font color='green'>Yes</font></small>"; } else { $tmp = "<small><font color='red'>No</font></small>"; }
					$value_array[$key]["user_mail"] .= "<br /><small>Confirmed:</small> ".$tmp;
					if($value_array[$key]["user_blocked"] == 0) { $tmp = "<small><font color='green'>No</font></small>"; } else { $tmp = "<small><font color='red'>Yes</font></small>"; }
					$value_array[$key]["user_mail"] .= "<br /><small>Blocked:</small> ".$tmp;
					unset($value_array[$key]["user_confirmed"]);
					unset($value_array[$key]["user_blocked"]);
				}
			}

			// Div with Top Margin for Elements!
			echo "<div class='xfpe_margintop15px'></div>";
			
			// Display the Information Box!
			hive__dashboard_alert_info($text_general);
			
			// Display the Operations Bar!
			hive__dashboard_box_start(false, "min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800 dark:text-gray-200");
					hive__dashboard_button_icright("Create User", "bx bx-plus", "lime", "black", "button", "", "", "window.location.href=window.location.href+'&add=true';");
			hive__dashboard_box_end();
			
			// Display the Table!
			hive__dashboard_box_start($title_general ." Listing", "min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800 xfpe_margintop15px");
			$tbl->spawn_table($table_title, $value_array, false, false, false, "Action", "display");
			hive__dashboard_box_end();
		}
	}