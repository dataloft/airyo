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
			<?php if(isset($main_menu) AND !empty($main_menu)) : ?>
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
			<?php endif; ?>
			<a class="navbar-brand" href="/" target="_blank" style="margin-right: 20px"><span class="glyphicon glyphicon-dashboard"></span> <?=ltrim($_SERVER['HTTP_HOST'],'www.');?></a>
		</div>
		<?php if(isset($main_menu) AND !empty($main_menu) AND isset($headermenu_modules) AND !empty($headermenu_modules)) : ?>
		<div class="navbar-collapse collapse">
			<ul class="nav navbar-nav">

				<?php foreach ($headermenu_modules as $key => $module) : ?>
					<?php if ($key < 3) : ?>
						<li <?=($main_menu == $module->alias) ? 'class="active"' : ''; ?> ><a href="/airyo/<?=$module->alias; ?>"><?=$module->title; ?></a></li>
					<?php endif; ?>
				<?php endforeach; ?>

                <?php if(sizeof($headermenu_modules) > 3) : ?>
                    <li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown">Все модули <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <?php foreach ($headermenu_modules as $key => $module) : ?>
                                <?php if ($key >= 3) : ?>
                                    <li <?=($main_menu == $module->alias) ? 'class="active"' : ''; ?> ><a href="/airyo/<?=$module->alias; ?>"><?=$module->title; ?></a></li>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </ul>
                    </li>
                <?php endif; ?>
			</ul>
			<!--form class="navbar-form navbar-right" style="width: 250px" role="search">
	        	<div class="input-group">
		        	<input type="text" class="form-control" placeholder="Поиск">
		        	<div class="input-group-btn"><button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button></div>
		        </div>
	        </form-->
		</div>
		<?php endif; ?>
	</div>
</div>
<script type="text/javascript">
	var url = document.location.href;
	$.each($(".menu a"),function(){
		if(this.href == url){
			$(this).addClass('active-menu');
		};
	});

	$(".box-category a").each(function(e){
});
</script>