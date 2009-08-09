<div>
<h3><?=lang('TOURS_HISTORY')?></h3>
<table>
	<thead>
		<tr>
			<th>
				Id
			</th>
			<th>
				<?=lang('DATE_DOC')?>
			</th>
			<th>
				<?=lang('CLIENT_L_NAME')?>
			</th>
			<th>
				<?=lang('COUNTRY')?>
			</th>
			<th>
				<?=lang('SUM')?>
			</th>
			<th>
				<?=lang('DATE_FROM')?>
			</th>
			<th>
				<?=lang('OWNER')?>
			</th>
			<th>
				<?=lang('ANULATED')?>
			</th>
			<th>
				<?=lang('ARCHIVE')?>
			</th>
			<th>
				<?=lang('MODIFYDT')?>
			</th>
		</tr>
	</thead>
	<?foreach($ds_tours as$r) { ?>
	<tr>
		<td>	
			<?=$r->rid?>
		</td>
		<td>
			<?=$r->date_doc?>
		</td>
		<td>
			<?=$r->client_name?>
		</td>
		<td>
			<?=$r->country_name?>
		</td>
		<td>
			<?=$r->sum?>
		</td>
		<td>
			<?=$r->date_from?>
		</td>
		<td>
			<?=$r->emp_name?>
		</td>
		<td>
			<?=get_valtype($r->anulated, 'yes_no')?>
		</td>
		<td>
			<?=get_valtype($r->archive, 'yes_no')?>
		</td>
		<td>
			<?=$r->modifyDT?>
		</td>
	</tr>
	<? } ?>
</table>
<h3><?=lang('AIRS_HISTORY')?></h3>
<table>
	<thead>
		<tr>
			<th>
				Id
			</th>
			<th>
				<?=lang('DATE_DOC')?>
			</th>
			<th>
				<?=lang('CLIENT_L_NAME')?>
			</th>
			<th>
				<?=lang('DNUM')?>
			</th>
			<th>
				<?=lang('BILL_CODE')?>
			</th>
			<th>
				<?=lang('BILL_NUM')?>
			</th>
			<th>
				<?=lang('SUM')?>
			</th>
			<th>
				<?=lang('OWNER')?>
			</th>
			<th>
				<?=lang('ANULATED')?>
			</th>
			<th>
				<?=lang('ARCHIVE')?>
			</th>
			<th>
				<?=lang('MODIFYDT')?>
			</th>
		</tr>
	</thead>
	<?foreach($ds_airs as$r) { ?>
	<tr>
		<td>	
			<?=$r->rid?>
		</td>
		<td>
			<?=$r->date_doc?>
		</td>
		<td>
			<?=$r->client_name?>
		</td>
		<td>
			<?=$r->dnum?>
		</td>
		<td>
			<?=$r->bill_code?>
		</td>
		<td>
			<?=$r->bill_num?>
		</td>
		<td>
			<?=$r->sum?>
		</td>
		<td>
			<?=$r->emp_name?>
		</td>
		<td>
			<?=get_valtype($r->anulated, 'yes_no')?>
		</td>
		<td>
			<?=get_valtype($r->archive, 'yes_no')?>
		</td>
		<td>
			<?=$r->modifyDT?>
		</td>
	</tr>
	<? } ?>
</table>
</div>
