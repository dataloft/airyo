<div class="container">
    <? if (is_array($message) and array_key_exists('type', $message)) {?>
        <div class="alert alert-<?=$message['type']?>"> <a class="close" data-dismiss="alert" href="#">&times;</a> <? if ($message['type']=='success') {?><span class="glyphicon glyphicon-ok"></span><?}?> <?=$message['text']?></div>
    <? } ?>
    <h1 class="page-header">Пользователи</h1>
    <div class="row">
        <div class="col-md-3" style="margin-bottom: 10px">
            <form class="content-search" action="" method="post">
                <!--<select class="form-control" name="typeSelect" id="typeSelect" onchange="this.form.submit();">

                    <?/*
                    foreach ($menu_list as $row)
                    {
                        */?>
                        <option value="<?/*=$row['id']*/?>"  <?/* if ($menu_group==$row['id']) echo 'selected'; */?>><?/*=$row['name']*/?></option>
                    <?/*}*/?>
                </select>-->
            </form>
        </div>
    </div>
    <div class="row">
        <!--<div class="col-md-12" style="margin-top: 20px">
            <p class="pull-right"><span class="glyphicon glyphicon-plus" style="color: #777"></span> <a href="/admin/menu/add/<?/*=$menu_group*/?>" class="add">Добавить новый раздел</a></p>
        </div>-->
    </div>
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
			        </tr>
		        </thead>
		        <tbody>
			        <?php foreach ($users as $user) : ?>
			        <tr>
				        <td><?=$user->id; ?></td>
				        <td><a href="users/edit/<?=$user->id; ?>"><?=$user->username; ?></a></td>
				        <td><?=$user->email; ?></td>
				        <td><?=$user->first_name; ?></td>
				        <td><?=$user->last_name; ?></td>
				        <td><?=$user->company; ?></td>
				        <td><?=$user->phone; ?></td>

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
