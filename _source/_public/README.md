# Public Folder

The Public Folder is designated for storing files associated with site modules. This directory is openly accessible, allowing for various necessary operations.

## Important Notes

- **Direct Access**: Files within this directory can be accessed directly.
- **Hardlinking**: Hardlinking to files is supported.
- **Backup Inclusion**: Files are included in backup operations.
- **Relocation**: Files may be moved if the corresponding site module is relocated within the admin panel.

## Usage Guide

To use this folder for your site module, follow this path:
```plaintext
./_public/SITE_MOD_NAME/*
```

## Important Information
Core Updates wont touch Files in this folder as they may be important for running Site Modules. If a Site modules name does change, the related folder / file names related in this folder may needs to be changed to, to not loose data. (Site Module Folder Names are the relation to Folder Name in this Directory.)

