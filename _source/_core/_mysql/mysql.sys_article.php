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
	$object["mysql"]->multi_query("CREATE TABLE IF NOT EXISTS `"._HIVE_PREFIX_."sys_article` (
	  `id` int NOT NULL AUTO_INCREMENT COMMENT 'Unique ID',
	  `seo_url` text NULL DEFAULT '' COMMENT 'Unique URL Name for SEO',
	  `art_fk_cat` int NOT NULL DEFAULT '0' COMMENT 'Related Cat',
	  `fk_cat_sub` int DEFAULT NULL COMMENT 'Related Subcat',
	  `fk_dist` int DEFAULT NULL COMMENT 'Parent Project',
	  `art_name` varchar(256) NOT NULL COMMENT 'Name',
	  `art_cover` varchar(1024) DEFAULT NULL COMMENT 'Cover URL',
	  `art_status` int(1) DEFAULT 0,
	  `art_descr` text COMMENT 'Description',
	  `meta_tags` text COMMENT 'Tags for Keywords',
	  `art_version` varchar(24) DEFAULT NULL COMMENT 'Version Number',
	  `fk_user` int(9) NOT NULL COMMENT 'Related Creating User',
	  `last_check` datetime DEFAULT NULL COMMENT 'Last Availability Check Date',
	  `site_data` text DEFAULT NULL COMMENT 'Additional Data for Site Modules',
	  `section` varchar(128) DEFAULT NULL COMMENT 'Related Multi Site Section',
	  `creation` datetime DEFAULT CURRENT_TIMESTAMP COMMENT 'Creation Date auto set',
	  `modification` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Modification Date auto set',
	  PRIMARY KEY (`id`) USING BTREE
	);");