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
	*/ require_once("../../internal.php");
	if(!_HIVE_ALLOW_TOOLS_) { hive_error_full("Not Available", "ERROR", "This area of the site has been deactivated in internal.php[_HIVE_ALLOW_TOOLS_]!", true, 404); }
	if (isset($_SERVER['HTTP_COOKIE'])) {
		$cookies = explode(';', $_SERVER['HTTP_COOKIE']);
		foreach($cookies as $cookie) {
			$parts = explode('=', $cookie);
			$name = trim($parts[0]);
			setcookie($name, '', time()-1000);
			setcookie($name, '', time()-1000, '/');
		}
	}?>
<html>
<head>
  <link rel="icon" type="image/x-icon" href="../_image/favicon.ico">
  <title>Cookie Deletion</title>
  <meta charset="UTF-8">
  <style>
    body {
      background-color: #111;
      color: #fff;
      font-family: Arial, sans-serif;
      display: flex;
      align-items: center;
      justify-content: center;
      height: 100vh;
      margin: 0;
    }
    #countdown-box {
      background-color: #222;
      color: #fff;
      padding: 15px;
      border-radius: 8px;
      text-align: center;
    }
    p {
      font-size: 14px;
      margin: 0;
    }
	a {
		color: yellow;
		text-decoration: none;
	}
  </style>
</head>
<body>
  <div id="countdown-box">
    <p>Your Cookies has been destroyed!<br />Click <a href="../../developer.php">here</a> to go back!</p>
  </div>
 </body>
 </html>