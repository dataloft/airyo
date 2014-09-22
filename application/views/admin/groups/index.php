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
				        <th width="20%">Пользователи</th>
			        </tr>
		        </thead>
		        <tbody>
			        <?php foreach ($groups as $group) : ?>
			        <tr>
				        <td><?=$group['id']; ?></td>
				        <td>
					        <div class="view-name-<?=$group['id']; ?>">
						        <span><?=$group['name']; ?></span>
						        <span><a href="#" onclick="editNameGroup(<?=$group['id']; ?>, true); return false;" title="Редактировать"><i class="glyphicon glyphicon-edit"></i></a></span>
						        <span><a href="#" title="Удалить"><i class="glyphicon glyphicon-remove"></i></a></span>

					        </div>
						    <div class="edit-name-<?=$group['id']; ?>" style="display: none;">
							    <button class="btn btn-info" onclick="saveNameGroup(<?=$group['id']; ?>); return false;"><i class="glyphicon glyphicon-floppy-disk"></i></button>
							    <button class="btn btn-warning" onclick="editNameGroup(<?=$group['id']; ?>, false); return false;"><i class="glyphicon glyphicon-remove"></i></button>
							    <div class="col-sm-5">
							        <input type="text" class="form-control" name="name-<?=$group['id']; ?>" value="<?=$group['name']; ?>" />
						        </div>
					        </div>
				        </td>
				        <td><div class="view-description-<?=$group['id']; ?>">
						        <span><?=$group['description']; ?></span>
						        <span><a href="#" onclick="editDescriptionGroup(<?=$group['id']; ?>, true); return false;" title="Редактировать"><i class="glyphicon glyphicon-edit"></i></a></span>
					        </div>
					        <div class="edit-description-<?=$group['id']; ?>" style="display: none;">
						        <button class="btn btn-info" onclick="saveDescriptionGroup(<?=$group['id']; ?>); return false;"><i class="glyphicon glyphicon-floppy-disk"></i></button>
						        <button class="btn btn-warning" onclick="editDescriptionGroup(<?=$group['id']; ?>, false); return false;"><i class="glyphicon glyphicon-remove"></i></button>
						        <div class="col-sm-5">
							        <input type="text" class="form-control" name="description-<?=$group['id']; ?>" value="<?=$group['description']; ?>" />
						        </div>
					        </div></td>
				        <td>
					        <?php if(isset($group['users']) AND !empty($group['users'])) : ?>
						        <ul class="list-group">
							        <?php foreach ($group['users'] as $user) : ?>
									    <li class="list-group-item">
										    <?=$user['first_name']; ?>
										    <?=$user['last_name']; ?>
										    (<a href="/admin/users/edit/<?=$user['id']; ?>"><?=$user['username']; ?></a>)
										    <a href="#" onclick="removeUserFromGroup(this, <?=$group['id']; ?>, <?=$user['id']; ?>); return false;" class="badge pull-right"><i class="glyphicon glyphicon-remove"></i></a>
							            </li>
							        <?php endforeach; ?>
						        </ul>
					        <?php endif ; ?>
					        <div class="row">
						        <div class="col-lg-9 pull-right">
							        <div class="input-group">
								        <input type="text" class="typeahead" autocomplete="off" name="add-user-<?=$group['id']; ?>">
									      <span class="input-group-btn">
									        <button class="btn btn-default" onclick="addUserToGroup(this, <?=$group['id']; ?>,
										      <?=$user['id']; ?>); return false;" type="button"><i class="glyphicon glyphicon-plus"></i> Добавить</button>
									      </span>
							        </div><!-- /input-group -->
						        </div><!-- /.col-lg-4 -->
					        </div><!-- /.col-lg-4 -->
				        </td>
					</tr>
			        <?php endforeach; ?>
		        </tbody>
	        </table>
        </div>
    </div>
</div>
