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
			Updater and listing Script for external Stores!
	*/ if(file_exists("../settings.php")) { require_once("../settings.php"); }
		else { echo "Store is currently not available! [Error x1]"; exit(); }
			
		$x_array = $object["mysql"]->select("SELECT * FROM "._TABLE_STORE_." WHERE is_active = 1 ORDER BY mod_rname, mod_version, mod_build DESC", true);
		if(is_array($x_array)) { 
			echo serialize($x_array);
		} else {
			echo serialize(array());
		}