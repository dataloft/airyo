<?$this->load->view('laseris/common/header')?>

<article class="inner_article">

<?= @$chunks['news_intro'] ?>

<header><h1>ЛЕНТА НОВОСТЕЙ</h1></header>

<ul class="news-list">
    <?
    if (!empty($news))
        foreach ($news as $row)
        {
    ?>
			<li>
				<? 
				if (!empty($row['img_ext']) && file_exists($_SERVER['DOCUMENT_ROOT'].'/public/news/'.$row['id'].'_s'.$row['img_ext'])) {
					if (!empty($row['content'])) echo '<div class="album"><div class="image-thumb"><a href="/news/'.$row['alias'].'"><img src="/public/news/'.$row['id'].'_s'.$row['img_ext'].'"></a></div></div>';
				}
				
				if (!empty($row['content'])) echo '<a href="/news/'.$row['alias'].'" class="title">'.$row['title'].'</a>';
					else echo '<span class="title">'.$row['title'].'</span>';
				?>
				
				<small class="date"><?=$row['date']?></small>
				<div class="anons"><?=$row['anons']?></div>
			</li>
    <? } ?>
</ul>

<div style="clear: both;"></div>

<?= $this->pagination->create_links() ?>

</article>

<?$this->load->view('laseris/common/footer')?>