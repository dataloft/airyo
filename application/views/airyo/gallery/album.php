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


		.placeholder {
			outline: 1px dashed #4183C4;
			/*-webkit-border-radius: 3px;
			-moz-border-radius: 3px;
			border-radius: 3px;
			margin: -1px;*/
		}

		ol.sortable {
			margin: 0 0 50px;
			padding: 0;
			list-style-type: none;
		}

		ol.sortable li {
			margin: 20px 0 0 0;
			padding: 0;
		}

		ol.sortable li > div  {
			xborder-top: 1px solid #d4d4d4;
			padding: 0px;
			margin: 0;
			cursor: move;

		}
		
		.image-gallery {
			
		}
		
		.vertical-align {
		    display: flex;
		    align-items: center;
		    justify-content: center;
		}
		


</style>

	";
	
$this->js = '
	<script src="/themes/airyo/js/jquery-1.7.2.min.js"></script>
	<script src="/themes/airyo/js/jquery-ui-1.8.16.custom.min.js"></script>
	<script src="/themes/airyo/js/jquery.ui.touch-punch.js"></script>
	<script src="/themes/airyo/js/jquery.mjs.nestedSortable.js"></script>
	<script src="/themes/airyo/js/FileUpload/js/vendor/jquery.ui.widget.js"></script>
	<script src="/themes/airyo/js/FileUpload/js/jquery.iframe-transport.js"></script>
	<script src="/themes/airyo/js/FileUpload/js/jquery.fileupload.js"></script>
	<script src="/themes/airyo/js/gallery.js"></script>
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
			tabSize: 1000,
			tolerance: 'pointer',
			toleranceElement: '> div',
			maxLevels: 1,
			isTree: false,
			disableNesting: 'no-nest',
			expandOnHover: 700,
			startCollapsed: false,
			
			update: function () {
		        list = $(this).nestedSortable('toHierarchy');
		        //alert(list[1]['id']);
		        $.post(
		            '/airyo/gallery/album1426535677/ajax-sorting',
		            { list: list },
		            function(data){
		                $('#result').hide().html(data).fadeIn('slow')
		            },
		            'html'
		        );
		    }
		});
		
		
		$('#serialize').click(function(){
			serialized = $('ol.sortable').nestedSortable('serialize');
			$('#serializeOutput').text(serialized);
		});
		

		$('#toHierarchy').click(function(e){
			hiered = $('ol.sortable').nestedSortable('toHierarchy');
			hiered = dump(hiered);
			$('#toHierarchyOutput').text(hiered);
			
			/*(typeof($('#toHierarchyOutput')[0].textContent) != 'undefined') ?
			$('#toHierarchyOutput')[0].textContent = hiered : $('#toHierarchyOutput')[0].innerText = hiered;*/
		});
		
		$('#toArray').click(function(e){
			arraied = $('ol.sortable').nestedSortable('toArray', {startDepthCount: 0});
			arraied = dump(arraied);
			(typeof($('#toArrayOutput')[0].textContent) != 'undefined') ?
			$('#toArrayOutput')[0].textContent = arraied : $('#toArrayOutput')[0].innerText = arraied;
		})
	";
	

$this->js .= '	

		function dump(arr,level) {
			var dumped_text = "";
			if(!level) level = 0;
	
			//The padding given at the beginning of the line.
			var level_padding = "";
			for(var j=0;j<level+1;j++) level_padding += "    ";
	
			if(typeof(arr) == "object") { //Array/Hashes/Objects
				for(var item in arr) {
					var value = arr[item];
	
					if(typeof(value) == "object") { //If it is an array,
						dumped_text += level_padding + "\'" + item + "\' ...\n";
						dumped_text += dump(value,level+1);
					} else {
						dumped_text += level_padding + "\'" + item + "\' => \"" + value + "\"\n";
					}
				}
			} else { //Strings/Chars/Numbers etc.
				dumped_text = "===>"+arr+"<===("+typeof(arr)+")";
			}
			return dumped_text;
		}
		
    
    </script>
	
	';
	
	
	
	
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
			<ul class="nav nav-pills pull-right">
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
		<form method="POST" action="/airyo/gallery/editAlbum" id="form-edit-album" style="display: <?=(!empty($images)) ? 'block' : 'none'; ?>">
			
			
			<ol class="sortable">
			
				<?php foreach($images as $image) : ?>
					<li id="list_<?=$image->id; ?>">
						
						
						<div class="row vertical-align">
		                                       
                            <div class="col-xs-1">
                                <input type="checkbox" class="check" name="selected[]" value="<?=$image->id; ?>" />
                            </div>
                            
                            
                            <div class="col-xs-2">
                            	
                            	<img src="/<?=$home_folder; ?>/<?=$album->label; ?>/thumbs<?=$preview_size['width']; ?>x<?=$preview_size['height']; ?>/thumbs<?=$image->id; ?><?=$preview_extension; ?>" alt="" class="img-responsive image-gallery" />
                            
                            </div>
						
                            <div class="col-xs-9">

	                           	<div class="form-group input-group-sm">
									<!--label for="inputName">Название</label-->
									<input type="hidden" value="<?=$image->title; ?>" class="form-control" name="album[title][]" id="inputName" placeholder="Название">
								</div>
								<div class="form-group">
									<label for="inputDescription">Описание</label>
									<textarea class="form-control" name="album[description][]" id="inputDescription" cols="60" rows="5"><?=$image->description; ?></textarea>
								</div>
								
								<input type="hidden" name="album[id][]" value="<?=$image->id; ?>" />
								
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