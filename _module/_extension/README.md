📁 **Extensions Modules Folder**

Modules applicable to website modules, enhancing their functionality.  
You can also find downloadable Extensions in the related Site Module Store!  
This is only possible if a specific Site Module supports extensions.

| Name | Description |
| --------- | ----------------------------------- |
| _exts6example   | Extension module example, deployable on a _administrator module installation inside your CMS. Check the _module folder inside this repository for the module's zip file and installation guide.|

**How to Install Extension Modules**

**Method 1: Choose Module from Store**
1. Login to the Administrator Site Module.
2. Navigate to "Store"
3. Download the desired extension through the web interface.
4. Navigate to the "Website Module" Area of the Administrator Module.
5. Activate the desired extension on the desired site Module.

**Method 2: Upload in Administrator Module**
1. Open the Administrator Module in your web browser.
2. Login as Administrator or Privileged user.
3. Go to the "Extensions" area and select "Upload Manually."
4. Upload the extensions's .zip file.
5. Navigate to the "Website Module" Area of the Administrator Module.
6. Activate the desired extension on the desired site Module.

**Method 3: Upload Manually**
1. Login to your webserver with FTP/SFTP.
2. Unpack the required Extension Modules folder.
3. Move the extracted folder to the _ext/SITEMODFOLDERNAME directory of the BugfishCMS installation.
   - Use only alphanumeric characters and underscores (_), but _ only at the start.
4. Site module is activated automatically if moved inside that folder. Installation with administrator Module is recommended.

**Notice**  
Site Modules which are inactive are stored in /_internal/_ext-dn/SITEMODULENAME/! 
Extension Modules Templates are stored in /_internal/_ext-tpl for multi deployment, in that folder /_internal/_ext-tpl they stay inactive!  

**Important Rules**
- Do not start a extension module name with a number.
- Do not start a extension module name with _ (reserved for core modules).
- Only use alphanumeric characters.
- Extension names and folder names should not exceed 10 characters.

Happy coding and have a great one!  
🐟 Bugfish <3