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
	if(file_exists(dirname(__FILE__)."/../../settings.php")) { require_once(dirname(__FILE__)."/../../settings.php"); } else { echo "Not yet installed!"; exit(); }
	if(_CRON_ONLY_CLI_) { if(!x_inCLI()) { echo "Cronjob execution only allowed in cli!";  exit(); } }
	$php_space = "\r\n"; if(!x_inCLI()) { $php_space = "<br />"; }
	echo "// Starting Daily Fast-PHP-Page Cronjob".$php_space.$php_space;
	if(is_dir($object["path"]."/_site/")) {
		$scan = scandir($object["path"]."/_site/");
		foreach($scan as $file) {
		   if (is_dir($object["path"]."/_site/".$file."/_cron/_daily") AND $file != "." AND $file != ".." AND $file != "__internal") {
			   foreach (glob($object["path"]."/_site/".$file."/_cron/_daily/cron.*.php") as $filename){ 
					echo "// Starting Site: ".$file." Cronjob: ".basename($filename)."".$php_space.$php_space;
					require_once($filename);
			   }
		   }
		}	  
	}