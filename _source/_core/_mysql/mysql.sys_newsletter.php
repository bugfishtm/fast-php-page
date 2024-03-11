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
	$object["mysql"]->multi_query("CREATE TABLE IF NOT EXISTS `"._HIVE_PREFIX_."sys_newsletter` (
		  `id` int NOT NULL AUTO_INCREMENT COMMENT 'Unique ID', 
		  `nl_mail` varchar(128) NOT NULL COMMENT 'Registred Mail',
		  `nl_reg_count` tinyint(1) DEFAULT NULL COMMENT 'Mail Try Count',
		  `nl_state` tinyint(1) DEFAULT '0' COMMENT '1 - Active | 0 - Awaiting Opt',
		  `nl_token` varchar(64) NOT NULL DEFAULT '0' COMMENT 'Token For OptIn',
		  `nl_token_count` int(11) DEFAULT '0' COMMENT 'Clicked on URLs with Token in Mail Count',
		  `nl_mails_count` int(11) DEFAULT '0' COMMENT 'Count Mails to this User',
		  `site_data` text DEFAULT NULL COMMENT 'Additional Data for Site Modules',
		  `section` varchar(128) DEFAULT NULL COMMENT 'Related Multi Site Section',
		  `last_mail_date` datetime DEFAULT NULL COMMENT 'Last Mail to This User', 
		  `creation` datetime DEFAULT CURRENT_TIMESTAMP COMMENT 'Creation Date auto set',
		  `modification` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Modification Date auto set',
		  PRIMARY KEY (`id`),
		  UNIQUE KEY `sys_newsletter` (`section`,`nl_mail`) USING BTREE
		);");