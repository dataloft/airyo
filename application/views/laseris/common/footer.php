				</div>
                <!-- /content -->
                <!-- side -->
                <div class="side">
                    <nav class="side_menu">
					
						<?
						
						//var_dump($menu);
						
						function printmenutree($menu, $step=1, $parents=array()){
							//$CI =& get_instance();
							//global $CI;
							
							$returning = '';
							
							if (!is_array($menu) || !count($menu)) return $returning;
							
							$returning .= '<ul>';
							
							foreach ($menu as $item){
								//if($item['parent_id']==0){
								//	$parents = $CI->menu_model->getChildsLinksArray($item['id'], 1);
									
								//}
								//$class='';
								//if($CI->uri->uri_string() == $item['url'] or current_url() == $item['url']) $class='class="active"';
								//if(substr($item['url'], 0, 1)=='/') $item['url'] = substr($item['url'], 1);
								$returning .= '<li '.@$class.'><a href="/'.$item['url'].'">'.$item['name'].'</a>';
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
	
	                    if ($menu) echo printmenutree($menu, 1);
						
					?>

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
		if (isset($albums) || isset($images)) echo '<script src="/themes/laseris/js/jquery.magnific-popup.min.js"></script>';
		?>

		<? if (!empty($counters)) echo $counters->text; ?>
        
    </body>

</html>