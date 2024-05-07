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
			Core Updater file for Store Functionalitites and Updating Core
	*/
		
	// Folder containing the files
	$folder = './_core/';

	// Get all files in the folder
	$files = glob($folder . '*.zip');

	// Function to extract version number from filename
	function extractVersion($filename) {
		preg_match('/(\d+\.\d+)/', $filename, $matches);
		return $matches[1];
	}

	// Array to store version numbers
	$versions = [];

	// Extract version numbers from filenames
	foreach ($files as $file) {
		$version = extractVersion(basename($file));
		$versions[] = $version;
	}

	// Sort the version numbers in descending order
	rsort($versions);

	// Output the sorted version numbers
	echo serialize($versions);