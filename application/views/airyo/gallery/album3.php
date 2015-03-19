<?

$this->css = '
	<link rel="stylesheet" href="/themes/airyo/js/FileUpload/css/jquery.fileupload.css" />
	<link rel="stylesheet" href="/themes/airyo/js/FileUpload/css/jquery.fileupload-ui.css" />
	<link rel="stylesheet" href="/themes/airyo/js/FileUpload/css/style.css" />
	<link rel="stylesheet" href="/themes/airyo/js/Gallery/css/ekko-lightbox.css" />
	<link rel="stylesheet" href="/themes/airyo/css/gallery.css" />
	';
	
$this->css .= '
<style type="text/css">



/**
 * Nestable
 */

.dd { position: relative; display: block; margin: 0; padding: 0; max-width: 600px; list-style: none; font-size: 13px; line-height: 20px; }

.dd-list { display: block; position: relative; margin: 0; padding: 0; list-style: none; }
.dd-list .dd-list { padding-left: 30px; }
.dd-collapsed .dd-list { display: none; }

.dd-item,
.dd-empty,
.dd-placeholder { display: block; position: relative; margin: 0; padding: 0; min-height: 20px; font-size: 13px; line-height: 20px; }

.dd-handle { display: block; xheight: 30px; margin: 5px 0; padding: 5px 10px; color: #333; text-decoration: none; font-weight: bold; border: 1px solid #ccc;
    background: #fafafa;
    background: -webkit-linear-gradient(top, #fafafa 0%, #eee 100%);
    background:    -moz-linear-gradient(top, #fafafa 0%, #eee 100%);
    background:         linear-gradient(top, #fafafa 0%, #eee 100%);
    -webkit-border-radius: 3px;
            border-radius: 3px;
    box-sizing: border-box; -moz-box-sizing: border-box;
}
.dd-handle:hover { color: #2ea8e5; background: #fff; }

.dd-item > button { display: block; position: relative; cursor: pointer; float: left; width: 25px; height: 20px; margin: 5px 0; padding: 0; text-indent: 100%; white-space: nowrap; overflow: hidden; border: 0; background: transparent; font-size: 12px; line-height: 1; text-align: center; font-weight: bold; }
.dd-item > button:before { content: \'+\'; display: block; position: absolute; width: 100%; text-align: center; text-indent: 0; }
.dd-item > button[data-action="collapse"]:before { content: \'-\'; }

.dd-placeholder,
.dd-empty { margin: 5px 0; padding: 0; min-height: 30px; background: #f2fbff; border: 1px dashed #b6bcbf; box-sizing: border-box; -moz-box-sizing: border-box; }
.dd-empty { border: 1px dashed #bbb; min-height: 100px; background-color: #e5e5e5;
    background-image: -webkit-linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff),
                      -webkit-linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff);
    background-image:    -moz-linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff),
                         -moz-linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff);
    background-image:         linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff),
                              linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff);
    background-size: 60px 60px;
    background-position: 0 0, 30px 30px;
}

.dd-dragel { position: absolute; pointer-events: none; z-index: 9999; }
.dd-dragel > .dd-item .dd-handle { margin-top: 0; }
.dd-dragel .dd-handle {
    -webkit-box-shadow: 2px 4px 6px 0 rgba(0,0,0,.1);
            box-shadow: 2px 4px 6px 0 rgba(0,0,0,.1);
}

/**
 * Nestable Extras
 */

.nestable-lists { display: block; clear: both; padding: 30px 0; width: 100%; border: 0; border-top: 2px solid #ddd; border-bottom: 2px solid #ddd; }

#nestable-menu { padding: 0; margin: 20px 0; }

#nestable-output,
#nestable2-output { width: 100%; height: 7em; font-size: 0.75em; line-height: 1.333333em; font-family: Consolas, monospace; padding: 5px; box-sizing: border-box; -moz-box-sizing: border-box; }

#nestable2 .dd-handle {
    color: #fff;
    border: 1px solid #999;
    background: #bbb;
    background: -webkit-linear-gradient(top, #bbb 0%, #999 100%);
    background:    -moz-linear-gradient(top, #bbb 0%, #999 100%);
    background:         linear-gradient(top, #bbb 0%, #999 100%);
}
#nestable2 .dd-handle:hover { background: #bbb; }
#nestable2 .dd-item > button:before { color: #fff; }

@media only screen and (min-width: 700px) {

    .dd { float: left; width: 48%; }
    .dd + .dd { margin-left: 2%; }

}

.dd-hover > .dd-handle { background: #2ea8e5 !important; }

/**
 * Nestable Draggable Handles
 */

.dd3-content { display: block; height: 30px; margin: 5px 0; padding: 5px 10px 5px 40px; color: #333; text-decoration: none; font-weight: bold; border: 1px solid #ccc;
    background: #fafafa;
    background: -webkit-linear-gradient(top, #fafafa 0%, #eee 100%);
    background:    -moz-linear-gradient(top, #fafafa 0%, #eee 100%);
    background:         linear-gradient(top, #fafafa 0%, #eee 100%);
    -webkit-border-radius: 3px;
            border-radius: 3px;
    box-sizing: border-box; -moz-box-sizing: border-box;
}
.dd3-content:hover { color: #2ea8e5; background: #fff; }

.dd-dragel > .dd3-item > .dd3-content { margin: 0; }

.dd3-item > button { margin-left: 30px; }

.dd3-handle { position: absolute; margin: 0; left: 0; top: 0; cursor: pointer; width: 30px; text-indent: 100%; white-space: nowrap; overflow: hidden;
    border: 1px solid #aaa;
    background: #ddd;
    background: -webkit-linear-gradient(top, #ddd 0%, #bbb 100%);
    background:    -moz-linear-gradient(top, #ddd 0%, #bbb 100%);
    background:         linear-gradient(top, #ddd 0%, #bbb 100%);
    border-top-right-radius: 0;
    border-bottom-right-radius: 0;
}
.dd3-handle:before { content: \'≡\'; display: block; position: absolute; left: 0; top: 3px; width: 100%; text-align: center; text-indent: 0; color: #fff; font-size: 20px; font-weight: normal; }
.dd3-handle:hover { background: #ddd; }

    </style>

	';
	
$this->js = '
	<script src="/themes/airyo/js/FileUpload/js/vendor/jquery.ui.widget.js"></script>
	<script src="/themes/airyo/js/FileUpload/js/jquery.iframe-transport.js"></script>
	<script src="/themes/airyo/js/FileUpload/js/jquery.fileupload.js"></script>
	<script src="/themes/airyo/js/Gallery/js/ekko-lightbox.js"></script>
	<script src="/themes/airyo/js/gallery.js"></script>
	<script src="/themes/airyo/js/jquery.nestable.js"></script>
	';
	
$this->js .= "
	
	<script>

	$(document).ready(function()
	{
	
	    var updateOutput = function(e)
	    {
	        var list   = e.length ? e : $(e.target),
	            output = list.data('output');
	        if (window.JSON) {
	            output.val(window.JSON.stringify(list.nestable('serialize')));//, null, 2));
	        } else {
	            output.val('JSON browser support required for this demo.');
	        }
	    };
	
	    $('#nestable3').nestable({
        	maxDepth: 0
    
	    })
	    .on('change', updateOutput);
	    
	    
	    updateOutput($('#nestable3').data('output', $('#nestable3-output')));
	
	});
	</script>
	
	";

$this->load->view('airyo/common/header')

?>

<div class="container">
	<h1 class="page-header">Фотоальбомы</h1>

	<?php if (!empty($message)) : ?>
		<div class="alert alert-<?=$message['type']?>">
			<a class="close" data-dismiss="alert" href="#">&times;</a>
			<?php if ($message['type']=='success') : ?>
				<span class="glyphicon glyphicon-ok"></span>
			<?php endif; ?>
			<?=$message['text']?>
		</div>
	<? endif; ?>

	<ol class="breadcrumb">
		<li><a href="/airyo/gallery">Фотоальбомы</a></li>
		<li><?=$album->title; ?></li>
	</ol>

	<div class="row">
		<div class="col-md-12" style="margin: 0 0 20px">
			<ul class="nav nav-pills pull-right sortable">
				<li>
					<a href='#' id="upload_mage" class="pull-right"><span class="glyphicon glyphicon-plus" style="color: #777"></span> Добавить изображения</a>
					<input id="fileupload" class="file-upload-link" type="file" name="files[]" data-url="/airyo/gallery/uploadimages" multiple />
					<input type="hidden" name="album_label" id="album_label" value="<?=$album->label; ?>" />
				</li>
				<li>
					<a href="/airyo/gallery/edit/<?=$album->label; ?>"><span class="glyphicon glyphicon-edit" style="color: #777"></span> Редактирование альбома</a>
				</li>
			</ul>
<!--			<?php /*if(!empty($images)) : */?>
				<ul class="nav nav-pills">
					<li>
						<a class="dropdown-toggle checkAllBtn checkAll" data-toggle="dropdown" href="#">
							<span class="glyphicon glyphicon-ok" style="color: #777"></span>&nbsp;&nbsp;Выделить все
						</a>
						<a class="dropdown-toggle uncheckAllBtn uncheckAll hidden" data-toggle="dropdown" href="#">
							<span class="glyphicon glyphicon-ok" style="color: #777"></span>&nbsp;&nbsp;Снять выделение
						</a>
					</li>
				</ul>
			--><?php /*endif; */?>
		</div>
	</div>

	<div class="row">
	<div class="col-md-12">
		<br>
		<br>
		<!-- The global progress bar -->
		<div id="progress" class="hidden progress">
			<div class="progress-bar progress-bar-success"></div>
		</div>
	</div>
	</div>

	<?/*php if(!empty($album->description)) : ?>
		<div class="starter-template">
			<p class="lead"><?=$album->description; ?></p>
		</div>
	<?php endif; */?>

	<div class="row" id="links">
	<div class="col-md-12">
	
		<textarea id="nestable3-output"></textarea>
		
		<form method="POST" action="/airyo/gallery/editAlbum" id="form-edit-album" style="display: <?=(!empty($images)) ? 'block' : 'none'; ?>">
			
			<div class="dd" id="nestable3">
			<ul class="dd-list">
				<?php foreach($images as $image) : ?>
					<li class="dd-item" data-id="<?=$image->id; ?>">
						<div class="dd-handle">
						
						<input type="checkbox" class="check" name="selected[]" value="<?=$image->id; ?>" />

						<a class="next" href="/<?=$home_folder; ?>/<?=$album->label; ?>/<?=$image->label; ?>" data-toggle="lightbox" data-gallery="multiimages" data-parent data-footer="<?=$image->description; ?>" data-title="<?=$image->title;?>">
							<img src="/<?=$home_folder; ?>/<?=$album->label; ?>/thumbs<?=$preview_size['width']; ?>x<?=$preview_size['height']; ?>/thumbs<?=$image->id; ?><?=$preview_extension; ?>" alt="" class="img-responsive image-gallery" />
						</a>

						<div class="form-group input-group-sm">
							<!--label for="inputName">Название</label-->
							<input type="hidden" value="<?=$image->title; ?>" class="form-control" name="album[title][]" id="inputName" placeholder="Название">
						</div>
						<div class="form-group">
							<label for="inputDescription">Описание</label>
							<textarea class="form-control" name="album[description][]" id="inputDescription" cols="60" rows="5"><?=$image->description; ?></textarea>
						</div>
						
						</div>
					</li>
				<?php endforeach; ?>
			</ul>
			
			</div>
			
			
			<div>
				<button type="submit" class="btn btn-success">
					<span class="checkAll"><?= $this->lang->line('save')?></span>
					<span class="uncheckAll hidden"><?= $this->lang->line('save_and_delete_checked')?></span>
				</button>
			</div>
		</form>

		<div class="center-block" id="block-empty-album" style="display: <?=(empty($images)) ? 'block' : 'none'; ?>">
			<p>В этом альбоме ещё нет фотографий</p>
		</div>
		
		<div class="text-center">
			<?=@$pagination->create_links(); ?>
		</div>
		
	</div>
	</div>
	
</div>

<?$this->load->view('airyo/common/footer')?>