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
	*/ if(file_exists("./settings.php")) { require_once("./settings.php"); } else { Header("Location: ./installer.php"); exit(); } 
	
	// Show Update Notification
	if(_HIVE_BUILD_ <= _HIVE_BUILD_ACTIVE_) { 		
		http_response_code(503); 
		require_once("./_core/_error/error.noupdate.html"); 
		exit(); }
	if(!@is_numeric(@$_SESSION["hive_installer_block"])) { $_SESSION["hive_installer_block"] = 0; }
		if(@$_SESSION["hive_installer_block"] > 5) { 
				@http_response_code(401);
				require_once("./_core/_error/error.blocked.html");
				exit(); 
		}
?>
<!doctype html>
<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title><?php echo _INSTALLER_TITLE_; ?></title>
    <style>
		body,table td{font-size:14px}.body,body{background-color:#121212}.container,.content{display:block;max-width:580px;padding:10px}body,h1,h2,h3,h4{color: white !important;line-height:1.4;font-family:sans-serif}body,h1,h2,h3,h4,ol,p,table td,ul{font-family:sans-serif}.btn a,.btn table td{background-color:#fff}.btn,.btn a,.content,.wrapper{box-sizing:border-box}.btn a,h1{text-transform:capitalize}.align-center,.btn table td,.footer,h1{text-align:center}.clear,.footer{clear:both}.btn a,.powered-by a{text-decoration:none}img{border:none;-ms-interpolation-mode:bicubic;max-width:100%}body{-webkit-font-smoothing:antialiased;margin:0;padding:0;-ms-text-size-adjust:100%;-webkit-text-size-adjust:100%}table{border-collapse:separate;mso-table-lspace:0pt;mso-table-rspace:0pt;width:100%}table td{vertical-align:top}.body{width:100%}.container{margin:0 auto!important;width:580px}.btn,.footer,.main{width:100%}.content{margin:0 auto}.main{background:#000;border-radius:3px;color: white;}.wrapper{padding:20px}.content-block{padding-bottom:10px;padding-top:10px}.footer{margin-top:10px}.footer a,.footer p,.footer span,.footer td{color:#999;font-size:12px;text-align:center}h1,h2,h3,h4{color:#000;font-weight:400;margin:0 0 30px}.btn a,a{color:#242424}h1{font-size:35px;font-weight:300}.btn a,ol,p,ul{font-size:14px}ol,p,ul{font-weight:400;margin:0 0 15px}ol li,p li,ul li{list-style-position:inside;margin-left:5px}a{text-decoration:underline}.btn>tbody>tr>td{padding-bottom:15px}.btn table{width:auto}.btn table td{border-radius:5px}.btn a{border:1px solid #242424;border-radius:5px;cursor:pointer;display:inline-block;font-weight:700;margin:0;padding:12px 25px}.btn-primary a,.btn-primary table td{background-color:#242424}.btn-primary a{border-color:#242424;color:#fff}.last,.mb0{margin-bottom:0}.first,.mt0{margin-top:0}.align-right{text-align:right}.align-left{text-align:left}.preheader{color:transparent;display:none;height:0;max-height:0;max-width:0;opacity:0;overflow:hidden;mso-hide:all;visibility:hidden;width:0}hr{border:0;border-bottom:1px solid #f6f6f6;margin:20px 0}@media only screen and (max-width:620px){table.body h1{font-size:28px!important;margin-bottom:10px!important}table.body a,table.body ol,table.body p,table.body span,table.body td,table.body ul{font-size:16px!important}table.body .article,table.body .wrapper{padding:10px!important}table.body .content{padding:0!important}table.body .container{padding:0!important;width:100%!important}table.body .main{border-left-width:0!important;border-radius:0!important;border-right-width:0!important}table.body .btn a,table.body .btn table{width:100%!important}table.body .img-responsive{height:auto!important;max-width:100%!important;width:auto!important}}@media all{.btn-primary a:hover,.btn-primary table td:hover{background-color:yellow!important}.ExternalClass{width:100%}.ExternalClass,.ExternalClass div,.ExternalClass font,.ExternalClass p,.ExternalClass span,.ExternalClass td{line-height:100%}.apple-link a{color:inherit!important;font-family:inherit!important;font-size:inherit!important;font-weight:inherit!important;line-height:inherit!important;text-decoration:none!important}#MessageViewBody a{color:inherit;text-decoration:none;font-size:inherit;font-family:inherit;font-weight:inherit;line-height:inherit}.btn-primary a:hover{border-color:yellow!important;color:black}}
    </style>
  </head>
  <body>
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
                        <h2 style="padding-bottom: 0px;margin-bottom: 0px;"><?php echo _INSTALLER_PRODUCT_; ?></h2>Update Runtime<br /><br />
                        <hr><p><b>You are going to update: '<?php echo _INSTALLER_PRODUCT_; ?>'!</b><br />This updater is mandatory to install database updates and more!</p><hr>
						
						


						<?php $checkx = false; if(@_INSTALLER_CODE_ == @$_POST["installer_code"]) { $checkx = true; } if(@_INSTALLER_CODE_ != @$_POST["installer_code"] AND isset($_POST["installer_code"])) {
						$_SESSION["hive_installer_block"] = $_SESSION["hive_installer_block"] + 1; }if(@$_POST["update_start"] != "set" OR !$checkx) { ?>
						
						
						
						
						
						<b>Newest Build</b>: <?php echo _HIVE_BUILD_; ?><br />
						<b>Active Build</b>: <?php echo _HIVE_BUILD_ACTIVE_; ?>
						
						<?php
							$ar = array();
							foreach (glob("./_site/"._HIVE_MODE_."/_updates/*") as $filename) {
								if(basename($filename) == "index.php") { continue; }
								if(basename($filename) == ".htaccess") { continue; }
								if(!is_numeric(basename($filename))) { continue; }
								array_push($ar, basename($filename));
							} natsort($ar); echo "<hr>"; echo "Update will be started by pressing 'Start Update'.<br />";
							$x = false;
							foreach ($ar as $key => $filename) {
								if($filename > _HIVE_BUILD_ACTIVE_ AND $filename <= _HIVE_BUILD_) { 
									if($x == 0) { echo "<b>Will be installed next: </b>Build "; $x = true; }
									else { echo "<b>Waiting: </b>Build ";  }							
									echo $filename; echo " Initializations<br />";
								}								
							}							

						?>
							<hr><form method="post">
							<?php if(_INSTALLER_CODE_ != false AND _INSTALLER_CODE_ != "") { ?>
							<b>Updater Code:</b><br />
							Please enter Security Code to start Update!<br />
							You can find the security Code in /_site/<?php echo _HIVE_MODE_; ?>/config.php
						<?php if(@!$checkx) { echo "<br /><b><font color='red'>Please provide a valid security code!</font></b>"; } ?>
							<input type="text" placeholder="updater_code" name="installer_code"><br /><br />
							<?php } ?>
							<table role="presentation" border="0" cellpadding="0" cellspacing="0" class="btn btn-primary">
							  <tbody>
								<tr>
								  <td align="left">
									<table role="presentation" border="0" cellpadding="0" cellspacing="0">
									  <tbody>
										<tr><input type="hidden" name="update_start" value="set">
										  <td> <button type="submit" style="background: none;color: white; border: none; outline: none;cursor: pointer; padding: 15px;font-weight: bold;font-family:sans-serif">Start Update</button> </td>
										</tr>
									  </tbody>
									</table>
								  </td>
								</tr>
							  </tbody>
							</table>
							</form>
						<?php } else { 
							
							$ar = array();
							foreach (glob("./_site/"._HIVE_MODE_."/_updates/*") as $filename) {
								if(basename($filename) == "index.php") { continue; }
								if(basename($filename) == ".htaccess") { continue; }
								if(!is_numeric(basename($filename))) { continue; }
								array_push($ar, basename($filename));
							} natsort($ar); 
							$x = false;
							$y = false;
							foreach ($ar as $key => $filename) {
								if($filename > _HIVE_BUILD_ACTIVE_ AND $filename <= _HIVE_BUILD_) { 
									$x = true; $y = $filename; 
									break;
								}								
							}							
							echo "<h5><b>Installing Build: ".$y."</b></h5>";
							if(!$x) { $y = _HIVE_BUILD_; }
							$object["var"]->set("_HIVE_BUILD_ACTIVE_", $y);
							if(file_exists("./_site/"._HIVE_MODE_."/_updates/".$y) AND $x) { require_once("./_site/"._HIVE_MODE_."/_updates/".$y); }
							else { echo "Version Number has been changed! - OK"; }
							
							echo "<h5><b>Build Installed!</b></h5>";
							
							?> <hr><form method="post">
							<table role="presentation" border="0" cellpadding="0" cellspacing="0" class="btn btn-primary">
							  <tbody>
								<tr>
								  <td align="left">
									<table role="presentation" border="0" cellpadding="0" cellspacing="0">
									  <tbody>
										<tr>
										  <td> <button type="submit" style="background: none;color: white; border: none; outline: none;cursor: pointer; padding: 15px;font-weight: bold;font-family:sans-serif">Finish</button> </td>
										</tr>
									  </tbody>
									</table>
								  </td>
								</tr>
							  </tbody>
							</table></form>
						 <?php } ?>
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>
            <!-- END MAIN CONTENT AREA -->
            </table>
            <!-- END CENTERED WHITE CONTAINER -->
            <!-- END FOOTER -->
          </div>
        </td>
        <td>&nbsp;</td>
      </tr>
    </table>
<div class="footer">
              <table role="presentation" border="0" cellpadding="0" cellspacing="0">
                <tbody><tr>
                  <td class="content-block">
                    <span class="apple-link">This updater is created by <a href="https://www.bugfish.eu" rel="noopener" target='_blank' style="color: yellow !important;">Bugfish</a> (Jan-Maurice Dahlmanns)<br>For Open Source Software and Projects!</span>
                  </td>
                </tr>
                <tr>
                  <td class="content-block powered-by">
						<!-- No Content Currently as Message -->
                  </td>
                </tr>
              </tbody></table>
            </div>
  </body>
</html>
	