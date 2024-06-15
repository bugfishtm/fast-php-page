📁 **Script Modules Folder**

Script modules can be included in site modules that support them. An installed script module is ready to use for all CMS installed site modules and is not related to a specific site module.

| Name | Description |
| --------- | ----------------------------------- |
| _screxample   | Extension script example that can be used on all site modules supporting its display. You can test this example script in our administrator module if you want to! |

**How to Install Script Modules**

**Method 1: Choose Module from Store**
1. Login to the Administrator Site Module.
2. Navigate to "Store"
3. Download the desired script module through the web interface.
4. Navigate to the "Scripts" Area of the Administrator Module.
5. Install the aquired Script
6. Use the script by hardlinking to the scripts public.php or access it through cms administrator module restricted.php or internal functionalities.

**Method 2: Upload in Administrator Module**
1. Open the Administrator Module in your web browser.
2. Login as Administrator or Privileged user.
3. Go to the "Script Module" area and select "Upload Manually."
4. Upload the scripts's .zip file.
5. Install the aquired Script
6. Use the script by hardlinking to the scripts public.php or access it through cms administrator module restricted.php or internal functionalities.

**Method 3: Upload Manually**
1. Login to your webserver with FTP/SFTP.
2. Unpack the required Script Modules folder.
3. Move the extracted folder to the _script directory of the BugfishCMS installation.
   - Use only alphanumeric characters and underscores (_), but _ only at the start.
4. Use the script by hardlinking to the scripts public.php or access it through cms administrator module restricted.php or internal functionalities.

**Notice**  
Script Modules Templates are stored in /_internal/_script-tpl for multi deployment, in that folder /_internal/_script-tpl they stay inactive!  

**Important Rules**
- Do not start a script module name with a number.
- Do not start a script module name with _ (reserved for core modules).
- Only use alphanumeric characters.
- script module names and folder names should not exceed 10 characters.

Happy coding and have a great one!  
🐟 Bugfish <3