<?php
require_once('../lib/common.inc.php');
require_once('lib/project.class.php');

$name = $_REQUEST['project'];
$project = new Project($name);
?>
<ul>
<?php foreach ($project->getDeployments() as $deployment): ?>
	$deployment->getStatus();
<?php endforeach; ?>
<li class="ui-finder-file"><a href="ajax/paneDeploymentCreate.php?project=<?=$name;?>&x=x.jpg" title="title is on link, not image">Create Deployment</a></li>
</ul>
