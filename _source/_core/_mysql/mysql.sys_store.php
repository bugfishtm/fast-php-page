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
			CREATE TABLE IF NOT EXISTS `"._HIVE_PREFIX_."sys_store` (
				`id` int(11) NOT NULL AUTO_INCREMENT,
			    `fk_creator` int(11) DEFAULT NULL,
			    `mod_rname` TEXT DEFAULT '',  
			    `mod_build` int(9) DEFAULT '', 
			    `mod_version` int(9) DEFAULT '',  
			    `mod_iframe` int(2) DEFAULT '',  
			    `mod_view` int(2) DEFAULT '', 
			    `mod_parent` TEXT DEFAULT '', 
			    `mod_ext` int(2) DEFAULT '', 
			    `mod_app` int(2) DEFAULT '', 
			    `mod_singleuse` int(2) DEFAULT '',  
			    `mod_tags` TEXT DEFAULT '',  
			    `mod_lang` TEXT DEFAULT '',   
			    `mod_license` TEXT DEFAULT '', 
			    `mod_autor` TEXT DEFAULT '',  
			    `mod_pseudo` TEXT DEFAULT '',  
			    `mod_mail` TEXT DEFAULT '',  
			    `mod_website` TEXT DEFAULT '',  
			    `mod_name` TEXT DEFAULT '',    
			    `mod_short` TEXT DEFAULT '',  
			    `mod_description` TEXT DEFAULT '', 
			    `is_active` int(11) DEFAULT 1,   
			    `is_beta` int(11) DEFAULT 0,   
			    `is_core_mod` int(11) DEFAULT 0,   
			    `creation` datetime DEFAULT current_timestamp(),
			    `modification` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
		    PRIMARY KEY (`id`) USING BTREE);
		");