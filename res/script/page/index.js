jQuery(function ($) {
	$('#projectList > h3 .status').each(function () {
		var e = $(this);
		
		$.get('ajax/getStatus.php', {'project': $(this).parent().find('.name').text()}, function (data) {
			var html;
			if (data.status == 'norepo') {
				e.html('<span class="disabled">no repo</span>');
			} else if (data.status == 'commit') {
				html = '<a class="currentCommit" title="'+data.currentCommit.sha1+'">'+data.currentCommit.sha1.substr(0,7)+'</a> '+data.currentCommit.author+': '+data.currentCommit.summary;
				e.html(html);
			}
		}, 'json');
	});
	$('#projectList .project').each(function () {
		var e = $(this);
		var project = e.prev().find('.name').text();
	
		e.attr('id', 'finder_'+project);
		e.html('<li class="ui-finder-folder"><a href="ajax/paneDeployments.php?project='+project+'">Deployments</a></li>');
		
		e.finder({
			onItemSelect : function(listItem,eventTarget,finderObject){
				CodeStewart.panelStarter = null;
			},
			onItemOpen : function(listItem,newColumn,finderObject){
				if ("function" == typeof CodeStewart.panelStarter) CodeStewart.panelStarter();
			}
		});
	});
	
	$('#projectList')
		.accordion({collapsible: true})
//		.accordion('activate', -1)
	;
});
