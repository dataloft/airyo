<div class="container">
    <? if (is_array($message) and array_key_exists('type', $message)) {?>
        <div class="alert alert-<?=$message['type']?>"> <a class="close" data-dismiss="alert" href="#">&times;</a> <? if ($message['type']=='success') {?><span class="glyphicon glyphicon-ok"></span><?}?> <?=$message['text']?></div>
    <? } ?>
    <h1 class="page-header">Пользователи</h1>
    
     <div class="row">
        <div class="col-md-12" style="margin: 0 0 20px">
            <ul class="nav nav-pills pull-right">
                <li>
                    <a href="/admin/users/add">
                        <span class="glyphicon glyphicon glyphicon-user" style="color: #777"></span> Добавить пользователя
                    </a>
                </li>
                <!--li>
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" onclick="$('#delete').submit();">
                        <span class="glyphicon glyphicon glyphicon-trash" style="color: #777"></span>&nbsp;&nbsp;Удалить
                    </a>
                </li-->
            </ul>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-12">
        	<ul class="list-group">
        		<?php foreach ($users as $user) : ?>
	        	<li class="list-group-item"><a href="users/edit/<?=$user->id; ?>"><?=$user->username; ?></a></li>
	        	<?php endforeach; ?>
	        </ul>
	        <div class="text-center">
	            <?=$pagination->create_links(); ?>
	        </div>
        </div>
    </div>
</div>
