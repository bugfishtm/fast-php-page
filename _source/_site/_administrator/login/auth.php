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
	if(!is_array($object)) { Header("Location: ../"); exit(); }
	if($object["user"]->user_loggedIn) { echo "<script>window.location.href= './?';</script>"; exit(); }
	if (isset($_POST["loginbutton"])) {
		if(!$object["ipbl"]->banned()) { 
			if (!empty($_POST["usermail"]) and !empty($_POST["password"])) {
				if ($object["csrf"]->check($_POST["token"])) {
					if(isset($_POST["rememberme"])) { $stay = true; } else { $stay = false; }
					$object["user"]->login_request($_POST["usermail"], $_POST["password"], $stay);
					if ($object["user"]->login_request_code == 1) {			
						$object["eventbox"]->ok("Login successfull!");
						Header("Location: ".$_SERVER["REQUEST_URI"]);
						exit();						
					} elseif ($object["user"]->login_request_code == 2) {	
						$object["eventbox"]->error("Wrong mail/password combination!");
						$object["ipbl"]->increase();
					} elseif ($object["user"]->login_request_code == 3) {
						$object["eventbox"]->error("Wrong mail/password combination!");
						$object["ipbl"]->increase();
					} elseif ($object["user"]->login_request_code == 4) {
						$object["eventbox"]->error("Your user account has been blocked by an site administrator!");
					} elseif ($object["user"]->login_request_code == 5) {
						$object["eventbox"]->error("Your user account is not yet activated! Recover your password to activate your user account.");
					} elseif ($object["user"]->login_request_code == 6) {
						$object["eventbox"]->error("You have entered the wrong password to many times and your user account has been blocked!");
					} elseif ($object["user"]->login_request_code == 7) {
						$object["eventbox"]->error("Your user account has been disabled!");
					}
				} else { $object["eventbox"]->error("Form expired, please try again!"); }		
			} else { $object["eventbox"]->error("Please fill all form fields, before you submit the form!"); }		
		} else { $object["eventbox"]->error("You have entered the wrong password to many times and your system's IP has been blocked!"); }	
	}
	?><div class="flex items-center p-6 bg-gray-50 dark:bg-gray-900">
      <div
        class="flex-1 h-full max-w-4xl mx-auto overflow-hidden bg-white rounded-lg shadow-xl dark:bg-gray-800 xfpe_maxheight600px_f"
      >

        <div class="flex flex-col overflow-y-auto md:flex-row">
          <div class="h-32 md:h-auto md:w-1/2">
            <img
              aria-hidden="true"
              class="object-cover w-full h-full dark:hidden"
              src="<?php echo _HIVE_URL_REL_."/_core/_image/bugfish-framework-logo.jpg"; ?>"
              alt="Office"
            />
            <img
              aria-hidden="true"
              class="hidden object-cover w-full h-full dark:block"
              src="<?php echo _HIVE_URL_REL_."/_core/_image/bugfish-framework-logo.jpg"; ?>"
              alt="Office"
            />
          </div>
          <div class="flex items-center justify-center p-6 sm:p-12 md:w-1/2">
            <div class="w-full">
			<form method="post"><input type="hidden" name="token" value="<?php echo $object["csrf"]->get(); ?>">
              <h1
                class="mb-4 text-xl font-semibold text-gray-700 dark:text-gray-200"
              >
                FP² Administrator
              </h1>
              <label class="block text-sm">
                <span class="text-gray-700 dark:text-gray-400">Account Mail</span>
                <input
                  class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-primary-bugfish dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                  placeholder="example@domain" name="usermail"
                />
              </label>
              <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">Account Password</span>
                <input
                  class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-primary-bugfish dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                  placeholder="***************"
                  type="password" name="password"
                />
              </label>

              <div class="flex mt-6 text-sm">
                <label class="flex items-center dark:text-gray-400">
                  <input
                    type="checkbox" name="rememberme"
                    class="text-bugfish-primary-600 form-checkbox focus:border-purple-400 focus:outline-none focus:shadow-primary-bugfish dark:focus:shadow-outline-gray"
                  />
                  <span class="ml-2">
                    Remember Login
                  </span>
                </label>
              </div>

              <!-- You should use a button here, as the anchor is only used for the example  -->
              <button
                class="block w-full px-4 py-2 mt-4 text-sm font-medium leading-5 text-center text-white transition-colors duration-150 bg-primary-bugfish border border-transparent rounded-lg active:bg-primary-bugfish hover:bg-purple-700 focus:outline-none focus:shadow-primary-bugfish"
                name="loginbutton"
              >
               Login
              </button>
				
              <a
                class="flex items-center justify-center w-full px-2 py-2 mt-2 text-sm font-medium leading-5 text-white text-gray-700 transition-colors duration-150 rounded-lg dark:text-gray-400 active:bg-transparent hover:border-gray-500 focus:border-gray-500 active:text-gray-500 focus:outline-none focus:shadow-outline-gray"
				href="<?php echo _HIVE_URL_REL_."/?"._HIVE_URL_GET_[0]."=login_recover"; ?>"
              >
                Lost Password?
              </a>
				
			  </form>
            </div>
          </div>
        </div>
       </div>
      </div>