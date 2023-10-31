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
	function  hive_get_url_rel($array) {
		$url_rel = _HIVE_URL_REL_."";
		if(_HIVE_URL_SEO_) {
			foreach($array as $key => $value) {
				if($value == false) { break;}
				if($key == 0) {  } else {$url_rel .= "/";  }
				if(@is_string(@_HIVE_URL_GET_[$key]) AND @is_string($value)) { $url_rel .= $value; }
			}
		} else {
			foreach($array as $key => $value) {
				if($value == false) { break;}
				if($key == 0) { $url_rel .= "?"; } else {$url_rel .= "&";  }
				if(@is_string(@_HIVE_URL_GET_[$key]) AND @is_string($value)) { $url_rel .= _HIVE_URL_GET_[$key]."=".$value; }
			}
		}
		return $url_rel;
	}