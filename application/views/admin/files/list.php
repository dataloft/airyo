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
		<!--div class="col-md-12" style="margin-top: 20px">
			<ul class="nav nav-pills pull-right">
				<li><span class="glyphicon glyphicon-folder-open" style="color: #777"></span>&nbsp;&nbsp;<a href="?mkdir" class="add">Выделить все</a></li>
				<li><span class="glyphicon glyphicon-folder-open" style="color: #777"></span>&nbsp;&nbsp;<a href="?mkdir" class="add">Удалить</a></li>
			</ul>
		</div>


		<div class="btn-group pull-right">
		  <button type="button" class="btn btn-default"><span class="glyphicon glyphicon-folder-open" style="color: #777"></span>&nbsp;&nbsp;<a href="?mkdir" class="add">Выделить все</a></button>
		  <button type="button" class="btn btn-default"><span class="glyphicon glyphicon-folder-open" style="color: #777"></span>&nbsp;&nbsp;<a href="?mkdir" class="add">Удалить</a></button>
		</div-->


<div class="col-md-12" style="margin: 0 0 20px">
<ul class="nav nav-pills pull-right">
  <li>
    <a class="dropdown-toggle " id="checkAll" data-toggle="dropdown" href="#">
      <span class="glyphicon glyphicon-ok" style="color: #777"></span>&nbsp;&nbsp;Выделить все
    </a>
  <a class="dropdown-toggle hidden" id="uncheckAll" data-toggle="dropdown" href="#">
      <span class="glyphicon glyphicon-ok" style="color: #777"></span>&nbsp;&nbsp;Снять выделение
  </a>
  </li>
  <li>
    <a class="dropdown-toggle" data-toggle="dropdown" href="#" onclick="$('#delete').submit();">
      <span class="glyphicon glyphicon glyphicon-trash" style="color: #777"></span>&nbsp;&nbsp;Удалить
    </a>
  </li>
</ul>
</div>



	</div>


	<div class="row">

		<div id="dropzone" class="dropzone col-md-12">

			<ul class="list-group">
                <form action="/admin/files/delete" id="delete" method="post">
                <?php foreach ($result as $i => $row): ?>
                    <?php if ($row['type'] == 'up'): ?>
                       <!-- <li class="list-group-item"><a href="<?php /*echo $row['url']; */?>"><?php /*echo $row['label']; */?></a></li>-->
                    <? else: ?>
                    <?php if ($row['type'] == 'dir'): ?>
                        <li class="list-group-item">
                        	<input type="checkbox" name="selected[]" value="<?php echo $row['path']; ?>">&nbsp;&nbsp;
                            <span class="glyphicon glyphicon-folder-open" style="color: #777; margin-right: 10px;"></span>
                            <a href="<?php echo $row['url']; ?>"><?php echo $row['label']; ?></a>
                        </li>
                    <?php else: ?>
                        <li class="list-group-item"><input type="checkbox" name="selected[]" value="<?=$row['path'];?>">&nbsp;&nbsp;<a href="" style="color: #555"><?php echo $row['label']; ?></a></li>
                <?php endif; ?>
                <?php endif; ?>
                <?php endforeach; ?>
                </form>
			</ul>
		</div>

        <div class="col-md-12">
            <br>
            <br>
            <!-- The global progress bar -->
            <div id="progress" class="hidden progress">
                <div class="progress-bar progress-bar-success"></div>
            </div>

        </div>

<!--div class="col-md-12">
<div class="panel panel-default">
<div class="panel-heading">
  <h4 class="panel-title">
    <a href="#collapseOne" data-toggle="collapse">Действия</a>
  </h4>
</div>
<div id="collapseOne" class="panel-collapse collapse in">
  <div class="panel-body"-->



        <div class="col-md-12" style="margin-top: 20px">

            <!-- Nav tabs -->
            <ul class="nav nav-tabs">
                <li class="active"><a href="#upload" data-toggle="tab">Загрузка файлов</a></li>
                <li><a href="#mkdir" data-toggle="tab">Создать папку</a></li>
                <? if ($value['url']!='') {?>
				  <li><a href="#renamedir" data-toggle="tab">Переименовать папку</a></li>
				<?}?>
            </ul>

            <!-- Tab panes -->

            <div class="tab-content">
                <div class="tab-pane fade in active" id="upload">
                    <form id="fileupload" action="/admin/files/upload" method="POST" enctype="multipart/form-data" style="margin-top: 20px">
                        <!-- The fileinput-button span is used to style the file input field as button -->
                        <span class="btn btn-success fileinput-button">
                            <i class="glyphicon glyphicon-plus"></i>
                            <span>Add files...</span>
                            <!-- The file input field used as target for the file upload widget -->
                            <input  type="file" name="file" multiple>
                            <input type="hidden" name="pth" value="<?=$value['url'];?>">
                        </span>
                    </form>
                </div>

                <div class="tab-pane fade" id="mkdir">
                    <form role="form" action="/admin/files/createfolder" method="post" class="form-inline" style="margin-top: 20px">
					  <div class="form-group">
					      <input type="hidden" value="<?=$value['url'];?>" name="path">
					    <input type="text" class="form-control" name="fname" placeholder="Название папки">
					  </div>
					  <button type="submit" class="btn btn-success">Создать</button>
					</form>
                </div>

				    <? if ($value['url']!='') {?>
				  <div class="tab-pane fade" id="renamedir">
				
				
				<form role="form" action="/admin/files/renamefolder" method="post" class="form-inline" style="margin-top: 20px">
				  <div class="form-group">
				    <input type="text" class="form-control" name="fname" value="<?= $path[$pathSize-1]['text'];?>">
				      <input type="hidden" class="form-control" name="oldfname" value="<?= $path[$pathSize-1]['text'];?>">
				      <input type="hidden" class="form-control" name="path" value="<?= $path[$pathSize-2]['url'];?>">
				  </div>
				  <button type="submit" class="btn btn-success">Переименовать</button>
				</form>
				
					  
					  
					  
				  </div>
				    <?}?>
            </div>
        </div>
  </div>
</div>
