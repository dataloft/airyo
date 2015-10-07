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

		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">ЛЕНТА НОВОСТЕЙ
				</h1>
			</div>
		</div>


		<?
		if (!empty($news))
			foreach ($news as $row)
			{
		?>
		<div class="row">
				<div class="col-md-2">
					<h3></h3>
					<?
					if (!empty($row['img_ext']) && file_exists($_SERVER['DOCUMENT_ROOT'].'/public/news/'.$row['id'].'_s'.$row['img_ext'])) {
						if (!empty($row['content'])) echo '<a href="/news/'.$row['alias'].'"><img class="img-responsive" src="/public/news/'.$row['id'].'_s'.$row['img_ext'].'" alt=""></a>';
						//if (!empty($row['content'])) echo '<div class="album"><div class="image-thumb"><a href="/news/'.$row['alias'].'"><img class="img-responsive" src="/public/news/'.$row['id'].'_s'.$row['img_ext'].'" alt=""></a></div></div>';
					}
					//echo '<span class="title">'.$row['title'].'</span>';
					?>
				</div>
				<div class="col-md-10">
					<h3><?=$row['title']?></h3>
					<h4><small class="date"><?=$row['date']?></small></h4>
					<p></p><div class="anons"><?=$row['anons']?></div></p>

					<?
					if (!empty($row['content'])) echo '<a href="/news/'.$row['alias'].'" class="btn btn-default">Читать далее<span class="glyphicon glyphicon-chevron-right"></span></a>';

					?>

				</div>

		</div>
				<hr>
		<? } ?>


	<div style="clear: both;"></div>

	<?= $this->pagination->create_links() ?>
	</div>
</article>

<? $this->load->view('startbootstrap/common/footer') ?>