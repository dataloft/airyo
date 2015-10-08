<?

$this->css .= "

	<style type=\"text/css\">
	
	.placeholder {
		outline: 1px dashed #4183C4;
	}
	
	.mjs-nestedSortable-error {
		background: #fbe3e4;
		border-color: transparent;
	}
	
	ol.sortable {
		margin: 0 0 40px;
		padding-left: 0px;
	}
	
	ol.sortable ol {
		margin-left: 20px;
		padding-left: 0px;
	}
	
	ol.sortable li {
		list-style: none;
		margin: 5px 0 0 0;
	}
	
	ol.sortable li.disabled > div a {
		color: #999;
	}
	
	ol.sortable li > div:hover, ol.sortable li a:focus  {
		background-color: #f5f5f5;	
	}
	
	ol.sortable li > div  {
		border: 1px solid #d4d4d4;
		-webkit-border-radius: 3px;
		-moz-border-radius: 3px;
		border-radius: 3px;
		border-color: #ddd;
		padding: 5px 15px;
		margin: 0;
		cursor: move;
	}
	
	</style>
	";
	
$this->js = '
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
		tabSize: 20,
		tolerance: 'pointer',
		toleranceElement: '> div',
		maxLevels: 4,
		isTree: true,
		expandOnHover: 700,
		startCollapsed: false,
	});
		
	$('#toHierarchy').click(function(e){
	
		list = $('ol.sortable').nestedSortable('toHierarchy');
		
		$.ajax({
            type: 'POST',
            url: '/airyo/menu/ajax_rebuild/".$menu_group."',
            data: { list: list },
            success: function() {
               $(location).attr('href', '/airyo/menu/".$menu_group."');
            },
            error: function(){
			   alert('Error');//Сделать нормальный нотис
			}
        });
	});

	</script>
	";

function printmenutree($menu, $step=1, $parents=array()) {
	
	$output = '';
	if (!is_array($menu) || !count($menu)) return $output;
	if ($step != 1) $output .= '<ol>';
	
	foreach ($menu as $item) 
	{
		$li_class = ($item['enabled']) ? '' : ' class="disabled"';
		$output .= '<li id="list_'.$item['id'].'"'.$li_class.'><div><a href="/airyo/menu/edit/'.$item['id'] . '">'.$item['name'].'</a> &nbsp;&nbsp;<small class="text-muted">' .$item['url'].'</small></div>';
		$step++;
		$output .= printmenutree($item['childs'], $step, $parents);
		$output .= '</li>';
	}
	
	if ($step != 1) $output .= '</ol>';
	
	return $output;
}


$this->load->view('airyo/common/header')
	
	
?>


<div class="container">
	<? if (is_array($message) and array_key_exists('type', $message)) {?>
        <div class="alert alert-<?=$message['type']?>"> <a class="close" data-dismiss="alert" href="#">&times;</a> <? if ($message['type']=='success') {?><span class="glyphicon glyphicon-ok"></span><?}?> <?=$message['text']?></div>
    <? } ?>
    <h1 class="page-header">Меню</h1>
    <div class="row">
        <div class="col-md-3" style="margin-bottom: 10px">
            <form class="content-search" action="" method="post">
                <select class="form-control" name="typeSelect" id="typeSelect" onchange="this.form.submit();">

                    <?
                    foreach ($menu_list as $row)
                    {
                        ?>
                        <option value="<?=$row['id']?>"  <? if ($menu_group==$row['id']) echo 'selected'; ?>><?=$row['name']?></option>
                    <?}?>
                </select>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12" style="margin: 20px 0 20px">
            <p class="pull-right"><span class="glyphicon glyphicon-plus" style="color: #777"></span> <a href="/airyo/menu/add/<?=$menu_group?>" class="add">Добавить пункт</a></p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <ol class="sortable">
                <? if ($menu) echo printmenutree($menu, 1) ?>
            </ol>
            <button id="toHierarchy" name="toHierarchy" type="submit" class="btn btn-success" style="float: left;"><?= $this->lang->line('save')?></button>
        </div>
    </div>
</div>


<?$this->load->view('airyo/common/footer')?>