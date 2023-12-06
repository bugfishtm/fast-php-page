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
	*/ if(file_exists("../settings.php")) { require_once("../settings.php"); } else { @http_response_code(404); Header("Location: ../"); exit(); } 
	if(!_HIVE_ALLOW_ADMIN_) { hive_error_full("Not Available", "ERROR", "This area of the site has been deactivated in internal.php[_HIVE_ALLOW_ADMIN_]!", true, 404); } 
	?>
	<html>
		<head>
		  <link rel="icon" type="image/x-icon" href="./_image/favicon.ico">
		  <title>Administrator Access</title>
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
			<?php if(@$_SESSION[_HIVE_COOKIE_."hive_mode"] == _HIVE_ADMIN_SITE_) { $is_admin = true; } else { $is_admin = false; } ?>
			<p>You are currently <?php if(@$_SESSION[_HIVE_COOKIE_."hive_mode"] != _HIVE_ADMIN_SITE_) { echo "<b>NOT</b>"; } ?> in Administrator Mode!<br />If you came here by mistake you can leave <a href="../">here</a>.</p>
			<?php if($is_admin) { 
				if(@$_GET["adm_change_access"]) {
					@$_SESSION[_HIVE_COOKIE_."hive_mode"] = @$_SESSION[_HIVE_COOKIE_."hive_mode_last"];
					@http_response_code(404); Header("Location: ../"); exit();
				} ?>
				<br />
				<small>You can switch back to Site Module: </small><br />
				<?php 
					if(@trim(@$_SESSION[_HIVE_COOKIE_."hive_mode_last"]) == "") { $newmode = _HIVE_MODE_DEFAULT_; } else { $newmode = @$_SESSION[_HIVE_COOKIE_."hive_mode_last"]; }
					echo "<b>".@htmlspecialchars($newmode)."</b><br /><br />"; ?>
				<form method="get">
					<input type="submit" value="Frontend Mode" name="adm_change_access">
				</form>
			<?php } else { 
				if(@$_GET["adm_change_access"]) {
					@$_SESSION[_HIVE_COOKIE_."hive_mode_last"] = @$_SESSION[_HIVE_COOKIE_."hive_mode"];
					@$_SESSION[_HIVE_COOKIE_."hive_mode"] = _HIVE_ADMIN_SITE_;
					@http_response_code(404); Header("Location: ../"); exit();					
				}
				?>
				<br />
				<form method="get">
					<input type="submit" value="Administrator Mode" name="adm_change_access">
				</form>
			<?php } ?>
		  </div>
		</body>
	</html>	
	<?php exit();