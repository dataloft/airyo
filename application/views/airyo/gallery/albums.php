<?

$this->css .= '
	<link href="/themes/airyo/css/datepicker/bootstrap-datepicker.css" rel="stylesheet" type="text/css" />
	';

$this->js = '
	<script src="/themes/airyo/js/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
	<script src="/themes/airyo/js/datepicker/locales/bootstrap-datepicker.ru.js" type="text/javascript"></script>
	';
	
$this->js .= "
	<script type='text/javascript'>
	    
    $(function() {
        
        $('#create_date').datepicker({
        	format: 'dd.mm.yyyy',
        	language: 'ru'
        });
           
    });
	    
	</script>
	";
	
$this->load->view('airyo/common/header') ?>

<div class="container">
	<h1 class="page-header">Фотоальбомы</h1>
	<div class="row" id="links">
		<div class="col-md-12">
		<?php if ($message) : ?>
			<div class="alert alert-<?=$message['type']?>">
				<a class="close" data-dismiss="alert" href="#">&times;</a>
				<?php if ($message['type']=='success') : ?>
					<span class="glyphicon glyphicon-ok"></span>
				<?php endif; ?>
				<?=$message['text']?>
			</div>
		<? endif; ?>
		</div>
	</div>

		<div class="row">
			<div class="col-md-12" style="margin: 0 0 20px">
				<ul class="nav nav-pills pull-right">
					<li>
						<a href="" class="pull-right" data-toggle="modal" data-target="#createAlbumModal"><span class="glyphicon glyphicon-plus" style="color: #777"></span> Создать альбом</a>
					</li>
				</ul>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12">
				<?php if(!empty($albums)) : ?>
					<ul class="list-group">
						<?php foreach($albums as $album) : ?>
							<li class="list-group-item"><a href="/airyo/gallery/<?=$album->label; ?>"><?=$album->title; ?></a> &nbsp;&nbsp;<small class="text-muted"><?=$album->create_date?></small></li>
						<?php endforeach; ?>
					</ul>
					<div class="text-center">
						<?=@$pagination->create_links(); ?>
					</div>
				<?php else : ?>
					<div class="clearfix"></div>
					<div id="album-empty"><p>Альбомов нет</p></div>
				<?php endif ?>
			</div>
		</div>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="createAlbumModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<form role="form" action="/airyo/gallery/createalbum" method="post" style="margin-top: 20px">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<h4 class="modal-title" id="myModalLabel">Создать альбом</h4>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label for="inputTitle">Название</label>
						<input type="text" class="form-control" required="required" name="album_title" id="inputTitle" autocomplete="off" placeholder="Название" />
					</div>
					<div class="form-group">
						<label for="inputDescription">Описание</label>
						<textarea class="form-control" name="album_description" id="inputDescription" cols="30" rows="6"></textarea>
					</div>
					<div class="form-group">
						<label for="inputDescription">Дата публикации (дд.мм.гггг)</label>
						<input type="text" name="create_date" class="form-control" value="<?= date('d.m.Y')?>" maxlength="10" id="create_date" style="width: 20em"/>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary">Создать альбом</button>
				</div>
			</div>
		</form>
	</div>
</div>

<?$this->load->view('airyo/common/footer')?>