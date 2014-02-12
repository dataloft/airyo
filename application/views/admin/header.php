<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<head>
	<link type="text/css" href="/i/css/airyo-style.css" rel="stylesheet"/>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<title></title>
</head>
<body>
	<div id="layout">
		<div class="sitename"><a href="/" target="_blank">dataloft.ru</a> - система управления</div>
		<?if(isset($menu)):?>
		<ul id="menu">
			<li><a href="/admin/content">Наполнение</a></li>
			<li><a href="/admin/menu">Меню</a></li>
		</ul>
		<a href="/admin/trash" class="trash">Корзина</a>
		<?endif?>
		<div class="clear"></div>