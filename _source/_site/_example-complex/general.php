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
		  
		 
		<?php hive__dashboard_box_full('Welcome to the "_example-complex" theme, an advanced and feature-rich option within our CMS ecosystem. This theme is tailored for users seeking a sophisticated yet user-friendly solution to swiftly create responsive websites with dynamic navigation. Unlike its simpler counterpart, "_example-simple," the "_example-complex" theme offers a wider array of features and design elements, providing a more intricate and visually appealing layout.
<br><br>
With a focus on responsiveness, this theme ensures that your website looks and functions seamlessly across various devices. It includes a responsive navigation system, optimizing user experience on both desktop and mobile platforms.
<br><br>
Furthermore, within the Site modules folder, you\'ll find the "_administrator" site module. This module boasts a comprehensive and dynamic administrator interface, empowering users to efficiently manage and customize their websites with ease.
<br><br>
You can also find "_example-site" Module in the _site folder of this website! The focus of this module is to explain all folders and configurations which may can be set. So if you need any leeds look inside this site Module to get inspirations on how to develop with this given CMS.<br /><br />
Explore the capabilities of the "_example-complex" theme to elevate your website\'s aesthetics and functionality while harnessing the power of a fully functional administrator interface for comprehensive site management. <br><br>Note: The Bugfish Framework is fully integrated within this CMS. Detailed documentation is readily accessible on GitHub or can be found in the "docs" folder within the repositories. Dive into the comprehensive documentation to leverage the capabilities and functionalities offered by the Bugfish Framework for an enhanced website-building experience.<br><br>To test functionalities and view administration area visit: <a target="_blank" href="'._HIVE_URL_REL_.'/developer.php">./developer.php</a>'); ?>

		<?php hive__dashboard_h2("Project Goal"); ?>
		<?php hive__dashboard_box_full('In the heart of our platform lies a revolutionary CMS that\'s all about pushing the envelope and infusing fresh ideas and functionalities into the realm of Backend PHP Development and Webhosting. We\'re here to redefine the landscape, transforming the way professionals approach their craft. Our commitment to innovation knows no bounds, and we invite you to join us in shaping the future of web development and hosting.<br /><br />At the core of our platform, you\'ll find a CMS that redefines the game, fusing forward-thinking ideas and functionalities into the world of Backend PHP Development and Webhosting. Our approach is all about propelling your professional journey to new heights. We\'re unapologetically dedicated to innovation, and we invite you to be part of the evolution that\'s changing the face of web development and hosting.'); ?>

		<?php hive__dashboard_h2("Message Banners"); ?>		
		  <?php hive__dashboard_alert_danger("Error Message"); ?>
		  <?php hive__dashboard_alert_success("Success Message"); ?>
		  <?php hive__dashboard_alert_warning("Warning Message"); ?>
		  <?php hive__dashboard_alert_info("Info Message"); ?>
		  <?php hive__dashboard_alert_primary("Primary Message"); ?>

		<?php hive__dashboard_h2("Buttons"); ?>
		<?php hive__dashboard_h4("Sizes"); ?>
		
		<div
		  class="flex flex-col flex-wrap mb-4 space-y-4 md:flex-row md:items-end md:space-x-4"
		>
            <!-- Divs are used just to display the examples. Use only the button. -->
            <?php hive__dashboard_button("Regular Button", "bx bxs-pear", "#030303", "#ffffff", "a", "#", "", ""); ?>
		</div>
		<p class="mb-8 text-gray-700 dark:text-gray-400">
		  Apply
		  <code>w-full</code>
		  to any button to create a block level button.
		</p>

            
		<?php hive__dashboard_h4("Icons"); ?>
		<div
		  class="flex flex-col flex-wrap mb-8 space-y-4 md:flex-row md:items-end md:space-x-4"
		>
		  <!-- Divs are used just to display the examples. Use only the button. -->
			<!--text icon color tcolor type[submit/button/a] url name js classes-->
			<?php hive__dashboard_button_icright("Icon Right", "bx bxs-pear", "#030303", "#ffffff", "a", "#", "", ""); ?>
			
		  <!-- Divs are used just to display the examples. Use only the button. -->
			<?php hive__dashboard_button_icleft("Icon Left", "bx bxs-pear", "#030303","#ffffff", "a", "#", "", ""); ?>

		  <!-- Divs are used just to display the examples. Use only the button. -->
			<?php hive__dashboard_button_small("bx bxs-pear", "#030303","#ffffff", "a", "#", "", ""); ?>

		  <!-- Divs are used just to display the examples. Use only the button. -->
			<?php hive__dashboard_button_small_round("bx bxs-pear", "#030303","#ffffff", "a", "#", "", ""); ?>
		</div>
		
		<?php hive__dashboard_h2("Modals"); ?>
		<div>
			<?php
				if(@$_POST["modal"] == true) {
					hive__dashboard_modal("Hi");
				}
			?>
			<form method="post">
			<input type="hidden" name="modal" value="true">
			  <button
				type="submit"
				class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-primary-bugfish border border-transparent rounded-lg active:bg-primary-bugfish hover:bg-primary-bugfish focus:outline-none focus:shadow-primary-bugfish"
			  >
				Open Modal
			  </button>
			 </form>
			  <button
				class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-primary-bugfish border border-transparent rounded-lg active:bg-primary-bugfish hover:bg-primary-bugfish focus:outline-none focus:shadow-primary-bugfish"
				onclick="xjs_popup('This is a simple Modal! This is a simple Modal! This is a simple Modal! This is a simple Modal! This is a simple Modal! ', 'Close')"
			  >
				Open XJS Function Modal
			  </button>
		</div>

		<?php hive__dashboard_h2("Eventboxes"); ?>		
			<?php
				if(@$_POST["evb1"] == true) {
					$object["eventbox"]->ok("This is a ok!");
				}
				if(@$_POST["evb2"] == true) {
					$object["eventbox"]->warning("This is a warning!");
				}
				if(@$_POST["evb3"] == true) {
					$object["eventbox"]->error("This is a error!");
				}
				if(@$_POST["evb4"] == true) {
					$object["eventbox"]->info("This is a info!");
				}
				if(@$_POST["evb5"] == true) {
					$object["eventbox"]->info("This is a info!");
					$object["eventbox"]->error("This is a error!");
					$object["eventbox"]->warning("This is a warning!");
					$object["eventbox"]->ok("This is a ok!");
				}
			?>
			<form method="post">
			<input type="hidden" name="evb1" value="true">
			  <button
				type="submit"
				class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-primary-bugfish border border-transparent rounded-lg active:bg-primary-bugfish hover:bg-primary-bugfish focus:outline-none focus:shadow-primary-bugfish"
			  >
				Success
			  </button>
			 </form>
			<form method="post">
			<input type="hidden" name="evb2" value="true">
			  <button
				type="submit"
				class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-primary-bugfish border border-transparent rounded-lg active:bg-primary-bugfish hover:bg-primary-bugfish focus:outline-none focus:shadow-primary-bugfish"
			  >
				Warning
			  </button>
			 </form>
			<form method="post">
			<input type="hidden" name="evb3" value="true">
			  <button
				type="submit"
				class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-primary-bugfish border border-transparent rounded-lg active:bg-primary-bugfish hover:bg-primary-bugfish focus:outline-none focus:shadow-primary-bugfish"
			  >
				Error
			  </button>
			 </form>
			<form method="post">
			<input type="hidden" name="evb4" value="true">
			  <button
				type="submit"
				class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-primary-bugfish border border-transparent rounded-lg active:bg-primary-bugfish hover:bg-primary-bugfish focus:outline-none focus:shadow-primary-bugfish"
			  >
				Info
			  </button>
			 </form>
			<form method="post">
			<input type="hidden" name="evb5" value="true">
			  <button
				type="submit"
				class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-primary-bugfish border border-transparent rounded-lg active:bg-primary-bugfish hover:bg-primary-bugfish focus:outline-none focus:shadow-primary-bugfish"
			  >
				multiple
			  </button>
			 </form>

		<!-- Header for Cards -->
		<?php hive__dashboard_h2("Multi Language Demonstration"); ?>
		<?php hive__dashboard_h4("Big section cards"); ?>
		<?php hive__dashboard_box_full("Large, full width sections goes here.<br />Here is the current translation for one string to test:<br />".$object["lang"]->translate("Test")); ?>
		<?php hive__dashboard_h2("Cards"); ?>
		
		<!-- Big section cards -->

		<!-- Responsive cards -->
		<?php hive__dashboard_h4("Responsive cards"); ?>
		<div class="grid gap-6 mb-8 md:grid-cols-2 xl:grid-cols-4">
			<?php echo hive__dashboard_box_card("Test", "test", "white", "bx bxs-pear"); ?>
			<?php echo hive__dashboard_box_card("Test", "test", "white", "bx bxs-pear"); ?>
			<?php echo hive__dashboard_box_card("Test", "test", "white", "bx bxs-pear"); ?>
		</div>

		<!-- Cards with title -->
		<?php hive__dashboard_h4("Cards with title"); ?>
		<div class="grid gap-6 mb-8 md:grid-cols-2">
			<?php hive__dashboard_box("Lorem ipsum dolor sit, amet consectetur adipisicing elit. Fuga, cum commodi a omnis numquam quod? Totam exercitationem quos hic ipsam at qui cum numquam, sed amet ratione! Ratione, nihil dolorum. ", "Revenue"); ?>
			<?php hive__dashboard_box_colored("Lorem ipsum dolor sit, amet consectetur adipisicing elit. Fuga, cum commodi a omnis numquam quod? Totam exercitationem quos hic ipsam at qui cum numquam, sed amet ratione! Ratione, nihil dolorum. ", "Revenue"); ?>
		</div>
		
	<!-- End Website Div -->
	</div>






   