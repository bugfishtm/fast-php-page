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
		$title_general 	= "File";
		$trts_general 	= "file_title, file_size, id";
		$item_general 	= "File";
		$text_general 	= "Streamline File administration effortlessly. Organize, modify, and oversee Files with ease, ensuring optimal access control and efficient collaboration within your platform.";
		$table_general 	= _HIVE_SITE_PREFIX_."file";
		$table_title   	= array(array("name" => "Name"),
							    array("name" => "Size"));
		
		// Create Table Object
		$tbl = new x_class_table($object["mysql"], $table_general, "table");
		
		// Table Edit Arrays and Create
		$tbl->config_rel_url("./?"._HIVE_URL_GET_[0]."="._HIVE_URL_CUR_[0]."&"._HIVE_URL_GET_[1]."="._HIVE_URL_CUR_[1]."");
		$create_ar  = array();
		$create_ar[0]["field_name"] 	= "file_title";
		$create_ar[0]["field_ph"] 		= "File Name";
		$create_ar[0]["field_type"] 	= "string";
		$create_ar[0]["field_classes"] 	= "block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input";
		$create_ar[3]["field_classes"] 	= "block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input";
		$edit_ar    = array();
		$edit_ar[0]["field_name"] 	= "file_title";
		$edit_ar[0]["field_ph"] 		= "File Name";
		$edit_ar[0]["field_type"] 	= "string";
		$edit_ar[0]["field_classes"] 	= "block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input";
		$tbl->config_array($create_ar, $edit_ar);			
		
		// Delete Item Operations
		$output1 =  $tbl->exec_delete();
		if($output1 == "deleted") { $object["eventbox"]->warning("The item has been deleted!"); unlink(_HIVE_PATH_."/_restricted/"._HIVE_MODE_."/".@$_POST["x_class_table_exec_deletetable"]);
									$object["log"]->info("Item '".$item_general."' with ID: ".@$_POST["x_class_table_exec_deletetable"]." has been deleted by UID: ".$object["user"]->user_id."");}
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
				$value_array[$key]["file_title"] = "<a href='./_site/"._HIVE_MODE_."/endpoint/download.php?id=".$value_array[$key]["id"]."'>".@htmlspecialchars($value_array[$key]["file_title"])."</a>";
				$value_array[$key]["file_size"] = @htmlspecialchars($value_array[$key]["file_size"]);
			}
		}

		// Div with Top Margin for Elements!
		echo "<div class='xfpe_margintop15px'></div>";
		
		// Display the Information Box!
		hive__dashboard_alert_danger("Files here are only download-able if logged in!");
		
		if(@$_POST["x_class_table_exec_edittable"]) {
			hive__dashboard_box_start("Edit File", "min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800 xfpe_margintop15px");
			$tbl->spawn_edit("Edit File", "flex items-center justify-between px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-primary-bugfish border border-transparent rounded-lg active:bg-primary-bugfish hover:bg-primary-bugfish focus:outline-none focus:shadow-primary-bugfish force-white-focus");
			hive__dashboard_box_end();
		} else {
			// Display the Operations Bar!
			hive__dashboard_box_start("Hochladen", "min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800 dark:text-gray-200"); ?>
			<!-- Uploader HTML -->
			<a id="file_upload_button">Select and Upload Files</a> 
			<!-- Uploader Script -->
			<script>
				<!-- Here are Functions for File Uploading -->
				var currentCatching = 0;
				var currentFiles = 0;
				var error_happen = false;
				var error_files = 0;
				
				// Initialization
				var r = new Resumable({ target: '<?php echo _HIVE_URL_REL_; ?>/_site/<?php echo _HIVE_MODE_; ?>/endpoint/upload.php', maxFileSize: 500000000000, maxFiles: 20});
				r.assignBrowse(document.getElementById('file_upload_button'));
				//r.assignDrop(document.getElementById('file_upload_button'));
				//r.opts.target  = "; 
				
				r.on('fileSuccess', function(file){
					currentCatching = currentCatching + 1;	
				});		
				
				r.on('complete', function()				{ console.debug('complete'); window.location.href = window.location.href+""; } );	
				r.on('filesAdded', function(array)	   	{ r.upload(); xjs_popup("Uploading...please wait!"); });
				r.on('fileAdded', function(file, event)	{ currentFiles = currentFiles + 1; });	
				r.on('fileSuccess', function(file)		{ currentCatching = currentCatching + 1;}); 		
				r.on('progress', function(){});	
				r.on('fileProgress', function(file) 	{  } ); 
				r.on('fileError', function(file, message){ error_happen = true; });
				r.on('error', function(message, file){ error_happen = true; });
				r.on('fileRetry', function(file){ /* No Reaction Integrated */ });
				r.on('pause', function(){ /* No Reaction Integrated */ });
				r.on('cancel', function(){ /* No Reaction Integrated */ });
			</script>			
			<?php
			hive__dashboard_box_end();	
		}
		
		// Display the Table!
		hive__dashboard_box_start($title_general ." Listing", "min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800 xfpe_margintop15px");
		$tbl->spawn_table($table_title, $value_array, "Edit", "Delete", false, "Action", "display");
		hive__dashboard_box_end();
	}