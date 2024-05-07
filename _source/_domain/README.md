This folder serves to save robot.txt and sitemap.xml files for different site modes which may run on different domains. You need to symbolic link every folder and file of this cms in the other vhosts of domains.

In every domain, link the sitemap.xml and robotx.txt file to the related file in _domain so per domain multi robots/sitemap files in one cms instance will work.

This is only required if you want to use robots.txt and sitemap.xml files on multi site domains for multiple domains.