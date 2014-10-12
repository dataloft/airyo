$(document).delegate('*[data-toggle="lightbox"]', 'click', function(event) {
	event.preventDefault();
	$(this).ekkoLightbox();
});

$(function () {
	$('#fileupload').fileupload({
		dataType: 'json',
		formData: {album: $('#album_label').val()},
		done: function (e, data) {
			$("#links").prepend('' +
			'<div class="col-lg-3 col-md-4 col-xs-6 thumb">' +
				'<a class="thumbnail next" href="/gallery/' + $('#album_label').val() + '/' + data.result.label + '" data-toggle="lightbox" data-parent data-gallery="multiimages" data-title="' + data.result.title + '">' +
					'<img class="img-responsive image-gallery" src="/gallery/' + $('#album_label').val() + '/' + data.result.label + '" alt="" />' +
				'</a>' +
			'</div>');

			$('#progress').addClass('hidden');
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
	});
});

/*$(function () {
	*//*
	 *//*
	'use strict';
	// Change this to the location of your server-side upload handler:
	var url = '/admin/gallery/uploadimages';
	$('#fileupload').fileupload({
		url: url,
		dataType: 'json',
		dropZone: $('#dropzone'),
		done: function (e, data) {
			*//*  $.each(data.result.files, function (index, file) {
			 $('<p/>').text(file.name).appendTo('#files');
			 });*//*
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
});*/

/*
$(document).bind('dragover', function (e) {
	var dropZone = $('.dropzone'),
		foundDropzone,
		timeout = window.dropZoneTimeout;
	dropZone.addClass('in');
	if (!timeout) {

	} else {
		clearTimeout(timeout);
	}
	var found = false,
		node = e.target;

	do {
		if ($(node).hasClass('dropzone')) {
			found = true;
			foundDropzone = $(node);
			break;
		}
		node = node.parentNode;

	} while (node != null);

	dropZone.removeClass('in hover');

	if (found) {
		foundDropzone.addClass('hover');
	}

	window.dropZoneTimeout = setTimeout(function () {
		window.dropZoneTimeout = null;
		dropZone.removeClass('in hover');
	}, 1000);
});*/
