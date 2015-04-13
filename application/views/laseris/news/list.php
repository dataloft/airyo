<?$this->load->view('laseris/common/header')?>
<article class="inner_article">
<header><h1>Новости</h1></header>

<ul class="news-list">
    <?
    if (!empty($news))
        foreach ($news as $row)
        {
    ?>
			<li>
				<a href="/news/<?=$row['alias']?>"><?=$row['title']?></a>
				<div><?=$row['anons']?></div>
				<small><?=$row['date']?></small>
			</li>
    <? } ?>
</ul>

<?= $this->pagination->create_links() ?>

</article>
<?$this->load->view('laseris/common/footer')?>