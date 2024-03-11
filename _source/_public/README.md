# Public Folder

The Public Folder serves as a designated directory for storing files associated with site modules. Access to this folder is open and unrestricted, allowing for various necessary operations.

**Important Notes:**
- Direct access to files within this directory is permitted.
- Hardlinking to files is feasible.
- Files are included in Backup Functionality.
- Files may be relocated if the site module is moved within the admin panel.

**Usage Guide**:  
Utilize the following path for your site module, if required:  
`./_public/SITE_MOD_NAME/*`

Please ensure that only non-critical files are stored in this folder, as its accessibility allows for hardlinking, and anyone can access files since they are not protected in any way.

This folder remains untouched during framework/core updates. However, if a site module is employed, the internal folders may undergo renaming to align with changes in the site modules.