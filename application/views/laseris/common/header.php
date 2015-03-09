<!DOCTYPE html>
<html lang="ru">

<head>
    <title>ЛазерИнформСервис</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="utf-8" />
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,700,600,800,300&subset=latin,cyrillic' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="/themes/laseris/css/reset.css" />
    <link rel="stylesheet" href="/themes/laseris/css/style.css" />
	
	
	<?
	
	if (isset($albums) || isset($images)) echo '<link rel="stylesheet" href="/themes/laseris/css/magnific-popup.css" />';
	
	?>
	
	
	<?
	if (!empty($styles))
	foreach ($styles as $style) {
	?>
	<link rel="stylesheet" href="<?=$style?>">
	<?
	}
	?>
	
    <!--[if lte IE 8]><link href= "/themes/laseris/css/ie.css" rel= "stylesheet" media= "all" /><![endif]-->
    <!--[if lt IE 9]>
		<script src="/themes/laseris/js/html5-ie.js"></script>
		<script src="/themes/laseris/js/respond.min.js"></script>
	<![endif]-->
    <script src="/themes/laseris/js/jquery-1.8.3.min.js"></script>
    <script src="/themes/laseris/js/jquery.placeholder.min.js"></script>
    <script src="/themes/laseris/js/script.js"></script>
    <link rel="icon" type="image/vnd.microsoft.icon" href="favicon.ico">
    <link rel="shortcut icon" href="favicon.ico">

    <body>
        <!-- wrap -->
        <div class="wrapper">
        <div class="wrap">
            <!-- header -->
            <header class="header">
                <div class="logo_pic">
                    <img src="/themes/laseris/img/main/logo_pic.jpg" alt="">
                </div>
                <div class="logo">
                    <a href="/" class="i i-logo"></a>
                </div>
            </header>
            <!-- /header -->
            <!-- nav -->
            <nav class="nav">
                <ul>
                	
                    <?
					if(is_array($mainmenu) && count($mainmenu)){
					foreach ($mainmenu as $item)
					{
					
					?>
						<li <? echo (($this->uri->uri_string() == $item['url'] or current_url() == $item['url']) ) ? 'class="active"' : ''; ?>>
							<a href="<?=$item['url']?>"><?=$item['name']?></a>
							<?
							if(is_array($item['childs']) && count($item['childs'])){
							?>
							<ul>
							<?
								foreach($item['childs'] as $childitem){
								?>
								<li><a href="<?=$childitem['url']?>"><?=$childitem['name']?></a></li>
								<?
								}
							?>
							</ul>
							<?
							}
							?>
						</li>
					<?
					}
					}
					?>
                </ul>
            </nav>
            <!-- /nav -->
            <!-- page -->
            <div class="page">
                <!-- content -->
                <div class="content">
                