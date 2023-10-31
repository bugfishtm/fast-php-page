<?php
	if(!is_array($object)) { @http_response_code(404); echo "No hardlinking!"; exit(); }
	hive__dashboard_header($object, "Dashboard Theme", "<!-- No Meta Extension -->", "dark");
	hive__dashboard_nav($object, "Title", array(hive_get_url_rel(array("create", false, false, false, false)), "Create Account"));
	hive__dashboard_start($object);	
	$pfm = array();
	$pfm[0]["nav_title"] = "Profile";
	$pfm[1]["nav_title"] = "Logout";
	$pfm[0]["nav_loc"] 	= hive_get_url_rel(array("profile", false, false, false, false));
	$pfm[1]["nav_loc"] 	= hive_get_url_rel(array("logout", false, false, false, false));
	hive__dashboard_topbar($object, $pfm,  true, hive_get_url_rel(array("search", false, false, false, false)), "Title", _HIVE_URL_REL_."/_site/"._HIVE_MODE_."/user.png");
	hive__dashboard_content_start($object);
	switch(_HIVE_URL_CUR_[0]) {
		case "general": case false: case "":
				require_once(_HIVE_PATH_."/_site/"._HIVE_MODE_."/general.php");
			break;
		case "charts":
				require_once(_HIVE_PATH_."/_site/"._HIVE_MODE_."/charts.php");
			break;	
		case "forms":
				require_once(_HIVE_PATH_."/_site/"._HIVE_MODE_."/forms.php");
			break;		
		case "tables":
				require_once(_HIVE_PATH_."/_site/"._HIVE_MODE_."/tables.php");
			break;		
		default:
				hive__dashboard_404($object);
	}
	hive__dashboard_content_end($object);
	hive__dashboard_end($object);
	hive__dashboard_footer($object, "Dashboard Template CMS Integrated by <a href='https://www.bugfish.eu' rel='noopener' target='_blank'>Bugfish</a>");
