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
	if(file_exists("./settings.php")) {
		// Require settings.php if existant
		require_once("./settings.php");
		// Check Update and Build Number
		if(_HIVE_BUILD_  > _HIVE_BUILD_ACTIVE_) {
			// Update is needed
			hive_error_full("Updates", "ERROR", "You need to update this software by executing updater.php!", true, 503);
		} elseif(_HIVE_BUILD_ < _HIVE_BUILD_ACTIVE_) {
			// Wrong Code Version installed!
			hive_error_full("Runtime", "ERROR", "Current installed Site Source Code Build ["._HIVE_BUILD_."] is lower than Database Build Version ["._HIVE_BUILD_ACTIVE_."]!", true, 503);
		}		
		// Check for Existant load.php
		if(file_exists($object["path"]."/_site/"._HIVE_MODE_."/load.php")) { 
			// Include Load.php
			require_once("./_site/"._HIVE_MODE_."/load.php"); 
			$object["benchmark"]->execute($object["mysql"]->benchmark_get());
		} else { 
			// Error load.php not found!
			hive_error_full("Runtime", "ERROR", "Load.php not found in sites directory!", true, 503);
		}
	} else {
		// If Settings.php Missing show Installation Notice
		Header("Location: ./installer.php");
	}