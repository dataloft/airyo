	<div id="layout">
		<div id="r">
			<h1><?=$page->h1?></h1>
			<?=$page->content?>
			<div id="ftr">
				Dataloft 2013
			</div>
		</div>
		<div id="l">
			<div id="dataloft"><a href="/">Dataloft</a></div>
			<?$this->load->view('menu')?>
		</div>
	</div>