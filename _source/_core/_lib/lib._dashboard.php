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
	function hive__dashboard_header($object, $tabtitle = "", $metaextensions = "", $theme =  "dark") {  ?>
		<!DOCTYPE html>
		<html :class="{ 'theme-dark': <?php echo $theme; ?> }" lang="en" x-data="data()" >
		  <head>
			<title><?php echo $tabtitle; ?><?php if(_HIVE_TITLE_SPACER_ != false) { echo _HIVE_TITLE_SPACER_; } ?><?php if(is_string(_HIVE_TITLE_)) { echo _HIVE_TITLE_; } ?></title>
			<meta charset="UTF-8" />
			<meta name="viewport" content="width=device-width, initial-scale=1.0" />
			<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
			<link rel="stylesheet" href="<?php echo _HIVE_URL_REL_; ?>/stylesheet.php">
			<link rel="stylesheet" href="<?php echo _HIVE_URL_REL_; ?>/_site/<?php echo _HIVE_MODE_; ?>/_theme/<?php echo _HIVE_THEME_; ?>/theme.css">
			<link rel="stylesheet" href="<?php echo _HIVE_URL_REL_; ?>/_vendor/boxicons/boxicons.css">
			<link rel="stylesheet" href="<?php echo _HIVE_URL_REL_; ?>/_vendor/sweetalert2/sweetalert2.min.css">
			<script
			  src='<?php echo _HIVE_URL_REL_; ?>/_vendor/alpine/alpine.min.js'
			  defer
			></script>
			<script src="<?php echo _HIVE_URL_REL_; ?>/_vendor/focustrap/focus-trap.js"></script>			
			<script src="<?php echo _HIVE_URL_REL_; ?>/_vendor/sweetalert2/sweetalert2.all.min.js"></script>			
			<script src="<?php echo _HIVE_URL_REL_; ?>/javascript.php"></script> 
			<?php echo $metaextensions; ?>
		  </head>
		  <body>
			<div
			  class="flex h-screen bg-gray-50 dark:bg-gray-900"
			  :class="{ 'overflow-hidden': isSideMenuOpen }"
			>
	<?php }
	
	function hive__dashboard_footer($object, $footer = "") { ?>
			</div>
			<!-- End of modal backdrop -->
			<footer id="web_footer">
				<?php echo $footer; ?>
			</footer>	
		  </body>
		</html>	
	<?php }
	
	function hive__dashboard_end($object) { ?>
			</div>
	<?php }	
	
	function hive__dashboard_start($object) {  ?>
		 <div class="flex flex-col flex-1 w-full">
	<?php } 
	
	function hive__dashboard_topbar($object, $profile_menu = false, $theme_menu = false, $search = false, $title = false, $img = "") {  ?>
        <header class="z-10 py-4 bg-white shadow-md dark:bg-gray-800">
          <div
            class="container flex items-center justify-between h-full px-6 mx-auto text-bugfish-primary-600 dark:text-purple-300"
          >
            <!-- Mobile hamburger -->
            <button
              class="p-1 mr-5 -ml-1 rounded-md md:hidden focus:outline-none focus:shadow-primary-bugfish"
              @click="toggleSideMenu"
              aria-label="Menu"
            >
              <svg
                class="w-6 h-6"
                aria-hidden="true"
                fill="currentColor"
                viewBox="0 0 20 20"
              >
                <path
                  fill-rule="evenodd"
                  d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                  clip-rule="evenodd"
                ></path>
              </svg>
            </button> <?php if($title) {  ?><div class='bugfish_top_header_title'><?php echo $title; ?></div><?php } ?>
			<?php if($search) {  ?>
				<!-- Search input -->
				<div class="flex justify-center flex-1 lg:mr-32">
				
				  <div
					class="relative w-full max-w-xl mr-6 focus-within:text-purple-500"
				  >
					<div class="absolute inset-y-0 flex items-center pl-2">
					  <svg
						class="w-4 h-4"
						aria-hidden="true"
						fill="currentColor"
						viewBox="0 0 20 20"
					  >
						<path
						  fill-rule="evenodd"
						  d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
						  clip-rule="evenodd"
						></path>
					  </svg>
					</div>
					<form method="get" action="<?php echo $search; ?>"><input
					  class="w-full pl-8 pr-2 text-sm text-gray-700 placeholder-gray-600 bg-gray-100 border-0 rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-primary-bugfish form-input"
					  type="text"
					  placeholder="Search"
					  aria-label="Search"
					/></form>
				  </div>
				</div>
			<?php } ?>
            <ul class="flex items-center flex-shrink-0 space-x-6">
			<?php if($theme_menu) {  ?>
				  <!-- Theme toggler -->
				  <li class="flex">
					<button
					  class="rounded-md focus:outline-none focus:shadow-primary-bugfish"
					  @click="toggleTheme"
					  aria-label="Toggle color mode"
					>
					  <template x-if="!dark">
						<svg
						  class="w-5 h-5"
						  aria-hidden="true"
						  fill="currentColor"
						  viewBox="0 0 20 20"
						>
						  <path
							d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"
						  ></path>
						</svg>
					  </template>
					  <template x-if="dark">
						<svg
						  class="w-5 h-5"
						  aria-hidden="true"
						  fill="currentColor"
						  viewBox="0 0 20 20"
						>
						  <path
							fill-rule="evenodd"
							d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"
							clip-rule="evenodd"
						  ></path>
						</svg>
					  </template>
					</button>
				  </li>
			  <?php } ?>
			  <?php if(is_array($profile_menu)) {  ?>
				  <!-- Profile menu -->
				  <li class="relative">
					<button
					  class="align-middle rounded-full focus:shadow-primary-bugfish focus:outline-none"
					  @click="toggleProfileMenu"
					  @keydown.escape="closeProfileMenu"
					  aria-label="Account"
					  aria-haspopup="true"
					>
					  <img
						class="object-cover w-8 h-8 rounded-full"
						src="<?php echo $img; ?>"
						alt=""
						aria-hidden="true"
					  />
					</button>
					<template x-if="isProfileMenuOpen">
					  <ul
						x-transition:leave="transition ease-in duration-150"
						x-transition:leave-start="opacity-100"
						x-transition:leave-end="opacity-0"
						@click.away="closeProfileMenu"
						@keydown.escape="closeProfileMenu"
						class="absolute right-0 w-56 p-2 mt-2 space-y-2 text-gray-600 bg-white border border-gray-100 rounded-md shadow-md dark:border-gray-700 dark:text-gray-300 dark:bg-gray-700"
						aria-label="submenu"
					  >
						<?php foreach($profile_menu as $key => $value) { ?>	
							<li class="flex">
							  <a
								class="inline-flex items-center w-full px-2 py-1 text-sm font-semibold transition-colors duration-150 rounded-md hover:bg-gray-100 hover:text-gray-800 dark:hover:bg-gray-800 dark:hover:text-gray-200"
								href="<?php echo $value["nav_loc"]; ?>"
							  >
								<i class='<?php echo $value["nav_img"]; ?> xfpe_marginright5px' ></i> 
								<span><?php echo $value["nav_title"]; ?></span>
							  </a>
							</li>
						<?php } ?>
					  </ul>
					</template>
				  </li>
			  <?php } ?>
            </ul>
          </div>
        </header>	
	<?php } 	
	
	function hive__dashboard_nav($object, $title = "", $button = false) {  ?>
      <!-- Desktop sidebar -->
      <aside
        class="z-20 hidden w-64 overflow-y-auto bg-white dark:bg-gray-800 md:block flex-shrink-0"
      >
        <div class="py-4 text-gray-500 dark:text-gray-400">
          <a
            class="ml-6 text-lg font-bold text-gray-800 dark:text-gray-200"
            href="#"
          >
            <?php echo $title; ?>
          </a>
          <ul class="mt-6">
			<?php foreach($object["nav"] as $key => $value) { ?>			
				<li class="relative px-6 py-3">
				<?php if(is_array($value["nav_sub"])) {?>
				  <button
					class="inline-flex items-center justify-between w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
					@click="togglePagesMenu"
					aria-haspopup="true"
				  >	
					<span class="inline-flex items-center">
					  <i class='<?php echo $value["nav_img"]; ?> xfpe_marginright5px' ></i> 
					  <span class="ml-4"><?php echo $value["nav_title"]; ?></span>
					</span>
					<svg
					  class="w-4 h-4"
					  aria-hidden="true"
					  fill="currentColor"
					  viewBox="0 0 20 20"
					>
					  <path
						fill-rule="evenodd"
						d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
						clip-rule="evenodd"
					  ></path>
					</svg>
				  </button>	
              <template x-if="isPagesMenuOpen">
                <ul
                  x-transition:enter="transition-all ease-in-out duration-300"
                  x-transition:enter-start="opacity-25 max-h-0"
                  x-transition:enter-end="opacity-100 max-h-xl"
                  x-transition:leave="transition-all ease-in-out duration-300"
                  x-transition:leave-start="opacity-100 max-h-xl"
                  x-transition:leave-end="opacity-0 max-h-0"
                  class="p-2 mt-2 space-y-2 overflow-hidden text-sm font-medium text-gray-500 rounded-md shadow-inner bg-gray-50 dark:text-gray-400 dark:bg-gray-900"
                  aria-label="submenu"
                >	

				<?php foreach($value["nav_sub"] as $key => $valuex) { ?>
                  <li
                    class="px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                  >
                    <a class="w-full" href="<?php echo $valuex["nav_loc"]; ?>">
                      <?php echo $valuex["nav_title"]; ?>
                    </a>
                  </li>			
				<?php } ?>
                </ul>
              </template>				
				<?php } else { ?>
				  <span
					class="absolute inset-y-0 left-0 w-1 bg-primary-bugfish rounded-tr-lg rounded-br-lg"
					aria-hidden="true"
				  ></span>
				  <a
					class="inline-flex items-center w-full text-sm font-semibold text-gray-800 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-100"
					href="<?php echo $value["nav_loc"]; ?>"
				  >
					<i class='<?php echo $value["nav_img"]; ?> xfpe_marginright5px' ></i> 
					<span class="ml-4"><?php echo $value["nav_title"]; ?></span>
				  </a>
				<?php }  ?>
				</li>		
				
			<?php } ?>
          </ul>
		  <?php if(is_array($button)) { ?>
          <div class="px-6 my-6">
            <a href="<?php echo $button[0]; ?>"
              class="flex items-center justify-between w-full px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-primary-bugfish border border-transparent rounded-lg active:bg-primary-bugfish hover:bg-primary-bugfish focus:outline-none focus:shadow-primary-bugfish"
            >
             <?php echo $button[1]; ?>
            </a>
          </div>
		  <?php } ?>
        </div>
      </aside>
      <!-- Mobile sidebar -->
      <!-- Backdrop -->
      <div
        x-show="isSideMenuOpen"
        x-transition:enter="transition ease-in-out duration-150"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in-out duration-150"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 z-10 flex items-end bg-black bg-opacity-50 sm:items-center sm:justify-center fix-turnout-navigation"
      ></div>
      <aside
        class="fixed inset-y-0 z-20 flex-shrink-0 w-64 mt-16 overflow-y-auto bg-white dark:bg-gray-800 md:hidden"
        x-show="isSideMenuOpen"
        x-transition:enter="transition ease-in-out duration-150"
        x-transition:enter-start="opacity-0 transform -translate-x-20"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in-out duration-150"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0 transform -translate-x-20"
        @click.away="closeSideMenu"
        @keydown.escape="closeSideMenu"
      >
        <div class="py-4 text-gray-500 dark:text-gray-400">
          <a
            class="ml-6 text-lg font-bold text-gray-800 dark:text-gray-200"
            href="#"
          >
             <?php echo $title; ?>
          </a>
          <ul class="mt-6">
			<?php foreach($object["nav"] as $key => $value) { ?>		
            <li class="relative px-6 py-3">
			<?php if(is_array($value["nav_sub"])) {?>
              <button
                class="inline-flex items-center justify-between w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                @click="togglePagesMenu"
                aria-haspopup="true"
              >			
			<?php } ?>
			<?php if(is_array($value["nav_sub"])) {?>
                <span class="inline-flex items-center">
                  <i class='<?php echo $value["nav_img"]; ?> xfpe_marginright5px' ></i> 
                  <span class="ml-4"><?php echo $value["nav_title"]; ?></span>
                </span>
                <svg
                  class="w-4 h-4"
                  aria-hidden="true"
                  fill="currentColor"
                  viewBox="0 0 20 20"
                >
                  <path
                    fill-rule="evenodd"
                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                    clip-rule="evenodd"
                  ></path>
                </svg>
              </button>		
              <template x-if="isPagesMenuOpen">
                <ul
                  x-transition:enter="transition-all ease-in-out duration-300"
                  x-transition:enter-start="opacity-25 max-h-0"
                  x-transition:enter-end="opacity-100 max-h-xl"
                  x-transition:leave="transition-all ease-in-out duration-300"
                  x-transition:leave-start="opacity-100 max-h-xl"
                  x-transition:leave-end="opacity-0 max-h-0"
                  class="p-2 mt-2 space-y-2 overflow-hidden text-sm font-medium text-gray-500 rounded-md shadow-inner bg-gray-50 dark:text-gray-400 dark:bg-gray-900"
                  aria-label="submenu"
                >
				<?php foreach($value["nav_sub"] as $key => $valuex) { ?>
                  <li
                    class="px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                  >
                    <a class="w-full" href=" <?php echo $valuex["nav_loc"]; ?>">
                      <?php echo $valuex["nav_title"]; ?>
                    </a>
                  </li>				
				<?php } ?>
                </ul>
              </template>			  
			<?php } else { ?>
              <span
                class="absolute inset-y-0 left-0 w-1 bg-primary-bugfish rounded-tr-lg rounded-br-lg"
                aria-hidden="true"
              ></span>
              <a
                class="inline-flex items-center w-full text-sm font-semibold text-gray-800 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-100 "
                href="<?php echo $value["nav_loc"]; ?>"
              >
                <i class='<?php echo $value["nav_img"]; ?> xfpe_marginright5px' ></i> 
                <span class="ml-4"><?php echo $value["nav_title"]; ?></span>
              </a>
            </li>			  
			<?php } ?>
			<?php } ?>
          </ul>
		  <?php if(is_array($button)) { ?>
          <div class="px-6 my-6">
            <a href="<?php echo $button[0]; ?>"
              class="flex items-center justify-between px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-primary-bugfish border border-transparent rounded-lg active:bg-primary-bugfish hover:bg-primary-bugfish focus:outline-none focus:shadow-primary-bugfish"
            >
              <?php echo $button[1]; ?>
            </a>
          </div>
		  <?php }  ?>
        </div>
      </aside>	
	<?php } 
	
	function hive__dashboard_content_start($object) { ?>
		<main class="h-full overflow-y-auto"><div class="container px-6 mx-auto grid">
	<?php }
	
	function hive__dashboard_content_end($object) { ?>
		</div></main>
	<?php }
	
	function hive__dashboard_404($object) { ?>
		<h1 class="text-6xl font-semibold text-gray-700 dark:text-gray-200">
		 ERROR 
		  404
		</h1>
		<p class="text-gray-700 dark:text-gray-300">
		  This page has not been found!
		</p>
	<?php }