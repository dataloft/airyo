<div class="container">
    <? if (is_array($message) and array_key_exists('type', $message)) {?>
        <div class="alert alert-<?=$message['type']?>"> <a class="close" data-dismiss="alert" href="#">&times;</a> <? if ($message['type']=='success') {?><span class="glyphicon glyphicon-ok"></span><?}?> <?=$message['text']?></div>
    <? } ?>
    <h1 class="page-header">Пользователи</h1>
    <div class="row">
        <div class="col-md-12">
	        <table class="table table-responsive">
		        <thead>
			        <tr>
				        <th>Id</th>
				        <th>Логин</th>
				        <th>Email</th>
				        <th>Имя</th>
				        <th>Фамилия</th>
				        <th>Компания</th>
				        <th>Номер телефона</th>
				        <th>Группы</th>
			        </tr>
		        </thead>
		        <tbody>
			        <?php foreach ($users as $user) : ?>
				        <tr>
					        <td><?=$user->id; ?></td>
					        <td><a href="<?=($profile_id == $user->id) ? 'users/profile' : 'users/edit/'.$user->id; ?>"><?=$user->username; ?></a></td>
					        <td><?=$user->email; ?></td>
					        <td><?=$user->first_name; ?></td>
					        <td><?=$user->last_name; ?></td>
					        <td><?=$user->company; ?></td>
					        <td><?=$user->phone; ?></td>
					        <td>
						        <ul>
							        <?php foreach ($user->groups as $group) : ?>
								        <li><a href="/admin/groups/edit/<?=$group['id']; ?>"><?=$group['name']; ?></a></li>
							        <?php endforeach; ?>
						        </ul>
					        </td>
				        </tr>
			        <?php endforeach; ?>
		        </tbody>
	        </table>
	        <div class="text-center">
	            <?=$pagination->create_links(); ?>
	        </div>
        </div>
    </div>
</div>
