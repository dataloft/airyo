<?$this->load->view('common/header')?>

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
            <li><a href="/airyo/files/<?=$value['url'];?>"><?=$value['text'];?></a></li>
       <?}?>
        <li><?=$end_element['text'];?></li>
	</ol>
	
	<div class="row">
        <div class="col-md-12">
            <ul class="nav nav-pills pull-right">
                <li>
                    <a class="dropdown-toggle" href="/airyo/download?file=<?=$file['path'];?>" download>
                        <span class="glyphicon glyphicon-download-alt" style="color: #777"></span>&nbsp;&nbsp;Скачать файл
                    </a>
                </li>
                <li>
                    <a class="dropdown-toggle" href="#" id="delete-link">
                        <span class="glyphicon glyphicon glyphicon-trash" style="color: #777"></span>&nbsp;&nbsp;Удалить
                    </a>
                </li>
            </ul>
        </div>
    </div>

	<div class="row">
		<div class="col-md-12">
	        <h3><span class="glyphicon glyphicon-file"></span> <?=$file['name'];?></h3>
	        <p>URL: <?=$file['url'];?></p>
	        
	        <?php
	            if (isset($file['type']) && $file['type'] == 'img'):
	        ?>
	            <div class="clearfix"><img src="/<?=$file['path'];?>" class="img-thumbnail" width="300"></div>
	        <?
	            endif;
	        ?>
	    </div>
   </div>
    <form action="/airyo/files/delete" id="delete" method="post">
        <input type="hidden" name="file" value="<?=$file['path'];?>">
        <input type="hidden" name="redirect" value="<? $end_element = array_pop($path); echo $end_element['url']; ?>">
    </form>
</div>

<?$this->load->view('common/footer')?>