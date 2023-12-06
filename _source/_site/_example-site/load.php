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
	if(!is_array($object)) { @http_response_code(404); Header("Location: ../"); exit(); }
	hive__dashboard_header($object, "Example Site Module", '<link rel="icon" type="image/x-icon" href="'._HIVE_URL_REL_.'/_core/_image/favicon.ico">', "dark");
	hive__dashboard_nav($object, "Example Site Module", array(hive_get_url_rel(array("create", false, false, false, false)), "Create Account"));
	hive__dashboard_start($object);
	hive__dashboard_topbar($object, $pfm,  true, hive_get_url_rel(array("search", false, false, false, false)), "Template", _HIVE_URL_REL_."/_core/_image/user_image.png", $lang_ar);
	hive__dashboard_content_start($object);
	switch(_HIVE_URL_CUR_[0]) {
		case "general": case false: case "":
				require_once(_HIVE_PATH_."/_site/"._HIVE_MODE_."/general.php");
			break;
		default:
				hive__dashboard_404($object);
	}
	hive__dashboard_content_end($object);
	hive__dashboard_end($object);
	$object["eventbox"]->show("Close");
	hive__dashboard_footer($object, _HIVE_CREATOR_);
