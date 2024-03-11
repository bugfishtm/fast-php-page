# Restricted Folder

The Restricted Folder is designated for storing files associated with site modules, with access restricted to authorized methods or PHP scripts. It is highly recommended to enforce access restrictions using mechanisms like htaccess.

**Important Notes:**
- Direct access to files within this directory should be strictly prohibited.
- Hardlinking to files should be made impossible.
- Files are included in Backup Functionality.
- Files may be relocated if the site module is moved within the admin panel.

**Usage Guide**:  
Utilize the following path for your site module, if required:  
`./_restricted/SITE_MOD_NAME/*`

It is imperative to control access to this folder strictly, allowing access only to authorized scripts or methods to uphold the security of your website modules.

This folder remains untouched during framework/core updates. However, if a site module is employed, the internal folders may undergo renaming to align with changes in the site modules.