<?php
function conf_detect_domain()
{
	$domain = $_SERVER['SERVER_NAME'];
	
	if ($domain == 'localhost') {
		$domain = '127.0.0.1';
	}
	
	return $domain;
}

function conf_detect_local_part()
{
	global $qconfig;
	
	$lp = '/'.substr($qconfig['directory'], strlen($_SERVER['DOCUMENT_ROOT']));
	
	return ($lp == '//') ? '/' : $lp;
}
?>
