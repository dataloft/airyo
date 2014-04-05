<div class="header">
<ul class="nav nav-pills pull-right">
    <?
    foreach ($menu as $punkt)
    {
    ?>
  <li><a href="<?=$punkt->url?>"><?=$punkt->name?></a></li>
    <?
    }
    ?>
 </ul>
<h3 class="text-muted">Airyo</h3>
</div>