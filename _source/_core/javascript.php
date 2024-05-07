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
			Javascript Loader file to load Files out of Site Module Directory 
			reltated to current active site mode into this file to be included in 
			the website.
	*/
	// Include Settings.php
	require_once("../settings.php");
	  
	// Header Settings 
	header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0"); 
	header("Cache-Control: post-check=0, pre-check=0", false);
	header("Pragma: no-cache");
	  
	// Javascript Output Header
	header('Content-type: application/javascript'); 
	
	// Include Framework JS Library
	require_once("../_framework/javascript/xjs_library.js");

	// Include Necessary Files
	if($object["user"]->loggedIn) {
		foreach (glob($object["path"]."/_site/"._HIVE_MODE_."/_js/js.global.*") as $filename){ require_once $filename; }
		foreach (glob($object["path"]."/_site/"._HIVE_MODE_."/_js/js.restricted.*") as $filename){ require_once $filename; }
	} else {
		foreach (glob($object["path"]."/_site/"._HIVE_MODE_."/_js/js.global.*") as $filename){ require_once $filename; }
		foreach (glob($object["path"]."/_site/"._HIVE_MODE_."/_js/js.public.*") as $filename){ require_once $filename; }
	}