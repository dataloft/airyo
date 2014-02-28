<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>

    <!-- Bootstrap -->
    <link href="/i/css/bootstrap.min.css" rel="stylesheet">
    <link href="/i/css/bootstrap-airyo.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <div class="navbar navbar-default" role="navigation">
      <div class="container">
        <div class="navbar-header">
        
        <?if(isset($menu)):?>
        	 <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
         <?endif?>
            
          <a class="navbar-brand" href="/" target="_blank" style="margin-right: 20px"><span class="glyphicon glyphicon-edit"></span> testsite.ru</a>
         </div>
          
       
          <?if(isset($menu)):?>
          
          <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="/admin/content">Наполнение</a></li>
            <li><a href="/admin/menu">Меню</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Все модули <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="#">Модуль 1</a></li>
                <li><a href="#">Модуль 2</a></li>
                <li><a href="#">Модуль 3</a></li>
              </ul>
            </li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="#"><span class="glyphicon glyphicon-trash"></span> Корзина</a></li>
          </ul>
        </div><!--/.nav-collapse -->
        
        <?endif?>
        
      </div>
    </div>