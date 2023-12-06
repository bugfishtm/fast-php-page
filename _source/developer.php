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
	*/  if(file_exists("./settings.php")) { require_once("./settings.php"); } else { @http_response_code(404); Header("Location: ./"); exit(); } 
	if(!_HIVE_MOD_CHANGES_) { hive_error_full("Not Available", "ERROR", "This area of the site has been deactivated in internal.php[_HIVE_MOD_CHANGES_]!", true, 404); }
	hive__simple_start($object, "Developer Tools", '<link rel="icon" type="image/x-icon" href="'._HIVE_URL_REL_.'/_core/_image/favicon.ico">'); ?>

	<div class="containerbox">
			<img src='./_core/_image/logo_alpha.png' width='40' style="margin-right: 10px;" > <b style='font-size:36px; padding-bottom: 10px;'>Backend Tools</b><br />
			<b>Change website session settings:</b><br />
			Here you can change this websites settings if available! <br />
			This changes will only be relative to your own sessions!<br />
			No global website configurations here!<br /><br />	
	</div>
	<div class="containerbox">
		<b>Operational URLs:</b><br />Here are some links to usefull backend tools!<br /><br />
		<a href="./_core/_tools/session_destroy.php" class="containerbox-btn">Session Destroy</a> 
		<a href="./_core/_tools/cookie_destroy.php" class="containerbox-btn">Cookie Destroy</a> <br /><br /><br />
		<a href="./_core/_tools/phpinfo.php" class="containerbox-btn">PHPInfo</a> 
		<a href="./_core/admin_switch.php" class="containerbox-btn">Admin Switch</a>
		<br /><br />
	</div>
	<div class="containerbox">
		<b>Some Benchmark Data:</b><br />Here you can see some background information about this page's loadup!<br /><br />		
		<b>Memory Load</b>: <?php echo $object["debug"]->memory_usage(); ?><br />
		<b>Memory Limit</b>: <?php echo $object["debug"]->memory_limit(); ?><br />
		<b>CPU Load</b>: <?php echo $object["debug"]->cpu_load(); ?><br />
		<b>Loadup Time</b>: <?php echo $object["debug"]->timer(); ?><br />
		<b>SQL Queries</b>: <?php echo $object["mysql"]->benchmark_get(); ?><br />
	</div>
	<div class="containerbox">
        <b>Change website mode:</b><br />Here you can change this websites mode if available!<br /><br />
		<b>Current Site</b>: <?php echo _HIVE_MODE_; ?><br />
		<b>Session Site</b>: <?php echo @$_SESSION[_HIVE_COOKIE_."hive_mode"]; ?><br />
		<b>Default Site</b>: <?php echo _HIVE_MODE_DEFAULT_; ?><br />
		<b>Array Site</b>: <span style='word-break: break-all;'><?php if(is_array(@_HIVE_MODE_ARRAY_)) { foreach(_HIVE_MODE_ARRAY_ as $key => $value) { if($key != 0) {echo ", ";} echo @htmlspecialchars($value);  } }?></span><br /><br />
		<?php 
			if(@is_string(@$_POST["mod_change"]) AND @in_array(@$_POST["mod_change"], @_HIVE_MODE_ARRAY_)) {
				$_SESSION[_HIVE_COOKIE_."hive_mode"] = @$_POST["mod_change"];
				echo "<script>window.location.href = window.location.href;</script>";
			}
		?>
		<form method="post">
			<select name="mod_change" class="containerbox-btn">
				<option value="<?php echo @htmlentities($_SESSION[_HIVE_COOKIE_."hive_mode"] ); ?>">Active: <?php echo @htmlentities($_SESSION[_HIVE_COOKIE_."hive_mode"] ); ?></option>
				<?php
					foreach(_HIVE_MODE_ARRAY_ as $key => $value) {
						echo "<option value='".@htmlspecialchars($value)."'>".@htmlspecialchars($value)."</option>";
					}
				?>
			</select>
			<input type="hidden" name="update_start" value="set">
			<button type="submit" class="containerbox-btn">Change Site</button> 		
		</form>		
	</div>
	<div class="containerbox">
		<b>Change website language:</b><br />Here you can change this websites language if available!<br /><br />
		<b>Current Language</b>: <?php echo @htmlspecialchars(_HIVE_LANG_); ?><br />
		<b>Session Language</b>: <?php echo @htmlspecialchars(@$_SESSION[_HIVE_SITE_COOKIE_."hive_language"]); ?><br />
		<b>Default Language</b>: <?php echo @htmlspecialchars(_HIVE_LANG_DEFAULT_); ?><br />
		<b>Array Language</b>: <span style='word-break: break-all;'><?php if(is_array(@_HIVE_LANG_ARRAY_)) { foreach(_HIVE_LANG_ARRAY_ as $key => $value) { if($key != 0) {echo ", ";} echo @htmlspecialchars($value);  } }?></span>
		<br />
		<?php 
			if(@is_string(@$_POST["lang_change"]) AND @in_array(@$_POST["lang_change"], @_HIVE_LANG_ARRAY_)) {
				@$_SESSION[_HIVE_SITE_COOKIE_."hive_language"] = @$_POST["lang_change"];
				echo "<script>window.location.href = window.location.href;</script>";
			}
		?>
		<form method="post">
			<select name="lang_change" class="containerbox-btn">
				<option value="<?php echo @htmlentities(@$_SESSION[_HIVE_SITE_COOKIE_."hive_language"]); ?>">Active: <?php echo @htmlentities(@$_SESSION[_HIVE_SITE_COOKIE_."hive_language"]); ?></option>
				<?php
					foreach(_HIVE_LANG_ARRAY_ as $key => $value) {
						echo "<option value='".@htmlspecialchars($value)."'>".@htmlspecialchars($value)."</option>";
					}
				?>
			</select>
			<input type="hidden" name="update_start" value="set">
			<button type="submit" class="containerbox-btn">Change Language</button>
		</form>		
	</div>
	<div class="containerbox">
		<b>Change website theme:</b><br />Here you can change this websites theme if available!<br /><br />
		<b>Current Theme</b>: <?php echo @htmlspecialchars(_HIVE_THEME_); ?><br />
		<b>Session Theme</b>: <?php echo @htmlspecialchars(@$_SESSION[_HIVE_SITE_COOKIE_."hive_theme"]); ?><br />
		<b>Default Theme</b>: <?php echo @htmlspecialchars(_HIVE_THEME_DEFAULT_); ?><br />
		<b>Array Theme</b>: <span style='word-break: break-all;'><?php if(is_array(@_HIVE_THEME_ARRAY_)) { foreach(_HIVE_THEME_ARRAY_ as $key => $value) { if($key != 0) {echo ", ";} echo @htmlspecialchars($value);  } }?></span>	
		<br />
		<?php 
			if(@is_string(@$_POST["thm_change"]) AND @in_array(@$_POST["thm_change"], @_HIVE_THEME_ARRAY_)) {
				@$_SESSION[_HIVE_SITE_COOKIE_."hive_theme"] = @$_POST["thm_change"];
				echo "<script>window.location.href = window.location.href;</script>";
			}
		?>
		<form method="post">
			<select name="thm_change" class="containerbox-btn">
			<option value="<?php echo @htmlentities(@$_SESSION[_HIVE_SITE_COOKIE_."hive_theme"]); ?>">Active: <?php echo @htmlentities(@$_SESSION[_HIVE_SITE_COOKIE_."hive_theme"]); ?></option>
				<?php
					foreach(_HIVE_THEME_ARRAY_ as $key => $value) {
						echo "<option value='".@htmlspecialchars($value)."'>".@htmlspecialchars($value)."</option>";
					}
				?>
			</select>
			<input type="hidden" name="update_start" value="set">
			<button type="submit" class="containerbox-btn">Change Theme</button> 
		</form>
	</div>		
	<div class="containerbox">
		<b>Change website color:</b><br />Here you can change this websites color if available!<br /><br />
		<b>Current Color</b>: <?php echo @htmlspecialchars(_HIVE_COLOR_); ?><br />
		<b>Session Color</b>: <?php echo @htmlspecialchars(@$_SESSION[_HIVE_SITE_COOKIE_."hive_color"]); ?><br />	
		<b>Default Color</b>: <?php echo @htmlspecialchars(_HIVE_THEME_COLOR_DEFAULT_); ?><br />		
		<br />
		<?php 
			if(@is_string(@$_POST["ctsd_change"])) {
				@$_SESSION[_HIVE_SITE_COOKIE_."hive_color"] = @$_POST["ctsd_change"];
				echo "<script>window.location.href = window.location.href;</script>";
			}
		?>
		<form method="post">
			<input type="color" name="ctsd_change" value='<?php echo @htmlspecialchars(_HIVE_COLOR_); ?>'>
			<input type="hidden" name="update_start" value="set">
			<button type="submit" class="containerbox-btn">Change Theme Color</button> 
		</form>
	</div>
	<div class="containerbox">
<?php 
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
	</div>
		
		
		<?php echo "</p>";	


hive__simple_end($object, _HIVE_CREATOR_); ?>
	