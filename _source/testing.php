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
	if(!_HIVE_MOD_SWITCH_MENU_) { 		
		http_response_code(503); 
		require_once("./_core/_error/error.nochange.html"); 
		exit(); }
?>
<!doctype html>
<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>Site-Mode Changer</title>
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
			<style>input {width: 100%; max-width: 97%; padding: 5px; background: #4B4B4B; color: white;} a{color: blue;} button:hover{color: black !important;} a {color: yellow; text-decoration: none;}</style>
            <!-- START CENTERED WHITE CONTAINER -->
            <table role="presentation" class="main">
			
              <!-- START MAIN CONTENT AREA -->
              <tr>
                <td class="wrapper">
                  <table role="presentation" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                      <td>
                        <h2 style="padding-bottom: 0px;margin-bottom: 0px;">System</h2>
                        <hr><p><b>Change website session settings:</b><br />
						Here you can change this websites settings if available! <br />
						This changes will only be relative to your own sessions!<br />
						No global website configurations here!<br /></p>
						<p><ul>
						<li><a href="./installer.php" target="_blank">Installer</a> - Website Installation Script if not already installed!</li>
						<li><a href="./updater.php" target="_blank">Updater</a> - Website Update Script to install updated if necessary!</li>
						<li><a href="./mod_change.php" target="_blank">Mod-Change</a> - Change the relative Website Mode</li>
						<li><a href="./lang_change.php" target="_blank">Lang-Change</a> - Change the relative language</li>
						<li><a href="./theme_change.php" target="_blank">Theme-Change</a> - Change the relative Theme</li>
						<li><a href="./color_change.php" target="_blank">Color-Change</a> - Change the relative Themes Color</li>
						</ul></p><p>Click on upper link to view section!</p>
					
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
                    <span class="apple-link">This script is created by <a href="https://www.bugfish.eu" rel="noopener" target='_blank' style="color: yellow !important;">Bugfish</a> (Jan-Maurice Dahlmanns)<br>For Open Source Software and Projects!</span>
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
	