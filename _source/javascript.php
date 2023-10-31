<?php
	/* 	
		@@@@@@@   @@@  @@@   @@@@@@@@  @@@@@@@@  @@@   @@@@@@   @@@  @@@  
		@@@@@@@@  @@@  @@@  @@@@@@@@@  @@@@@@@@  @@@  @@@@@@@   @@@  @@@  
		@@!  @@@  @@!  @@@  !@@        @@!       @@!  !@@       @@!  @@@  
		!@   @!@  !@!  @!@  !@!        !@!       !@!  !@!       !@!  @!@  
		@!@!@!@   @!@  !@!  !@! @!@!@  @!!!:!    !!@  !!@@!!    @!@!@!@!  
		!!!@!!!!  !@!  !!!  !!! !!@!!  !!!!!:    !!!   !!@!!!   !!!@!!!!  
		!!:  !!!  !!:  !!!  :!!   !!:  !!:       !!:       !:!  !!:  !!!  
		:!:  !:!  :!:  !:!  :!:   !::  :!:       :!:      !:!   :!:  !:!  
		 :: ::::  ::::: ::   ::: ::::   ::        ::  :::: ::   ::   :::  
		:: : ::    : :  :    :: :: :    :        :    :: : :     :   : :  
		   ____         _     __                      __  __         __           __  __
		  /  _/ _    __(_)__ / /    __ _____  __ __  / /_/ /  ___   / /  ___ ___ / /_/ /
		 _/ /  | |/|/ / (_-</ _ \  / // / _ \/ // / / __/ _ \/ -_) / _ \/ -_|_-</ __/_/ 
		/___/  |__,__/_/___/_//_/  \_, /\___/\_,_/  \__/_//_/\__/ /_.__/\__/___/\__(_)  
								  /___/                           
		Bugfish Framework - Skeleton / MIT License
		// Autor: Jan-Maurice Dahlmanns (Bugfish)
		// Website: www.bugfish.eu 
	*/
	// Include Settings.php
	require_once("./settings.php");
	  
	// Header Settings 
	header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0"); 
	header("Cache-Control: post-check=0, pre-check=0", false);
	header("Pragma: no-cache");
	  
	// Javascript Output Header
	header('Content-type: application/javascript'); 
	
	// Include Framework JS Library
	require_once("./_framework/javascript/xjs_library.js");
	
	// Include Necessary Files
	if($object["user"]->loggedIn) {
		foreach (glob($object["path"]."/_site/"._HIVE_MODE_."/_js/js.global.*") as $filename){ require_once $filename; }
		foreach (glob($object["path"]."/_site/"._HIVE_MODE_."/_js/js.restricted.*") as $filename){ require_once $filename; }
	} else {
		foreach (glob($object["path"]."/_site/"._HIVE_MODE_."/_js/js.global.*") as $filename){ require_once $filename; }
		foreach (glob($object["path"]."/_site/"._HIVE_MODE_."/_js/js.public.*") as $filename){ require_once $filename; }
	}