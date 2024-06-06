# Site Modules

The Site Modules directory houses modules installed by the store module or uploaded automatically. These modules are accessible via the integrated admin panel or by adjusting the `cfg_ruleset.php` file.

## Caution renaming Folders
If you rename a folder, relations to other site modules data folders in _restricted/_public or _internal/_domains are getting lost. So only rename Site Module Folders manually if you know what you are doing. The Administrator Module has some functionalities to find lost data.

## How to install Site Modules?

### Method 1: Choose Module out of Store
- Login to the Administrator Site Module
- Navigate to "Store"
- Download Desired Module and Install it through our webinterface

### Method 2: Upload in Administrator Module
- Open the Administrator Module of your bugfishCMS Instance with your web browser
- Login as Administrator or Privilegued user to control Modules / Extensions
- Go to the Store area and chooose "Upload Manually" at the topbar.
- Choose your obtained modules .zip file and upload it, by selecting the file in the file browser which appears by clicking on "choose file".
- The Site module will now be installed as a template.
- Navigate to the Site Modules Section
- Install the new uploaded Site Module Template with a desired Name. It will be installed and activated. It is recommended to open the site module a single time to initialize the site modules required data and variables in the database.

### Method 3: Upload Manually
- Login to your webserver with FTP/SFTP
- Unpack the required Site Modules folder.
- Move the folder which has been extracted, containing the files version.php (...) to the _site directory of the bugfishCMS Installation. Be sure that no special signs are used in the site folder name. The one and only special char allowed in a site modules folder name is _, but only as the first letter.
- You will now be able to use the site module by navigating to is using the administrator module, or by using ./developer.php script to choose the new site Module. If you are using ./developer.php, be sure that this script is activated in cfg_ruleset.php, otherwhise you will receveive an error message with more details.

## How to set up Standalone Module Pages?
Use cfg_ruleset.php in the websites Root Folders to get access to deep CMS Functionalitites.

## Important Information
Core Updates wont touch Files in this folder as they may be important for running Site Modules. If a Site modules name does change, the related folder / file names related in this folder may needs to be changed to, to not loose data. (Site Module Folder Names are the relation to Folder Name in this Directory.)

Happy Siteing! xDD  
Bugfish <3