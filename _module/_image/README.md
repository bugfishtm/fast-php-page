📁 **Website Images Folder**

Full deployable Website Modules to easily deploy other projects and include controlling functionalities inside the cms. Primary Focus is to deploy 3rd party software like docker and other to vhosts. Will serve for vhosts for integrated hosting functionalities at implementation.

| Name | Description |
| --------- | ----------------------------------- |
| _imgexample   | Exmaple Image Website Module for developers to look up its functionality! |

**How to Install Image Modules**

**Method 1: Choose Module from Store**
1. Login to the Administrator Site Module.
2. Navigate to "Store"
3. Download the desired image module through the web interface.
4. Navigate to the "Image Module" Area of the Administrator Module.
5. Install the uploaded image template with a desired name.
6. Follow required steps of the image module to deploy website by navigating to the website images subfolder or apache2 vhost created for this image template.

**Method 2: Upload in Administrator Module**
1. Open the Administrator Module in your web browser.
2. Login as Administrator or Privileged user.
3. Go to the "Image Module" area and select "Upload Manually."
4. Upload the image's .zip file.
5. Install the uploaded image template with a desired name.
6. Follow required steps of the image module to deploy website by navigating to the website images subfolder or apache2 vhost created for this image template.

**Method 3: Upload Manually**
1. Login to your webserver with FTP/SFTP.
2. Unpack the required Site Modules folder.
3. Move the extracted folder to the _image directory of the BugfishCMS installation.
   - Use only alphanumeric characters and underscores (_), but _ only at the start.
4. Navigate to your uploaded folder with your web browser and follow the website images instruction or create necessary files depending on the deployed website image an its instructions.

**Notice**  
Inactive Site Images are stored in /_internal/_image-dn!  
Site Images Templates are stored in /_internal/_image-tpl!  

**Important Rules**
- Do not start a image module name with a number.
- Do not start a image module name with _ (reserved for core modules).
- Only use alphanumeric characters.
- Module names and folder names should not exceed 10 characters.

Happy coding and have a great one!  
🐟 Bugfish <3