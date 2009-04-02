<div id="Node_BreadCrumb" class="breadCrumb2-US">
	<?=anchor(index_page(), lang('CLIENTS_HOME'), 'title="'.lang('CLIENTS_HOME').'"')?>
	<span class="grey">></span>
	<?=anchor('clients', lang('CLIENTS_STORES_BREADCRUMB'), 'title="'.lang('CLIENTS_STORES_BREADCRUMB').'"')?>
	<span class="grey">></span>
	<span class="greyb">
		<?=lang('CLIENTS_ALL_PRODUCTS')?><?=$client->name?>
	</span>
</div>
<div class="client-categories">
<h3><?=lang('CLIENTS_ALL_PRODUCTS')?><?=$client->name?></h3>
<?=sprintf(lang('CLIENTS_PRODUCTS_DESCR'), count($result))?>
<table class="client-products" width="100%" cellspacing="1" cellpadding="6">
	<?foreach($result as $key=>$row) { ?>
	<?if(($key+1)%2===0) { ?>
		<td><?=anchor('category/'.$row->rid.'-'.$row->slug, $row->name, 'title="'.$row->name.'"')?><span class="subgrey">(<?=$row->offers_quan?>)</span></td></tr>	
	<? } else { ?>
		<tr bgcolor="white"><td><?=anchor('category/'.$row->rid.'-'.$row->slug, $row->name, 'title="'.$row->name.'"')?><span class="subgrey">(<?=$row->offers_quan?>)</span></td>
	<? } ?>
	<? } ?>
</table>
</div>