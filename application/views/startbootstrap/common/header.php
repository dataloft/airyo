<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?= @$page['title']?></title>

    <!-- Bootstrap core CSS -->
    <link href="/themes/startbootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Add custom CSS here -->
    <link href="/themes/startbootstrap/css/custom.css" rel="stylesheet">
    
    <!--<link href="/themes/startbootstrap/css/all/one-page-wonder.css" rel="stylesheet">
    <link href="/themes/startbootstrap/css/all/business-frontpage.css" rel="stylesheet">-->
    
    <?= @$this->css?>
    
    <!-- JavaScript -->
    <script src="/themes/startbootstrap/js/jquery-1.10.2.js"></script>
    <script src="/themes/startbootstrap/js/bootstrap.js"></script>
    <?= @$this->js?>
    
</head>

<body>

	<nav class="navbar navbar-fixed-top navbar-inverse" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/">Project name</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav">
                <?
			    foreach ($menu as $item)
			    {

			    ?>
			    	<li <? echo (($this->uri->uri_string() == $item->url or current_url() == $item->url) ) ? 'class="active"' : ''; ?>><a href="<?=$item->url?>"><?=$item->name?></a></li>
			    <?
			    }
			    ?>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>