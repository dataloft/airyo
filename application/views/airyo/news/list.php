<? $this->load->view('airyo/common/header')?>

<div class="container">
	
    <? if (is_array($notice) and array_key_exists('type', $notice)) { ?>
    
        <div class="alert alert-<?=$notice['type']?>">
        	<a class="close" data-dismiss="alert" href="#">&times;</a>
        	
        	<? if ($notice['type']=='success') { ?>
        		<span class="glyphicon glyphicon-ok"></span>
        	<? } ?>
        	
        	<?=$notice['text']?>
        </div>
        
    <? } ?>
    
	<h1 class="page-header">Новости</h1>

	<div class="row">
		<div class="col-md-12" style="margin-top: 20px">
			<p class="pull-right">
				<span class="glyphicon glyphicon-plus" style="color: #777"></span>
				<a href="/airyo/news/edit<? if (!empty($type)) echo '?type='.$type; ?>" class="add">Создать</a>
			</p>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<ul class="list-group">
                <?
                if (!empty($news))
                    foreach ($news as $row)
                    {
                ?>
        				<li class="list-group-item">
        					<a href="/airyo/news/edit/<?=$row['id']?>"><?=$row['title']?></a>
        				</li>
		        <? } ?>
			</ul>
		</div>
	</div>
</div>

<? $this->load->view('airyo/common/footer')?>