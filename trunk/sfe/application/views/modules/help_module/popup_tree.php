<?php
function ShowCatTree($forest)
{
        foreach ($forest as $tree)
        {
                echo '<ul class="bul" id="tree">';
                        echo '<li>'.$tree['name'].' (id='.$tree['rid'].')';
                                ShowCatTree($tree['childNodes']);
                        echo '</li>';
                echo '</ul>';
                if(!$tree['_categories_rid']) 
        	  	echo '<div style="padding:3px 0;margin:4px 0;overflow:hidden;border:1px dashed #B1BFC7;border-left:0;border-right:0;border-bottom: 0;"></div>';
        }
} 
?>
					<div class="box">
						<div class="b_h">
							<div id="hc_market" class="b_hc" >
								<?php echo $help_module_area_title?>
							</div>
						</div>
						<div class="b_c">
							<div class="o" id="market_c" style="">
								<div id="market_cnt">
									<?php ShowCatTree($help_module_area_content)?><br>
								</div>
							</div>
							<div>
							
							</div>
						</div>
					</div> 
