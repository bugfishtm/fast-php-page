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
	if(file_exists("./settings.php")) {
		// Require settings.php if existant
		require_once("./settings.php");
		
		// Check Update and Build Number
		if(_HIVE_BUILD_  > _HIVE_BUILD_ACTIVE_) {
			// Update is needed
			http_response_code(503);
			require_once("./_core/_error/error.update.html");
			exit();
		} elseif(_HIVE_BUILD_ < _HIVE_BUILD_ACTIVE_) {
			// Wrong Code Version installed!
			http_response_code(503);
			require_once("./_core/_error/error.version.html");
			exit();
		}		
		
		// Check for Existant load.php
		if(file_exists($object["path"]."/_site/"._HIVE_MODE_."/load.php")) { 
			// Include Load.php
			require_once("./_site/"._HIVE_MODE_."/load.php"); 
			exit();
		} else { 
			// Error load.php not found!
			http_response_code(503); 
			require_once("./_core/_error/error.load.html"); 
			exit(); 
		}
	} else {
		// If Settings.php Missing show Installation Notice
		http_response_code(503);
		require_once("./_core/_error/error.install.html");
		exit();
	}