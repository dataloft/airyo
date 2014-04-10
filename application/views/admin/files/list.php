<div class="container">
	<h1 class="page-header">Файлы</h1>
    <? if ($message) {?>
        <div class="alert alert-<?=$message['msg_type']?>"> <a class="close" data-dismiss="alert" href="#">&times;</a> <? if ($message['msg_type']=='success') {?><span class="glyphicon glyphicon-ok"></span><?}?> <?=$message['text']?></div>
    <? } ?>
	<ol class="breadcrumb">
       <?
            $pathSize = count($path);
            foreach ($path as $value) {
        ?>
            <li><a href="/admin/files/<?=$value['url'];?>"><?=$value['text'];?></a></li>
       <?}?>
	</ol>
	<div class="row">
		<div class="col-md-12" style="margin-top: 20px">
			<p class="pull-right"><span class="glyphicon glyphicon-upload" style="color: #777"></span> <a href="/admin/content/edit" class="add">Загрузить файлы</a></p>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<ul class="list-group">
                <?php foreach ($result as $i => $row): ?>
                    <?php if ($row['type'] == 'up'): ?>
                       <!-- <li class="list-group-item"><a href="<?php /*echo $row['url']; */?>"><?php /*echo $row['label']; */?></a></li>-->
                    <? else: ?>
                    <?php if ($row['type'] == 'dir'): ?>
                        <li class="list-group-item">
                            <span class="glyphicon glyphicon-folder-open" style="color: #777; margin-right: 10px;"></span>
                            <a href="<?php echo $row['url']; ?>"><?php echo $row['label']; ?></a>
                        </li>
                    <?php else: ?>
                        <li class="list-group-item"><span class="glyphicon glyphiconicon-file"></span><span data="label"><?php echo $row['label']; ?></span>
                <?php endif; ?>
                <?php endif; ?>
                <?php endforeach; ?>
			</ul>
		</div>
	</div>
</div>
