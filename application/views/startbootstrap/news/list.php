<? $this->load->view('startbootstrap/common/header') ?>

<article class="inner_article">
	<div class="container">
		<br>
		<div class="row">
			<div class="col-lg-12">
				<div class="well text-center">
				<?= @$chunks['news_intro'] ?>
				</div>
			</div>
		</div>

	<header><h1>ЛЕНТА НОВОСТЕЙ</h1></header>

	<div class="row">
		<?
		if (!empty($news))
			foreach ($news as $row)
			{
		?>
				<div class="col-md-4">
					<?
					if (!empty($row['img_ext']) && file_exists($_SERVER['DOCUMENT_ROOT'].'/public/news/'.$row['id'].'_s'.$row['img_ext'])) {
						if (!empty($row['content'])) echo '<div class="album"><div class="image-thumb"><a href="/news/'.$row['alias'].'"><img class="img-responsive img-rounded" src="/public/news/'.$row['id'].'_s'.$row['img_ext'].'"></a></div></div>';
					}
					//echo '<span class="title">'.$row['title'].'</span>';
					?>
					<h3><?=$row['title']?></h3>
					<small class="date"><?=$row['date']?></small>
					<div class="anons"><?=$row['anons']?></div>

					<?
					if (!empty($row['content'])) echo '<a href="/news/'.$row['alias'].'" class="btn btn-default">Читать далее</a>';

					?>



				</div>
		<? } ?>
	</div>

	<div style="clear: both;"></div>

	<?= $this->pagination->create_links() ?>
	</div>
</article>

<? $this->load->view('startbootstrap/common/footer') ?>