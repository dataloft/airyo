$(document).ready( function() {
	// Check All
	$('#checkAll').click(function () {
		$('input[name*=\'selected\']').prop("checked", true);
		$('#uncheckAll').removeClass("hidden");
		$(this).addClass("hidden");
	});
	// Uncheck All
	$('#uncheckAll').click(function () {

		$('input[name*=\'selected\']').prop('checked', false);

		$(this).addClass("hidden");
		$('#checkAll').removeClass("hidden");
		return;
	});

    $('#delete-link').click(function (ev) {
        ev.preventDefault();
        if (!confirm('Удалить?')) {
            return false;
        }
        else
        {
            $('#delete').submit();
        }
	});

});

$(function () {
	/*
	 */
	'use strict';
	// Change this to the location of your server-side upload handler:
	var url = '/admin/files/upload';
	$('#fileupload').fileupload({
		url: url,
		dataType: 'json',
		dropZone: $('#dropzone'),
		done: function (e, data) {
			/*  $.each(data.result.files, function (index, file) {
			 $('<p/>').text(file.name).appendTo('#files');
			 });*/
			//window.location.replace(data.result.path);

		},
		progressall: function (e, data) {
			var progress = parseInt(data.loaded / data.total * 100, 10);
			$('#progress .progress-bar').css(
				'width',
				progress + '%'
			);

		},
		start: function () {
			$('#progress').removeClass('hidden');
		}
	}).prop('disabled', !$.support.fileInput)
		.parent().addClass($.support.fileInput ? undefined : 'disabled');
});
$('#fileupload').bind('fileuploadstop', function (e) { window.location.replace(''); });
$(document).bind('drop dragover', function (e) {
	e.stopPropagation();
	e.preventDefault();
});
$('.dropzone').bind('dragleave', function (e) {
	$('.dropzone').removeClass('in hover');
});
$(document).bind('dragover', function (e)
{
	var dropZone = $('.dropzone'),
		foundDropzone,
		timeout = window.dropZoneTimeout;
	dropZone.addClass('in');
	if (!timeout)
	{

	}
	else
	{
		clearTimeout(timeout);
	}
	var found = false,
		node = e.target;

	do{

		if ($(node).hasClass('dropzone'))
		{
			found = true;
			foundDropzone = $(node);
			break;
		}

		node = node.parentNode;

	}while (node != null);

	dropZone.removeClass('in hover');

	if (found)
	{
		foundDropzone.addClass('hover');
	}

	window.dropZoneTimeout = setTimeout(function ()
	{
		window.dropZoneTimeout = null;
		dropZone.removeClass('in hover');
	}, 1000);
});