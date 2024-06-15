📁 **Website Modules Folder**

Full website modules capable of acting standalone.  
You can also find downloadable Site Modules in our store!

| Name | Description |
| --------- | ----------------------------------- |
| _documentation-adminbsb     | Documentation for the integrated AdminBSB Template.   |
| _documentation-volt     | Documentation for the integrated Volt Template.   | 
| _documentation-framework     | Documentation for the integrated Bugish Framework.   |
| _documentation   | Documentation for this CMS integrated as a site module.      |
| _lab   | Module used at lab.bugfish.eu to showcase different site modules with a token! A very simple minimal site module, just to redirect to the internal CMS Token Switch to Module Page. | 
| _example-minimal        | Minimal site module example. A minimal responsive open-source template.  | 
| _example-windmill   | Windmill Dashboard site module example. A TailwindCSS open-source template.   | 
| _example-volt   | Volt Dashboard site module example. A Bootstrap 5 open-source template.     | 
| _skeleton   | Skeleton of site modules for developers to explore and understand folder functionalities and more! Very minimalistic. If you are looking for an enhanced site module to gain development insights, take a look at the integrated _administrator site module!    | 
| _storepage   | Module used at store.bugfish.eu to showcase the internal store, deployable on other instances as a dedicated website! Works together with the Administration Module to showcase different available modules for deployment. Features the Volt Dashboard Theme. |
| _administrator   | Most enhanced and documented example/useable module. This module is the main administration module integrated into the core version of the CMS. You can delete the module if you do not need it. You can find it in the _site/_administrator folder of your CMS instance.   |

**How to Install Site Modules**

**Method 1: Choose Module from Store**
1. Login to the Administrator Site Module.
2. Navigate to "Store"
3. Download the desired module through the web interface.
4. Navigate to the "Website Module" Area of the Administrator Module.
5. Install the uploaded module template with a desired name.
6. Open the site module once to initialize required data and variables in the database.

**Method 2: Upload in Administrator Module**
1. Open the Administrator Module in your web browser.
2. Login as Administrator or Privileged user.
3. Go to the "Website Module" area and select "Upload Manually."
4. Upload the module's .zip file.
5. Install the uploaded module template with a desired name.
6. Open the site module once to initialize required data and variables in the database.

**Method 3: Upload Manually**
1. Login to your webserver with FTP/SFTP.
2. Unpack the required Site Modules folder.
3. Move the extracted folder to the _site directory of the BugfishCMS installation.
   - Use only alphanumeric characters and underscores (_), but _ only at the start.
4. Use the administrator module or ./developer.php script (ensure it's activated in cfg_ruleset.php) to use the new site module.

**Notice**  
Site Modules which are inactive are stored in /_internal/_site-dn! 
Site Modules Templates are stored in /_internal/_site-tpl for multi deployment, in that folder /_internal/_site-tpl they stay inactive!  

**Setting Up Standalone Module Pages**
- Use cfg_ruleset.php in the website's root folders to access deep CMS functionalities.

**Important Rules**
- Do not start a site module name with a number.
- Do not start a site module name with _ (reserved for core modules).
- Only use alphanumeric characters.
- Module names and folder names should not exceed 10 characters.

Happy coding and have a great one!  
🐟 Bugfish <3