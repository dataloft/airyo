<? $this->load->view('airyo/common/header')?>

<div class="container">
	<h1 class="page-header">Слайдеры</h1>
	<div class="row">
		<div class="col-md-12">
			<ul class="nav nav-pills pull-right">
				<li>
					<a href="#" class="pull-right" data-toggle-"modal" data-target="#createSliderModal">
						<span class="glyphicon glyphicon-plus" style="color: #777"></span>
						Создать слайдер
					</a>
				</li>
			</ul>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<ul class="list-group">
				<li class="list-group-item">
					<a href="/airyo/sliders/slide">Первый слайдер</a>
					<small class="text-muted">09.10.2015</small>
				</li>
				<li class="list-group-item">
					<a href="/airyo/sliders/slide">Второй слайдер</a>
					<small class="text-muted">09.10.2015</small>
				</li>
			</ul>
		</div>
	</div>
</div>

<? $this->load->view('airyo/common/footer')?>

