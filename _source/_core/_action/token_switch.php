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
	*/ if(file_exists("../../settings.php")) { require_once("../../settings.php"); } else { @http_response_code(404); Header("Location: ../"); exit(); } ?>
	<html>
		<head>
		  <link rel="icon" type="image/x-icon" href="../_image/favicon.ico">
		  <title>Token Site Switch - FP²</title>
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
			
			input[type=submit]:hover {
				background: white !important;
				color: black !important;
			}
		  </style>
		</head>
		<body>
		  <div id="countdown-box">
			<img src="../_image/logo_alpha.png" width="100">
			<p>You may have been invited to visit a page, which is hidden on this platform!<br>
			Currently you are active on site module: <b><?php echo htmlspecialchars(_HIVE_MODE_ ?? ""); ?></b></p><br />

			<?php
				
				if(@$_POST["token_change_page"]) { 
					if(trim(@$_POST["token_for_view"] ?? "") == "") {
						echo '<font color="red">You have to enter the provided access token!</font>';
					} else {
						$bind[0]["value"] = $_POST["token_for_view"];
						$x = $object["mysql"]->select("SELECT * FROM "._TABLE_TOKEN_." WHERE token_key = ?", false, $bind);
						if($x) {
							if(in_array($x["site_mode"], _HIVE_MODE_ARRAY_)) {
								$_SESSION[_HIVE_COOKIE_."hive_mode"] = $x["site_mode"];
								echo "<script>window.location.href = '../';</script>";
							} else {
								echo '<font color="yellow">The content you have requested is not available anymore. It may has been deleted and needs to be redeployed for you to view this website!</font>';
							}
						} else {
							echo '<font color="yellow">The provided access code has not been found or is expired!</font>';
						}
					}
				}
				
			?>

			<form method="post" action="./token_switch.php">
				<input type="text" name="token_for_view" value="<?php echo htmlentities(@$_GET["token"] ?? ""); ?>" placeholder="Enter your Token" style="font-weight: bold;border: none !important;outline: none !important; background:#3b3b3b; color: white; padding: 15px; border-radius: 5px;margin-bottom: 5px; "/><br />
				<input type="hidden" value="1" name="token_change_page">
				<input type="submit" value="Change Site" name="token_change_page" style="font-weight: bold;border: none; background:#3b3b3b; color: white; padding: 15px; cursor: pointer; border-radius: 5px;">
			</form>
			
			
			
			<p>If you came here by mistake you can leave <a href="../">here</a>.</p>
		  </div>
		</body>
	</html>	
	<?php exit();