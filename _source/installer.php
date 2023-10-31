<?php
	/* 	
		@@@@@@@   @@@  @@@   @@@@@@@@  @@@@@@@@  @@@   @@@@@@   @@@  @@@  
		@@@@@@@@  @@@  @@@  @@@@@@@@@  @@@@@@@@  @@@  @@@@@@@   @@@  @@@  
		@@!  @@@  @@!  @@@  !@@        @@!       @@!  !@@       @@!  @@@  
		!@   @!@  !@!  @!@  !@!        !@!       !@!  !@!       !@!  @!@  
		@!@!@!@   @!@  !@!  !@! @!@!@  @!!!:!    !!@  !!@@!!    @!@!@!@!  
		!!!@!!!!  !@!  !!!  !!! !!@!!  !!!!!:    !!!   !!@!!!   !!!@!!!!  
		!!:  !!!  !!:  !!!  :!!   !!:  !!:       !!:       !:!  !!:  !!!  
		:!:  !:!  :!:  !:!  :!:   !::  :!:       :!:      !:!   :!:  !:!  
		 :: ::::  ::::: ::   ::: ::::   ::        ::  :::: ::   ::   :::  
		:: : ::    : :  :    :: :: :    :        :    :: : :     :   : :  
		   ____         _     __                      __  __         __           __  __
		  /  _/ _    __(_)__ / /    __ _____  __ __  / /_/ /  ___   / /  ___ ___ / /_/ /
		 _/ /  | |/|/ / (_-</ _ \  / // / _ \/ // / / __/ _ \/ -_) / _ \/ -_|_-</ __/_/ 
		/___/  |__,__/_/___/_//_/  \_, /\___/\_,_/  \__/_//_/\__/ /_.__/\__/___/\__(_)  
								  /___/                           
		Bugfish Framework - Skeleton / MIT License
		// Autor: Jan-Maurice Dahlmanns (Bugfish)
		// Website: www.bugfish.eu 
	*/ # No Installation Needed
	if(file_exists("./settings.php")) {
		@http_response_code(401);
		require_once("./_core/_error/error.install.lock.html");
		exit(); 
	}
	
	// Start Session
	session_start();
	
	// Require Initial Setup Configuration
	require_once("./_config/config.installer.php");
	
	
		if(@$_SESSION["hive_installer_block"] > 5) { 
				@http_response_code(401);
				require_once("./_core/_error/error.blocked.html");
				exit(); 
		}
	// Installation Start and Fetch
	$erroremptyr = false;
	$erroremptyu = false;
	$erroremptyd = false;
	$erroremptyrcced = false;
	$do = false;
	$con = false;
	$coner = false;
	if(!@is_numeric(@$_SESSION["hive_installer_block"])) { $_SESSION["hive_installer_block"] = 0; }
	if(isset($_POST["mysql_host"])) { 
		if(@$_SESSION["csrf_hive_installer"] == @$_POST["csrf"]) { 
				if(@_INSTALLER_CODE_ == @$_POST["installer_code"] OR @_INSTALLER_CODE_ == false OR @_INSTALLER_CODE_ == "") { 
					$do = true;
					if(@trim(@$_POST["website_url"]) == "") {  $erroremptyu = true; $do = false;}
					if(!file_exists(@$_POST["doc_root"]."_core/discovery_file.x658.php")) { $erroremptyr = true; $do = false;}
					if(@trim(@$_POST["mysql_db"]) == "") {  $erroremptyd = true; $do = false;}
					if(!is_numeric(@$_POST["mysql_port"])) { $_POST["mysql_port"] = 3306; }
					if(@trim(@$_POST["mysql_host"]) == "") { $_POST["mysql_host"] = "localhost"; }
					try { $mysqli = new mysqli(@$_POST["mysql_host"], $_POST["mysql_user"], $_POST["mysql_pass"], $_POST["mysql_db"], $_POST["mysql_port"]);  
						if ($mysqli->connect_errno) {
							$coner = "Connection Error: ".$mysqli->connect_error;
						}		
						/* check if server is alive */
						if ($mysqli->ping()) {
							$con = true;
						} else {
							$coner .= " | Ping Error: ".$mysqli->error;
						}			
					} catch (\Throwable $e) {
						$coner = $e->getMessage();
					}	
				} else { $erroremptyrcced = true; $_SESSION["hive_installer_block"] = $_SESSION["hive_installer_block"] + 1; }	
		} else { $csrf = "<font color='red'><b>CSRF Form Protection Error</b><br /> Please Try Again, the form you have executed is expired.</font><br /><br />"; }	
	}	
	$_SESSION["csrf_hive_installer"] = mt_rand(1000000, 9999999);
	?>
<!doctype html>
<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title><?php echo _INSTALLER_TITLE_; ?></title>
    <style>
		body,table td{font-size:14px}.body,body{background-color:#121212;color:white;}.container,.content{display:block;max-width:580px;padding:10px}body,h1,h2,h3,h4{line-height:1.4;font-family:sans-serif;color: white !important;}body,h1,h2,h3,h4,ol,p,table td,ul{font-family:sans-serif}.btn a,.btn table td{background-color:#fff}.btn,.btn a,.content,.wrapper{box-sizing:border-box}.btn a,h1{text-transform:capitalize}.align-center,.btn table td,.footer,h1{text-align:center}.clear,.footer{clear:both}.btn a,.powered-by a{text-decoration:none}img{border:none;-ms-interpolation-mode:bicubic;max-width:100%}body{-webkit-font-smoothing:antialiased;margin:0;padding:0;-ms-text-size-adjust:100%;-webkit-text-size-adjust:100%}table{border-collapse:separate;mso-table-lspace:0pt;mso-table-rspace:0pt;width:100%}table td{vertical-align:top}.body{width:100%}.container{margin:0 auto!important;width:580px}.btn,.footer,.main{width:100%}.content{margin:0 auto}.main{background:#000;color: white;border-radius:3px}.wrapper{padding:20px}.content-block{padding-bottom:10px;padding-top:10px}.footer{margin-top:10px}.footer a,.footer p,.footer span,.footer td{color:#999;font-size:12px;text-align:center}h1,h2,h3,h4{color:#000;font-weight:400;margin:0 0 30px}.btn a,a{color:#242424}h1{font-size:35px;font-weight:300}.btn a,ol,p,ul{font-size:14px}ol,p,ul{font-weight:400;margin:0 0 15px}ol li,p li,ul li{list-style-position:inside;margin-left:5px}a{text-decoration:underline}.btn>tbody>tr>td{padding-bottom:15px}.btn table{width:auto}.btn table td{border-radius:5px}.btn a{border:1px solid #242424;border-radius:5px;cursor:pointer;display:inline-block;font-weight:700;margin:0;padding:12px 25px}.btn-primary a,.btn-primary table td{background-color:#242424}.btn-primary a{border-color:#242424;color:#fff}.last,.mb0{margin-bottom:0}.first,.mt0{margin-top:0}.align-right{text-align:right}.align-left{text-align:left}.preheader{color:transparent;display:none;height:0;max-height:0;max-width:0;opacity:0;overflow:hidden;mso-hide:all;visibility:hidden;width:0}hr{border:0;border-bottom:1px solid #f6f6f6;margin:20px 0}@media only screen and (max-width:620px){table.body h1{font-size:28px!important;margin-bottom:10px!important}table.body a,table.body ol,table.body p,table.body span,table.body td,table.body ul{font-size:16px!important}table.body .article,table.body .wrapper{padding:10px!important}table.body .content{padding:0!important}table.body .container{padding:0!important;width:100%!important}table.body .main{border-left-width:0!important;border-radius:0!important;border-right-width:0!important}table.body .btn a,table.body .btn table{width:100%!important}table.body .img-responsive{height:auto!important;max-width:100%!important;width:auto!important}}@media all{.btn-primary a:hover,.btn-primary table td:hover{background-color:yellow!important}.ExternalClass{width:100%}.ExternalClass,.ExternalClass div,.ExternalClass font,.ExternalClass p,.ExternalClass span,.ExternalClass td{line-height:100%}.apple-link a{color:inherit!important;font-family:inherit!important;font-size:inherit!important;font-weight:inherit!important;line-height:inherit!important;text-decoration:none!important}#MessageViewBody a{color:inherit;text-decoration:none;font-size:inherit;font-family:inherit;font-weight:inherit;line-height:inherit}.btn-primary a:hover{border-color:yellow!important;color:yellow;}}
		.hovernew:hover { color: black !important;} a { color: yellow !important; text-decoration: none; }
	</style>
  </head>
  <body>
	<?php
	if(!$do OR $erroremptyr OR $erroremptyu OR $erroremptyd OR !$con OR $coner OR @$erroremptyrcced) {
?>
    <table role="presentation" border="0" cellpadding="0" cellspacing="0" class="body">
      <tr>
        <td>&nbsp;</td>
        <td class="container">
          <div class="content">
			<style>input {width: 100%; max-width: 97%; padding: 5px; background: #242424; border-radius: 5px;color: white; border: 1px solid #242424; padding: 5px;} a{color: blue;} button:hover{color: black !important;}</style>
            <!-- START CENTERED WHITE CONTAINER -->
            <table role="presentation" class="main">
			
              <!-- START MAIN CONTENT AREA -->
              <tr>
                <td class="wrapper">
                  <table role="presentation" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                      <td>
                        <h2 style="padding-bottom: 0px;margin-bottom: 0px;"><?php echo _INSTALLER_PRODUCT_; ?></h2>Installation Runtime<br /><br />
                        <p><b>You are going to install: '<?php echo _INSTALLER_PRODUCT_; ?>'!</b><br /><?php echo _INSTALLER_DESCR_; ?></p>
							
						<form method="post">
						<input type="hidden" name="csrf" value="<?php echo $_SESSION["csrf_hive_installer"]; ?>">
						<b>Installation</b><br />To install this software, you need to provide MySQL Login Data and your Website URL, where this instance will be public visible on! Please adjust following settings and click on "Start Installation":<br /><br />
						
						<?php if(_INSTALLER_CODE_ != false AND _INSTALLER_CODE_ != "") { ?>
						<b>Installation Code</b>:<br />Provide Installation Code to install this software!<br /> You can find the installer code in /_config/config.installer.php!<br />
						<?php if(@$erroremptyrcced) { echo "<b><font color='red'>Please provide a valid installer code!</font></b>"; } ?>
						<input type="text" name="installer_code"  placeholder="Installer Code" value="<?php if(!is_string(@$_POST["installer_code"])) { echo ""; } else { echo htmlentities(@$_POST["installer_code"]);} ?>"> <br />
						<br />
						<?php }?>
						<?php echo @$csrf; if($coner) { echo "<b><font color='red'>MySQL Error</font></b>:<br /><font color='red'>MySQL: ".$coner."</font><br /><br />"; } ?>
						<b>MySQL Hostname</b>:<br />The hostname of the MySQL Server you want to connect to.<br />
						<input type="text" name="mysql_host"  placeholder="MySQL Host" value="<?php if(!is_string(@$_POST["mysql_host"])) { echo "localhost"; } else { echo htmlentities(@$_POST["mysql_host"]);} ?>"> <br />
						<br />
						<b>MySQL Port</b>:<br />The port of the MySQL Server you want to connect to.<br />
						<input type="number" name="mysql_port" placeholder="MySQL Port" value="<?php if(!is_numeric(@$_POST["mysql_port"])) { echo "3306"; } else { echo htmlentities(@$_POST["mysql_port"]);} ?>"> <br />
						<br />
						<b>MySQL Username</b>:<br />The username to connect to the MySQL Instance<br />
						<input type="text" name="mysql_user" placeholder="MySQL Username" value="<?php if(!is_string(@$_POST["mysql_user"])) { echo "root"; } else { echo htmlentities(@$_POST["mysql_user"]);} ?>"> <br />
						<br />
						<b>MySQL Password</b>:<br /> The password to connect to the MySQL Instance<br />
						<input type="password" name="mysql_pass" placeholder="*****" > <br />
						<br />
						<b>MySQL Database</b>:<br />The name of the MySQL Database you want to connect to.<br />
							<?php if($erroremptyd) { echo "<b><font color='red'>Please provide needed information!</font></b>"; } ?>
						<input type="text" name="mysql_db" placeholder="Database Name"> <br />
						<br />
						<b>Document Root</b>:<br />Document Root Folder where this website is located on your webspace. This will be auto-determined, you do not need to change this, as the default setting should be correct! <b>Please add a trailing slash if not existant!</b><br />
						<?php if($erroremptyr) { echo "<b><font color='red'>Please provide a valid document root!</font></b>"; } ?>
						<input type="text" name="doc_root" value="<?php if(!is_string(@$_POST["doc_root"])) { echo substr(dirname(__FILE__), 0)."/"; } else { echo htmlentities(@$_POST["doc_root"]);} ?>"> <br />
						<br />
						<b>Website URL</b>:<br /> Enter the Website URL it will be reachable online. Enter the URL Name without www/http and without trailing slash. If this website is installed in a subfolder, do add this subfolder into this domain as well.<b>Please add a trailing slash if not existant!</b><br />
						<?php if($erroremptyu) { echo "<b><font color='red'>Please provide needed information!</font></b>"; } ?>
						<input type="text" name="website_url" value="<?php if(!is_string(@$_POST["website_url"])) { echo $_SERVER["HTTP_HOST"]."/"; } else { echo htmlentities(@$_POST["website_url"]);} ?>"> <br />
						<br />
						<b>Cookie Prefix</b>:<br /> Cookie Prefix, does not need to be changed.<br />
						<?php if($erroremptyu) { echo "<b><font color='red'>Please provide needed information!</font></b>"; } ?>
						<input type="text" name="website_cookie" value="<?php if(!is_string(@$_POST["website_cookie"])) {  echo _INSTALLER_COOKIE_;} else { echo htmlentities(@$_POST["website_cookie"]);} ?>"> <br />
						<br />
						<b>Table Prefix</b>:<br /> MySQL Tables Prefix, does not need to be changed.<br />
						<?php if($erroremptyu) { echo "<b><font color='red'>Please provide needed information!</font></b>"; } ?>
						<input type="text" name="website_prefix" value="<?php if(!is_string(@$_POST["website_prefix"])) { echo _INSTALLER_PREFIX_; } else { echo htmlentities(@$_POST["website_prefix"]);} ?>"> <br />
						<br /><br />
						<p><b>If you click "Start Installation", the Installation process will start.</b><br />
							<ul>
								<li>Settings.php in Document Root will be generated</li>
							</ul>
						You can always restart the installation process by deleting the settings.php in your document root folder!
						</p>
                        <table role="presentation" border="0" cellpadding="0" cellspacing="0" class="btn btn-primary">
                          <tbody>
                            <tr>
                              <td align="left">
                                <table role="presentation" border="0" cellpadding="0" cellspacing="0">
                                  <tbody>
                                    <tr>
                                      <td> <button type="submit" style="background: none;color: white; border: none; outline: none;cursor: pointer; padding: 15px;font-weight: bold;font-family:sans-serif">Start Installation</button> </td>
                                    </tr>
                                  </tbody>
                                </table>
                              </td>
                            </tr>
                          </tbody>
                        </table>
						</form>
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>

            <!-- END MAIN CONTENT AREA -->
            </table>
            <!-- END CENTERED WHITE CONTAINER -->

            <!-- START FOOTER -->
            <div class="footer">
              <table role="presentation" border="0" cellpadding="0" cellspacing="0">
                <tr>
                  <td class="content-block">
                    <span class="apple-link">This installer is created by <a href="https://www.bugfish.eu" rel="noopener" target="_blank" style="color: yellow !important;">Bugfish</a> (Jan-Maurice Dahlmanns)<br />For Open Source Software and Projects!</span>
                  </td>
                </tr>
                <tr>
                  <td class="content-block powered-by">
						<!-- No Content Currently as Message -->
                  </td>
                </tr>
              </table>
            </div>
            <!-- END FOOTER -->
          </div>
        </td>
        <td>&nbsp;</td>
      </tr>
    </table>
  </body>
</html>
	<?php } else { ?>
    <table role="presentation" border="0" cellpadding="0" cellspacing="0" class="body">
      <tr>
        <td>&nbsp;</td>
        <td class="container">
          <div class="content">
			<style>input {width: 100%; max-width: 97%; padding: 5px; background: #4B4B4B; color: white;} a{color: blue;} button:hover{color: black !important;}</style>
            <!-- START CENTERED WHITE CONTAINER -->
            <table role="presentation" class="main">
			
              <!-- START MAIN CONTENT AREA -->
              <tr>
                <td class="wrapper">
                  <table role="presentation" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                      <td>
                        <h2 style="padding-bottom: 0px;margin-bottom: 0px;"><?php echo _INSTALLER_PRODUCT_; ?></h2>Installation Runtime<br /><br />
                        <p><b>Installation Starting: '<?php echo _INSTALLER_PRODUCT_; ?>'!</b></p>
							<?php
if(!file_exists("./settings.php")) {
	if(file_put_contents( "./settings.php", "<?php
	/* Generated Settings.php File by Installer at ".date("Y-m-d H:i")." */
	
	/* Generated Settings */
	\$mysql['host'] = '".str_replace("'", "\\'",str_replace("\\", "\\\\", $_POST["mysql_host"]))."';
	\$mysql['port'] = '".str_replace("'", "\\'",str_replace("\\", "\\\\",$_POST["mysql_port"]))."';
	\$mysql['user'] = '".str_replace("'", "\\'",str_replace("\\", "\\\\",$_POST["mysql_user"]))."';
	\$mysql['pass'] = '".str_replace("'", "\\'",str_replace("\\", "\\\\",$_POST["mysql_pass"]))."';
	\$mysql['db'] 	= '".str_replace("'", "\\'",str_replace("\\", "\\\\",$_POST["mysql_db"]))."';
	\$mysql['prefix'] 	= '".str_replace("'", "\\'",str_replace("\\", "\\\\",$_POST["website_prefix"]))."';
	\$object['cookie'] 	= '".str_replace("'", "\\'",str_replace("\\", "\\\\",$_POST["website_cookie"]))."';
	\$object['path'] 	= '".str_replace("'", "\\'",str_replace("\\", "\\\\",$_POST["doc_root"]))."';
	\$object['url'] 	= '".str_replace("'", "\\'",str_replace("\\", "\\\\",$_POST["website_url"]))."';
	
	
	
	/* Do not change below! */
	require_once(\$object['path'].\"/_config/_loader.php\");
	")) {
		echo "<p><font color='lime'>OK: Settings.php created.</font><br />";
		echo "<font color='lime'>OK: Installation Complete, you can now click on 'Finish Installation'</font></p>";
	} else {  echo "<p><font color='red'>Error: File settings.php could not be created! <br />This may be a permission or unknown error.</font></p>"; }
	
	
	
} else { echo "<p><font color='red'>Error: File settings.php already exists!</font></p>"; }
							?><br />
                        <table role="presentation" border="0" cellpadding="0" cellspacing="0" class="btn btn-primary">
                          <tbody>
                            <tr>
                              <td align="left">
                                <table role="presentation" border="0" cellpadding="0" cellspacing="0">
                                  <tbody>
                                    <tr>
                                      <td> <a href="../" class='hovernew'>Finish Installation</a> </td>
                                    </tr>
                                  </tbody>
                                </table>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>

            <!-- END MAIN CONTENT AREA -->
            </table>
            <!-- END CENTERED WHITE CONTAINER -->

            <!-- START FOOTER -->
            <div class="footer">
              <table role="presentation" border="0" cellpadding="0" cellspacing="0">
                <tr>
                  <td class="content-block">
                    <span class="apple-link">This installer is created by <a href="https://www.bugfish.eu" rel="noopener" target="_blank" style="color: yellow !important;">Bugfish</a> (Jan-Maurice Dahlmanns)<br />For Open Source Software and Projects!</span>
                  </td>
                </tr>
                <tr>
                  <td class="content-block powered-by">
						<!-- No Content Currently as Message -->
                  </td>
                </tr>
              </table>
            </div>
            <!-- END FOOTER -->
          </div>
        </td>
        <td>&nbsp;</td>
      </tr>
    </table>
  </body>
</html>	
	<?php } ?>