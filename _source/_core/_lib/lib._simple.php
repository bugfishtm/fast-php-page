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
		// Website: www.bugfish.eu  */
	function hive__simple_start($object, $tabtitle = "", $metaextensions = "") {  ?>
<!doctype html>
<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title><?php echo $tabtitle; ?><?php if(_HIVE_TITLE_SPACER_ != false) { echo _HIVE_TITLE_SPACER_; } ?><?php if(is_string(_HIVE_TITLE_)) { echo _HIVE_TITLE_; } ?></title>
	<link rel="stylesheet" href="<?php echo _HIVE_URL_REL_; ?>/stylesheet.php">
	<script src="<?php echo _HIVE_URL_REL_; ?>/javascript.php"></script> 
	<?php echo $metaextensions; ?>
  </head>
  <body>
    <table role="presentation" border="0" cellpadding="0" cellspacing="0" class="body">
      <tr>
        <td>&nbsp;</td>
        <td class="container">
          <div class="content">
            <!-- START CENTERED WHITE CONTAINER -->
            <table role="presentation" class="main">
              <!-- START MAIN CONTENT AREA -->
              <tr>
                <td class="wrapper">
                  <table role="presentation" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                      <td>
	<?php }
	
	function hive__simple_end($object, $footer = "") { ?>
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
							<span class="apple-link"><?php echo $footer; ?></span>
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
	<?php }