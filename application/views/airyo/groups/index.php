<?$this->load->view('airyo/common/header')?>

<div class="container">
	<?php if (is_array($message) and array_key_exists('type', $message)) : ?>
		<div class="alert alert-<?=$message['type']?>"> <a class="close" data-dismiss="alert" href="#">&times;</a>
			<?php if($message['type']=='success') : ?>
				<span class="glyphicon glyphicon-ok"></span>
			<?php endif; ?>
			<?=$message['text']?></div>
	<?php endif; ?>
	<h1 class="page-header">Группы</h1>
	<div class="row">
		<div class="col-md-12" style="margin-top: 20px">
			<p class="pull-right"><span class="glyphicon glyphicon-plus" style="color: #777"></span> <a href="/airyo/groups/add" class="add">Создать</a></p>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<ul class="list-group">
				<?php if (!empty($groups)) : ?>
					<?php foreach ($groups as $group) : ?>
						<li class="list-group-item">
							<a href="/airyo/groups/edit/<?=$group['id']?>"><?=$group['name']; ?></a>
							<!--small>(<?=$group['description']; ?>)</small-->
						</li>
					<?php endforeach; ?>
				<?php endif; ?>
			</ul>
		</div>
	</div>
</div>

<?$this->load->view('airyo/common/footer')?>