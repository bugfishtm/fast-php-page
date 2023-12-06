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
?>	<div class="container px-6 mx-auto grid">
		<?php hive__dashboard_h2("Informations"); ?>
          
		  <?php hive__dashboard_alert_url("See this project on Github!", "bx bxs-star", "https://github.com/bugfishtm/fast-php-page", true); ?>
		  <?php hive__dashboard_alert_url("See CMS Documentation for Developers and Users!", "bx bxs-star", "https://bugfishtm.github.io/fast-php-page/", true); ?>
		  
		<?php hive__dashboard_box_full('Welcome to the "_example-site" theme, an advanced and feature-rich option within our CMS ecosystem. This Site Module is to demonstrate automatic including of files in different site modules folders and more! Take a look at this sites module folders structure at _site/_example-site to get more insights about how to develop modules with that CMS!<br /><br /> This theme is tailored for users seeking a sophisticated yet user-friendly solution to swiftly create responsive websites with dynamic navigation. Unlike its simpler counterpart, "_example-simple," the "_example-complex" theme offers a wider array of features and design elements, providing a more intricate and visually appealing layout.
<br><br>
With a focus on responsiveness, this theme ensures that your website looks and functions seamlessly across various devices. It includes a responsive navigation system, optimizing user experience on both desktop and mobile platforms.
<br><br>
Furthermore, within the Site modules folder, you\'ll find the "_administrator" site module. This module boasts a comprehensive and dynamic administrator interface, empowering users to efficiently manage and customize their websites with ease.
<br><br>
Explore the capabilities of the "_example-site" theme to elevate your website\'s aesthetics and functionality while harnessing the power of a fully functional administrator interface for comprehensive site management. <br><br>Note: The Bugfish Framework is fully integrated within this CMS. Detailed documentation is readily accessible on GitHub or can be found in the "docs" folder within the repositories. Dive into the comprehensive documentation to leverage the capabilities and functionalities offered by the Bugfish Framework for an enhanced website-building experience.<br><br>To test functionalities and view administration area visit: <a target="_blank" href="'._HIVE_URL_REL_.'/developer.php">./developer.php</a>'); ?>

		<?php hive__dashboard_h2("Project Goal"); ?>
		<?php hive__dashboard_box_full('In the heart of our platform lies a revolutionary CMS that\'s all about pushing the envelope and infusing fresh ideas and functionalities into the realm of Backend PHP Development and Webhosting. We\'re here to redefine the landscape, transforming the way professionals approach their craft. Our commitment to innovation knows no bounds, and we invite you to join us in shaping the future of web development and hosting.<br /><br />At the core of our platform, you\'ll find a CMS that redefines the game, fusing forward-thinking ideas and functionalities into the world of Backend PHP Development and Webhosting. Our approach is all about propelling your professional journey to new heights. We\'re unapologetically dedicated to innovation, and we invite you to be part of the evolution that\'s changing the face of web development and hosting.'); ?>

		<?php hive__dashboard_h2("Multi Language Demonstration"); ?>
		<?php hive__dashboard_h4("Big section cards"); ?>
		<?php hive__dashboard_box_full("Large, full width sections goes here.<br />Here is the current translation for one string to test:<br />".$object["lang"]->translate("Test")); ?>
	<!-- End Website Div -->
	</div>






   