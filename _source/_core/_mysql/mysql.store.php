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
		$object["mysql"]->multi_query("
			CREATE TABLE IF NOT EXISTS `"._HIVE_PREFIX_."store` (
				`id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
			    `fk_user` int(11) DEFAULT NULL COMMENT 'ID of User who created this item',
			    `mod_type` int(9) DEFAULT NULL COMMENT '1 - Site Module | 2 - Site Extension | 3 - Extend Script', 
			    `mod_build` int(9) DEFAULT NULL COMMENT 'Build Number of the Module', 
			    `mod_version` text DEFAULT NULL COMMENT 'Version of the Module',  
			    `mod_lang` TEXT DEFAULT NULL COMMENT 'Serialized Array of Language Keys for Module',   
			    `mod_parent_rname` TEXT DEFAULT NULL COMMENT 'If extension, Parent Identifier Module Name',  
			    `mod_rname` TEXT DEFAULT NULL COMMENT 'Unique Module Identifier Name',  
			    `mod_name` TEXT DEFAULT NULL COMMENT 'Name of the Module',    
			    `mod_short` TEXT DEFAULT NULL COMMENT 'Short Description of the Module',  
			    `mod_license` TEXT DEFAULT NULL COMMENT 'License of the Module', 
			    `mod_autor` TEXT DEFAULT NULL COMMENT 'Module Creator',    
			    `mod_mail` TEXT DEFAULT NULL COMMENT 'Module Creator Mail',  
			    `mod_website` TEXT DEFAULT NULL COMMENT 'Module Creator Website',
			    `mod_description` TEXT DEFAULT NULL COMMENT 'Module Description', 
			    `is_active` int(11) DEFAULT 1 COMMENT '1 - Active for Deployment | 0 - Inactive for Deployment',   
			    `creation` datetime DEFAULT current_timestamp() COMMENT 'Creation Date auto set',
			    `modification` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT 'Modification Date auto set',
			PRIMARY KEY (`id`) USING BTREE);
		");