<div class="container">
	<?php if ($message) : ?>
		<div class="alert alert-<?=$message['type']?>"> <a class="close" data-dismiss="alert" href="#">&times;</a> <? if ($message['type']=='success') {?><span class="glyphicon glyphicon-ok"></span><?}?> <?=$message['text']?></div>
	<?php endif; ?>
	<h1 class="page-header">Пользователи</h1>
	
	<ol class="breadcrumb">
       <li><a href="/airyo/users/">Пользователи</a></li>
       <li>Новый пользователь</li>
	</ol>

	<?php echo form_open("", 'class="form-horizontal" method="POST"');?>
		<div class="form-group  <?php if(form_error('username')) echo 'has-error'; ?>">
			<label for="inputlogin" class="control-label col-xs-2">Логин:</label>
			<div class="col-xs-3">
				<input type="text" class="form-control" name="username" id="inputlogin" placeholder="Логин" value="<?=!empty($session['username']) ? $session['username'] : ''; ?>" />
			</div>
		</div>
		<div class="form-group <?php if(form_error('first_name')) echo 'has-error'; ?>">
			<label for="inputFirstName" class="control-label col-xs-2">Имя:</label>
			<div class="col-xs-3">
				<input type="text" class="form-control" name="first_name" id="inputFirstName" placeholder="Имя" value="<?=!empty($session['first_name']) ? $session['first_name'] : ''; ?>"/ >
			</div>
		</div>
		<div class="form-group <?php if(form_error('email')) echo 'has-error'; ?>">
			<label for="inputEmail" class="control-label col-xs-2">E-mail:</label>
			<div class="col-xs-3">
				<input type="email" autocomplete="off" class="form-control" name="email" id="inputEmail" placeholder="E-mail" value="<?=!empty($session['email']) ? $session['email'] : ''; ?>" />
			</div>
		</div>
		<?php if($user_data->role_id == 2) : ?>
			<div class="form-group <?php if(form_error('role')) echo 'has-error'; ?>">
				<label for="inputGroup" class="control-label col-xs-2">Роль:</label>
				<div class="col-xs-3">
					<select class="form-control" name="role" id="inputRole">
						<option value="0">user</option>
						<?php foreach ($roles as $role) : ?>
							<option value="<?=$role->id; ?>"><?=$role->title; ?></option>
						<?php endforeach; ?>
					</select>
				</div>
			</div>
		<?php endif; ?>
		<div class="form-group <?php if(form_error('newpass')) echo 'has-error'; ?>">
			<label for="inputNewPassword" class="control-label col-xs-2">Пароль:</label>
			<div class="col-xs-3">
				<input type="password" autocomplete="off" class="form-control" name="newpass" id="inputNewPassword" placeholder="Пароль">
			</div>
		</div>
		<div class="form-group <?php if(form_error('passconf')) echo 'has-error'; ?>">
			<label for="inputConfirmPassword" class="control-label col-xs-2">Подтвердите пароль:</label>
			<div class="col-xs-3">
				<input type="password" autocomplete="off" class="form-control" name="passconf" id="inputConfirmPassword" placeholder="Подтверждение пароля">
			</div>
		</div>
		<div class="form-group <?php if(form_error('groups')) echo 'has-error'; ?>">
			<label for="inputGroup" class="control-label col-xs-2">Группа:</label>
			<div class="col-xs-3">
				<select multiple class="form-control" name="groups[]" id="inputGroup">
					<?php foreach ($groups as $key => $group) : ?>
						<option value="<?=$group['id']; ?>"><?=$group['name']; ?></option>
					<?php endforeach; ?>
				</select>
			</div>
		</div>
		<div class="form-group">
			<div class="col-xs-offset-2 col-xs-10">
				<button type="submit" class="btn btn-success">Сохранить</button>
			</div>
		</div>
		<input type="hidden" name="form_add" value="add" />
	<?php echo form_close();?>
</div>
