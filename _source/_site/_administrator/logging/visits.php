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
	if(!hive__access($object, "admin_logging", false) AND $object["user"]->user["user_initial"] != 1) {
		define("_INT_SHOW_ACCESS_", "true");
	} else {		
		////////////////////////////////////////////////////////////////
		// Variables
		////////////////////////////////////////////////////////////////
		$title_general 	= "Visits";
		$trts_general 	= "modification, full_url, switches, arrivals, summarized, section, id";
		$item_general 	= "Visits Entry";
		$text_general 	= "Track and analyze website visits with comprehensive data and insights in this dedicated section, empowering you to understand user behavior and optimize site performance.";
		$table_general 	= _TABLE_LOG_VISIT_;
		$table_title   	= array(array("name" => "Modification"),
							    array("name" => "URL"),
							    array("name" => "Switched"),
							    array("name" => "Arrived"),
							    array("name" => "Hits"),
							    array("name" => "Module"));
		
		// Create Table Object
		$tbl = new x_class_table($object["mysql"], $table_general, "table");
		
		// Table Flush Operation
		if(@$_POST["hive_submit_flush_table"]) { 
			$object["mysql"]->query("DELETE FROM ".$table_general."");
			$object["mysql"]->query("ALTER TABLE ".$table_general." AUTO_INCREMENT = 1");
			$object["eventbox"]->warning("The Table '".$table_general."' has been flushed!");
			$object["log"]->info("Table: '".$table_general."' flushed by UID: ".$object["user"]->user_id."");
		}		
		
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
				$value_array[$key]["modification"] = @htmlspecialchars($value_array[$key]["modification"]);
				$value_array[$key]["full_url"] = @htmlspecialchars($value_array[$key]["full_url"]);
				$value_array[$key]["switches"] = @htmlspecialchars($value_array[$key]["switches"]);
				$value_array[$key]["arrivals"] = @htmlspecialchars($value_array[$key]["arrivals"]);
				$value_array[$key]["summarized"] = @htmlspecialchars($value_array[$key]["summarized"]);
				$value_array[$key]["section"] = @htmlspecialchars($value_array[$key]["section"]);
			}
		}

		// Div with Top Margin for Elements!
		echo "<div class='xfpe_margintop15px'></div>";
		
		// Display the Information Box!
		hive__dashboard_alert_info($text_general);
		
		// Display the Operations Bar!
		hive__dashboard_box_start(false, "min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800 dark:text-gray-200");
			echo "<form method='post' action='./?"._HIVE_URL_GET_[0]."="._HIVE_URL_CUR_[0]."&"._HIVE_URL_GET_[1]."="._HIVE_URL_CUR_[1]."'>";
				hive__dashboard_button_icright("Flush Table", "bx bxs-radiation", "red", "white", "submit", "", "hive_submit_flush_table");
				echo "<input type='hidden' name='hive_submit_flush_table' value='1'>";
			echo "</form>";
		hive__dashboard_box_end();
		
		// Display the Table!
		hive__dashboard_box_start($title_general ." Listing", "min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800 xfpe_margintop15px");
		$tbl->spawn_table($table_title, $value_array, false, "Delete", false, "Delete", "display");
		hive__dashboard_box_end();
	}