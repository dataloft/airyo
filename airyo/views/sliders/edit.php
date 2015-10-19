<?
$this->css = "
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
					<a href="#">
						<span class="glyphicon glyphicon-plus" style="color: #777"></span>
						Добавить слайды
					</a>
				</li>
			</ul>
		</div>
	</div>
	
	
	<? if (!empty($slide)) { ?>
	<div class="row slider-wrapper">
		<form action="" method="post" class="sortable">
			<? foreach ($slide as $row) { ?>
			<div class="col-md-4" id="item_<?= $row['id'] ?>">
				<div class="one-slide">
					<span class="glyphicon glyphicon-move"></span>
					<a href="/public/sliders/a9.jpg" target="_blank">
						<img src="/public/sliders/a9.jpg" alt="" class="img-responsive img-slide">
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
