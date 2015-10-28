<? $this->load->view('startbootstrap/common/header') ?>

<!-- Header Carousel -->

<? if(0){ foreach($sliders as $key => $value) : ?>
	<header id="myCarousel<?=$value['id']?>" class="carousel slide">
	
		<!-- Indicators -->
		<ol class="carousel-indicators">
			<? foreach($value['slide'] as $k => $v) : ?>
				<li data-target="#myCarousel<?=$value['id']?>" data-slide-to="<?=$v['order']?>"></li>
			<? endforeach; ?>
		</ol>

		<!-- Wrapper for slides -->
		<div class="carousel-inner">
			<? foreach($value['slide'] as $k => $v) : ?>
				<div class="item">
					<div class="fill" style="background-image:url('/public/sliders/a<?=rand(1,11)?>.jpg');"></div>
					<div class="carousel-caption">
						<h2><?=$v['title']?></h2>
					</div>
				</div>
		    <? endforeach; ?>
		</div>

		<!-- Controls -->
		<a class="left carousel-control" href="#myCarousel<?=$value['id']?>" data-slide="prev">
			<span class="icon-prev"></span>
		</a>
		<a class="right carousel-control" href="#myCarousel<?=$value['id']?>" data-slide="next">
			<span class="icon-next"></span>
		</a>
	</header>
<? endforeach; } ?>


<!-- Page Content -->
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <?=html_entity_decode($page['content'])?>
        </div>
    </div>
</div>

<script>
	$(document).ready(function(){
		$('.item:nth-of-type(1)').addClass('active');
		$('.carousel-indicators li:nth-of-type(1)').addClass('active');
	});
</script>
    
<? $this->load->view('startbootstrap/common/footer') ?>