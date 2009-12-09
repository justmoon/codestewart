<?php
require_once('config.helper.php');

$qconfig = array();

// Directory the site is installed in
$qconfig['directory'] = realpath(dirname(__FILE__).'/../').'/';

// This is the basic root url of the site
$qconfig['domain'] = conf_detect_domain(); // domain/ip of the server
$qconfig['local_part'] = conf_detect_local_part(); // local part of the url
$qconfig['base_url'] = 'http://'.$qconfig['domain'].$qconfig['local_part'];

// Project specific directories
$qconfig['dir_code'] = $qconfig['directory'] . 'code/';
?>
