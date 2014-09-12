<div class="container">
	<?php if ($message) : ?>
		<div class="alert alert-<?=$message['type']?>"> <a class="close" data-dismiss="alert" href="#">&times;</a> <? if ($message['type']=='success') {?><span class="glyphicon glyphicon-ok"></span><?}?> <?=$message['text']?></div>
	<?php endif; ?>
	<h1 class="page-header">Профиль</h1>

	<?php echo form_open("", 'class="form-horizontal" method="POST"');?>
		<div class="form-group  <?php if(form_error('username')) echo 'has-error"'; ?>">
			<label for="inputlogin" class="control-label col-xs-2">Логин:</label>
			<div class="col-xs-3">
				<input type="text" class="form-control" name="username" id="inputlogin" placeholder="Логин" value="<?=$user->username; ?>">
			</div>
		</div>
		<div class="form-group <?php if(form_error('first_name')) echo 'has-error"'; ?>">
			<label for="inputFirstName" class="control-label col-xs-2">Имя:</label>
			<div class="col-xs-3">
				<input type="text" class="form-control" name="first_name" id="inputFirstName" placeholder="Имя" value="<?=$user->first_name; ?>">
			</div>
		</div>
		<div class="form-group <?php if(form_error('last_name')) echo 'has-error"'; ?>">
			<label for="inputLastName" class="control-label col-xs-2">Фамилия:</label>
			<div class="col-xs-3">
				<input type="text" class="form-control" name="last_name" id="inputLastName" placeholder="Фамилия" value="<?=$user->last_name; ?>">
			</div>
		</div>
		<div class="form-group <?php if(form_error('email')) echo 'has-error"'; ?>">
			<label for="inputEmail" class="control-label col-xs-2">E-mail:</label>
			<div class="col-xs-3">
				<input type="email" class="form-control" name="email" id="inputEmail" placeholder="E-mail" value="<?=$user->email; ?>">
			</div>
		</div>
		<div class="form-group <?php if(form_error('company')) echo 'has-error"'; ?>">
			<label for="inputCompany" class="control-label col-xs-2">Компания:</label>
			<div class="col-xs-3">
				<input type="text" class="form-control" name="company" id="inputCompany" placeholder="Название компании" value="<?=$user->company; ?>">
			</div>
		</div>
		<div class="form-group <?php if(form_error('phone')) echo 'has-error"'; ?>">
			<label for="inputPhone" class="control-label col-xs-2">Телефон:</label>
			<div class="col-xs-3">
				<input type="text" class="form-control" name="phone" id="inputPhone" placeholder="Номер телефона" value="<?=$user->phone; ?>">
			</div>
		</div>
		<div class="form-group">
			<div class="col-xs-offset-2 col-xs-10">
				<button type="submit" class="btn btn-primary">Сохранить</button>
			</div>
		</div>
	<input type="hidden" name="form_edit" value="edit" />
	<?php echo form_close();?>
</div>
