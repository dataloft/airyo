$(document).ready( function() {
	var checkCount = 0;

	// Check All
	$('.checkAllBtn').click(function () {
		checkCount = $('.check').length;

		$('input[name*=\'selected\']').prop("checked", true);
		$('.uncheckAll').removeClass("hidden");
		$('.checkAll').addClass("hidden");
	});
	// Uncheck All
	$('.uncheckAllBtn').click(function () {
		checkCount = 0;

		$('input[name*=\'selected\']').prop('checked', false);
		$('.uncheckAll').addClass("hidden");
		$('.checkAll').removeClass("hidden");
	});

	$('.check').click( function() {
		if(this.checked){
			checkCount++;
		} else {
			checkCount--;
		}
		if (checkCount == 0){
			$('.uncheckAll').addClass("hidden");
			$('.checkAll').removeClass("hidden");
		} else {
			$('.uncheckAll').removeClass("hidden");
			$('.checkAll').addClass("hidden");
		}
	})

});

$(document).delegate('*[data-toggle="lightbox"]', 'click', function(event) {
	event.preventDefault();
	$(this).ekkoLightbox();
});

$(function () {
	var selectImage = 0;
	var uploadImage = 0;

	$('#fileupload').fileupload({
		dataType: 'json',
		formData: {album: $('#album_label').val()},
		done: function (e, data) {
			updateMessageBlock(data.result.message);
			if (selectImage === uploadImage) {
				location.reload();
			}
		},
		progressall: function (e, data) {
			var progress = parseInt(data.loaded / data.total * 100, 10);
			$('#progress .progress-bar').css(
				'width',
				progress + '%'
			);
		},
		change: function (e, data) {
			var idx = 0;
			$.each(data.files, function (index, file) {
				idx++;
			});
			selectImage = idx;
		},
		beforeSend : function(xhr, opts){
			uploadImage++;

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

	/** Удаление альбома */
	var albumRemoveLink = $('.link-album-remove');
	albumRemoveLink.click(function (ev) {
		ev.preventDefault();

		var iAlbumId = $(this).attr('data-album');
		if(iAlbumId > 0) {
			if(confirm('Вы уверены, что хотите удалить альбом?')) {
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