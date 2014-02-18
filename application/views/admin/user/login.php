
		<h2>Вход в систему</h2>
		<?php echo form_open("admin/login", 'id="login" class="login" name="login" method="POST"');?>
			<div>
				<label for="textfield">Email</label>
				<input type="text" name="identity" id="textfield" />
			</div>
			<div>
				<label for="textfield">Пароль</label>
				<input type="password" name="password" id="textfield" />
			</div>
			<button name="submit" type="submit" value="">Войти</button>
		<?php echo form_close();?>