# Docker Instance
You can use bugfishCMS in a docker instance of necessary. Be sure to adjust the URL where the platform is running at the installation configuration and in site modules to make them run properly, otherwhise you may experience errors while using reverse proxy services as apache2 or nginx to connect to the docker container.

## How to use our Docker Instance
Docker Files are included to install this software with a docker container.

- Check docker-compose.yml
- Check .env for internal container mysql password (needed for cms installation)
- Windows: Execute the .bat file in the repositories Root Folder.
- Linux: Execute the .sh file in the repositories Root Folder
- The Docker container should now start to initialize
- If the docker container have been initialized go to your domain:658 (port 658) and you can see the deployed docker image featuring the bugfishcms. You can change the exposed port in the docker-compose.yml
- Go to ./installer.php and Install the CMS by providing required data.
- After the Installation you will be redirected to the CMS Login Page
- Login with data provided below in "Initial Login"
- You can now use the CMS and install new modules or extensions out of our official store! You can deploy your own modules to the _site folder, or use the installation manager at the administrator interface! You can develop own modules and remove the optional administrator module. You can even use standalone modules for single site instances. This CMS will be the only thing you need to accomplish every possible PHP Website goal!

Have fun virtualizing!  
Bugfish <3 