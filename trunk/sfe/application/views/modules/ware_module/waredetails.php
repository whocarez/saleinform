<?php
function ShowWareDetails($forest)
{
        foreach ($forest as $tree)
        {
			if(!count($tree['childNodes']) && !$tree['value']) continue;
			echo '<tr>';
			if (count($tree['childNodes']))
			{
				$empty = true;
				foreach($tree['childNodes'] as $ch)
				{ 
					if($ch['value']) 
					{
						$empty = false;
						echo '<td colspan="2" style="font-size:8pt;"><span><strong>'.$tree['name'].'</strong></span></td>';
						break;
					} 
				}   
			}
			else
			{
				if($tree['value']) echo '<td  width="50%" style="font-size:8pt;">&nbsp;&nbsp;&nbsp;&nbsp;'.$tree['name'].'</td><td width="50%"><font style="color:#888888; font-size: 8pt;">'.$tree['value'].'</font></td>';
			}
			#echo (count($tree['childNodes']))?'<td colspan="2" style="border-bottom: 1px dashed black;"><span><strong>'.$tree['name'].'</strong></span></td>':'<td  width="70%">&nbsp;&nbsp;&nbsp;&nbsp;'.$tree['name'].'</td><td width="30%"><font style="color:#888888; font-size: 8pt;">'.$tree['value'].'</font></td>';
			ShowWareDetails($tree['childNodes']);
			echo '</tr>';
        }
} 
?>
	<div class="box">
		<div class="b_h">
			<a href="<?php echo $ware_offers_reviews_link?>" id="news_3" class="rCG" >
				<span id="news_3text"><?php echo $ware_reviews_info_tab_title?></span>
			</a>
			<a href="<?php echo $ware_offers_opinions_link?>" id="news_2" class="rCG">
				<span id="news_2text"><?php echo $ware_users_opinions_tab_title;?></span>
			</a>
			<a href="<?php echo $ware_offers_detailed_link?>" id="news_1" class="rC">
				<span id="news_1text"><?php echo $ware_detailed_info_tab_title?></span>
			</a>
			<a href="<?php echo $ware_offers_offers_link?>" id="news_0" class="rCG" >
				<span id="news_0text"><?php echo $ware_compare_prices_tab_title?></span>
			</a>
			<div id="hc_news" class="b_hc" >
				<?php echo $ware_offers_header_warename?>
			</div>
		</div>
			<div class="b_c">
				<div class="o" id="news_c" style="">
					<div id="news_cnt">
						<div style="padding: 5px;" id="themes_cnt">
								<?php echo $ware_offers_header;?>
							<div class="n_fb">
								<table style="font-size: 100%;">
								<?php if(!$ware_offers_details_flag) ShowWareDetails($ware_offers_details_forest);else echo $ware_offers_details_noinformation;?>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>