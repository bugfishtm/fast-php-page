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
	// Activate Account if Requested
	if(is_numeric(@$_GET["mai_user"]) AND is_numeric(@$_GET["mai_token"])) {
		$code = $object["user"]->mail_edit_confirm(@$_GET["mai_user"], @$_GET["mai_token"]);
		if($code == 1) { $object["eventbox"]->skip(); $object["eventbox"]->ok("You have successfully activated your new mail!");  }
		if($code == 2) { $object["eventbox"]->skip(); $object["eventbox"]->error("Error activating your new Mail!"); }
		if($code == 3) { $object["eventbox"]->skip(); $object["eventbox"]->error("Mail Activation code expired! Please retry to change your mail in the profile setup!"); }
		if($code == 4) { $object["eventbox"]->skip(); $object["eventbox"]->error("The mail you tried to activate is now used on another account, so it cannot be related to your account!"); }
		if($code == 5) { $object["eventbox"]->skip(); $object["eventbox"]->error("Your account is blocked for mail changes!"); }
		if($code == 6) { $object["eventbox"]->skip(); $object["eventbox"]->error("The mail you tried to activate is now used on another account, so it cannot be related to your account!"); }
		echo "<script>window.location.href = './';</script>"; }
?>