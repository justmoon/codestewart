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
	$latestCommit = $repo->getObject($repo->getTip());

	$data['status'] = 'commit';
	$data['currentCommit'] = array(
		'sha1' => sha1_hex($repo->getTip()),
		'author' => $latestCommit->author->name,
		'summary' => $latestCommit->summary
	);
}

echo json_encode($data);

