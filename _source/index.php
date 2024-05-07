<?php
	/* 
		 _               __ _    _    ___ __  __ ___ 
		| |__ _  _ __ _ / _(_)__| |_ / __|  \/  / __|
		| '_ \ || / _` |  _| (_-< ' \ (__| |\/| \__ \
		|_.__/\_,_\__, |_| |_/__/_||_\___|_|  |_|___/
				  |___/                              

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
		
		File Description:
			Initial Site Loadup File
	*/
	
	////////////////////////////////////////////////////////////////////////////////////
	// Loadup File for all Site Modules
	// This file may gets updated during core updates.
	////////////////////////////////////////////////////////////////////////////////////
	
	if(file_exists("./settings.php")) {
		// Require settings.php if existant
		require_once("./settings.php");
		
		if(@trim(@$_GET["hive__seo_tag_loc"] ?? '') != ""  AND @$_GET["hive__seo_tag_loc"] != false) {
			if(!_HIVE_URL_SEO_) {
				require_once($object["path"]."/_core/_error/error.404.php");
				exit();
			}
		}
		
		$version = explode('.', PHP_VERSION);
		if($version[0] <= 7) {  
			hive_error_full("Critical Error", "This software does need at least PHP8.X to run properly!", "Your system is running PHP ".$version[0].", which is NOT supported!", true, 503);		
		}		
		unset($version);
		
		// Check if Public/Internal/Restricted is writeable
		if ( ! is_writable(dirname(_HIVE_PATH_PRIVATE_."/dummy.file"))) {
			hive_error_full("Critical Error", "File/Folder permission error!", "The folder: '"._HIVE_PATH_PRIVATE_."' is not writeable!", true, 503);	
		}
		if ( ! is_writable(dirname(_HIVE_PATH_INTERNAL_."/dummy.file"))) {
			hive_error_full("Critical Error", "File/Folder permission error!", "The folder: '"._HIVE_PATH_INTERNAL_."' is not writeable!", true, 503);	
		}
		if ( ! is_writable(dirname(_HIVE_PATH_PUBLIC_."/dummy.file"))) {
			hive_error_full("Critical Error", "File/Folder permission error!", "The folder: '"._HIVE_PATH_PUBLIC_."' is not writeable!", true, 503);	
		}
		
		// If not Site Mode Found Display Error
		if(!defined("_HIVE_BUILD_")) { 
			hive_error_full("Critical Error", "_HIVE_BUILD_ not found while initializing the Side Module: '".@htmlspecialchars(_HIVE_MODE_ ?? '')."'!", "Please check the version.php informations of the deployed module.", true, 503);
		}
		if(!defined("_HIVE_RNAME_")) { 
			hive_error_full("Critical Error", "_HIVE_RNAME_ not found while initializing the Side Module: '".@htmlspecialchars(_HIVE_MODE_ ?? '')."'!", "Please check the version.php informations of the deployed module.", true, 503);
		}
		if(!defined("_HIVE_VERSION_")) { 
			hive_error_full("Critical Error", "_HIVE_VERSION_ not found while initializing the Side Module: '".@htmlspecialchars(_HIVE_MODE_ ?? '')."'!", "Please check the version.php informations of the deployed module.", true, 503);
		}
		if(!defined("_HIVE_BUILD_ACTIVE_")) { 
			hive_error_full("Critical Error", "_HIVE_BUILD_ACTIVE_ not found while initializing the Side Module: '".@htmlspecialchars(_HIVE_MODE_ ?? '')."'!", "Please check the version.php informations of the deployed module.", true, 503);
		}
		if(!defined("_HIVE_RNAME_ACTIVE_")) { 
			hive_error_full("Critical Error", "_HIVE_RNAME_ACTIVE_ not found while initializing the Side Module: '".@htmlspecialchars(_HIVE_MODE_ ?? '')."'!", "Please check the version.php informations of the deployed module.", true, 503);
		}
		
		if(_HIVE_BUILD_ == 0) { 
			hive_error_full("Critical Error", "_HIVE_BUILD_ is NULL while initializing the Side Module: '".@htmlspecialchars(_HIVE_MODE_ ?? '')."'!", "Please check if the module folder exists in _site!", true, 503);		
		}
		if(_HIVE_RNAME_ == 0) { 
			hive_error_full("Critical Error", "_HIVE_RNAME_ is NULL while initializing the Side Module: '".@htmlspecialchars(_HIVE_MODE_ ?? '')."'!", "Please check the version.php informations of the deployed module.", true, 503);		
		}
		if(_HIVE_VERSION_ == 0) { 
			hive_error_full("Critical Error", "_HIVE_VERSION_ is NULL while initializing the Side Module: '".@htmlspecialchars(_HIVE_MODE_ ?? '')."'!", "Please check the version.php informations of the deployed module.", true, 503);		
		}
		if(_HIVE_BUILD_ACTIVE_ == 0) { 
			hive_error_full("Critical Error", "_HIVE_BUILD_ACTIVE_ is NULL while initializing the Side Module: '".@htmlspecialchars(_HIVE_MODE_ ?? '')."'!", "Please check the version.php informations of the deployed module.", true, 503);		
		}
		if(_HIVE_RNAME_ACTIVE_ == 0) { 
			hive_error_full("Critical Error", "_HIVE_RNAME_ACTIVE_ is NULL while initializing the Side Module: '".@htmlspecialchars(_HIVE_MODE_ ?? '')."'!", "Please check the version.php informations of the deployed module.", true, 503);		
		}
		
		// Check Update and Build Number/RNAME
		if(_HIVE_RNAME_ != _HIVE_RNAME_ACTIVE_) {
			// Update is needed
			hive_error_full("Module Error", "The installed _HIVE_RNAME_: '".@htmlspecialchars(_HIVE_RNAME_ ?? '')."' does not match the module folders _HIVE_RNAME_ACTIVE_: '".@htmlspecialchars(_HIVE_RNAME_ACTIVE_ ?? '')."'!", "You need to delete the old data manually or in the administrator interface to use this module!", true, 503);
		} 			
		
		// Check Update and Build Number/RNAME
		if(_HIVE_BUILD_ > _HIVE_BUILD_ACTIVE_) {
			// Update is needed
			hive_error_full("Update Required", "You need to visit <a href='./updater.php'>./updater.php</a> for: '".@htmlspecialchars(_HIVE_MODE_ ?? '')."'!", "Version/Build in Database does not fit the current running site module.<br /> You may need to update this website to proceed!", true, 503);
		} 	
		// Check Update and Build Number/RNAME
		if(_HIVE_BUILD_ < _HIVE_BUILD_ACTIVE_) {
			// Update is needed
			hive_error_full("Downgrade Error", "Module: '".@htmlspecialchars(_HIVE_MODE_ ?? '')."' files have been downgraded, please install folder build: '".@htmlspecialchars(_HIVE_BUILD_ACTIVE_ ?? '')."'!", "It is not recommended to downgrade a deployed module!", true, 503);
		} 	
		
		// Check Update and Build Number/RNAME
		if(_HIVE_BUILD_ != _HIVE_BUILD_ACTIVE_) {
			// Update is needed
			hive_error_full("Critical Error", "Critical module versioning error for: '".@htmlspecialchars(_HIVE_MODE_ ?? '')."'!", "Version/Build error with current installed module! [Install and Deployed does not fit]", true, 503);
		} 	
		
		if(defined("_HIVE_CRIT_ER_")) {
			hive_error_full("Critical Error", "Critical Page Error on: '".@htmlspecialchars(_HIVE_MODE_ ?? '')."'!", "Unspecified Error!", true, 503);
		}
		
		// Check for Existant load.php
		if(file_exists($object["path"]."/_site/"._HIVE_MODE_."/load.php")) {
			// Include Load.php
			require_once("./_site/"._HIVE_MODE_."/load.php"); 
			// Execute Scripts
			$object["benchmark"]->execute($object["mysql"]->benchmark_get());
			$object["hitcounter"]->execute();
		} else { 
			// Error load.php not found!
			hive_error_full("Critical Error", "Something went wrong initializing the Side Module '".@htmlspecialchars(_HIVE_MODE_ ?? '')."'!", "We found no load.php file for activated Site Module.<br />Please re-install Site Module or check availability of related load.php.", true, 503);
		}
	} else {
		// Error without Configuration
		function hive_error_full_out($title, $subtitle, $description, $exit, $code) { 
		if(is_numeric($code)) { @http_response_code($code); }?>	
<!DOCTYPE html>
<html lang="en">
<head>
	<!--
		 _               __ _    _    ___ __  __ ___ 
		| |__ _  _ __ _ / _(_)__| |_ / __|  \/  / __|
		| '_ \ || / _` |  _| (_-< ' \ (__| |\/| \__ \
		|_.__/\_,_\__, |_| |_/__/_||_\___|_|  |_|___/
				  |___/                              	
										Error / Notification CMS Page
	-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="robots" content="noindex, nofollow">
	<?php if(defined("_HIVE_URL_REL_")) { ?> <link rel="icon" type="image/x-icon" href="<?php echo _HIVE_URL_REL_; ?>/_core/_image/favicon.ico"> <?php } ?>
    <title><?php echo $title; ?><?php if(defined("_HIVE_TITLE_SPACER_")) { echo _HIVE_TITLE_SPACER_; } else { echo " - "; } ?><?php if(defined("_HIVE_TITLE_")) { echo _HIVE_TITLE_; } else { echo "CMS"; } ?></title>
    <style>
        body { 	margin: 0;
				padding: 0;
				height: 100vh;
				min-height: 225px;
				display: flex;
				justify-content: center;
				align-items: center;
				background-color: #080808;
				color: #fff;
				padding-top: 20px;
				padding-bottom: 20px;
				box-sizing: border-box;
				font-family: Arial, sans-serif; }
        h1 { 	font-size: 24px; margin-bottom: 10px; }
        p { 	font-size: 16px; margin-bottom: 20px; }
        .container {
				text-align: center;
				max-width: 400px;
				padding: 20px;
				margin: 20px;
				padding-top: 0px;
				border: 2px solid #FF0000;
				border-radius: 10px;
				background-color: #121212;}
        .box {
            background-color: #444;
            padding: 10px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
			font-size: 14px !important;
			text-align: left;
			max-height: 75px;
			overflow-y: auto;
			font-family: Courier; }
		a { color: white; text-decoration: none; font-size: 12px; }
        .info-container {
				border: 2px solid #0080ff;}
        .ok-container {
				border: 2px solid #15ff00;}
		.box a {
			color: #FFFF00;
		}
    </style>
</head>
<body>
    <div class="container <?php echo @$type; ?>-container">
        <h1><?php echo $title; ?></h1>
        <div class="box <?php echo @$type; ?>-box">
            Information:<br /><?php echo $subtitle; ?><br /><br />
			Details:<br /><?php echo $description; ?>
        </div><br />
		<a href="../">Click here to get back!</a>
    </div>
</body>
</html>
	<?php if($exit) { exit(); } }
		// If Settings.php Missing show Installation Notice
		hive_error_full_out("Deploy", "You need to install at: <a href='./installer.php'>./installer.php</a>", "We found no settings.php file!<br > It seems that this is the first time you viewing this instance.", true, 503);
	}