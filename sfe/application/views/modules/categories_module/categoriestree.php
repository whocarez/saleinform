<?php
function ShowForest($forest)
{
        foreach ($forest as $tree)
        {
                echo '<ul class="bul" id="tree">';
                        echo '<li>'.anchor('/categories/c/'.$tree['rid'], $tree['name']);
                                ShowForest($tree['childNodes']);
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
								<?php echo $categories_table_show_all_title;?>
							</div>
						</div>
						<a class="hide" href="#" id="market_r" >#</a>
						<div class="b_c">
							<div class="o" id="market_c" style="">
								<div id="market_md" class="m_d">
								</div>
								<div style="text-align: right;">
									<?php
										echo anchor('/categories/sa', $categories_table_by_alph_title, array()); 
									?>
									| 
									<?php
										echo anchor('/categories/st', $categories_table_by_tree_title, array('style'=>"color: rgb(0, 0, 0);")); 
									?>
								</div>
								<div style="padding:3px 0;margin:4px 0;overflow:hidden;border:1px dashed #B1BFC7;border-left:0;border-right:0;border-bottom: 0;"></div>
								
								<div id="market_cnt" style="clear: both;">
									<div style="width: 49%;float: right;padding-left: 9px;">
										<?php ShowForest($categories_tree_list_2c)?>
									</div>
									<div style="width: 48%;float: left;">
										<?php ShowForest($categories_tree_list_1c)?>
									</div>
								</div>
							</div>
						</div>
					</div> 
