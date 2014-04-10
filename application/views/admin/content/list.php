<div class="container">
	<h1 class="page-header">Наполнение</h1>
	<div class="row">
        <form class="content-search" method="post">
		<div class="col-md-9 col-md-push-3" style="margin-bottom: 10px">

				<div class="input-group">
					<input type="text" class="form-control" value="<?=$search?>" name="search" placeholder="Поиск по тексту или адресу">
					<div class="input-group-btn">
						<button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
					</div>
				</div>

		</div>
		<div class="col-md-3 col-md-pull-9" style="margin-bottom: 10px">
				<select class="form-control" name="typeSelect" id="typeSelect" onchange="this.form.submit();">

                    <option value="">Все типы записей</option>
					<option value="Страницы" <? if ($type=='Страницы') echo 'selected'; ?>>Страницы</option>
					<option value="Новости" <? if ($type=='Новости') echo 'selected'; ?>>Новости</option>
					<option value="Фрагменты" <? if ($type=='Фрагменты') echo 'selected'; ?>>Фрагменты</option>
				</select>
		</div>
        </form>
	</div>
	<div class="row">
		<div class="col-md-12" style="margin-top: 20px">
			<p class="pull-right"><span class="glyphicon glyphicon-plus" style="color: #777"></span> <a href="/admin/content/edit" class="add">Создать</a></p>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<ul class="list-group">
                <?
                if (!empty($content))
                    foreach ($content as $row)
                    {
                ?>
        				<li class="list-group-item"><a href="/admin/content/edit/<?=$row['id']?>"><?=$row['h1']?></a></li>
		           <?}?>
			</ul>
		</div>
	</div>
</div>