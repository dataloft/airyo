	<div id="layout">
		<div id="r">
			<h1><?=$page->h1?></h1>
			<?=$page->content?>
			<div id="ftr">
				Airyo 2014
			</div>
		</div>
		<div id="l">
			<div id="airyo"><a href="/">Airyo</a></div>
			<?$this->load->view('menu')?>
		</div>
	</div>