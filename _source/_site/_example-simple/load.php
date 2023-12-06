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
	*/
	if(!is_array($object)) { @http_response_code(404); Header("Location: ../"); exit(); }
	
	// Simple Theme Header
	hive__simple_start($object,  "Simple Theme - FP²", '<link rel="icon" type="image/x-icon" href="'._HIVE_URL_REL_.'/_core/_image/favicon.ico">');
	

	// Start Container
	echo "<div class='containerbox'>";	

		// Title
		echo "<h2>Simple Theme</h2>";	
		echo "<p><b>Introduction</b>:<br />Introducing our simple theme – a minimalist yet effective template designed for ease of use on our CMS. This theme embodies simplicity at its core, offering a clean and straightforward layout that serves as a perfect starting point for your website. With a focus on clarity and functionality, it provides a basic structure that can be easily customized and expanded upon according to your needs. Enjoy the simplicity and versatility of this theme as you embark on creating your website effortlessly.</p>";	
		echo "<p><b>Bugfish's Websites</b>:<br />";	
			echo 'Some of the autors websites! Sub me on youtube if you want to support me! This is just some promotion for myself. On my website you can get access to my newsletter if you want to stay updated!<br /><br />';
			echo "<a href='https://bugfish.eu' rel='noopener' target='_blank' class='containerbox-btn'>Website</a><br><br><br>";
			echo "<a href='https://github.com/bugfishtm' rel='noopener' target='_blank' class='containerbox-btn'>Github</a><br><br><br>";
			echo "<a href='https://bugfish.bandcamp.com' rel='noopener' target='_blank' class='containerbox-btn'>Bandcamp</a><br><br><br>";
			echo "<a href='https://youtube.com/bugfishtm' rel='noopener' target='_blank' class='containerbox-btn'>Youtube</a><br><br>";
		echo "</p>";	
		echo "<p><b>Documentation</b>:<br />";	
			echo 'Below you can find some pages with documentations! It is advised to search there for function and cms explanations! You can find detailed instructions on how to use every single class out of the bugfish framework. Besides that you can get informations on how to work with this cms and how to deploy your websites!<br /><br />';
			echo "<a href='https://bugfish.eu' rel='noopener' target='_blank' class='containerbox-btn'>Bugfish Website</a><br><br><br>";
			echo "<a href='https://youtube.com/bugfishtm' rel='noopener' target='_blank' class='containerbox-btn'>Bugfish Youtube</a><br><br><br>";
			echo "<a href='https://bugfish-github.de' rel='noopener' target='_blank' class='containerbox-btn'>Documentation Hub</a><br><br><br>";
			echo "<a href='https://bugfish-github.de/fast-php-page' rel='noopener' target='_blank' class='containerbox-btn'>Backend Framework Documentation</a><br><br><br>";
			echo "<a href='https://bugfish-github.de/bugfish-framework' rel='noopener' target='_blank' class='containerbox-btn'>Fast-PHP-Page Documentations</a><br><br>";
		echo "</p>";	
		echo "<p><b>Developer Panel & Administration</b>:<br />";	
			echo 'You can enter the administration and developer area below! With the button below you will find access to the developers backend interface, which can also be used in combination with the frontend and the general developer tools. This tools are there to give you a better understanding on how this cms and site modules of the cms are working!<br /><br />';
			echo "<a href='"._HIVE_URL_REL_."/developer.php' rel='noopener' target='_blank' class='containerbox-btn'>Developer Tools</a><br><br>";
		echo "</p>";	
		echo "<p><b>Example Site Modules</b>:<br />You can find the example site modules in the websites _site folder!";	?>
		
<ul>
  <li>
    <strong>_example-site:</strong> Site module demonstrating File Implementations and Backend Automation Functionalities. This module showcases how the CMS handles file operations and automates backend tasks.
  </li>
  <li>
    <strong>_example-simple:</strong> Site Module showcasing a simple theme for this CMS. It provides an easy-to-understand demonstration of the basic theming capabilities of the system.
  </li>
  <li>
    <strong>_example-complex:</strong> Site Module demonstrating a responsive, complex theme for this CMS. This enhanced version is based on the Windmill Dashboard theme, showcasing the system's capabilities in handling sophisticated, responsive designs.
  </li>
  <li>
    <strong>_administrator:</strong> Site Module designed to demonstrate an administrator interface for controlling CMS functionalities. It serves as a backend control panel for managing various aspects of the CMS, making it useful for both learning purposes and backend control in deployed websites or personal projects.
  </li>
  <li>
    <strong>_documentation:</strong> Site Module designed that holds this CMS Documentation to be viewed any time needed!
  </li>
  <li>
    <strong>_frameworkdocs:</strong> Site Module designed that holds the Bugfish Framework Documentation to be viewed any time needed!
  </li>
</ul>
		
		
		<?php echo "</p>";	
		
		// Best Wishes
		echo "<p>I wish you the best!<br />Sincerely, Bugfish</p>";
	
	// End Container
	echo "</div>";
	
	// Simple Theme Footer
	hive__simple_end($object, _HIVE_CREATOR_);