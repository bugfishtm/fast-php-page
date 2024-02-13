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
	*/ if(!is_array($object)) { @http_response_code(404); Header("Location: ../"); exit(); } ?>
	
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" href="./_core/_image/favicon.ico" type="image/x-icon">
    <title>AdminBSB Documentation</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            overflow: hidden;
        }

        #top-bar {
            background-color: #333;
            padding: 10px;
            text-align: center;
            color: #fff;
        }

        #iframe-container {
            width: 100%;
            height: calc(100vh - 40px); /* Adjusted for the top bar height */
        }

        #myIframe {
            width: 100%;
            height: 100%;
            border: none;
        }
    </style>
</head>
<body>
    <div id="top-bar">
        <a href="./_site/<?php echo _HIVE_MODE_; ?>/index.html" target="_blank" style="color: #fff; text-decoration: none;">[Direct Link]</a> - 
        <a href="./_core/_tools/admin_switch.php" style="color: #fff; text-decoration: none;">[Back to Administrator]</a>
    </div>
    
    <div id="iframe-container">
        <iframe id="myIframe" src="./_site/<?php echo _HIVE_MODE_; ?>/index.html" frameborder="0"></iframe>
    </div>
</body>
</html>
