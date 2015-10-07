<? 

$this->css = '<link rel="stylesheet" href="/themes/startbootstrap/css/magnific-popup.css" />';
$this->js = '<script src="/themes/startbootstrap/js/jquery.magnific-popup.min.js"></script>';

$this->load->view('startbootstrap/common/header');

?>



<div class="container">
<br>
<a href="/news/" class="btn btn-default"><i class="fa fa-arrow-left"></i><span class="glyphicon glyphicon-chevron-left"></span> Вернуться к списку новостей</a>
<article class="inner_article">

<header><h1><?= $page['title']?></h1></header>

	<div class="row">
		<div class="col-md-2">
			<?
			if (!empty($page['img_ext'])
				&& file_exists($_SERVER['DOCUMENT_ROOT'].'/public/news/'.$page['id'].'_m'.$page['img_ext']))
				{
			?>

			<div class="album news-album" id="<?=$page['alias']?>">
				<div class="image-thumb">
					<a name="<?=$page['alias']?>" href="/public/news/<?= $page['id']?>_m<?= $page['img_ext']?>" title="">
						<img class="img-responsive" src="/public/news/<?= $page['id']?>_s<?= $page['img_ext']?>" alt="" class="img-responsive image-gallery" />
					</a>
				</div>
			</div>


		<?
		}
		?>
		</div>
		<div class="col-md-10">
			<div><?= $page['content']?></div>
		</div>
	</div>
</article>

<script>

$(document).ready(function(){
<?
echo "
		$('#".$page['alias']."').magnificPopup({
			delegate: 'a[name=".$page['alias']."]', 
			type: 'image',
			gallery:{enabled:true}
		});
	";
?>

});

</script>


<? $this->load->view('startbootstrap/common/footer')?>