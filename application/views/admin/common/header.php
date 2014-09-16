<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title></title>

<!-- Bootstrap -->
<link href="/themes/airyo/css/bootstrap.min.css" rel="stylesheet">
<link href="/themes/airyo/css/bootstrap-airyo.css" rel="stylesheet">

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- Generic page styles -->
<?
if (!empty($styles))
    foreach ($styles as $style) {
?>
        <link rel="stylesheet" href="<?=$style?>">
    <?
    }
?>
    <!-- CSS to style the file input field as button and adjust the Bootstrap progress bars -->

    <link rel="stylesheet" href="/themes/airyo/js/FileUpload/css/jquery.fileupload-ui.css">
    <link rel="stylesheet" href="/themes/airyo/js/FileUpload/css/style.css">
</head>
<body>
<div class="navbar navbar-default" role="navigation">
	<div class="container">
		<div class="navbar-header">
			<?php if(isset($menu)) : ?>
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
			<?php endif; ?>

			<a class="navbar-brand" href="/" target="_blank" style="margin-right: 20px"><span class="glyphicon glyphicon-edit"></span> <?=ltrim($_SERVER['HTTP_HOST'],'www.');?></a>
		</div>
		<?if(isset($menu)):?>
		<div class="navbar-collapse collapse">
			<ul class="nav navbar-nav">
				<li <? if ($main_menu == 'users') echo 'class="active"';?> ><a href="/admin/users">Пользователи</a></li>
				<li <? if ($main_menu == 'content') echo 'class="active"';?> ><a href="/admin/content">Материалы</a></li>
				<li <? if ($main_menu == 'menu') echo 'class="active"';?> ><a href="/admin/menu">Меню</a></li>
				<li <? if ($main_menu == 'files') echo 'class="active"';?>><a href="/admin/files">Файлы</a></li>
				<li class="dropdown <?  if ($main_menu[0] == 'modules') echo 'active';?>"> <a href="#" class="dropdown-toggle" data-toggle="dropdown">Все модули <b class="caret"></b></a>
					<ul class="dropdown-menu">
						<li><a href="/admin/gallery">Галереи</a></li>
						<li><a href="/admin/">Слайдеры</a></li>
						<li><a href="/admin/">Каталог товаров</a></li>
						<li><a href="/admin/">Пользователи</a></li>
						<li><a href="/admin/">Заказы</a></li>
						<li><a href="/admin/">Формы и запросы</a></li>
						<li><a href="/admin/">Комментарии</a></li>
						<li><a href="/admin/">Подписки и рассылки</a></li>
						<li><a href="/admin/">Журнал действий</a></li>
						<li><a href="/admin/">Настройки сайта</a></li>
						<li><a href="/admin/">Пакетные операции</a></li>
						<li  <? if ($main_menu[1] == 'counters') echo 'class="active"';?>><a href="/admin/counters">Счетчики</a></li>
					</ul>
				</li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li><a href="#"><span class="glyphicon glyphicon-trash"></span> Корзина</a></li>
				<?php if(isset($usermenu)): ?>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span> Андрей Цветков <span class="caret"></span></a>
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
		</div>
		<?php endif; ?>
	</div>
</div>
<script>
var url = document.location.href;
$.each($(".menu a"),function(){
if(this.href == url){
$(this).addClass('active-menu');
};
});

$(".box-category a").each(function(e){


});
</script>