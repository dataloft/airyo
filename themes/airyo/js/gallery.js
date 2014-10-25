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

$(function () {
	var frm = $('#edit-album');
	frm.submit(function (ev) {
		$.ajax({
			url: "/admin/gallery/ajaxEditAlbum",
			method: 'POST',
			data: $('#edit-album').serialize()
		}).done(function() {
			$( this ).addClass( "done" );
		});
		ev.preventDefault();
	});

	var formEditDescriptionAlbum = $('#edit-description-album');
	formEditDescriptionAlbum.submit(function (ev) {
		$.ajax({
			url: "/admin/gallery/ajaxEditDescriptionAlbum",
			method: 'POST',
			data: $('#edit-description-album').serialize()
		}).done(function() {
			$( this ).addClass( "done" );
		});
		ev.preventDefault();
	});
});