<?php
require_once('../lib/common.inc.php');
require_once('lib/project.class.php');

$name = $_REQUEST['project'];
$project = new Project($name);
$deployment = $project->getDeployment((int)$_REQUEST['development']);
?>
<?=$deployment->getName();?>
