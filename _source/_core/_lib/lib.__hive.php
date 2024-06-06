<?php
	/* 
		 _               __ _    _    ___ __  __ ___ 
		| |__ _  _ __ _ / _(_)__| |_ / __|  \/  / __|
		| '_ \ || / _` |  _| (_-< ' \ (__| |\/| \__ \
		|_.__/\_,_\__, |_| |_/__/_||_\___|_|  |_|___/
				  |___/                              

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
		
		File Description:
			Function Library for General CMS Functionalitites
	*/ if(!is_array(@$object)) { @http_response_code(@404); @Header("Location: ../"); exit(); }
	
	function hive_site_acces($object, $rights, $displayerror = false) { return hive__access($object, $rights, $displayerror);}
	function hive__access($object, $rights, $displayerror = false) { 
		if(@$object["user"]->user["user_initial"] == 1) { return true; }
		// Check if Type is OR (In Group and User Permissions)
		if(is_array($rights)) {
			foreach($rights AS $key => $value) {
				if($object["user_perm"]->has_perm($value)) { return true; }
				foreach($object["user_group"] as $groupkey => $groupvalue) { 
					if($groupvalue["perm_obj"]->has_perm($value)) { return true; }
				}
			}} else {
			if($object["user_perm"]->has_perm($rights)) { return true; }
			foreach($object["user_group"] as $groupkey => $groupvalue) { 
				if($groupvalue["perm_obj"]->has_perm($rights)) { return true; }
			}
		}
		if($displayerror) { require_once($object["path"]."/_core/_error/error.401.php"); exit(); }
		return false;}
		
	function  hive_get_url_rel($array) {
		$url_rel = _HIVE_URL_REL_."";
		if(_HIVE_URL_SEO_) {
			foreach($array as $key => $value) {
				if($value == false) { break;}
				if($key == 0) {  } else {$url_rel .= "/";  }
				if(@is_string(@_HIVE_URL_GET_[$key]) AND @is_string($value)) { $url_rel .= $value; }}
		} else {
			foreach($array as $key => $value) {
				if($value == false) { break;}
				if($key == 0) { $url_rel .= "?"; } else {$url_rel .= "&";  }
				if(@is_string(@_HIVE_URL_GET_[$key]) AND @is_string($value)) { $url_rel .= _HIVE_URL_GET_[$key]."=".$value; }
			}}
			if(substr($url_rel, 0, 1) == "?") { return "/".$url_rel;}
		return $url_rel;}
	
	
	function hive_error_full($title, $subtitle, $description, $exit, $code, $type = "error") { 
		if(is_numeric($code)) { @http_response_code($code); }?>	
<!DOCTYPE html>
<html lang="en">
<head>
	<!--
		 _               __ _    _    ___ __  __ ___ 
		| |__ _  _ __ _ / _(_)__| |_ / __|  \/  / __|
		| '_ \ || / _` |  _| (_-< ' \ (__| |\/| \__ \
		|_.__/\_,_\__, |_| |_/__/_||_\___|_|  |_|___/
				  |___/                              	
										Error / Notification CMS Page
	-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="robots" content="noindex, nofollow">
	<?php if(defined("_HIVE_URL_REL_")) { ?> <link rel="icon" type="image/x-icon" href="<?php echo _HIVE_URL_REL_; ?>/_core/_image/favicon.ico"> <?php } ?>
    <title><?php echo $title; ?><?php if(defined("_HIVE_TITLE_SPACER_")) { echo _HIVE_TITLE_SPACER_; } else { echo " - "; } ?><?php if(defined("_HIVE_TITLE_")) { echo _HIVE_TITLE_; } else { echo "CMS"; } ?></title>
    <style>
        body { 	margin: 0;
				padding: 0;
				height: 100vh;
				min-height: 225px;
				background-color: #080808;
				color: #fff;
				padding-top: 0px;
				padding-bottom: 20px;
				box-sizing: border-box;
				font-family: Arial, sans-serif; }
        .flex { 	
				display: flex;
				justify-content: center;
				align-items: center; }
        h1 { 	font-size: 24px; margin-bottom: 10px; }
        p { 	font-size: 16px; margin-bottom: 20px; }
        .container {
				text-align: center;
				max-width: 400px;
				padding: 20px;
				margin: 20px;
				padding-top: 0px;
				border: 2px solid #FF0000;
				border-radius: 10px;
				background-color: #121212;}
        .box {
            background-color: #444;
            padding: 10px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
			font-size: 14px !important;
			text-align: left;
			overflow-y: none;
			font-family: Courier; }
		a { color: white; text-decoration: none; font-size: 12px; }
        .info-container {
				border: 2px solid #0080ff;}
        .ok-container {
				border: 2px solid #15ff00;}
		.box a {
			color: #FFFF00;
		}
    </style>
</head>
<body>
    <div class="flex">
    <div class="container <?php echo $type; ?>-container">
        <h1><?php echo $title; ?></h1>
        <div class="box <?php echo $type; ?>-box">
            Information:<br /><?php echo $subtitle; ?><br /><br />
			Details:<br /><?php echo $description; ?>
        </div><br />
		<a href="../">Click here to get back!</a>
    </div>
    </div>
</body>
</html>
	<?php if($exit) { exit(); } }
	
	function hive__template_mail_activate($object, $get_token = "mai_token", $get_user = "mai_user", $message = true, $redirect = _HIVE_URL_REL_) {
	$code = false;
	if(is_numeric(@$_GET[$get_user]) AND is_numeric(@$_GET[$get_token])) {
		$code = $object["user"]->mail_edit_confirm(@$_GET[$get_user], @$_GET[$get_token]);
		if($code == 1) { if($message) { $object["eventbox"]->ok($object["lang"]->translate("hive_login_msg_m_ok"));  }}
		if($code == 2) { if($message) { $object["eventbox"]->error($object["lang"]->translate("hive_login_msg_m_er")); }}
		if($code == 3) { if($message) { $object["eventbox"]->error($object["lang"]->translate("hive_login_msg_m_exp")); }}
		if($code == 4) { if($message) { $object["eventbox"]->error($object["lang"]->translate("hive_login_msg_m_res")); }}
		if($code == 5) { if($message) { $object["eventbox"]->error($object["lang"]->translate("hive_login_msg_m_block")); }}
		if($code == 6) { if($message) { $object["eventbox"]->error($object["lang"]->translate("hive_login_msg_m_res")); }}
		if($redirect) { Header("Location: ".$redirect.""); exit(); } } return $code; }
	
	function hive__template_user_activate($object, $get_token = "act_token", $get_user = "act_user", $message = true, $redirect = _HIVE_URL_REL_) {
	$code = false;
	if(is_numeric(@$_GET[$get_user]) AND is_numeric(@$_GET[$get_token])) {
		$code = $object["user"]->activation_confirm(@$_GET[$get_user], @$_GET[$get_token]);
		if($code == 1) { if($message) { $object["eventbox"]->ok($object["lang"]->translate("hive_login_msg_a_ok"));  } }
		if($code == 2) { if($message) { $object["eventbox"]->error($object["lang"]->translate("hive_login_msg_a_er")); } }
		if($code == 3) { if($message) { $object["eventbox"]->error($object["lang"]->translate("hive_login_msg_a_exp")); } }
		if($code == 4) { if($message) { $object["eventbox"]->error($object["lang"]->translate("hive_login_msg_a_block")); } }
		if($redirect) { Header("Location: ".$redirect.""); exit(); } } return $code; }
		
	function hive__template_recover_exec($object, $rec_url = false, $get_token = "rec_token", $get_user = "rec_user", $mailtemplate = "_RECOVER_", $message = true, $redirect = _HIVE_URL_REL_) {
		if($object["user"]->user_loggedIn) { if($message) {$object["eventbox"]->error($object["lang"]->translate("hive_login_msg_notposlogin")); } if($redirect) { Header("Location: ".$redirect.""); exit(); } return "already_logged_in"; }
		if(!is_numeric(@$_GET[$get_user]) AND !isset($_GET[$get_token])) { 
				if (isset($_POST["resetbutton"])) {
					if (@trim(@$_POST["mail"]) != "") {									
						if ($object["csrf"]->check($_POST["token"])) {								
							$object["user"]->recover_request($_POST["mail"]);
							if ($object["user"]->rec_request_code == 1) {	
									$object["mail_template"]->set_template($mailtemplate);	
									$newurlx =  _HIVE_SITE_URL_ . "/".$rec_url;
									if(@strpos(@$newurlx, "?") > 0) { $newurlx .= "&"; } else { $newurlx .= "?"; }
									$object["mail_template"]->add_substitution("_ACTION_URL_", $newurlx.$get_token."=" . $object["user"]->mail_ref_token . "&".$get_user."=" . $object["user"]->mail_ref_user . ""); 
									$title = $object["mail_template"]->get_subject(true);
									$content = $object["mail_template"]->get_content(true);								
									$object["mail"]->send($object["user"]->mail_ref_receiver, $object["user"]->mail_ref_receiver, $title, $content);
									if($message) { $object["eventbox"]->ok($object["lang"]->translate("hive_login_msg_recnok")); }
									if($redirect) { Header("Location: ".$redirect.""); exit(); }
								}
							if ($object["user"]->rec_request_code == 2) { if($message) {$object["eventbox"]->error($object["lang"]->translate("hive_login_msg_recnewunk")); } if($redirect) { Header("Location: ".$_SERVER["REQUEST_URI"].""); exit(); }}
							if ($object["user"]->rec_request_code == 4) { if($message) {$object["eventbox"]->error($object["lang"]->translate("hive_login_msg_recnope")); } if($redirect) { Header("Location: ".$_SERVER["REQUEST_URI"].""); exit(); }}
							if ($object["user"]->rec_request_code == 5) { if($message) {$object["eventbox"]->error($object["lang"]->translate("hive_login_msg_recnopede")); } if($redirect) { Header("Location: ".$_SERVER["REQUEST_URI"].""); exit(); }}
							if ($object["user"]->rec_request_code == 3) { 
								$vartmp = round($object["user"]->recover_request_time($object["user"]->mail_ref_user) / 60, 0);
								if($message) {$object["eventbox"]->error($object["lang"]->translate("hive_login_msg_recwait")." ".$vartmp." ".$object["lang"]->translate("hive_login_msg_min")); }
								if($redirect) { Header("Location: ".$_SERVER["REQUEST_URI"].""); exit(); }}
						} else { if($message) {$object["eventbox"]->error($object["lang"]->translate("hive_login_msg_csrf"));	} if($redirect) { Header("Location: ".$_SERVER["REQUEST_URI"].""); exit(); } }
					} else {if($message) {$object["eventbox"]->error($object["lang"]->translate("hive_login_msg_empty")); } if($redirect) { Header("Location: ".$_SERVER["REQUEST_URI"].""); exit(); } }
				} return @$object["user"]->rec_request_code; ?>	
		<?php } else { 
				// Recover Password per Mail									
				if ($object["user"]->recover_token_valid(@$_GET[$get_user], @$_GET[$get_token])) {
					if (isset($_POST["recoverbut"])) {
						if ($object["csrf"]->check($_POST["token"])) {
							if (@trim($_POST["rec_pass"]) != "") {
								if ($_POST["rec_pass"] == $_POST["rec_pass_confirm"]) {
									if($object["user"]->passfilter_check($_POST["rec_pass"])) {
										if ($object["user"]->recover_confirm($_GET[$get_user], $_GET[$get_token], $_POST["rec_pass"])) {
											if($message) { $object["eventbox"]->ok($object["lang"]->translate("hive_login_msg_pwcok")); }
											if($redirect) { Header("Location: ".$redirect.""); exit(); }
											return "recexec_ok";
										} else {
											if($message) { $object["eventbox"]->error($object["lang"]->translate("hive_login_msg_unk"));}
											if($redirect) { Header("Location: ".$_SERVER["REQUEST_URI"].""); exit(); }
											return "recexec_err";
										}  
									} else { if($message) { $object["eventbox"]->error($object["lang"]->translate("hive_login_msg_pwrecno")); } 
										if($redirect) { Header("Location: ".$_SERVER["REQUEST_URI"].""); exit(); } return "recexec_pwmissingrequirements"; } 
								} else { if($message) { $object["eventbox"]->error($object["lang"]->translate("hive_login_msg_pwnomatch")); } 
										if($redirect) { Header("Location: ".$_SERVER["REQUEST_URI"].""); exit(); } return "recexec_pwnomatch"; }
							} else {if($message) { $object["eventbox"]->error($object["lang"]->translate("hive_login_msg_empty"));}  
										if($redirect) { Header("Location: ".$_SERVER["REQUEST_URI"].""); exit(); } return "recexec_fieldmissing"; }
						} else { if($message) { $object["eventbox"]->error($object["lang"]->translate("hive_login_msg_csrf"));}  
										if($redirect) { Header("Location: ".$_SERVER["REQUEST_URI"].""); exit(); } return "recexec_csrf"; } 
					} 
				} else { if($message) { $object["eventbox"]->error($object["lang"]->translate("hive_login_msg_pwtexpire")); }  
										if($redirect) { Header("Location: ".$_SERVER["REQUEST_URI"].""); exit(); } return "recexec_expire"; } ?>
		<?php } 		
	}
	
	function hive__template_login_exec($object, $cookies_allow = false) {
		if($object["user"]->user_loggedIn) { echo "<script>window.location.href= '"._HIVE_URL_REL_."';</script>"; exit(); }
			if (isset($_POST["loginbutton"])) {
				if(!$object["ipbl"]->banned()) { 
					if (!empty($_POST["usermail"]) and !empty($_POST["password"])) {
						if ($object["csrf"]->check($_POST["token"])) {
							if(isset($_POST["rememberme"]) AND $cookies_allow) { $stay = true; } else { $stay = false; }
							$object["user"]->login_request($_POST["usermail"], $_POST["password"], $stay);
							if ($object["user"]->login_request_code == 1) {			
								$object["eventbox"]->ok($object["lang"]->translate("hive_login_msg_ok"));
								echo "<script>window.location.href= '"._HIVE_URL_REL_."';</script>";
								$object["eventbox"]->skip();
							} elseif ($object["user"]->login_request_code == 2) {	
								$object["eventbox"]->error($object["lang"]->translate("hive_login_msg_wrong"));
								$object["ipbl"]->increase();	
							} elseif ($object["user"]->login_request_code == 3) {
								$object["eventbox"]->error($object["lang"]->translate("hive_login_msg_wrong"));
								$object["ipbl"]->increase();			
							} elseif ($object["user"]->login_request_code == 4) {
								$object["eventbox"]->error($object["lang"]->translate("hive_login_msg_blocked"));	
							} elseif ($object["user"]->login_request_code == 5) {
								$object["eventbox"]->error($object["lang"]->translate("hive_login_msg_inactive"));	
							} elseif ($object["user"]->login_request_code == 6) {
								$object["eventbox"]->error($object["lang"]->translate("hive_login_msg_blockedpwf"));
							} elseif ($object["user"]->login_request_code == 7) {
								$object["eventbox"]->error($object["lang"]->translate("hive_login_msg_disabled"));	 
							}
						} else { $object["eventbox"]->error($object["lang"]->translate("hive_login_msg_csrf"));	}	
					} else { $object["eventbox"]->error($object["lang"]->translate("hive_login_msg_empty")); }		
				} else { $object["eventbox"]->error($object["lang"]->translate("hive_login_msg_banned")); }	
			}	
	}
	
	function hive__user_lang_set($object, $user_id, $mode, $theme_name) {
		if(is_numeric($user_id) AND @in_array(@$theme_name, _HIVE_LANG_ARRAY_)) {
			$x = $object["user"]->get($user_id);
			$tmp = @unserialize($x["hive_extradata"]);
			$tmp[$mode]["lang"] = $theme_name;
			$tmp = serialize($tmp);
			$bind[0]["value"] = $tmp;
			$bind[0]["type"] = "s";
			$object["mysql"]->query("UPDATE "._TABLE_USER_." SET hive_extradata = ? WHERE id = '".$user_id."'", $bind);
		} return false;
	}
	
	function hive__user_theme_set($object, $user_id, $mode, $theme_name) {
		if(is_numeric($user_id) AND @in_array(@$theme_name, _HIVE_THEME_ARRAY_)) {
			$x = $object["user"]->get($user_id);
			$tmp = @unserialize($x["hive_extradata"]);
			$tmp[$mode]["theme"] = $theme_name;
			$tmp = serialize($tmp);
			$bind[0]["value"] = $tmp;
			$bind[0]["type"] = "s";
			$object["mysql"]->query("UPDATE "._TABLE_USER_." SET hive_extradata = ? WHERE id = '".$user_id."'", $bind);
		} return false;
	}	
	function hive__user_theme_sub_set($object, $user_id, $mode, $theme_name) {
		if(is_numeric($user_id)) {
			$x = $object["user"]->get($user_id);
			$tmp = @unserialize($x["hive_extradata"]);
			$tmp[$mode]["theme_sub"] = $theme_name;
			$tmp = serialize($tmp);
			$bind[0]["value"] = $tmp;
			$bind[0]["type"] = "s";
			$object["mysql"]->query("UPDATE "._TABLE_USER_." SET hive_extradata = ? WHERE id = '".$user_id."'", $bind);
		} return false;
	}	
	function hive__user_color_set($object, $user_id, $mode, $theme_name) {
		if(is_numeric($user_id)) {
			$x = $object["user"]->get($user_id);
			$tmp = @unserialize($x["hive_extradata"]);
			$tmp[$mode]["color"] = $theme_name;
			$tmp = serialize($tmp);
			$bind[0]["value"] = $tmp;
			$bind[0]["type"] = "s";
			$object["mysql"]->query("UPDATE "._TABLE_USER_." SET hive_extradata = ? WHERE id = '".$user_id."'", $bind);
		} return false;
	}		