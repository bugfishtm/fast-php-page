# bugfishCMS Modules

Modules which can be installed to check functionalities and more!

## How to install?

### Method 1: Upload in Administrator Module
- Open the Administrator Module of your bugfishCMS Instance with your web browser
- Login as Administrator or Privilegued user to control Modules / Extensions
- Go to the Store area and chooose "Upload Manually" at the topbar.
- Choose your obtained modules .zip file and upload it, by selecting the file in the file browser which appears by clicking on "choose file".
- The Site module will now be installed as a template.
- Navigate to the Site Modules Section
- Install the new uploaded Site Module Template with a desired Name. It will be installed and activated. It is recommended to open the site module a single time to initialize the site modules required data and variables in the database.

### Method 2: Upload Manually
- Login to your webserver with FTP/SFTP
- Unpack the required Site Modules folder.
- Move the folder which has been extracted, containing the files version.php (...) to the _site directory of the bugfishCMS Installation. Be sure that no special signs are used in the site folder name. The one and only special char allowed in a site modules folder name is _, but only as the first letter.
- You will now be able to use the site module by navigating to is using the administrator module, or by using ./developer.php script to choose the new site Module. If you are using ./developer.php, be sure that this script is activated in cfg_ruleset.php, otherwhise you will receveive an error message with more details.

## Integrated Modules
If you are a developer trying to look into functionalities, you maybe should take a look at this template modules, you can find them inside this repositories _module  folder:

| Name      | Description                         | 
| --------- | ----------------------------------- |
| _administrator   | Advanced Backend CMS (featuring AdminBSB) system to be copied, modified or used! This Module is automatically integrated into the crm and can optionaly be removed. You can find the Module in the _site folder, where all Site Modules (active ones) are stored.     | 
| _documentation-adminbsb     | Documentation for integrated AdminBSB Template.   |
| _documentation-volt     | Documentation for integrated Volt Template.   | 
| _documentation-framework     | Documentation for integrated Bugish Framework.   |
| _documentation   | Documentation for this CMS integrated as a Site Module.      |
| _example-minimal        | Minimal Site Module Example.               | 
| _example-windmill   | Windmill Dashboard Site Module example.   | 
| _example-volt   | Volt Dashboard Site Module example.     | 
| _skeleton   | Skeleton of site modules for developers to look into to understand folder functionalities and more!     | 
| _lab   | Module used at lab.bugfish.eu to showcase different site modules with a token!     | 
| _storepage   | Module used at store.bugfish.eu to showcase internal store to be deployed on other instances on a dedicated website!     | 

Happy coding!  
Bugfish <3