<?php
require_once('lib/common.inc.php');
require_once('lib/project.class.php');

cs_show_header('Code Stewart',
	'<link rel="stylesheet" type="text/css" href="'.cs_res_url('jqueryfinder/ui.finder.css').'">'."\r\n".
	'<script type="text/javascript" src="'.cs_res_url('jqueryfinder/ui.finder.js').'"></script>'."\r\n".
	'<script type="text/javascript" src="'.cs_res_url('script/CodeStewart.js').'"></script>'."\r\n".
	'<script type="text/javascript" src="'.cs_res_url('script/page/index.js').'"></script>'."\r\n");
?>
<div id="projectList">
<?php foreach(Project::getAll() as $project): ?>
	<h3><a href="#"><span class="name"><?=$project->getTitle();?></span> &bull; <span class="status"></span></a></h3>
	<ul id="project_<?=$project->getName();?>" class="project"></ul>
<?php endforeach; ?>
</div>
<?php cs_show_footer(); ?>
