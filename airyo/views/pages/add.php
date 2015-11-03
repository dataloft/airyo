<?

$this->js = '<script src="/themes/airyo/js/content.js"></script>';

$this->load->view('common/header')

?>

<div class="container">
    <? $this->load->view('common/notice')?>

    <h1 class="page-header"><?= $this->lang->line('module_title_pages')?></h1>
    
    <ul class="breadcrumb">
		<li><a href="/airyo/pages/"><?= $this->lang->line('module_title_pages')?></a></li>
		<li>Новая страница</li>
	</ul>
    
    <?php echo form_open_multipart("", 'name="add" id="pages" method="POST"');?>
        <div class="form-group <?php if (form_error('template')) echo 'has-error"'; ?>">
            <label for="template" class="control-label">Шаблон страницы</label>
            <select class="form-control" id="tpl" name="template">
                <? foreach ($page as $row) { ?>
                    <option value="<?=$row['view']?>"><?=$row['title']?></option>
                <?}?>
            </select>
        </div>
        <div class="form-group <?php if (form_error('content')) echo 'has-error"'; ?>">
            <label for="description" class="control-label">Html-код страницы</label>
            <textarea rows="20" id="content" name="content" class="form-control" placeholder=""></textarea>
        </div>
		<div class="form-group <?php if (form_error('h1')) echo 'has-error"'; ?>">
			<label for="h1" class="control-label">Название</label>
			<input type="text" class="form-control" id="h1" name="h1" placeholder="" >
		</div>
		<div class="form-group <?php if (form_error('alias')) echo 'has-error"'; ?>">
			<label for="alias" class="control-label">Адрес</label>
            <input type="text" class="form-control" id="alias" name="alias" placeholder="" >
		</div>
        <div class="checkbox">
            <label><input type="checkbox" id="enabled" name="enabled" value="1">Enabled</label>
        </div>
		<button type="submit" class="btn btn-success" style="float: left;">
            <?= $this->lang->line('save')?>
    <?php echo form_close();?>
    
</div>

<?$this->load->view('common/footer')?>