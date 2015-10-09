<?
$this->css = '<link rel="stylesheet" href="/themes/airyo/css/custom.css" />';
?>

<? $this->load->view('airyo/common/header')?>

<div class="container">

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
						Добавить изображение
					</a>
				</li>
				<li>
					<a href="#">
						<span class="glyphicon glyphicon-edit" style="color: #777"></span>
						Редактирование слайдера
					</a>
				</li>
			</ul>
		</div>
	</div>
	
	<div class="row slider-wrapper">
		<div class="col-md-4">
			<div class="one-slide">
				<h4>Первый слайд</h4>
				<img src="/themes/airyo/img/a5.jpg" alt="" class="img-responsive img-slide">
				<form action="#">
					<div class="input-group">
						<input type="text" name="name" id="name" class="form-control one-slide-input" placeholder="Название">
						<textarea name="description" id="description" cols="10" rows="3" class="form-control one-slide-input" placeholder="Описание"></textarea>
						<input type="text" name="link" id="link" class="form-control one-slide-input" placeholder="Ссылка">
						
						<label for="del" id="del-label"class="form-control one-slide-input one-slide-label"><input type="checkbox" name="del" id="del"> Удалить</label>
					</div>
				</form>
			</div>
		</div>
		<div class="col-md-4">
			<div class="one-slide">
				<h4>Второй слайд</h4>
				<img src="/themes/airyo/img/a7.jpg" alt="" class="img-responsive img-slide">
				<form action="#">
					<div class="input-group">
						<input type="text" name="name" id="name1" class="form-control one-slide-input" placeholder="Название">
						<textarea name="description" id="description" cols="10" rows="3" class="form-control one-slide-input" placeholder="Описание"></textarea>
						<input type="text" name="link" id="link1" class="form-control one-slide-input" placeholder="Ссылка">
						
						<label for="del1" id="del-label1"class="form-control one-slide-input one-slide-label"><input type="checkbox" name="del" id="del1"> Удалить</label>
					</div>
				</form>
			</div>
		</div>
		<div class="col-md-4">
			<div class="one-slide">
				<h4>Третий слайд</h4>
				<img src="/themes/airyo/img/a19.jpg" alt="" class="img-responsive img-slide">
				<form action="#">
					<div class="input-group">
						<input type="text" name="name" id="name2" class="form-control one-slide-input" placeholder="Название">
						<textarea name="description" id="description2" cols="10" rows="3" class="form-control one-slide-input" placeholder="Описание"></textarea>
						<input type="text" name="link" id="link2" class="form-control one-slide-input" placeholder="Ссылка">
						
						<label for="del2" id="del-label2"class="form-control one-slide-input one-slide-label"><input type="checkbox" name="del" id="del2"> Удалить</label>
					</div>
				</form>
			</div>
		</div>
		<div class="col-md-4">
			<div class="one-slide">
				<h4>Четвертый слайд</h4>
				<img src="/themes/airyo/img/a3.jpg" alt="" class="img-responsive img-slide">
				<form action="#">
					<div class="input-group">
						<input type="text" name="name" id="name" class="form-control one-slide-input" placeholder="Название">
						<textarea name="description" id="description" cols="10" rows="3" class="form-control one-slide-input" placeholder="Описание"></textarea>
						<input type="text" name="link" id="link" class="form-control one-slide-input" placeholder="Ссылка">
						
						<label for="del" id="del-label"class="form-control one-slide-input one-slide-label"><input type="checkbox" name="del" id="del"> Удалить</label>
					</div>
				</form>
			</div>
		</div>
		<div class="col-md-4">
			<div class="one-slide">
				<h4>Пятый слайд</h4>
				<img src="/themes/airyo/img/a13.jpg" alt="" class="img-responsive img-slide">
				<form action="#">
					<div class="input-group">
						<input type="text" name="name" id="name1" class="form-control one-slide-input" placeholder="Название">
						<textarea name="description" id="description" cols="10" rows="3" class="form-control one-slide-input" placeholder="Описание"></textarea>
						<input type="text" name="link" id="link1" class="form-control one-slide-input" placeholder="Ссылка">
						
						<label for="del1" id="del-label1"class="form-control one-slide-input one-slide-label"><input type="checkbox" name="del" id="del1"> Удалить</label>
					</div>
				</form>
			</div>
		</div>
		<div class="col-md-4">
			<div class="one-slide">
				<h4>Шестой слайд</h4>
				<img src="/themes/airyo/img/a18.jpg" alt="" class="img-responsive img-slide">
				<form action="#">
					<div class="input-group">
						<input type="text" name="name" id="name2" class="form-control one-slide-input" placeholder="Название">
						<textarea name="description" id="description2" cols="10" rows="3" class="form-control one-slide-input" placeholder="Описание"></textarea>
						<input type="text" name="link" id="link2" class="form-control one-slide-input" placeholder="Ссылка">
						
						<label for="del2" id="del-label2"class="form-control one-slide-input one-slide-label"><input type="checkbox" name="del" id="del2"> Удалить</label>
					</div>
				</form>
			</div>
		</div>
	</div>

	<div>
		<button type="submit" class="btn btn-success">
			<span>Сохранить и удалить отмеченные</span>
		</button>
	</div>

</div>

<? $this->load->view('airyo/common/footer')?>
