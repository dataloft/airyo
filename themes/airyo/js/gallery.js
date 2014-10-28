$(document).delegate('*[data-toggle="lightbox"]', 'click', function(event) {
	event.preventDefault();
	$(this).ekkoLightbox();
});

$(function () {
	$('#fileupload').fileupload({
		dataType: 'json',
		formData: {album: $('#album_label').val()},
		done: function (e, data) {
            var sFooter = "<div class='pull-right'><small>Добавлена " + data.result.image.create_date + "<br/>" + data.result.user.first_name + " " + data.result.user.last_name + "</small></div><br/>";

			$("#links").prepend('' +
			'<div class="col-lg-3 col-md-4 col-xs-6 thumb">' +
				'<a class="thumbnail next" href="/gallery/' + $('#album_label').val() + '/' + data.result.image.label + '" data-toggle="lightbox" data-parent data-gallery="multiimages" data-footer="' + sFooter + '" data-title="' + data.result.image.title + '">' +
					'<img class="img-responsive image-gallery" src="/gallery/' + $('#album_label').val() + '/' + data.result.image.label + '" alt="" />' +
				'</a>' +
			'</div>');

            updateMessageBlock(data.result.message);
            $('#progress').addClass('hidden');
            $('#album-empty').hide();
		},
		progressall: function (e, data) {
			var progress = parseInt(data.loaded / data.total * 100, 10);
			$('#progress .progress-bar').css(
				'width',
				progress + '%'
			);
		},
		beforeSend : function(xhr, opts){
			$.each(opts.originalFiles, function( key, value ) {
				var ext = value.name.split('.').pop().toLowerCase();

				if($.inArray(ext, ['gif','png','jpg','jpeg']) == -1) {
					var oResponse = {
						type: 'danger',
						text: 'Доступные форматы для загрузки: gif, png, jpeg'
					}
					updateMessageBlock(oResponse);
					xhr.abort();
					return false;
				}
			});

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
	var frm = $('#form-edit-album');
	frm.submit(function (ev) {
		$.ajax({
			url: "/admin/gallery/ajaxEditAlbum",
			method: 'POST',
			data: $('#form-edit-album').serialize()
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
        $(this).parents('.image-edit-block').fadeOut(1200).empty();

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
                var iCount = $('#table-edit-album td').length;
                if(iCount < 1) {
                    $('#form-edit-album').hide(1200);
                    $('#block-empty-album').show(1200);
                    $('.album-gallery-edit').attr('src', '');
                }
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
                updateMessageBlock(oResponse);
                setTimeout(function() {
                    window.location = "/admin/gallery";
                }, 2000);
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