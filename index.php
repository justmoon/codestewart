<?php
require_once('lib/common.inc.php');
require_once('lib/project.class.php');

cs_show_header('Code Stewart',
	'<script type="text/javascript" src="'.cs_res_url('script/CodeStewart.js').'"></script>'."\r\n".
	'<script type="text/javascript" src="'.cs_res_url('script/page/index.js').'"></script>'."\r\n");
?>
<div id="projectList">
<?php foreach(Project::getAll() as $project): ?>
	<h3><a href="#"><?=$project->getTitle();?></a></h3>
	<div></div>
<?php endforeach; ?>
</ul>
<?php cs_show_footer(); ?>
