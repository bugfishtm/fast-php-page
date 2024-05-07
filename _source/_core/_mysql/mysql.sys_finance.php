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
			File in this folder with mysql.**table_name**.php will be installed automatically if you use syntax below.
			Use CREATE TABLE IF NOT EXISTS - to prevent performance lowagen through handler errors.
			File name shall not create the Prefix which has been set at the installation, prefix of tables will
			automatically be included!
	*/ if(!is_array($object)) { @http_response_code(404); Header("Location: ../"); exit(); }	
	$object["mysql"]->multi_query("CREATE TABLE IF NOT EXISTS `"._HIVE_PREFIX_."sys_finance` (
		  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Unique ID',
			`acc_type` varchar(12) NOT NULL COMMENT '1 - Incoming One | 2 - Incoming Reocc | 3 - Outgoing Once | 4 - Outgoing Reoccuring | 5 - Account',
			`acc_value` float(7,2) DEFAULT '0.00' COMMENT 'Transaction Value',
			`acc_name` varchar(256) NOT NULL COMMENT 'Transaction Name',
			`acc_data` text COMMENT 'Transaction Data',
			`fk_user` int(11) NULL DEFAULT '0' COMMENT 'Autor ID',
			`site_data` text DEFAULT NULL COMMENT 'Additional Data for Site Modules',
			`section` varchar(128) DEFAULT NULL COMMENT 'Related Multi Site Section',
			`creation` datetime DEFAULT CURRENT_TIMESTAMP COMMENT 'Creation Date auto set',
			`modification` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Modification Date auto set',
		  PRIMARY KEY (`id`)
		);");	
		
		
		