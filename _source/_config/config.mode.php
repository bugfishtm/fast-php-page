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
		// Website: www.bugfish.eu  */
	define('_HIVE_MOD_SWITCH_',  		true);	
	define('_HIVE_MOD_SWITCH_MENU_',  		true);	
	define("_HIVE_MODE_DEFAULT_", 	"_simple");
	define("_HIVE_MODE_ARRAY_", 	array("_simple", "_dashboard"));
	
	// Switcher
	if(@is_string(@$_SESSION[_HIVE_COOKIE_."hive_mode"]) AND _HIVE_MOD_SWITCH_ AND @in_array(@$_SESSION[_HIVE_COOKIE_."hive_mode"], @_HIVE_MODE_ARRAY_)) {
		define("_HIVE_MODE_", 	$_SESSION[_HIVE_COOKIE_."hive_mode"]);
	} else {
		define("_HIVE_MODE_", 	_HIVE_MODE_DEFAULT_);
		$_SESSION[_HIVE_COOKIE_."hive_mode"] = _HIVE_MODE_DEFAULT_;
	}