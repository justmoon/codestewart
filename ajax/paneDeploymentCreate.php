<?php
require_once('../lib/common.inc.php');
require_once('lib/project.class.php');

$name = $_REQUEST['project'];
$project = new Project($name);
?>
<div id="field_<?=$name;?>_new_deployment_type">
	<input type="radio" id="<?=$name;?>_new_deployment_type_ssh" name="<?=$name;?>_new_deployment_type" value="ssh" />
	<label for="<?=$name;?>_new_deployment_type_ssh">SSH</label>
</div>
<div id="field_<?=$name;?>_new_deployment_wiz"></div>
<script type="text/javascript">
//<![CDATA[
	var sshWiz = '\
		<div id="field_<?=$name;?>_new_deployment_ssh_host">\
			<label for="<?=$name;?>_new_deployment_ssh_host">SSH Host/IP:</label>\
			<input type="text" id="<?=$name;?>_new_deployment_ssh_host" name="<?=$name;?>_new_deployment_ssh_host" value=""/>\
		</div>\
		<div id="field_<?=$name;?>_new_deployment_ssh_connect">\
			<button id="<?=$name;?>_new_deployment_ssh_connect">Connect</button>\
		</div>\
	';
	CodeStewart.panelStarter = function () {
		$('#<?=$name;?>_new_deployment_type_ssh').change(function () {
			if (!$(this).is(':checked')) return;
		
			var wiz = $('#field_<?=$name;?>_new_deployment_wiz')
				.empty()
				.append(sshWiz);
			;
			
			function updateSshConnectionStatus()
			{
				var sshHost = 
				$.get('ajax/sshTestConnection.php')
			};
			
			wiz.find('#<?=$name;?>_new_deployment_ssh_connect').click(updateSshConnectionStatus);
		});
	};
//]]>
</script>
