<? $this->load->view('airyo/common/header')?>

<div class="container">
	
    <? $this->load->view('airyo/common/notice')?>
    
	<h1 class="page-header"><?= $this->lang->line('module_title')?></h1>
	
	<? if (!empty($list)) { ?>
		<div class="row" style="margin-top: 40px">
			<div class="col-md-12">
				<ul class="list-group">
					<? foreach ($list as $row) { ?>
	    				<li class="list-group-item">
	    					<a href="/airyo/<?= $main_menu ?>/edit/<?= $row['id'] ?>"><?=$row['name']?></a> &nbsp;&nbsp;<small class="text-muted"><?=$row['alias']?></small>
	    				</li>
    				<? } ?>
				</ul>
			</div>
		</div>
	<? } ?>
	
	<? $this->load->view('airyo/common/pagination')?>
	
</div>

<? $this->load->view('airyo/common/footer')?>