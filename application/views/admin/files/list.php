<div class="container">
	<h1 class="page-header">Файлы</h1>
	<ol class="breadcrumb">
       <?
            $pathSize = count($path);
            foreach ($path as $value) {
        ?>
            <li><a href="/admin/files/?dir=<?=$value['url'];?>"><?=$value['text'];?></a></li>
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
                <?php foreach ($data as $i => $row): ?>
                    <?php if ($row['type'] == 'up'): ?>
                       <!-- <li class="list-group-item"><a href="<?php /*echo $row['url']; */?>"><?php /*echo $row['label']; */?></a></li>-->
                    <? else: ?>
                    <?php if ($row['type'] == 'dir'): ?>
                        <li class="list-group-item">
                            <span class="glyphicon glyphicon-folder-close" style="color: #777;"></span>
                            <a href="<?php echo $row['url']; ?>"> <?php echo $row['label']; ?> </a>
                        </li>
                    <?php else: ?>
                        <li class="list-group-i
                        tem"><span class="glyphicon glyphiconicon-file"></span><span data="label"><?php echo $row['label']; ?></span>
                <?php endif; ?>
                <?php endif; ?>
                <?php endforeach; ?>
			</ul>
		</div>
	</div>
</div>
