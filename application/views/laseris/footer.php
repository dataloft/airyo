
                </div>
                <!-- /content -->
                <!-- side -->
                <div class="side">
                    <nav class="side_menu">
                    
                    	<?php /*?><ul>
<?
if(is_array($menu) && count($menu)){
foreach ($menu as $item)
{

?>
	<li <? echo (($this->uri->uri_string() == $item['url'] or current_url() == $item['url']) ) ? 'class="active"' : ''; ?>>
    	<a href="<?=$item['url']?>"><?=$item['name']?></a>
        <?
        if(is_array($item['childs']) && count($item['childs'])){
		?>
        <ul>
        <?
			foreach($item['childs'] as $childitem){
			?>
            <li><a href="<?=$childitem['url']?>"><?=$childitem['name']?></a></li>
            <?
			}
		?>
        </ul>
        <?
		}
		?>
    </li>
<?
}
}
?>                    
                    	</ul><?php */?>
<?

function printmenutree($menu, $step=1, $parents=array()){
	//$CI =& get_instance();
	global $CI;
	$returning = '';
	if(!is_array($menu) || !count($menu)) return $returning;
	$returning .= '<ul>';
	foreach ($menu as $item){
		if($item['parent_id']==0){
			$parents = $CI->menu_model->getChildsLinksArray($item['id'], 1);
			
		}
		$class='';
		if($CI->uri->uri_string() == $item['url'] or current_url() == $item['url']) $class='class="active"';
		if(substr($item['url'], 0, 1)=='/') $item['url'] = substr($item['url'], 1);
		$returning .= '<li '.$class.'><a href="/'.$item['url'].'">'.$item['name'].'</a>';
		//if($CI->uri->uri_string() == $item['url']) $returning .= '->';
		/*if(is_array($item['childs']) && count($item['childs'])){
			$step++;
			if($step<=3){
				$returning .= printmenutree($item['childs'], $step, $parents);
			}else{
				if(isset($parents[$CI->uri->uri_string()])){
					$returning .= printmenutree($item['childs'], $step, $parents);
				}
			}
			$step--;
		}*/
		$returning .= printmenutree($item['childs'], $step, $parents);
		$returning .= '</li>';
	}
	$returning .= '</ul>';
	return $returning;
}
?>
 					<?
                    if($menu) echo printmenutree($menu, 1);
					?>
                    
                        <?php /*?><ul>
                            <li>
                                <a href="">Новости</a>
                                <ul>
                                    <li><a href="">Вакансии и кадры</a>
                                    </li>
                                    <li><a href="">Выставки</a>
                                    </li>
                                    <li><a href="">Конференции</a>
                                    </li>
                                    <li><a href="">Семинары</a>
                                    </li>
                                    <li><a href="">ЛТО и ЛГ</a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="">Информация</a>
                                <ul>
                                    <li><a href="">Аналитические обзоры</a>
                                    </li>
                                    <li><a href="">Библиография</a>
                                    </li>
                                    <li><a href="">Лазерные технологии (ЛТ)</a>
                                    </li>
                                    <li><a href="">Лазерное технологическое оборудование (ЛТО)</a>
                                    </li>
                                    <li><a href="">Рынок ЛТО и ЛТ</a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="">История</a>
                                <ul>
                                    <li><a href="">Благодарности и награды</a>
                                    </li>
                                    <li><a href="">Достижения</a>
                                    </li>
                                    <li><a href="">Изобретения и патенты</a>
                                    </li>
                                    <li><a href="">Партнеры и заказчики</a>
                                    </li>
                                    <li><a href="">Фотогалерея</a>
                                    </li>
                                </ul>
                            </li>
                            <li><a href="">ЛРСЗЦ</a></li>
                        </ul><?php */?>
                    </nav>
                </div>
                <!-- /side -->
            </div>
            <!-- /page -->
            <div class="empty"></div>
        </div>
        </div>
        <!-- /wrap -->
        <!-- footer -->
        <footer class="footer">
            <div class="inner">
                <div class="copy">
                    &copy; ЛазерИнформСервис, 1992-2015
                    <br>&copy; Игнатов А.Г., 1982-2015
                </div>
                <div class="logos">
                    <img src="/themes/laseris/img/main/logos.png" alt="">
                </div>
            </div>
        </footer>
        <!-- /footer -->
        
<?
if (!empty($counters))
    echo $counters->text;
?>

<?
if (!empty($scripts))
    foreach ($scripts as $script) {
?>
<script src="<?=$script?>"></script>
<?
    }
?>
        
    </body>

</html>