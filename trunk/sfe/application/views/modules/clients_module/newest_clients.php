<div class="nclients-block">
	<div class="nclients-header">
		<div class="nclients-right-corner"></div>
	</div>
	<div class="nclients-content">
		<h3><?=lang('CLIENTS_NEWEST_SHOPS');?></h3>
		<table class="zebra-table" cellpadding="0" cellspacing="0" border="0" >
			<tr>
				<th>
				</th>
				<th>
					<strong><?=lang('CLIENTS_NAME');?></strong>
				</th>
				<th>
					<strong><?=lang('CLIENTS_COUNTRY');?></strong>
				</th>
				<th>
					<strong><?=lang('CLIENTS_REGION');?></strong>
				</th>
				<!-- 
				<th width="">
					<strong><?=lang('CLIENTS_CATS');?></strong>
				</th>
				--> 
				<th>
				</th>
				
			</tr>
		
		<?foreach($clients_list as $client) { ?>
			<tr class="<?=alternator('rowEven', 'rowOdd')?>">
				<td>
					<?=img(array('src'=>$client->logo, 'alt'=>$client->name))?>
				</td>			
				<td>
					<?=$client->name?>
				</td>
				<td>
					<?=$client->country_name?>
				</td>
				<td>
					<?=$client->city_name?><br>
				</td>
				<!-- 
				<td>
					<?=$client->cats?>
				</td>
				--> 
				<td>
					<div class="btCalcR">
						<?=anchor('', lang('CLIENTS_DETAILS'), 'class="btCalcL"');?>
					</div>					
				</td>
				
			</tr>
		<? } ?>
		 
		</table>
		<br>
		<span class="link-more" style="padding-right: 10px;">
			<?=anchor('clients', lang('CLIENTS_SEEALL'));?>
		</span>
		<br> 
	</div>	
	<div class="nclients-bottom-border">
		<div class="nclients-footer-bar">
			<div class="nclients-bottom-right-corner"></div>
		</div>
	</div>	
</div>
					