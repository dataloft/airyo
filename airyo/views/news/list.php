<? $this->load->view('common/header')?>

<div class="container">
	
    <? $this->load->view('common/notice')?>
    
	<h1 class="page-header">Новости</h1>

	<div class="row">
		<div class="col-md-12" style="margin-top: 20px">
			<p class="pull-right">
				<span class="glyphicon glyphicon-plus" style="color: #777"></span>
				<a href="/airyo/news/edit<? if (!empty($type)) echo '?type='.$type; ?>" class="add">Создать</a>
			</p>
		</div>
	</div>
	
	<? if (!empty($news)) { ?>
		<div class="row">
			<div class="col-md-12">
				<ul class="list-group">
					<? foreach ($news as $row) { ?>
	    				<li class="list-group-item">
	    					<a href="/airyo/news/edit/<?=$row['id']?>"><?=$row['title']?></a> &nbsp;&nbsp;<small class="text-muted"><?=$row['date']?></small>
	    				</li>
    				<? } ?>
				</ul>
			</div>
		</div>
	<? } ?>
	
	<? $this->load->view('common/pagination')?>
	
</div>

<? $this->load->view('common/footer')?>