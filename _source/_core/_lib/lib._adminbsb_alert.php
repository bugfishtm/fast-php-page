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
	// Alert Boxes
	#############################################################################################################################################
	function hive__adminbsb_alert_danger($message, $classes = "") { return '<div class="alert alert-danger '.$classes.'">'.$message.'</div>';	}
	function hive__adminbsb_alert_success($message, $classes = "") { return '<div class="alert alert-success '.$classes.'">'.$message.'</div>'; }
	function hive__adminbsb_alert_warning($message, $classes = "") { return '<div class="alert alert-warning '.$classes.'">'.$message.'</div>'; }
	function hive__adminbsb_alert_info($message, $classes = "") { return '<div class="alert alert-info '.$classes.'">'.$message.'</div>'; }
	function hive__adminbsb_alert_primary($message, $classes = "") { return '<div class="alert alert-primary bg-'._HIVE_THEME_.' '.$classes.'">'.$message.'</div>'; }
	function hive__adminbsb_alert_secondary($message, $classes = "") { return '<div class="alert alert-secondary '.$classes.'">'.$message.'</div>'; }