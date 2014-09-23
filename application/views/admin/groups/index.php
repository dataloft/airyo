<div class="container">
    <? if (is_array($message) and array_key_exists('type', $message)) {?>
        <div class="alert alert-<?=$message['type']?>"> <a class="close" data-dismiss="alert" href="#">&times;</a> <? if ($message['type']=='success') {?><span class="glyphicon glyphicon-ok"></span><?}?> <?=$message['text']?></div>
    <? } ?>
    <h1 class="page-header">Группы пользователей</h1>
    <div class="row">
        <div class="col-md-12">
	        <table class="table table-responsive">
		        <thead>
			        <tr>
				        <th width="1%">Id</th>
				        <th width="20%">Наименование</th>
				        <th width="20%">Описание</th>
				        <th width="18%">Пользователи</th>
				        <th width="7%"></th>
			        </tr>
		        </thead>
		        <tbody>
			        <?php foreach ($groups as $group) : ?>
				        <tr>
					        <td><?=$group['id']; ?></td>
					        <td>
									<span><?=$group['name']; ?></span>
					        </td>
					        <td>
									<span><?=$group['description']; ?></span>
					        <td>
						        <?php if(isset($group['users']) AND !empty($group['users'])) : ?>
							        <ul class="list-group">
								        <?php foreach ($group['users'] as $user) : ?>
										    <li class="list-group-item">
											    <?=$user['first_name']; ?>
											    <?=$user['last_name']; ?>
											    (<a href="/admin/users/edit/<?=$user['id']; ?>"><?=$user['username']; ?></a>)
								            </li>
								        <?php endforeach; ?>
							        </ul>
						        <?php endif ; ?>
					        </td>
					        <td>
						        <a href="/admin/groups/edit/<?=$group['id']; ?>" class="btn btn-info" title="Сохранить группу"><i class="glyphicon glyphicon-edit"></i></a>
						        <a class="btn btn-danger" title="Удалить группу"><i class="glyphicon glyphicon-remove"></i></a>
					        </td>
						</tr>
			        <?php endforeach; ?>
		        </tbody>
	        </table>
        </div>
    </div>
</div>
