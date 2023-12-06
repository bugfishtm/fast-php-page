<?php
	/* 	 __   .__        .__ 
		|  | _|__|_  _  _|__|
		|  |/ /  \ \/ \/ /  |
		|    <|  |\     /|  |
		|__|_ \__| \/\_/ |__|
			 \/               Form Actions  */
	// Require Settings
	require_once("../../../settings.php");
	$folder = "../../../_restricted";
	if(!is_dir($folder)) { @mkdir($folder, 0770, true); @chmod($folder, 0770); }	 
	$folder = "../../../_restricted/"._HIVE_MODE_."";
	if(!is_dir($folder)) { @mkdir($folder, 0770, true); @chmod($folder, 0770); } 
	$folder = "../../../_restricted/"._HIVE_MODE_."/_cache";
	if(!is_dir($folder)) { @mkdir($folder, 0770, true); @chmod($folder, 0770); }
	
	if(!hive__access($object, "admin_backend", false)) {
		echo "no Permission"; exit();
	}	
	// Check Login
	if(!$object["user"]->user_loggedIn) { echo "no Permission!"; exit();} //$object["user"]->user_id

	### Request Operations ###
	if ($_SERVER['REQUEST_METHOD'] === 'GET') {
		if(!(isset($_GET['resumableIdentifier']) && trim($_GET['resumableIdentifier'])!='')){ $_GET['resumableIdentifier']=''; }
		$temp_dir = '../../../_restricted/'._HIVE_MODE_.'/_cache/'.$object["user"]->user_id.'/'.$_GET['resumableIdentifier'];
		if(!is_dir($temp_dir)) { @mkdir($temp_dir, 0770, true); @chmod($temp_dir, 0770); }
		if(!(isset($_GET['resumableFilename']) && trim($_GET['resumableFilename'])!='')){ $_GET['resumableFilename']=''; }
		if(!(isset($_GET['resumableChunkNumber']) && trim($_GET['resumableChunkNumber'])!='')){ $_GET['resumableChunkNumber']=''; }
		$chunk_file = $temp_dir.'/'.$_GET['resumableFilename'].'.part'.$_GET['resumableChunkNumber'];
		if (file_exists($chunk_file)) { header("HTTP/1.0 200 Ok"); } else { header("HTTP/1.0 404 Not Found"); }}		
		
	### Processing  ###
	if (!empty($_FILES)) foreach ($_FILES as $file) {		
		// If Error than Continue
		if ($file['error'] != 0) { continue; }

		// Get Post Identifier if Needed
		if(isset($_POST['resumableIdentifier']) && trim($_POST['resumableIdentifier'])!=''){ $temp_dir = '../../../_restricted/'._HIVE_MODE_.'/_cache/'.$object["user"]->user_id.'/'.$_POST['resumableIdentifier']; }

		// Current Chunk Destination File
		$dest_file = $temp_dir.'/'.$_GET['resumableFilename'].'.part'.$_POST['resumableChunkNumber'];
				
		// If Temp Dir does not Exist than make Dir
		if (!is_dir($temp_dir)) { mkdir($temp_dir, 0770, true); }
				
		// Move File and Go with Chunks
		if (move_uploaded_file($file['tmp_name'], $dest_file)) {
			// Create File from Chunks
			$total_files_on_server_size = 0;
			$temp_total = 0;					
				
			foreach(scandir($temp_dir) as $file) {
				$temp_total = $total_files_on_server_size;
				$tempfilesize = filesize($temp_dir.'/'.$file);
				$total_files_on_server_size = $temp_total + $tempfilesize;
			}

			if ($total_files_on_server_size >= $_POST['resumableTotalSize']) {
				if (($fp = fopen($temp_dir.'/'.$_POST['resumableFilename'], 'w')) !== false) {
					for ($i=1; $i<=$_POST['resumableTotalChunks']; $i++) {
						fwrite($fp, file_get_contents($temp_dir.'/'.$_POST['resumableFilename'].'.part'.$i));
					}
					fclose($fp);
				} else { return false; }
			}
					
			// If file Exists proceed
			if (file_exists($temp_dir.'/'.$_POST['resumableFilename'])) {
				$bind[0]["value"] = $_POST['resumableFilename'];
				$bind[0]["type"] = "s";
				$object["mysql"]->query("INSERT INTO "._HIVE_SITE_PREFIX_."file (file_title, file_size)
								VALUES (?, '".$object["mysql"]->escape($_POST['resumableTotalSize'])."');", $bind);	
				$id = $object["mysql"]->insert_id();
				$to = $temp_dir."/../../../".$id;
				rename($temp_dir.'/'.$_POST['resumableFilename'], $to);
			}
		}	
	}		
