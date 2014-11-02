<div class="container">

	<h1 class="page-header">Файлы</h1>
    <?php if ($message) : ?>
        <div class="alert alert-<?=$message['type']?>">
	        <a class="close" data-dismiss="alert" href="#">&times;</a>
	        <?php if ($message['type']=='success') : ?>
	            <span class="glyphicon glyphicon-ok"></span>
	        <?php endif; ?>
	        <?=$message['text']?>
        </div>
    <? endif; ?>
	<ol class="breadcrumb">
       <?
            $end_element = array_pop($path);
            foreach ($path as $value) {
        ?>
            <li><a href="/admin/files/<?=$value['url'];?>"><?=$value['text'];?></a></li>
       <?}?>
        <li><?=$end_element['text'];?></li>
	</ol>

	<div class="row">
        <h1><?=$file['name'];?></h1>
        <?php
            if (isset($file['type']) && $file['type'] == 'img'):
        ?>
            <img src="/<?=$file['path'];?>">
        <?
            endif;
        ?>
        <?=$file['url'];?>
        <a href="<?=$file['url'];?>" download>Скачать файл</a>
   </div>
</div>
