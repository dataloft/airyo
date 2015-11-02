<?
$this->css = '
	<link rel="stylesheet" href="/airyo/theme/js/FileUpload/css/jquery.fileupload.css" />
	<link rel="stylesheet" href="/airyo/theme/js/FileUpload/css/jquery.fileupload-ui.css" />
	<link rel="stylesheet" href="/airyo/theme/js/FileUpload/css/style.css" />
	<link rel="stylesheet" href="/airyo/theme/js/Gallery/css/ekko-lightbox.css" />
	<link rel="stylesheet" href="/airyo/theme/css/gallery.css" />
	';
$this->css .= "
	<style type=\"text/css\">
	.slider-wrapper {
		margin-top: 20px;
	}

	.glyphicon-move {
		color: #777; 
		font-size:18px; 
		padding: 8px 12px; 
		width: 100%;
	}

	.glyphicon-move:hover {
		cursor: move;
	}

	.one-slide {
		border: 1px solid #ccc;
		margin-bottom: 35px;
	}

	.input-group {
		width: 100%;
	}

	.one-slide-input {
		border: none;
		padding-top: 26px;
		padding-bottom: 20px;
	}

	.one-slide-textarea {
		border: none;
		resize: none;
	}

	.one-slide-label {
		border: none;
		border-radius: 0;
		box-shadow: 0px 1px 0px rgba(0, 0, 0, 0.075) inset;
		padding-top: 16px;
		padding-bottom: 30px;
		font-weight: normal;
		color: #999999;
		width: 50% !important;
	}

	.one-slide a {
		display: block;
		overflow: hidden;
	}

	.slider-wrapper .col-md-4 {
		padding-left: 0;
		padding-right: 0;
	}

	.slider-wrapper .col-md-4 .one-slide {
		margin-left: 15px;
		margin-right: 15px;
	}

	@media only screen and (min-width: 1201px) {

		.one-slide a {
			height: 214px;
		}

	}

	@media only screen and (min-width: 992px) and (max-width: 1200px) {

		.one-slide a {
			height: 174px;
		}
	}
	</style>
	";

$this->js = '
	<script src="/airyo/theme/js/jquery-1.7.2.min.js"></script>
	<script src="/airyo/theme/js/jquery-ui-1.8.16.custom.min.js"></script>
	<script src="/airyo/theme/js/jquery.ui.touch-punch.js"></script>
	<script src="/airyo/theme/js/FileUpload/js/vendor/jquery.ui.widget.js"></script>
	<script src="/airyo/theme/js/FileUpload/js/jquery.iframe-transport.js"></script>
	<script src="/airyo/theme/js/FileUpload/js/jquery.fileupload.js"></script>
	';
	
$this->js .= "
	
<script>
	$(document).ready(function(){
		$( '.sortable' ).sortable({
			handle: '.glyphicon-move',
			cancel:'.btn',
			update: function (event, ui) {
				var data = $( '.sortable' ).sortable('serialize');
				 $.ajax({
            		data: data,
            		type: 'POST',
            		url: '/airyo/sliders/sort'
        		});
			}
		});
		$( '#sortable' ).disableSelection();
	});
	
	$(function () {
	var selectImage = 0;
	var uploadImage = 0;
	$('#fileupload').fileupload({
		dataType: 'json',
		formData: {slider_id: $('#slider_id').val()},
		done: function (e, data) {
			uploadImage++;
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
			$.each(opts.originalFiles, function( key, value ) {
				var ext = value.name.split('.').pop().toLowerCase();

				if($.inArray(ext, ['gif','png','jpg','jpeg']) == -1) {
					var oResponse = {
						type: 'danger',
						text: 'Доступные форматы для загрузки: gif, png, jpeg'
					};
					updateMessageBlock(oResponse);
					xhr.abort();
					return false;
				}
			});
			$('#progress').removeClass('hidden');
		}
	});
});
</script>
	";
?>

<? $this->load->view('common/header')?>

<div class="container">

	<? $this->load->view('common/notice')?>

	<h1 class="page-header">Слайдеры</h1>

	<ol class="breadcrumb">
		<li><a href="/airyo/sliders">Слайдеры</a></li>
		<li>Первый слайдер</li>
	</ol>
	<div class="row">
		<div class="col-md-12">
			<ul class="nav nav-pills pull-right">
				<li>
					<a href='#' id="upload_mage" class="pull-right"><span class="glyphicon glyphicon-plus" style="color: #777"></span> Добавить слайды</a>
					<input id="fileupload" class="file-upload-link" type="file" name="files[]" data-url="/airyo/sliders/uploadimages" multiple>
					<input type="hidden" name="slider_id" id="slider_id" value="<?=$slider['id']; ?>" />
				</li>
			</ul>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<br>
			<br>
			<!-- The global progress bar -->
			<div id="progress" class="hidden progress">
				<div class="progress-bar progress-bar-success"></div>
			</div>
		</div>
	</div>

	<? if (!empty($slide)) { ?>
	<div class="row slider-wrapper">
		<form action="" method="post" class="sortable">
			<? foreach ($slide as $row) { ?>
			<div class="col-md-4" id="item_<?= $row['id'] ?>">
				<div class="one-slide">
					<span class="glyphicon glyphicon-move"></span>
					<a href="/<?=$home_folder; ?>/<?=$row['img_title']; ?>" target="_blank">
						<img src="/<?=$home_folder; ?>/<?=$row['img_title']; ?>" alt="" class="img-responsive img-slide">
					</a>
					<div class="input-group">
						<input type="text" name="slides[<?= $row['id'] ?>][title]" class="form-control one-slide-input" placeholder="Название" value="<?=$row['title']?>">
						<textarea name="slides[<?= $row['id'] ?>][description]" cols="10" rows="3" class="form-control one-slide-textarea" placeholder="Описание"><?=$row['description']?></textarea>
						<input type="text" name="slides[<?= $row['id'] ?>][link]" class="form-control one-slide-input" placeholder="Ссылка" value="<?=$row['link']?>">
						<label for="del<?= $row['id'] ?>" class="form-control one-slide-input one-slide-label">
							<input type="checkbox" name="delete[<?= $row['id'] ?>]" id="del<?= $row['id'] ?>"> Удалить
						</label>
						<label for="show<?= $row['id'] ?>" class="form-control one-slide-input one-slide-label">
							<input type="hidden" name="enabled[<?= $row['id'] ?>]" value="<?= $row['enabled'] ?>">
							<input type="checkbox" name="enabled_new[<?= $row['id'] ?>]" id="show<?= $row['id'] ?>" value="1"<?= $row['enabled'] ? ' checked="checked"' : '' ?>> Показать
						</label>
					</div>
				</div>
			</div>
			<? } ?>
			<div class="col-md-12">
				<button type="submit" name="submit" value="submit" class="btn btn-success">Сохранить</button>
			</div>
		</form>
	</div>
	<? } ?>

</div>

<? $this->load->view('common/footer')?>
