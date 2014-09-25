<div class="container">
    <? if (is_array($message) and array_key_exists('type', $message)) {?>
        <div class="alert alert-<?=$message['type']?>"> <a class="close" data-dismiss="alert" href="#">&times;</a> <? if ($message['type']=='success') {?><span class="glyphicon glyphicon-ok"></span><?}?> <?=$message['text']?></div>
    <? } ?>
    <h1 class="page-header">Группы пользователей <a href="/admin/groups/add" class="btn btn-success"><i class="glyphicon glyphicon-plus"></i> Добавить группу</a></h1>
    <div class="row">
        <div class="col-md-12">
	        <table class="table table-responsive table-hover">
		        <thead>
			        <tr>
				        <th width="1%">Id</th>
				        <th width="20%">Наименование</th>
				        <th width="20%">Описание</th>
				        <th width="5%"></th>
			        </tr>
		        </thead>
		        <tbody>
			        <?php foreach ($groups as $group) : ?>
				        <tr>
					        <td>
						        <?=$group['id']; ?>
					        </td>
					        <td>
								<span><?=$group['name']; ?></span>
					        </td>
					        <td>
								<span><?=$group['description']; ?></span>
					        </td>
					        <td>
						        <a href="/admin/groups/edit/<?=$group['id']; ?>" class="btn btn-info" title="Сохранить группу"><i class="glyphicon glyphicon-edit"></i></a>
						        <a class="btn btn-danger" onclick="removeGroup('<?=$group['id']; ?>');" title="Удалить группу"><i class="glyphicon glyphicon-remove"></i></a>
					        </td>
						</tr>
			        <?php endforeach; ?>
		        </tbody>
	        </table>
        </div>
    </div>
</div>
