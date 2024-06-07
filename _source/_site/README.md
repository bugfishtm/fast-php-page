# 🚀 Site Modules

The **Site Modules** directory houses modules installed by the store module or uploaded automatically. These modules are accessible via the integrated admin panel or by adjusting the `cfg_ruleset.php` file.

## 🚧 Caution When Renaming Folders
If you rename a folder, relations to other site modules data folders in _restricted/_public or _internal/_domains are lost. So only rename Site Module Folders manually if you know what you are doing. The Administrator Module has functionalities to find lost data.

## How to Install Site Modules?

### Method 1: Choose Module from Store
- Login to the Administrator Site Module.
- Navigate to "Store."
- Download the Desired Module and Install it through our web interface.

### Method 2: Upload in Administrator Module
- Open the Administrator Module of your BugfishCMS Instance with your web browser.
- Login as Administrator or Privileged user to control Modules / Extensions.
- Go to the Store area and choose "Upload Manually" at the top bar.
- Choose your obtained module's .zip file and upload it, by selecting the file in the file browser which appears by clicking on "choose file."
- The Site module will now be installed as a template.
- Navigate to the Site Modules Section.
- Install the newly uploaded Site Module Template with a desired Name. It will be installed and activated. It is recommended to open the site module a single time to initialize the site module's required data and variables in the database.

### Method 3: Upload Manually
- Login to your webserver with FTP/SFTP.
- Unpack the required Site Modules folder.
- Move the extracted folder, containing the files version.php (...) to the _site directory of the BugfishCMS Installation. Be sure that no special signs are used in the site folder name. The one and only special char allowed in a site module's folder name is _, but only as the first letter.
- You will now be able to use the site module by navigating to it using the administrator module, or by using ./developer.php script to choose the new site Module. If you are using ./developer.php, be sure that this script is activated in cfg_ruleset.php, otherwise you will receive an error message with more details.

## How to Set Up Standalone Module Pages?
Use cfg_ruleset.php in the website's Root Folders to access deep CMS functionalities.

## Important Information
Core Updates won't touch Files in this folder as they may be important for running Site Modules. If a Site module's name does change, the related folder / file names related in this folder may need to be changed too, to not lose data. (Site Module Folder Names are the relation to Folder Name in this Directory.)

Happy Site-ing!  
Bugfish <3