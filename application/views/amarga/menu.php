	<div id="templatemo_header">
    	<div style="text-align: center">
	         <a href="/seminar-shamanhealing"><img src="/themes/amarga/images/top_seminar_27june.gif"></a><br>
	         <a href="/go">Максимальная скидка действует до 10 мая 2014 года</a>
    	</div>
    	<div id="site_title"><h1>Ошо-группы с Ма Прем Амарга</h1></div>
    	<div class="cleaner"></div>
    </div> <!-- end of header -->
    
    <div id="templatemo_menu" class="ddsmoothmenu">
    	<div class="wrapper">
        <ul>
            <?
		    foreach ($menu as $punkt)
		    {
		    ?>
		    	<li><a href="<?=$punkt->url?>"><?=$punkt->name?></a></li>
		    <?
		    }
		    ?>
        </div>
        </ul>
    </div> <!-- end of templatemo_menu -->