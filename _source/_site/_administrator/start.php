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

	// Div with Top Margin for Elements!
	echo "<div class='xfpe_margintop15px'></div>";
	
	// Display the Information Box!
	hive__dashboard_alert_info("Choose an item of the navigation bar to get into a specific administrator area! This is the default start page, where all users will be refered to if they log in! You need specific permissions to access the different areas. The initial created user of this interface is a 'superadmin' user, which does not need specific rights assigned to enter all areas and execute operations. If you are missing content, get in touch with your hoster or developer/management to ask for specific permissions or features.");
	
	// Information Text
	hive__dashboard_box_start("Administrator Dashboard", "min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800 dark:text-gray-200 ");
	?> Our comprehensive administrative platform is meticulously designed to empower you in managing your website efficiently and effectively. Positioned at the top right corner, your profile picture serves as a gateway to personalized options. A simple click unveils a convenient submenu, offering quick access to essential actions, allowing you to seamlessly switch back to the front page, log out securely, or view and manage your profile details.
	<br /><br />
	The left-hand side features a responsive navigation bar, thoughtfully curated to provide easy access to various administrative areas. Each item listed represents a distinct aspect, facilitating seamless oversight and control over different segments of your website.
	<br /><br />
	In the System section, you have the flexibility to set up new modules effortlessly, enhancing and customizing your website's functionalities according to your unique requirements.
	<br /><br />
	Additionally, delve into specialized sections dedicated to log protocols and other crucial functionalities. Gain valuable insights and control over your website's performance and security through these dedicated sections.
	<br /><br />
	Our user-friendly admin area empowers you to efficiently manage, monitor, and optimize your website with ease, ensuring a seamless and robust online presence.<?php
	hive__dashboard_box_end();
	
	// Powerd By Bugfish Framework
	hive__dashboard_box_start("Powered by Bugfish Framework", "min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800 dark:text-gray-200 xfpe_margintop15px");
	?> 
		<img src="<?php echo _HIVE_URL_REL_; ?>/_core/_image/bugfish-framework-banner.jpg">
	<?php
	hive__dashboard_box_end();
	
	// Support Us Banner
	hive__dashboard_box_start("Support us by including this banner!", "min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800 dark:text-gray-200 xfpe_margintop15px");
	?> 
		<img src="<?php echo _HIVE_URL_REL_; ?>/_core/_image/bugfish-fp2-banner.jpg">
	<?php
	hive__dashboard_box_end();