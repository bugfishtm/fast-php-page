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
if(!is_numeric(@$_GET["rec_user"]) AND !isset($_GET["rec_token"])) { 
		if (isset($_POST["resetbutton"])) {
			if (@trim(@$_POST["mail"]) != "") {									
				if ($object["csrf"]->check($_POST["token"])) {								
					$object["user"]->recover_request($_POST["mail"]);
					if ($object["user"]->rec_request_code == 1) {	
							$object["mail_template"]->set_template("_RECOVER_");	
							$object["mail_template"]->add_substitution("_ACTION_URL_", "https://" . _HIVE_SITE_URL_ . "/?"._HIVE_URL_GET_[0]."=login_recover&rec_token=" . $object["user"]->mail_ref_token . "&rec_user=" . $object["user"]->mail_ref_user . ""); 
							$title = $object["mail_template"]->get_subject(true);
							$content = $object["mail_template"]->get_content(true);								
							$object["mail"]->send($object["user"]->mail_ref_receiver, $object["user"]->mail_ref_receiver, $title, $content);
							$object["eventbox"]->ok("Please check your inbox for a password reset mail, this mail contains a link to recover your password.");
						}
					if ($object["user"]->rec_request_code == 2) { $object["eventbox"]->error("Mail unknown!"); }
					if ($object["user"]->rec_request_code == 4) { $object["eventbox"]->error("You account does not have permission to recover the password!"); }
					if ($object["user"]->rec_request_code == 5) { $object["eventbox"]->error("Your account has been deactivated and can not do new requests!"); }
					if ($object["user"]->rec_request_code == 3) { 
						$vartmp = round($object["user"]->recover_request_time($object["user"]->mail_ref_user) / 60, 0);
						$object["eventbox"]->error("You need to wait '".$vartmp."' Minutes before you start a new Recover request!"); }
				} else { $object["eventbox"]->error("Form expired, please try again!"); }
			} else {$object["eventbox"]->error("Please enter a Mail!"); }
		} ?>
   <div class="flex items-center p-6 bg-gray-50 dark:bg-gray-900">
      <div
        class="flex-1 h-full max-w-4xl mx-auto overflow-hidden bg-white rounded-lg shadow-xl dark:bg-gray-800 xfpe_maxheight500px_f"
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
              <h1
                class="mb-4 text-xl font-semibold text-gray-700 dark:text-gray-200"
              >
                Recover your Password
              </h1>
			<form method="post" action="./?<?php echo _HIVE_URL_GET_[0]; ?>=login_recover">
			<input type="hidden" name="resetbutton" value="1">
			<input type="hidden" name="token" value="<?php echo $object["csrf"]->get(); ?>">
			  
              <label class="block text-sm">
                <span class="text-gray-700 dark:text-gray-400">Account Mail</span>
                <input
                  class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-primary-bugfish dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                  placeholder="example@domain" type="text" name="mail"
                />
              </label>

              <!-- You should use a button here, as the anchor is only used for the example  -->
              <button type="submit" 
                class="block w-full px-4 py-2 mt-4 text-sm font-medium leading-5 text-center text-white transition-colors duration-150 bg-primary-bugfish border border-transparent rounded-lg active:bg-primary-bugfish hover:bg-purple-700 focus:outline-none focus:shadow-primary-bugfish"
              >
               Recover Account
              </button>

			</form>
              <a
                class="flex items-center justify-center w-full px-2 py-2 mt-2 text-sm font-medium leading-5 text-white text-gray-700 transition-colors duration-150 rounded-lg dark:text-gray-400 active:bg-transparent hover:border-gray-500 focus:border-gray-500 active:text-gray-500 focus:outline-none focus:shadow-outline-gray"
				href="<?php echo _HIVE_URL_REL_."/"; ?>"
              >
                Back to Login
              </a>
            </div>
          </div>	  
        </div>
       </div>
      </div>	  
<?php } else { 
		// Recover Password per Mail									
		if ($object["user"]->recover_token_valid(@$_GET["rec_user"], @$_GET["rec_token"])) {
			if (isset($_POST["recoverbut"])) {
				if ($object["csrf"]->check($_POST["token"])) {
					if (@trim($_POST["rec_pass"]) != "") {
						if ($_POST["rec_pass"] == $_POST["rec_pass_confirm"]) {
							if($object["user"]->passfilter_check($_POST["rec_pass"])) {
								if ($object["user"]->recover_confirm($_GET["rec_user"], $_GET["rec_token"], $_POST["rec_pass"])) {
									$object["eventbox"]->ok("You have successfully changed your password!");
									$object["eventbox"]->skip();
									echo "<script>window.location.href = './?';</script>";
								} else {
									$object["eventbox"]->error("Unknown Error!");
								}  
							} else { $object["eventbox"]->error("Your password does not match the requirements: 1 Small Character, 1 Capital Character, 1 Numeric Character and at least 10 signs!"); }
						} else { $object["eventbox"]->error("Passwords do not match!"); }
					} else {$object["eventbox"]->error("Please enter a new password!"); }
				} else { $object["eventbox"]->error("Form expired, please try again!"); }
			} 
		} else { $object["eventbox"]->error("This Password-Recover Token is expired! Please retry to recover your account."); } ?>
  <div class="flex items-center p-6 bg-gray-50 dark:bg-gray-900">
      <div
        class="flex-1 h-full max-w-4xl mx-auto overflow-hidden bg-white rounded-lg shadow-xl dark:bg-gray-800 xfpe_maxheight500px_f"
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
              <h1
                class="mb-4 text-xl font-semibold text-gray-700 dark:text-gray-200"
              >
                Recover your Password
              </h1>		
			<form method="post" action="./?<?php echo _HIVE_URL_GET_[0]; ?>=login_recover&rec_user=<?php echo @$_GET["rec_user"]; ?>&rec_token=<?php echo @$_GET["rec_token"]; ?>">
			<input type="hidden" name="recoverbut" value="1">
			<input type="hidden" name="token" value="<?php echo $object["csrf"]->get(); ?>">
              <label class="block text-sm">
                <span class="text-gray-700 dark:text-gray-400">New Password</span>
                <input
                  class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-primary-bugfish dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                  placeholder="New Password" name="rec_pass" type="password"
                />
              </label><br>
              <label class="block text-sm">
                <span class="text-gray-700 dark:text-gray-400">Confirm New Password</span>
                <input
                  class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-primary-bugfish dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                  placeholder="Confirm New Password" name="rec_pass_confirm" type="password"
                />
              </label>
              <!-- You should use a button here, as the anchor is only used for the example  -->
              <button type="submit"
                class="block w-full px-4 py-2 mt-4 text-sm font-medium leading-5 text-center text-white transition-colors duration-150 bg-primary-bugfish border border-transparent rounded-lg active:bg-primary-bugfish hover:bg-purple-700 focus:outline-none focus:shadow-primary-bugfish"
              >
               Change Password
              </button>
			</form>
              <a
                class="flex items-center justify-center w-full px-2 py-2 mt-2 text-sm font-medium leading-5 text-white text-gray-700 transition-colors duration-150 rounded-lg dark:text-gray-400 active:bg-transparent hover:border-gray-500 focus:border-gray-500 active:text-gray-500 focus:outline-none focus:shadow-outline-gray"
				href="<?php echo _HIVE_URL_REL_."/"; ?>"
              >
                Back to Login
              </a>
            </div>
          </div>		  
        </div>
       </div>
      </div>
<?php } 