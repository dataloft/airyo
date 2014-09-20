<div id="footer" class="navbar-default" role="navigation">
	<div class="container">
		<div class="navbar-left">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-2">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span> 
				<span class="icon-bar"></span> 
			</button>
			<ul class="nav navbar-nav navbar-right">
				<?php if(isset($usermenu)): ?>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span> <?=$user_data->first_name; ?> <?=$user_data->last_name; ?> <span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							<li>
								<a href="/admin/users/profile">
									<span class="glyphicon glyphicon-edit"></span>
									Редактировать</a>
							</li>
							<li>
								<a href="/admin/logout">
									<span class="glyphicon glyphicon-log-out"></span>
									Выйти</a>
							</li>
						</ul>
					</li>
				<?php endif; ?>
			</ul>
			<p class="navbar-brand text-muted"><small>&copy; Airyo 2014</small></p>
		</div>
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