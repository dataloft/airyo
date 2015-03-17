<?$this->load->view('airyo/common/header')?>

<div class="container">
    <? if (is_array($message) and array_key_exists('type', $message)) {?>
        <div class="alert alert-<?=$message['type']?>"> <a class="close" data-dismiss="alert" href="#">&times;</a> <? if ($message['type']=='success') {?><span class="glyphicon glyphicon-ok"></span><?}?> <?=$message['text']?></div>
    <? } ?>
	<h1 class="page-header"><?= $this->lang->line('module_title_pages')?></h1>
	<div class="row">
		<div class="col-md-12" style="margin: 20px 0 20px">
			<p class="pull-right"><span class="glyphicon glyphicon-plus" style="color: #777"></span> <a href="/airyo/pages/edit<? if (!empty($type)) echo '?type='.$type; ?>" class="add">Создать страницу</a></p>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<ul class="list-group">
                <?
                if (!empty($content))
                    foreach ($content as $row)
                    {
                ?>
        				<li class="list-group-item"><a href="/airyo/pages/edit/<?=$row['id']?>"><?=$row['h1']?></a></li>
		           <?}?>
			</ul>
		</div>
	</div>
</div>

<?$this->load->view('airyo/common/footer')?>