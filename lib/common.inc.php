<?php
define('CODESTEWART_COMMONS', true);

// Load configuration
require_once('config.default.php');
@include_once('config.inc.php');

// Add base directory to the include path
$include_path = realpath(dirname(__FILE__).'/../') . '/';
set_include_path($include_path . PATH_SEPARATOR . $include_path.'lib/' . PATH_SEPARATOR . get_include_path());

// Include basic functions
require_once('lib/functions.inc.php');

// Check code directory
if (!is_dir($qconfig['dir_code'])) trigger_error('Couldn\'t find code store folder: '.$qconfig['dir_code'], E_USER_ERROR);
if (!is_writable($qconfig['dir_code'])) trigger_error('Wrong permissions! Code store folder must be writable: '.$qconfig['dir_code'], E_USER_ERROR);

/**
 * Load framework components as needed.
 */
function __autoload($class)
{
	global $qconfig;
	
	switch (strtolower($class)) {
	}
}
?>
