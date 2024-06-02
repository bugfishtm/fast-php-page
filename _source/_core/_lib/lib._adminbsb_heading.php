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
	if(!is_array(@$object)) { Header("Location: ../"); exit(); }
	#############################################################################################################################################
	// Heading Elements
	#############################################################################################################################################
	function hive__adminbsb_h1($message, $classes = "") { return '<h1 class="'.$classes.'">'.$message.'</h1>'; }
	function hive__adminbsb_h2($message, $classes = "") { return '<h2 class="'.$classes.'">'.$message.'</h2>'; }
	function hive__adminbsb_h3($message, $classes = "") { return '<h3 class="'.$classes.'">'.$message.'</h3>'; }
	function hive__adminbsb_h4($message, $classes = "") { return '<h4 class="'.$classes.'">'.$message.'</h4>'; }
	function hive__adminbsb_h5($message, $classes = "") { return '<h5 class="'.$classes.'">'.$message.'</h5>'; }