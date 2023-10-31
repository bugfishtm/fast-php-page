<?php
	if(!is_array($object)) { @http_response_code(404); echo "No hardlinking!"; exit(); }
	# Cron Files need to start with cron.*
?>