jQuery(function ($) {
	$('#projectList > h3 .status').each(function () {
		var e = $(this);
		
		$.get('ajax/getStatus.php', {'project': $(this).parent().find('.name').text()}, function (data) {
			var html;
			if (data.status == 'norepo') {
				e.html('<span class="disabled">no repo</span>');
			} else if (data.status == 'commit') {
				html = 'Current Commit: ';
				html += '<a class="currentCommit">'+data.currentCommit+'</a>';
				e.html(html);
			}
		}, 'json');
	});
	$('#projectList .project').each(function () {
		var e = $(this);
		var project = e.prev().find('.name').text();
	
		e.html('<li class="ui-finder-folder"><a href="ajax/paneDeployments.php?project='+project+'">Deployments</a></li>');
		
		e.finder({
			onRootReady: function(rootList,finderObj){
				console.log('Root ready',arguments)
			},
			onInit : function(finderObj) {
	
				console.log('Finder initialised',arguments)
	
				$('.ui-finder-action-refresh').click(function() {
					$('[name="refresh"]').click();
				});
	
	
				$('.ui-finder-action-open').click(function(){
					$('[name="select"]').click();
				});

				$('.ui-finder-action-current').click(function(){
					$('[name="getCurrent"]').click();
				});

				$('.ui-finder-action-destroy').click(function(){
					$('[name="createFinder"]').click();
				});

			},
			onItemSelect : function(listItem,eventTarget,finderObject){			
				var anchor = $('a',listItem),
					href = anchor.attr('rel');
	
			// Debug is a function specified in Finder script for debugging purposes
			// Remove it if unnecessary
				console.log('onItemSelect - URL: ',href)

			// By returning false, the url specified is not fetched
			// ie. Do not display new column if selected item is not an image
				if(href.indexOf('.jpg') == -1) {return false;}
	
			},
			onFolderSelect : function(listItem,eventTarget,finderObject){
				var anchor = $('a',listItem),
					href = anchor.attr('rel');
		
				console.log('onFolderSelect - URL: ',href)
			},
			onItemOpen : function(listItem,newColumn,finderObject){
				var anchor = $('a',listItem),
					href = anchor.attr('href');
	
				console.log('onItemOpen - Column source: ',newColumn.attr('data-finder-list-source'))

			},
			onFolderOpen : function(listItem,newColumn,finderObject){
				var anchor = $('a',listItem),
					href = anchor.attr('href');
	
				console.log('onFolderOpen - Column source: ',newColumn.attr('data-finder-list-source'))
			}
		});
		return false;
	});
	
	$('#projectList')
		.accordion()
//		.accordion('activate', -1)
	;
});
