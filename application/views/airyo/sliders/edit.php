<?
$this->css = '<link rel="stylesheet" href="/themes/airyo/css/custom.css" />';
?>

<? $this->load->view('airyo/common/header')?>

<div class="container">

	<? $this->load->view('airyo/common/notice')?>

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
		<form action="" method="post">
			<? foreach ($slide as $row) { ?>
			<div class="col-md-4">
				<div class="one-slide">
					<a href="/themes/airyo/img/a19.jpg" target="_blank">
						<img src="/themes/airyo/img/a19.jpg" alt="" class="img-responsive img-slide">
					</a>
					<div class="input-group">
						<input type="text" name="name" id="name" class="form-control one-slide-input" 
						placeholder="Название" value="<?=$row['title']?>">
						<textarea name="description" id="description" cols="10" rows="3" class="form-control one-slide-textarea" placeholder="Описание"><?=$row['description']?></textarea>
						<input type="text" name="link" id="link" class="form-control one-slide-input" 
						placeholder="Ссылка" value="<?=$row['link']?>">
						<label for="del" class="form-control one-slide-input one-slide-label"><input type="checkbox" name="del" id="del"> Удалить</label>
						<label class="form-control one-slide-input one-slide-label">
							<input type="hidden" name="enabled[<?= $row['id'] ?>]" value="<?= $row['enabled'] ?>">
							<input type="checkbox" name="enabled_new[<?= $row['id'] ?>]" value="1"<?= $row['enabled'] ? ' checked="checked"' : '' ?>> Показать
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

<? $this->load->view('airyo/common/footer')?>
