<?php
	if(!is_array($object)) { @http_response_code(404); echo "No hardlinking!"; exit(); }
	hive__simple_start($object, "Simple Theme", "");
	echo "Welcome to the Simple Theme Webpage of this CMS!<br />Testing Area: ";
	echo "<a href='"._HIVE_URL_REL_."/testing.php'>here</a>!";
	hive__simple_end($object, 'This installer is created by <a href="https://www.bugfish.eu" rel="noopener" target="_blank" style="color: yellow !important;">Bugfish</a> 
									(Jan-Maurice Dahlmanns)<br />For Open Source Software and Projects!');