<div class="container">
    <h1 class="page-header">Меню&nbsp;сайта</h1>
    <div class="row">
        <div class="col-md-3" style="margin-bottom: 10px">
            <form class="content-search" action="" method="post">
                <select class="form-control" name="typeSelect" id="typeSelect" onchange="this.form.submit();">

                    <?
                    foreach ($menu_list as $row)
                    {
                        ?>
                        <option value="<?=$row['id']?>"  <? if ($menu_group==$row['id']) echo 'selected'; ?>><?=$row['name']?></option>
                    <?}?>
                </select>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12" style="margin-top: 20px">
            <p class="pull-right"><span class="glyphicon glyphicon-plus" style="color: #777"></span> <a href="/admin/menu/add/<?=$menu_group?>" class="add">Добавить новый раздел</a></p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <ul class="list-group">
                <?
                if (!empty($content))
                    echo $content;
                ?>
            </ul>
        </div>
    </div>
</div>
