<div id="footer" class="navbar navbar-default navbar-fixed-bottom" role="navigation">
	<div class="container">
		<?if(isset($user_data) AND !empty($user_data)):?>
			<div class="navbar-left">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-2">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>	
				<!--p class="navbar-text"><span class="glyphicon glyphicon-trash"></span> <a href="#">Корзина</a></p-->
			</div>
			<div class="nav collapse navbar-collapse" id="bs-example-navbar-collapse-2">
				<p class="navbar-text navbar-right">
					<span class="glyphicon glyphicon-user"></span>
					<a href="/airyo/users/edit/<?=$user_data->id; ?>" style="margin-right: 20px;"><?=$user_data->username; ?></a>
					<span class="glyphicon glyphicon-log-out"></span>
					<a href="/airyo/logout">Выйти</a>
				</p>
			</div>
		<?endif?>
	</div>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
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