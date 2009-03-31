<?php
function ShowWareDetails($forest)
{
        foreach ($forest as $tree)
        {
			echo '<tr>';
			$values = '';
			foreach($tree['valuesARR'] as $item) $values .= '<td width="150px" nowrap style="border-left:1px solid #F7F6F2;"><font style="color:#888888; font-size: 8pt;">'.(($item)?$item:'&nbsp;').'</font></td>';
			echo (count($tree['childNodes']))?'<td colspan="99" style="border-bottom: 1px dashed black;border-top: 1px dashed black;background-color: #F7F6F2;"><span><strong>'.$tree['name'].'</strong></span></td>':'<td  width="200px" nowrap>&nbsp;&nbsp;&nbsp;&nbsp;<font  style="font-size: 8pt;">'.$tree['name'].'</font></td>'.$values;
			ShowWareDetails($tree['childNodes']);
			echo '</tr>';
        }
} 
?>
<script type="text/javascript">
	YAHOO.example.init = function() 
	{   
	   var anim = new YAHOO.util.Scroll('compare_fr', { scroll: { by: [100, 0] } });
   		YAHOO.util.Event.on(document, 'click', anim.animate, anim, true);
	};
	YAHOO.util.Event.onAvailable('compare_fr', YAHOO.example.init);
</script>

	<div class="box">
		<div class="b_h">
			<div id="hc_market" class="b_hc" >
				<?php echo $ware_compare_wares_title;?>
			</div>
		</div>
	
		<div class="b_c">
			<div class="o" id="chat_c" style="">
				<div id="chat_md" class="m_d">
				</div>
				<div class="n_fb" id="compare_fr" style="overflow: auto;">
					<!--  <iframe>  -->
					<table style="font-size: 100%;" cellspacing="0" cellpadding="3">
						<tr>
							<?php foreach($ware_compare_datas_arr['T_image'] as $key=>$item) { ?>	
								<?php if($key=='0') { ?>
									<td width="200px" nowrap>
										&nbsp;&nbsp;&nbsp;&nbsp;<strong><?php echo $item;?></strong>
									</td>
								<?php } else { ?>
									<td  width="150px" nowrap>
										<?php if($item){?>
											<img src="<?php echo $item?>" align="left" hspace="2" vspace="2" border="0" >
										<?php } else echo '&nbsp;'?>
									</td>
								<?php } ?>
							<?php } unset($ware_compare_datas_arr['T_image']);?>	
						</tr>
						<tr>
							<?php foreach($ware_compare_datas_arr['T_name'] as $key=>$item) { ?>	
								<?php if($key=='0') { ?>
									<td style="background-color: #F7F6F2;" nowrap>
										&nbsp;&nbsp;&nbsp;&nbsp;<strong><?php echo $item;?></strong>
									</td>
								<?php } else { ?>
									<td style="background-color: #F7F6F2;" nowrap>
										<font style="color:#888888; font-size: 8pt;">
										<?php echo $item?>
										</font>
									</td>
								<?php } ?>
							<?php } unset($ware_compare_datas_arr['T_name']);?>	
						</tr>
						<tr>
							<?php foreach($ware_compare_datas_arr['T_prtype'] as $key=>$item) { ?>	
								<?php if($key=='0') { ?>
									<td style="background-color: #F7F6F2;" nowrap>
										&nbsp;&nbsp;&nbsp;&nbsp;<strong><?php echo $item;?></strong>
									</td>
								<?php } else { ?>
									<td style="background-color: #F7F6F2;" nowrap>
										<font style="color:#888888; font-size: 8pt;">
										<?php echo $item?>
										</font>
									</td>
								<?php } ?>
							<?php } unset($ware_compare_datas_arr['T_prtype']);?>	
						</tr>
						<tr>
							<?php foreach($ware_compare_datas_arr['T_prrange'] as $key=>$item) { ?>	
								<?php if($key=='0') { ?>
									<td style="background-color: #F7F6F2;" nowrap>
										&nbsp;&nbsp;&nbsp;&nbsp;<strong><?php echo $item;?></strong>
									</td>
								<?php } else { ?>
									<td style="background-color: #F7F6F2;" nowrap>
										<font style="color:#888888; font-size: 8pt;">
										<?php echo $item?>
										</font>
									</td>
								<?php } ?>
							<?php } unset($ware_compare_datas_arr['T_prrange']);?>	
						</tr>
						<tr>
							<?php foreach($ware_compare_datas_arr['T_rating'] as $key=>$item) { ?>	
								<?php if($key=='0') { ?>
									<td style="background-color: #F7F6F2;" nowrap>
										&nbsp;&nbsp;&nbsp;&nbsp;<strong><?php echo $item;?></strong>
									</td>
								<?php } else { ?>
									<td style="background-color: #F7F6F2;" nowrap>
										<font style="color:#888888; font-size: 8pt;">
										<?php echo $item?>
										</font>
									</td>
								<?php } ?>
							<?php } unset($ware_compare_datas_arr['T_rating']);?>	
						</tr>
						<tr>
							<?php foreach($ware_compare_datas_arr['T_reviews'] as $key=>$item) { ?>	
								<?php if($key=='0') { ?>
									<td style="background-color: #F7F6F2;" nowrap>
										&nbsp;&nbsp;&nbsp;&nbsp;<strong><?php echo $item;?></strong>
									</td>
								<?php } else { ?>
									<td style="background-color: #F7F6F2;" nowrap>
										<font style="color:#888888; font-size: 8pt;">
										<?php echo $item?>
										</font>
									</td>
								<?php } ?>
							<?php } unset($ware_compare_datas_arr['T_reviews']);?>	
						</tr>
					<?php ShowWareDetails($ware_compare_datas_arr['DATAS']);?>
					</table>
					<!-- </iframe>  -->
				</div>
			</div>
		</div>
	</div>

