# Docker Instance
You can use bugfishCMS in a docker instance of necessary. Be sure to adjust the URL where the platform is running at the installation configuration and in site modules to make them run properly, otherwhise you may experience errors while using reverse proxy services as apache2 or nginx to connect to the docker container.

**This files are just for testing purposes! It is recommended to use this docker script in an active environment. This docker instance here is just set up for testing purposes.**
## How to use our Docker Instance
Docker Files are included to install this software with a docker container.

- Check docker-compose.yml
- Insert your required release version into the _source folder here besides the readmes file.
- Check .env for internal container mysql password (needed for cms installation)
- Windows: Execute the .bat file in the repositories Root Folder.
- Linux: Execute the .sh file in the repositories Root Folder
- The Docker container should now start to initialize
- If the docker container have been initialized go to your domain:658 (port 658) and you can see the deployed docker image featuring the bugfishcms. You can change the exposed port in the docker-compose.yml
- Open the CMS Page in your webbrowser and follow installation steps.

Have fun virtualizing!  
Bugfish <3 