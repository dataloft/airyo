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

	/** Обновление описания альбома */
	var formEditDescriptionAlbum = $('#edit-description-album');
	formEditDescriptionAlbum.submit(function (ev) {
		$.ajax({
			url: "/admin/gallery/ajaxEditDescriptionAlbum",
			method: 'POST',
			data: $('#edit-description-album').serialize()
		}).done(function(response) {
			var oResponse = $.parseJSON(response);
			updateMessageBlock(oResponse);
		});
		ev.preventDefault();
	});

	/** Обновление содержания альбома */
	var frm = $('#edit-album');
	frm.submit(function (ev) {
		$.ajax({
			url: "/admin/gallery/ajaxEditAlbum",
			method: 'POST',
			data: $('#edit-album').serialize()
		}).done(function(response) {
			var oResponse = $.parseJSON(response);
			updateMessageBlock(oResponse);
			$('html, body').animate({ scrollTop: 0 }, 'fast');
		});
		ev.preventDefault();
	});

	/** Удаление изображения */
	var imageLink = $('.link-image-remove');
	imageLink.click(function (ev) {
		ev.preventDefault();
		$(this).parents('.image-edit-block').hide(200);

		var iImageId = $(this).attr('data-image');
		if(iImageId > 0) {
			$.ajax({
				url: "/admin/gallery/ajaxRemoveImage",
				method: 'POST',
				data: {
					iImageId: iImageId
				}
			}).done(function(response) {
				var oResponse = $.parseJSON(response);

				updateMessageBlock(oResponse);
			});
		}
	});

	/** Удаление альбома */
	var albumRemoveLink = $('.link-album-remove');
	albumRemoveLink.click(function (ev) {
		ev.preventDefault();

		var iAlbumId = $(this).attr('data-album');
		if(iAlbumId > 0) {
			$.ajax({
				url: "/admin/gallery/ajaxRemoveAlbum",
				method: 'POST',
				data: {
					iAlbumId: iAlbumId
				}
			}).done(function(response) {
				var oResponse = $.parseJSON(response);
				location.reload();
				updateMessageBlock(oResponse);
			});
		}
	});

	/**
	 * Установка сообщения
	 *
	 * @param oData
	 */
	function updateMessageBlock(oData) {
		var oAlertMessage = $('#alert-message');
		var oIconMessageSucces = $('#icon-message-success');
		var oTextMessage = $('#text-message');

		$(oAlertMessage).show(200);

		oAlertMessage.addClass('alert-' + oData.type);
		oTextMessage.text(oData.text);

		if(oData.type == 'success') {
			oIconMessageSucces.addClass('glyphicon-ok')
		} else {
			oIconMessageSucces.addClass('glyphicon-remove')
		}

		setTimeout(function() {
			$(oAlertMessage).hide(200);

			oAlertMessage.removeClass('alert-' + oData.type);
			if(oData.type == 'success') {
				oIconMessageSucces.removeClass('glyphicon-ok')
			} else {
				oIconMessageSucces.removeClass('glyphicon-remove')
			}
		}, 3500)
	}
});