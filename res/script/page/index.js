jQuery(function ($) {
	$('#projectList').accordion();
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
});
