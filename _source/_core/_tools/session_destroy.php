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
			Tool Script to destroy current Session
	*/ if(file_exists("../../settings.php")) { require_once("../../settings.php"); } else { @http_response_code(404); Header("Location: ./"); exit(); }
	

	if(!_HIVE_ALLOW_TOOLS_) { hive_error_full("Access Error", "Script is deactivated in ruleset.php!", "Enable _HIVE_ALLOW_TOOLS_ in ruleset.php or in the _administration interface to enable this files execution!", true, 401);}
	session_destroy();?>
<html>
<head>
  <link rel="icon" type="image/x-icon" href="../_image/favicon.ico">
  <title>Session Deletion - CMS</title>
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
	<img src="../_image/logo_alpha_color.png" width="100">
    <p>Your Session has been destroyed!<br />Click <a href="../../developer.php">here</a> to go back!</p>
  </div>
 </body>
 </html>