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
		if($object["user"]->user_id != @$_GET["id"] AND isset($_GET["id"])) {
			define("_INT_SHOW_ACCESS_", "true");
		} 
	} 
	
	if(!defined("_INT_SHOW_ACCESS_")) {
		$found = false;
		if(isset($_GET["id"])) {
			$x = $object["user"]->get(@$_GET["id"]);
			if(is_array($x)) { $found = true; }
		} else {
			$x = $object["user"]->get($object["user"]->user_id);
			if(is_array($x)) { $found = true; }
		}
		if($found) {
			// User Mail Change Waiting Message
			if(@$_GET["abort_shadow"] == "true") {
				if(@$object["csrf"]->check(@$_GET["token"])) {
					$object["mysql"]->query("UPDATE "._TABLE_USER_." SET user_shadow = '' WHERE id = '".$x["id"]."'");
					$object["eventbox"]->info("The Mail Change request has been cancelled!");
				} else { $object["eventbox"]->error("Form Expired! Please try again!"); } 
			} $x = $object["user"]->get($x["id"]);
			if(hive__access($object, "admin_user", false) OR $object["user"]->user["user_initial"] == 1) { 
			// Block / Activate User
			if(@$_GET["user_block"] == "true") {
				if(@$object["csrf"]->check(@$_GET["token"])) {
					$object["mysql"]->query("UPDATE "._TABLE_USER_." SET user_blocked = 1 WHERE id = '".$x["id"]."'");
					$object["eventbox"]->info("The User has been blocked!");
				} else { $object["eventbox"]->error("Form Expired! Please try again!"); } 
			} $x = $object["user"]->get($x["id"]);
			if(@$_GET["user_deblock"] == "true") {
				if(@$object["csrf"]->check(@$_GET["token"])) {
					$object["mysql"]->query("UPDATE "._TABLE_USER_." SET user_blocked = 0 WHERE id = '".$x["id"]."'");
					$object["eventbox"]->info("The User has been unblocked!");
				} else { $object["eventbox"]->error("Form Expired! Please try again!"); } 
			} $x = $object["user"]->get($x["id"]);
			if(@$_GET["user_confirmed"] == "true") {
				if(@$object["csrf"]->check(@$_GET["token"])) {
					$object["mysql"]->query("UPDATE "._TABLE_USER_." SET user_confirmed = 1 WHERE id = '".$x["id"]."'");
					$object["eventbox"]->info("The User has been confirmed!");
				} else { $object["eventbox"]->error("Form Expired! Please try again!"); } 
			} $x = $object["user"]->get($x["id"]);
			if(@$_GET["user_deconfirmed"] == "true") {
				if(@$object["csrf"]->check(@$_GET["token"])) {
					$object["mysql"]->query("UPDATE "._TABLE_USER_." SET user_confirmed = 0 WHERE id = '".$x["id"]."'");
					$object["eventbox"]->info("The User has been unconfirmed!");
				} else { $object["eventbox"]->error("Form Expired! Please try again!"); } 
			} $x = $object["user"]->get($x["id"]); }

			if(hive__access($object, "admin_user", false) OR $object["user"]->user["user_initial"] == 1) { 
			// Delete Operation
			if(is_numeric(@$_POST["form_id_dgroup"])) {
				if($object["csrf"]->check($_POST["form_csrf"])) {		
					$object["mysql"]->query("DELETE FROM "._TABLE_USER_." WHERE id = '".@$_POST["form_id_dgroup"]."'");
					$object["mysql"]->query("DELETE FROM "._TABLE_USER_GROUP_LINK_." WHERE fk_user = '".@$_POST["form_id_dgroup"]."'");
					$object["mysql"]->query("DELETE FROM "._TABLE_USER_PERM_." WHERE ref = '".@$_POST["form_id_dgroup"]."'");
					$object["log"]->info("Item 'User' with ID: ".@$x["id"]." has been deleted by UID: ".$object["user"]->user_id."");
					$object["eventbox"]->ok("The user has been deleted!"); echo "<script>window.location.href=window.location.href;</script>";
				} else { $object["eventbox"]->error("Form expired! Please try again!"); }
			} @$x = $object["user"]->get($x["id"]);
			}
			
			// Permission Change
			if(hive__access($object, "admin_user", false) OR $object["user"]->user["user_initial"] == 1) { 
				if(@$_POST["perm_change"] == "1") {
					if(@$object["csrf"]->check(@$_POST["form_token"])) {
						// Add Rights
						$object["perm_user"]->clear_perms($x["id"]);
						if(is_array(@$_POST["multiselectsortable_value_right"])) {
							foreach($_POST["multiselectsortable_value_right"] AS $key => $value) {
								$isin = false;
								if(is_array($object["set"]["permission"])){
									foreach($object["set"]["permission"] AS $keyx => $valuex) {
										if($valuex[0] == $value) { $isin = true; }
									}
								}								
								if($isin) {
									$object["perm_user"]->add_perm($x["id"], $value);
								}
							}
						}						
						$object["eventbox"]->info("Permissions have been edited!");
					} else { $object["eventbox"]->error("Form Expired! Please try again!"); } 
				} @$x = $object["user"]->get($x["id"]); 
			}
			// Group Change
			if(hive__access($object, "admin_user", false) OR $object["user"]->user["user_initial"] == 1) { 
				if(@$_POST["group_change"] == "1") {
					if(@$object["csrf"]->check(@$_POST["form_token"])) {
						// Add Rights
						$object["mysql"]->query("DELETE FROM "._TABLE_USER_GROUP_LINK_." WHERE fk_user = '".$x["id"]."'");
						if(is_array(@$_POST["multiselectsortable_value_grp"])) {
							foreach($_POST["multiselectsortable_value_grp"] AS $key => $value) {		
								if(is_numeric($value)) { 
									$object["mysql"]->query("INSERT INTO "._TABLE_USER_GROUP_LINK_."(fk_user, fk_group) VALUES('".$x["id"]."', '".$value."');");
								}
							}
						}						
						$object["eventbox"]->info("Groups have been edited!");
					} else { $object["eventbox"]->error("Form Expired! Please try again!"); } 
				} @$x = @$object["user"]->get($x["id"]);
			}
			
			// Password Set
			if(hive__access($object, "admin_user", false) OR $object["user"]->user["user_initial"] == 1 OR ($object["user"]->user_id == @$x["id"]) OR !is_numeric(@$x["id"])) { 
			if(@$_POST["pw_change"] == "1") {
				if(@$object["csrf"]->check(@$_POST["form_token"])) {
					if(@$_POST["pass1"] == @$_POST["pass2"]) {
						if(@trim(@$_POST["pass1"]) != "") {
							if($object["user"]->passfilter_check(@$_POST["pass1"])) {
								$object["user"]->change_pass($x["id"], @$_POST["pass1"]);
								$object["eventbox"]->info("The Users password has been changed!");
							} else { $object["eventbox"]->error("Password does need one integer, one small and one capital letter! At least you need to have 10 signs."); } 
						} else { $object["eventbox"]->error("Passwords cant be empty!"); } 
					} else { $object["eventbox"]->error("Passwords do not match!"); } 
				} else { $object["eventbox"]->error("Form Expired! Please try again!"); } 
			} $x = $object["user"]->get($x["id"]);			
			}
			// Mail Set
			if(hive__access($object, "admin_user", false) OR $object["user"]->user["user_initial"] == 1 OR ($object["user"]->user_id == @$x["id"]) OR !is_numeric(@$x["id"])) { 
			if(@$_POST["mail_change"] == "1") {
				if(@$object["csrf"]->check(@$_POST["form_token"])) {
					if(@trim($_POST["new_mail_change"]) != "") {
						$res = $object["user"]->mail_edit($x["id"], $_POST["new_mail_change"], false);
						if($res == 1) { 
								$object["mail_template"]->set_template("_MAIL_CHANGE_");	
								$object["mail_template"]->add_substitution("_ACTION_URL_", "https://" . _HIVE_SITE_URL_ . "/?"._HIVE_URL_GET_[0]."=login_mail_change&mai_token=" . $object["user"]->mail_ref_token . "&mai_user=" . $object["user"]->mail_ref_user . ""); 
								$title = $object["mail_template"]->get_subject(true);
								$content = $object["mail_template"]->get_content(true);								
								$object["mail"]->send($_POST["new_mail_change"], $_POST["new_mail_change"], $title, $content);
								$object["eventbox"]->warning("Please check your new mails inbox to activate new mail!"); 
						} else { $object["eventbox"]->error("Error sending mail activation! Please try again later"); }
					} else { $object["eventbox"]->error("Mail cant be empty!"); } 
				} else { $object["eventbox"]->error("Form Expired! Please try again!"); } 
			} $x = $object["user"]->get($x["id"]);			
			}
			
			
			// Div with Top Margin for Elements!
			echo "<div class='xfpe_margintop15px'></div>";
			// Welcome Message
			hive__dashboard_box_start("User Profile", "min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800 dark:text-gray-200 xfpe_marginbottom15px");
			echo "Welcome to the user profile view!<br /> Here you can see information about your or other users user profile!";
			hive__dashboard_box_end();	
			// User Superuser Message
			if($x["user_initial"] == 1) { hive__dashboard_alert_info("This is the initial super-admin account! It always has full access to this admin panel!"); }
			// User Blocked Message
			if($x["user_blocked"] == 1) { hive__dashboard_alert_danger("This user is currently blocked!"); }
			// User Unconfirmed Message
			if($x["user_confirmed"] != 1) { hive__dashboard_alert_danger("This user is currently not confirmed by mail!"); }
			// Mail Change Request Information
			if(is_string($x["user_shadow"]) AND trim($x["user_shadow"] !=  "")) { 
				hive__dashboard_alert_warning("Awaiting Confirmation of Mail: '".htmlspecialchars($x["user_shadow"])."'!<br /><a href='./?"._HIVE_URL_GET_[0]."="._HIVE_URL_CUR_[0]."&"._HIVE_URL_GET_[1]."="._HIVE_URL_CUR_[1]."&id=".$x["id"]."&abort_shadow=true&token=".$object["csrf"]->get()."'>Click here to abort mail Change Request!</a>");}			
			// Block / Activate User
			if(hive__access($object, "admin_user", false) OR $object["user"]->user["user_initial"] == 1) { 
				hive__dashboard_box_start("Operations", "min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800 dark:text-gray-200");
				echo "<a href='./?"._HIVE_URL_GET_[0]."="._HIVE_URL_CUR_[0]."&"._HIVE_URL_GET_[1]."="._HIVE_URL_CUR_[1]."&id=".$x["id"]."&user_confirmed=true&token=".$object["csrf"]->get()."'>Confirm</a> | ";
				echo "<a href='./?"._HIVE_URL_GET_[0]."="._HIVE_URL_CUR_[0]."&"._HIVE_URL_GET_[1]."="._HIVE_URL_CUR_[1]."&id=".$x["id"]."&user_deconfirmed=true&token=".$object["csrf"]->get()."'>Unconfirm</a> | ";
				echo "<a href='./?"._HIVE_URL_GET_[0]."="._HIVE_URL_CUR_[0]."&"._HIVE_URL_GET_[1]."="._HIVE_URL_CUR_[1]."&id=".$x["id"]."&user_block=true&token=".$object["csrf"]->get()."'>Block</a> | ";
				echo "<a href='./?"._HIVE_URL_GET_[0]."="._HIVE_URL_CUR_[0]."&"._HIVE_URL_GET_[1]."="._HIVE_URL_CUR_[1]."&id=".$x["id"]."&user_deblock=true&token=".$object["csrf"]->get()."'>Unblock</a>";
				hive__dashboard_box_end();}
			// All Data
			if(hive__access($object, "admin_user", false) OR $object["user"]->user["user_initial"] == 1) {
				hive__dashboard_box_start("User Table Data", "min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800 dark:text-gray-200 xfpe_margintop15px");
					echo "<table id='x_class_table_id_tbl_table'>";
						echo "<thead>";
						echo "<tr>";
							echo "<th>Field Name</th>";
							echo "<th>Field Value</th>";
						echo "</tr>";
						echo "</thead>";
						echo "<tbody>";
					foreach($x as $key => $value) {
						if(is_numeric($key)) {  continue; }
						echo "<tr>";
							echo "<td>".htmlspecialchars($key)."</td>";
							echo "<td>".htmlspecialchars($value)."</td>";
						echo "</tr>";
					}
					echo "</tbody>";
					echo "</table>";
				hive__dashboard_box_end();
				

				// Display the Operations Bar!
				hive__dashboard_box_start("Delete User", "min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800 dark:text-gray-200 xfpe_margintop15px");	
				?> <form method="post" action="<?php echo _HIVE_URL_REL_."/?"._HIVE_URL_GET_[0]."="._HIVE_URL_CUR_[0]."&"._HIVE_URL_GET_[1]."="._HIVE_URL_CUR_[1]."&id=".$x["id"].""; ?>"><?php
				hive__dashboard_button_icright("Delete User", "bx bx-delete", "red", "white", "submit"); 
				echo "<input type='hidden' name='form_csrf' value='".$object["csrf"]->get()."'>";
				echo "<input type='hidden' name='form_id_dgroup' value='".$x["id"]."'>";
				echo "</form>";
				hive__dashboard_box_end();	
				
				}
				
				
			
			// Mail Set
			if(hive__access($object, "admin_user", false) OR $object["user"]->user["user_initial"] == 1 OR ($object["user"]->user_id == @$x["id"]) OR !is_numeric(@$x["id"])) { 
				hive__dashboard_box_start("Mail Change", "min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800 dark:text-gray-200 xfpe_margintop15px");
				?><form method='post' action="<?php echo "./?"._HIVE_URL_GET_[0]."="._HIVE_URL_CUR_[0]."&"._HIVE_URL_GET_[1]."="._HIVE_URL_CUR_[1]."&id=".$x["id"].""; ?>">
				
				
			<label class="block text-sm xfpe_marginbottom15px">
                <span class="text-gray-700 dark:text-gray-400">New Mail</span>
                <input class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-primary-bugfish dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="example@example" name="new_mail_change">
              </label>
					
					<?php echo hive__dashboard_button_icright("Change Mail", "bx bx-edit", "yellow", "black", "submit"); ?>
					<input type="hidden" name="mail_change" value="1">
					<input type="hidden" name="form_token" value="<?php echo $object["csrf"]->get(); ?>">
					</form>				
				
				<?php
				hive__dashboard_box_end();	 
			}			
		
			// Permissions
			if(hive__access($object, "admin_user", false) OR $object["user"]->user["user_initial"] == 1) { 
				hive__dashboard_box_start("Permission Change", "min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800 dark:text-gray-200 xfpe_margintop15px");
					?><form method="post" action="<?php echo "./?"._HIVE_URL_GET_[0]."="._HIVE_URL_CUR_[0]."&"._HIVE_URL_GET_[1]."="._HIVE_URL_CUR_[1]."&id=".$x["id"].""; ?>"><div><select class="multiselectsortable_value_right" id="multiselectsortable_value_right" name="multiselectsortable_value_right" multiple><?php
						if(is_array($x)) {
							if(is_array($object["set"]["permission"])) {
								$curperms = $object["mysql"]->select("SELECT * FROM "._TABLE_USER_PERM_." WHERE ref = ".$x["id"]."", false);  
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
					?></select>	</div>
					<?php echo hive__dashboard_button_icright("Change Permission", "bx bx-edit", "yellow", "black", "submit"); ?>
					<input type="hidden" name="perm_change" value="1">
					<input type="hidden" name="form_token" value="<?php echo $object["csrf"]->get(); ?>"></form>
					<script>				  
						jQuery(function($){$('.multiselectsortable_value_right').bugfish_sortselect({rid:56});})							  
					</script>	<?php		
				hive__dashboard_box_end();	
			}
			
			// Groups
			if(hive__access($object, "admin_user", false) OR $object["user"]->user["user_initial"] == 1) { 
				hive__dashboard_box_start("Groups Change", "min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800 dark:text-gray-200 xfpe_margintop15px");
					?><form method='post' action="<?php echo "./?"._HIVE_URL_GET_[0]."="._HIVE_URL_CUR_[0]."&"._HIVE_URL_GET_[1]."="._HIVE_URL_CUR_[1]."&id=".$x["id"].""; ?>"><div><select class="multiselectsortable_value_grp" id="multiselectsortable_value_grp" name="multiselectsortable_value_grp" multiple><?php
						$gal = $object["mysql"]->select("SELECT * FROM "._TABLE_USER_GROUP_."", true);  
						if(is_array($x)) {
							if(is_array($gal)) {
								$curperms = $object["mysql"]->select("SELECT * FROM "._TABLE_USER_GROUP_LINK_." WHERE fk_user = ".$x["id"]."", true);  
								if(is_array($curperms)) {  
									foreach($curperms as $key => $value) {
										$descr = "";
										$isin = false;
										if(is_array($gal)) {
											foreach($gal as $keyx => $valuex) {
												if($valuex["id"] == $value["fk_group"]) 
													{ $isin = true; $descr = $valuex["group_description"]; $tt = $valuex["group_name"]; }
											}		
										}												
										if($isin) { echo '<option value="'.htmlentities($value["id"]).'" selected><b>'.htmlspecialchars($tt).'</b> - '.htmlspecialchars($descr).'</option>'; }
									}	
									foreach($gal as $key => $value) {
										$used = false;
										if(is_array($curperms)) {
											foreach($curperms as $keyx => $valuex) {
												if($valuex["fk_group"] == $value["id"]) { $used = true; }
											}		
										}
										if(!$used) { echo '<option value="'.htmlentities($value["id"]).'"><b>'.htmlspecialchars($value["group_name"]).'</b> - '.htmlspecialchars($value["group_description"]).'</option>'; }
									}									
								} else {
									if(is_array($gal)) {
										foreach($gal as $key => $value) {
											echo '<option value="'.htmlentities($value["id"]).'"><b>'.htmlspecialchars($value["group_name"]).'</b> - '.htmlspecialchars($value["group_description"]).'</option>';
										}
									}
								}								
							}	else { 
								if(is_array($gal)) {
									foreach($gal as $key => $value) {
										echo '<option value="'.htmlentities($value["id"]).'"><b>'.htmlspecialchars($value["group_name"]).'</b> - '.htmlspecialchars($value["group_description"]).'</option>';
									}
								}
							}								
						} else { 
							if(is_array($gal)) {
								foreach($gal as $key => $value) {
									echo '<option value="'.htmlentities($value[0]).'"><b>'.htmlspecialchars($value["group_description"]).'</b> - '.htmlspecialchars($value["group_description"]).'</option>';
								}
							}
						}								
					?></select>	</div>
					<?php echo hive__dashboard_button_icright("Change Groups", "bx bx-edit", "yellow", "black", "submit"); ?>
					<input type="hidden" name="group_change" value="1">
					<input type="hidden" name="form_token" value="<?php echo $object["csrf"]->get(); ?>">
					</form>
					<script>				  
						jQuery(function($){$('.multiselectsortable_value_grp').bugfish_sortselect({rid:57});})							  
					</script>	<?php	
				hive__dashboard_box_end();	 
			}
			
			// Password Set
			if(hive__access($object, "admin_user", false) OR $object["user"]->user["user_initial"] == 1 OR ($object["user"]->user_id == @$x["id"]) OR !is_numeric(@$x["id"])) { 
				hive__dashboard_box_start("Password Change", "min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800 dark:text-gray-200 xfpe_margintop15px");
				?><form method='post' action="<?php echo "./?"._HIVE_URL_GET_[0]."="._HIVE_URL_CUR_[0]."&"._HIVE_URL_GET_[1]."="._HIVE_URL_CUR_[1]."&id=".$x["id"].""; ?>">
				
				
<label class="block text-sm xfpe_marginbottom15px">
                <span class="text-gray-700 dark:text-gray-400">Password</span>
                <input class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-primary-bugfish dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="New Password" type="password" name="pass1">
              </label>
				
<label class="block text-sm xfpe_marginbottom15px">
                <span class="text-gray-700 dark:text-gray-400">Password Confirm</span>
                <input class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-primary-bugfish dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="New Password Confirmation" type="password" name="pass2">
              </label>				
					<?php echo hive__dashboard_button_icright("Change Password", "bx bx-edit", "yellow", "black", "submit"); ?>
					<input type="hidden" name="pw_change" value="1">
					<input type="hidden" name="form_token" value="<?php echo $object["csrf"]->get(); ?>">
					</form>
				<?php hive__dashboard_box_end();	 
			}		
		} else {
			// Div with Top Margin for Elements!
			echo "<div class='xfpe_margintop15px'></div>";
			hive__dashboard_alert_warning("You cannot view this user item!");
		}
	}
