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
	  
	// Cache Setup
	header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0"); 
	header("Cache-Control: post-check=0, pre-check=0", false);
	header("Pragma: no-cache");
	  
	// Content is Text/CSS
	header('Content-Type: text/css'); 
	  
    // Include Necessary CSS Files into this File
	if($object["user"]->loggedIn) {
		foreach (glob($object["path"]."/_site/"._HIVE_MODE_."/_css/css.global.*") as $filename){ require_once $filename; }
		foreach (glob($object["path"]."/_site/"._HIVE_MODE_."/_css/css.restricted.*") as $filename){ require_once $filename; }
	} else {
		foreach (glob($object["path"]."/_site/"._HIVE_MODE_."/_css/css.global.*") as $filename){ require_once $filename; }
		foreach (glob($object["path"]."/_site/"._HIVE_MODE_."/_css/css.public.*") as $filename){ require_once $filename; }
	}
	  
	// Include Framework CSS File
	require_once("./_framework/css/xcss_xfpe.css");	  
	  
