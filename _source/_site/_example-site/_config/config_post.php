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
	*/ if(!is_array($object)) { @http_response_code(404); Header("Location: ../"); exit(); }
	#####################################################################################
	## Dashboard Theme Language Menue (Needed if using Complex Theme)
	#####################################################################################	
		// Array for Language in topbar Changer
		$lang_ar = array();
		//$lang_ar[0]["current_ident"] = _HIVE_LANG_;
		$lang_ar[0]["current_img"] = _HIVE_URL_REL_."/_core/_vendor/country-flags-icons/png/"._HIVE_LANG_.".png";
		$lang_ar[0]["ident"] = "gb";
		$lang_ar[0]["img"] = _HIVE_URL_REL_."/_core/_vendor/country-flags-icons/png/gb.png";
		$lang_ar[0]["name"] = "English";
		$lang_ar[1]["ident"] = "de";
		$lang_ar[1]["img"] = _HIVE_URL_REL_."/_core/_vendor/country-flags-icons/png/de.png";
		$lang_ar[1]["name"] = "Deutsch";