<?

$this->css = '
	<link rel="stylesheet" href="/themes/airyo/js/FileUpload/css/jquery.fileupload.css" />
	<link rel="stylesheet" href="/themes/airyo/js/FileUpload/css/jquery.fileupload-ui.css" />
	<link rel="stylesheet" href="/themes/airyo/js/FileUpload/css/style.css" />
	<link rel="stylesheet" href="/themes/airyo/js/Gallery/css/ekko-lightbox.css" />
	<link rel="stylesheet" href="/themes/airyo/css/gallery.css" />
	';
	
$this->css .= "

<style type=\"text/css\">

		.mjs-nestedSortable-error {
			background: #fbe3e4;
			border-color: transparent;
		}

		ol {
			margin: 0;
			padding: 0;
			padding-left: 30px;
		}

		ol.sortable, ol.sortable ol {
			margin: 0 0 0 25px;
			padding: 0;
			list-style-type: none;
		}

		ol.sortable {
			margin: 4em 0;
		}

		.sortable li {
			margin: 5px 0 0 0;
			padding: 0;
		}

		.sortable li div  {
			border: 1px solid #d4d4d4;
			-webkit-border-radius: 3px;
			-moz-border-radius: 3px;
			border-radius: 3px;
			border-color: #D4D4D4 #D4D4D4 #BCBCBC;
			padding: 6px;
			margin: 0;
			cursor: move;
			background: #f6f6f6;
			background: -moz-linear-gradient(top,  #ffffff 0%, #f6f6f6 47%, #ededed 100%);
			background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#ffffff), color-stop(47%,#f6f6f6), color-stop(100%,#ededed));
			background: -webkit-linear-gradient(top,  #ffffff 0%,#f6f6f6 47%,#ededed 100%);
			background: -o-linear-gradient(top,  #ffffff 0%,#f6f6f6 47%,#ededed 100%);
			background: -ms-linear-gradient(top,  #ffffff 0%,#f6f6f6 47%,#ededed 100%);
			background: linear-gradient(to bottom,  #ffffff 0%,#f6f6f6 47%,#ededed 100%);
			filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ffffff', endColorstr='#ededed',GradientType=0 );
		}

		.sortable li.mjs-nestedSortable-branch div {
			background: -moz-linear-gradient(top,  #ffffff 0%, #f6f6f6 47%, #f0ece9 100%);
			background: -webkit-linear-gradient(top,  #ffffff 0%,#f6f6f6 47%,#f0ece9 100%);

		}

		.sortable li.mjs-nestedSortable-leaf div {
			background: -moz-linear-gradient(top,  #ffffff 0%, #f6f6f6 47%, #bcccbc 100%);
			background: -webkit-linear-gradient(top,  #ffffff 0%,#f6f6f6 47%,#bcccbc 100%);

		}

		li.mjs-nestedSortable-collapsed.mjs-nestedSortable-hovering div {
			border-color: #999;
			background: #fafafa;
		}

		.disclose {
			cursor: pointer;
			width: 10px;
			display: none;
		}

		.sortable li.mjs-nestedSortable-collapsed > ol {
			display: none;
		}

		.sortable li.mjs-nestedSortable-branch > div > .disclose {
			display: inline-block;
		}

		.sortable li.mjs-nestedSortable-collapsed > div > .disclose > span:before {
			content: '+ ';
		}

		.sortable li.mjs-nestedSortable-expanded > div > .disclose > span:before {
			content: '- ';
		}

</style>

	";
	
$this->js = '
	<script src="/themes/airyo/js/FileUpload/js/vendor/jquery.ui.widget.js"></script>
	<script src="/themes/airyo/js/FileUpload/js/jquery.iframe-transport.js"></script>
	<script src="/themes/airyo/js/FileUpload/js/jquery.fileupload.js"></script>
	<script src="/themes/airyo/js/Gallery/js/ekko-lightbox.js"></script>
	<script src="/themes/airyo/js/gallery.js"></script>
	<script src="/themes/airyo/js/jquery-1.7.2.min.js"></script>
	<script src="/themes/airyo/js/jquery-ui-1.8.16.custom.min.js"></script>
	<script src="/themes/airyo/js/jquery.ui.touch-punch.js"></script>
	<script src="/themes/airyo/js/jquery.mjs.nestedSortable.js"></script>
	';
	
$this->js .= "
	
	<script>
	
	$('ol.sortable').nestedSortable({
			forcePlaceholderSize: true,
			handle: 'div',
			helper:	'clone',
			items: 'li',
			opacity: .6,
			placeholder: 'placeholder',
			revert: 250,
			tabSize: 25,
			tolerance: 'pointer',
			toleranceElement: '> div',
			maxLevels: 0,
			isTree: false,
			disableNesting: 'no-nest',
			expandOnHover: 700,
			startCollapsed: false,
			
			update: function () {
		        list = $(this).nestedSortable('toHierarchy', {startDepthCount: 0});
		        alert(list[0][id]);
		        /*$.post(
		            'http://www.domainname.com/ajax/ajax.php',
		            { update_sql: 'ok', list: list },
		            function(data){
		                $('#result').hide().html(data).fadeIn('slow')
		            },
		            'html'
		        );*/
		    }
		});
		
		
		$('#serialize').click(function(){
			serialized = $('ol.sortable').nestedSortable('serialize');
			$('#serializeOutput').text(serialized);
		});
		

		$('#toHierarchy').click(function(e){
			hiered = $('ol.sortable').nestedSortable('toHierarchy', {startDepthCount: 0});
			hiered = dump(hiered);
			$('#toHierarchyOutput')[0].innerText = '123';
			
			/*(typeof($('#toHierarchyOutput')[0].textContent) != 'undefined') ?
			$('#toHierarchyOutput')[0].textContent = hiered : $('#toHierarchyOutput')[0].innerText = hiered;*/
		});
		
    
    </script>
	
	";
	
	
	
	
$this->jsxx .= "
	
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
	
	
	
	
		
		<p><br />
			<input type="submit" name="serialize" id="serialize" value="Serialize" />
		<pre id="serializeOutput"></pre>
	
		<p>
			<input type="submit" name="toArray" id="toArray" value="To array" />
		<pre id="toArrayOutput"></pre>
	
		<p>
			<input type="submit" name="toHierarchy" id="toHierarchy" value="To hierarchy" />
		<pre id="toHierarchyOutput"></pre>
	
	
	
	
		
		
		<form method="POST" action="/airyo/gallery/editAlbum" id="form-edit-album" style="display: <?=(!empty($images)) ? 'block' : 'none'; ?>">
			
			
			<ol class="sortable">
				<?php foreach($images as $image) : ?>
					<li id="list_<?=$image->id; ?>">
						<div>
						
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
			</ol>
			
			
			
			
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