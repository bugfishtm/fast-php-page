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
	if(!hive__access($object, "admin_backend", false) AND $object["user"]->user["user_initial"] != 1) {
		define("_INT_SHOW_ACCESS_", "true");
	} else {		
		////////////////////////////////////////////////////////////////
		// Variables
		////////////////////////////////////////////////////////////////
		$title_general 	= "Token";
		$trts_general 	= "api_token, direction, section, id";
		$item_general 	= "Token";
		$text_general 	= "Streamline Token administration effortlessly. Organize, modify, and oversee Tokens with ease, ensuring optimal access control and efficient collaboration within your platform.";
		$table_general 	= _TABLE_API_;
		$table_title   	= array(array("name" => "Token"),
							    array("name" => "Type"),
							    array("name" => "Module"));
		
		// Create Table Object
		$tbl = new x_class_table($object["mysql"], $table_general, "table");
		
		// Table Edit Arrays and Create
		$tbl->config_rel_url("./?"._HIVE_URL_GET_[0]."="._HIVE_URL_CUR_[0]."&"._HIVE_URL_GET_[1]."="._HIVE_URL_CUR_[1]."");
		$create_ar  = array();
		$create_ar[0]["field_name"] 	= "api_token";
		$create_ar[0]["field_ph"] 		= "Token Key";
		$create_ar[0]["field_type"] 	= "string";
		$create_ar[0]["field_classes"] 	= "block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input";
		$create_ar[1]["field_name"] 	= "direction";
		$create_ar[1]["field_ph"] 		= "Token Type";
		$create_ar[1]["select_array"] 	= array(array("in", "in"), array("out", "out"));
		$create_ar[1]["field_type"] 	= "select";
		$create_ar[1]["field_classes"] 	= "block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input";
		$create_ar[2]["field_name"] 	= "section";
		$create_ar[2]["field_ph"] 		= "Token Module";
		$create_ar[2]["field_type"] 	= "string";
		$create_ar[2]["field_classes"] = "block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input";
		
		
		$edit_ar    = array();
		$edit_ar[0]["field_name"] 		= "api_token";
		$edit_ar[0]["field_ph"] 		= "Token Key";
		$edit_ar[0]["field_type"] 		= "string";
		$edit_ar[0]["field_classes"] 	= "block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input";
		$edit_ar[1]["field_name"] 		= "direction";
		$edit_ar[1]["field_ph"] 		= "Token Type";
		$edit_ar[1]["select_array"] 	= array(array("in", "in"), array("out", "out"));
		$edit_ar[1]["field_type"] 	= "select";
		$edit_ar[1]["field_classes"] 	= "block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input";
		$edit_ar[2]["field_name"] 		= "section";
		$edit_ar[2]["field_ph"] 		= "Token Module";
		$edit_ar[2]["field_type"] 		= "string";
		$edit_ar[2]["field_classes"] 	= "block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input";
		
		
		$tbl->config_array($create_ar, $edit_ar);		
		
		// Delete Item Operations
		$output1 =  $tbl->exec_delete();
		if($output1 == "deleted") { $object["eventbox"]->warning("The item has been deleted!"); 
									$object["log"]->info("Item '".$item_general."' with ID: ".@$_POST["x_class_table_exec_deletetable"]." has been deleted by UID: ".$object["user"]->user_id."");}
		if($output1 == "csrf") { $object["eventbox"]->error("Form expired! Please try again!");}

		// Delete Operations
		$output1 =  $tbl->exec_create();
		if($output1 == "created") { $object["eventbox"]->warning("The item has been created!"); 
									$object["log"]->info("Item '".$item_general."' with ID: ".@$object["mysql"]->insert_id()." has been created by UID: ".$object["user"]->user_id."");}
		if($output1 == "csrf") { $object["eventbox"]->error("Form expired! Please try again!");}
		
		// Delete Operations
		$output1 =  $tbl->exec_edit();
		if($output1 == "edited") { $object["eventbox"]->warning("The item has been edited!"); 
									$object["log"]->info("Item '".$item_general."' with ID: ".@$object["mysql"]->insert_id()." has been edited by UID: ".$object["user"]->user_id."");}
		if($output1 == "csrf") { $object["eventbox"]->error("Form expired! Please try again!");}

	
		////////////////////////////////////////////////////////////////
		// Get Table Values
		////////////////////////////////////////////////////////////////
		$value_array = $object["mysql"]->select("SELECT ".$trts_general." FROM ".$table_general."", true);
		if(is_array($value_array)) {
			foreach($value_array as $key => $value) {
				$value_array[$key]["api_token"] = @htmlspecialchars($value_array[$key]["api_token"]);
				$value_array[$key]["direction"] = @htmlspecialchars($value_array[$key]["direction"]);
				$value_array[$key]["section"] = @htmlspecialchars($value_array[$key]["section"]);
			}
		}

		// Div with Top Margin for Elements!
		echo "<div class='xfpe_margintop15px'></div>";
		
		// Display the Information Box!
		hive__dashboard_alert_info($text_general);
		
		if(@!$_POST["x_class_table_exec_edittable"]) {
			hive__dashboard_box_start("Add Token", "min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800");
			$tbl->spawn_create("Create Token", "flex items-center justify-between px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-primary-bugfish border border-transparent rounded-lg 	active:bg-primary-bugfish hover:bg-primary-bugfish focus:outline-none focus:shadow-primary-bugfish force-white-focus");
			hive__dashboard_box_end();
		} else {
			hive__dashboard_box_start("Edit Token", "min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800");
			$tbl->spawn_edit("Edit Token", "flex items-center justify-between px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-primary-bugfish border border-transparent rounded-lg active:bg-primary-bugfish hover:bg-primary-bugfish focus:outline-none focus:shadow-primary-bugfish force-white-focus");
			hive__dashboard_box_end();
		}
		
		// Display the Table!
		hive__dashboard_box_start($title_general ." Listing", "min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800 xfpe_margintop15px");
		$tbl->spawn_table($table_title, $value_array, "Edit", "Delete", "New Token", "Action", "display");
		hive__dashboard_box_end();
	}