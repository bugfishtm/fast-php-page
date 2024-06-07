# Restricted Folder

The Restricted Folder is designated for storing files associated with site modules, with access restricted to authorized methods or PHP scripts. It is crucial to enforce access restrictions using mechanisms such as `.htaccess`.

## Important Notes

- **Restricted Access**: Direct access to files within this directory must be strictly prohibited.
- **No Hardlinking**: Hardlinking to files should be prevented.
- **Relocation**: Files may be moved if the corresponding site module is relocated within the admin panel.

## Usage Guide

To use this folder for your site module, follow this path:
```plaintext
./_restricted/SITE_MOD_NAME/*
```

## Important Information
Core Updates wont touch Files in this folder as they may be important for running Site Modules. If a Site modules name does change, the related folder / file names related in this folder may needs to be changed to, to not loose data. (Site Module Folder Names are the relation to Folder Name in this Directory.)
