<?php
	/* 	__________ ____ ___  ___________________.___  _________ ___ ___  
		\______   \    |   \/  _____/\_   _____/|   |/   _____//   |   \ 
		 |    |  _/    |   /   \  ___ |    __)  |   |\_____  \/    ~    \
		 |    |   \    |  /\    \_\  \|     \   |   |/        \    Y    /
		 |______  /______/  \______  /\___  /   |___/_______  /\___|_  / 
				\/                 \/     \/                \/       \/  	
							www.bugfish.eu
							
	    Bugfish Framework
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
	class x_class_file {
		// Class Variables
		private $mysql     				= false;
		private $tbl_file				= false;
		private $tbl_folder				= false;
		private $section   				= false;
		
		// Constructor
		function __construct($mysql, $tbl_file, $tbl_folder, $section = "") {
			$this->mysql	= $mysql;
			$this->tbl_file = $tbl_file;
			$this->tbl_folder = $tbl_folder;
			$this->section = @substr(trim($section), 0, 127);
		
		}	
			
			
			

		function folder_delete() {
			
		}
		
		function folder_exists() {
			
		}
		
		function folder_create() {
			
		}
		
		function folder_change_name() {
			
		}
		
		function file_delete() {
			
		}
		
		function file_create() {
			
		}
		
		function file_change_name() {
			
		}
		
		function file_change_pass() {
			
		}
		
		function file_change_visibility() {
		}
		
		function api_upload() {
		}
		
		function api_download() {
		}
	}
