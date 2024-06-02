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
	// Button Elements
	#############################################################################################################################################
	function hive__adminbsb_button_danger($text , $type = "button", $name = "", $js = "", $classes = "") { 
		if($type == false) { $type = "button"; }
		if($classes == false) { $classes = ""; }
		if($js == false) { $js = ""; }
		if($name == false) { $name = ""; }
		return '<button class="btn btn-danger '.$classes.'" name="'.$name.'" onClick="'.$js.'" type="'.$type.'">'.$text.'</button>';	}
	function hive__adminbsb_button_success($text , $type = "button", $name = "", $js = "", $classes = "") { 
		if($type == false) { $type = "button"; }
		if($classes == false) { $classes = ""; }
		if($js == false) { $js = ""; }
		if($name == false) { $name = ""; }
		return '<button class="btn btn-success '.$classes.'" name="'.$name.'" onClick="'.$js.'" type="'.$type.'">'.$text.'</button>';	}
	function hive__adminbsb_button_warning($text , $type = "button", $name = "", $js = "", $classes = "") { 
		if($type == false) { $type = "button"; }
		if($classes == false) { $classes = ""; }
		if($js == false) { $js = ""; }
		if($name == false) { $name = ""; }
		return '<button class="btn btn-warning '.$classes.'" name="'.$name.'" onClick="'.$js.'" type="'.$type.'">'.$text.'</button>';	}
	function hive__adminbsb_button_info($text , $type = "button", $name = "", $js = "", $classes = "") { 
		if($type == false) { $type = "button"; }
		if($classes == false) { $classes = ""; }
		if($js == false) { $js = ""; }
		if($name == false) { $name = ""; }
		return '<button class="btn btn-info '.$classes.'" name="'.$name.'" onClick="'.$js.'" type="'.$type.'">'.$text.'</button>';	}
	function hive__adminbsb_button_primary($text , $type = "button", $name = "", $js = "", $classes = "") { 
		if($type == false) { $type = "button"; }
		if($classes == false) { $classes = ""; }
		if($js == false) { $js = ""; }
		if($name == false) { $name = ""; }
		return '<button class="btn btn-primary '.$classes.'" name="'.$name.'" onClick="'.$js.'" type="'.$type.'">'.$text.'</button>';	}
	function hive__adminbsb_button_secondary($text , $type = "button", $name = "", $js = "", $classes = "") { 
		if($type == false) { $type = "button"; }
		if($classes == false) { $classes = ""; }
		if($js == false) { $js = ""; }
		if($name == false) { $name = ""; }
		return '<button class="btn btn-secondary '.$classes.'" name="'.$name.'" onClick="'.$js.'" type="'.$type.'">'.$text.'</button>';	}