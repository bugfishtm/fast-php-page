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
		
		File Description:
			File in this folder with mysql.**table_name**.php will be installed automatically if you use syntax below.
			Use CREATE TABLE IF NOT EXISTS - to prevent performance lowagen through handler errors.
			File name shall not create the Prefix which has been set at the installation, prefix of tables will
			automatically be included!
	*/ if(!is_array($object)) { @http_response_code(404); Header("Location: ../"); exit(); }	
		$object["mysql"]->multi_query("
			CREATE TABLE IF NOT EXISTS `"._HIVE_PREFIX_."sys_wfc_link` (
			  `id` int(11) NOT NULL AUTO_INCREMENT,
			  `fk_wfc` int(11) NOT NULL COMMENT 'Related WFC',
			  `fk_wfc_name` text NOT NULL COMMENT 'Related Function Name',
			  `wfc_setting` text NULL COMMENT 'WFC Settings',
			  `wfc_sort` int(11) NULL COMMENT 'WFC Sort Number',
			  `wfc_container` TEXT DEFAULT NULL COMMENT 'WFC Container String',
			  `fk_creator` int(11) DEFAULT NULL, 
			  `site_data` text DEFAULT NULL COMMENT 'Additional Data for Site Modules',
			  `creation` datetime DEFAULT CURRENT_TIMESTAMP COMMENT 'Creation Date auto set',
			  `modification` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Modification Date auto set',
			  PRIMARY KEY (`id`) USING BTREE );
		");
		
