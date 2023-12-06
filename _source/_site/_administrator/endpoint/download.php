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
	// Require Settings
	require_once("../../../settings.php");

	// Parameter Set
	$current_id			= @$_GET["id"];
	if(!hive__access($object, "admin_backend", false) AND $object["user"]->user["user_initial"] != 1) {
		echo "no Permission"; exit();
	}
	// Invalid GET id Handle	
	if(!is_numeric(@$_GET["id"])) {
		http_response_code(404);	
		@header("X-Robots-Tag: noindex, nofollow", true);
		echo "Invalid File Identificator!";
		exit(); }
	if(!$object["user"]->user_loggedIn) {
		http_response_code(404);	
		@header("X-Robots-Tag: noindex, nofollow", true);
		echo "Please Login!";
		exit(); }
	
	// Check if File Exists
	$filepath = _HIVE_PATH_."/_restricted/"._HIVE_MODE_."/".$current_id;
	if (!file_exists($filepath)) {
		@header("X-Robots-Tag: noindex, nofollow", true);
		http_response_code(404);			
		echo "File does not exist!";
		exit();	}
	
	$rx 	= $object["mysql"]->select("SELECT * FROM "._HIVE_SITE_PREFIX_."file WHERE id = \"".$current_id."\"");
	//header('Content-type: ' . mime_content_type($filepath));
	//header('Content-Disposition: attachment; filename="' . $rx["file_title"] . '"');
	//header("X-Sendfile: " . $filepath);
	
	// GET A NAME FOR THE FILE
	$basename = basename($filepath);
	
    // THESE HEADERS ARE USED ON ALL BROWSERS
    header("Content-Type: application-x/force-download");
    header("Content-Disposition: attachment; filename=\"".$rx["file_title"]."\"");
    header("Content-length: " . filesize($filepath));
    header("Expires: ".gmdate("D, d M Y H:i:s", mktime(date("H")+2, date("i"), date("s"), date("m"), date("d"), date("Y")))." GMT");
    header("Last-Modified: ".gmdate("D, d M Y H:i:s")." GMT");

    // THIS HEADER MUST BE OMITTED FOR IE 6+
    if (FALSE === strpos($_SERVER["HTTP_USER_AGENT"], 'MSIE '))
	{
        header("Cache-Control: no-cache, must-revalidate");
    }

	// THIS IS THE LAST HEADER
	header("Pragma: no-cache");
	readfile($filepath); 