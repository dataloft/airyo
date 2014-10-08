<?php
/**
 * Created by PhpStorm.
 * User: N.Kulchinskiy
 * Date: 07.10.14
 * Time: 22:30
 */
?>
<div class="container">
	<div class="row" id="links">
		<h1 class="page-header">Галерея</h1>

		<ol class="breadcrumb">
			<li><a href="#">Галерея</a></li>
			<li><a href="#">Library</a></li>
			<li class="active">Data</li>
			<li class="un-styled pull-right"><a href="" class="pull-right" data-toggle="modal" data-target="#createAlbumModal">Создать альбом</a></li>
		</ol>

		<div class="col-lg-3 col-md-4 col-xs-6 thumb">
			<a class="thumbnail" href="http://www.arscolors.in/uploaded_files/product/30-big2.jpg" title="Фотографии автомобилей" data-gallery="">
				<img src="http://www.arscolors.in/uploaded_files/product/30-big2.jpg">
				<div class="photo-album-title">
					<p class="photo-title pull-left">Фотографии автомобилей</p>
					<span class="pull-right"><i class="glyphicon glyphicon-camera"></i> 12</span>
				</div>
			</a>
		</div>
		<div class="col-lg-3 col-md-4 col-xs-6 thumb">
			<a class="thumbnail" href="http://kopanausobi.sweb.cz/Motocykly/slides/suzuki-gsx-r1000-400x300.jpg" title="Фотографии мотоциклов" data-gallery="">
				<img src="http://kopanausobi.sweb.cz/Motocykly/slides/suzuki-gsx-r1000-400x300.jpg">
				<div class="photo-album-title">
					<p class="photo-title pull-left">Фотографии мотоциклов</p>
					<span class="pull-right"><i class="glyphicon glyphicon-camera"></i> 13</span>
				</div>
			</a>
		</div>
		<div class="col-lg-3 col-md-4 col-xs-6 thumb">
			<a class="thumbnail" href="#">
				<img class="img-responsive" src="http://placehold.it/400x300" alt="">
			</a>
		</div>
		<div class="col-lg-3 col-md-4 col-xs-6 thumb">
			<a class="thumbnail" href="#">
				<img class="img-responsive" src="http://placehold.it/400x300" alt="">
			</a>
		</div>
		<div class="col-lg-3 col-md-4 col-xs-6 thumb">
			<a class="thumbnail" href="#">
				<img class="img-responsive" src="http://placehold.it/400x300" alt="">
			</a>
		</div>
		<div class="col-lg-3 col-md-4 col-xs-6 thumb">
			<a class="thumbnail" href="#">
				<img class="img-responsive" src="http://placehold.it/400x300" alt="">
			</a>
		</div>
		<div class="col-lg-3 col-md-4 col-xs-6 thumb">
			<a class="thumbnail" href="#">
				<img class="img-responsive" src="http://placehold.it/400x300" alt="">
			</a>
		</div>
		<div class="col-lg-3 col-md-4 col-xs-6 thumb">
			<a class="thumbnail" href="#">
				<img class="img-responsive" src="http://placehold.it/400x300" alt="">
			</a>
		</div>
		<div class="col-lg-3 col-md-4 col-xs-6 thumb">
			<a class="thumbnail" href="#">
				<img class="img-responsive" src="http://placehold.it/400x300" alt="">
			</a>
		</div>
		<div class="col-lg-3 col-md-4 col-xs-6 thumb">
			<a class="thumbnail" href="#">
				<img class="img-responsive" src="http://placehold.it/400x300" alt="">
			</a>
		</div>
		<div class="col-lg-3 col-md-4 col-xs-6 thumb">
			<a class="thumbnail" href="#">
				<img class="img-responsive" src="http://placehold.it/400x300" alt="">
			</a>
		</div>
		<div class="col-lg-3 col-md-4 col-xs-6 thumb">
			<a class="thumbnail" href="#">
				<img class="img-responsive" src="http://placehold.it/400x300" alt="">
			</a>
		</div>
	</div>
</div>
<!-- The Bootstrap Image Gallery lightbox, should be a child element of the document body -->
<div id="blueimp-gallery" class="blueimp-gallery">
	<!-- The container for the modal slides -->
	<div class="slides"></div>
	<!-- Controls for the borderless lightbox -->
	<h3 class="title"></h3>
	<a class="prev">‹</a>
	<a class="next">›</a>
	<a class="close">×</a>
	<a class="play-pause"></a>
	<ol class="indicator"></ol>
	<!-- The modal dialog, which will be used to wrap the lightbox content -->
	<div class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" aria-hidden="true">&times;</button>
					<h4 class="modal-title"></h4>
				</div>
				<div class="modal-body next"></div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default pull-left prev">
						<i class="glyphicon glyphicon-chevron-left"></i>
						Previous
					</button>
					<button type="button" class="btn btn-primary next">
						Next
						<i class="glyphicon glyphicon-chevron-right"></i>
					</button>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="createAlbumModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title" id="myModalLabel">Создать альбом</h4>
			</div>
			<div class="modal-body">
				...
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary">Создать альбом</button>
			</div>
		</div>
	</div>
</div>