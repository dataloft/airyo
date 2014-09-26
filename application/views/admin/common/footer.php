<div id="footer" class="navbar-default" role="navigation">
	<div class="container">
		<div class="navbar-left">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-2">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span> 
				<span class="icon-bar"></span> 
			</button>

			<p class="navbar-brand text-muted"><small>&copy; Airyo 2014</small></p>
		</div>
		<?php if(isset($usermenu)): ?>
			<div class="nav collapse navbar-collapse" id="bs-example-navbar-collapse-2">
				<p class="navbar-text navbar-right">
					<a href="/admin/users/profile">
						<span class="glyphicon glyphicon-edit"></span>
						<?=$user_data->first_name; ?> <?=$user_data->last_name; ?></a>
					<a href="/admin/logout">
						<span class="glyphicon glyphicon-log-out"></span>
						Выйти</a>
				</p>
			</div>

		<?php endif; ?>
	</div>
</div>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

<!-- Include all compiled plugins (below), or include individual files as needed --> 
<script src="/themes/airyo/js/bootstrap.min.js"></script>
<?
if (!empty($scripts))
    foreach ($scripts as $script) {
?>
<script src="<?=$script?>"></script>
<?
    }
?>

</body>
</html>