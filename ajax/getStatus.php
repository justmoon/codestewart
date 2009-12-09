<?php
require_once('../lib/common.inc.php');
require_once('lib/project.class.php');

$name = $_REQUEST['project'];
$project = new Project($name);



$data = array();

if (!$project->hasRepo()) {
	$data['status'] = 'norepo';
} else {
	$repo = $project->getRepo();
	$data['status'] = 'commit';
	$data['currentCommit'] = sha1_hex($repo->getTip());
}

echo json_encode($data);

