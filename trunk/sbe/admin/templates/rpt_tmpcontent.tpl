<form id={$name} name={$name}>
<center>
<table width=100% border=0 cellspacing=5 cellpadding=1 bgcolor="white" style="">
<tr><td colspan=10 class="title">{$title}</td></tr>
{assign var="evt" value=""}
{assign var="i" value="0"}
{assign var="items_total" value="0"}
{foreach from=$table item=row}
{if $i == 0 }
	{assign var="i" value="1"}
	<tr>
		<td  width="30%">
			<b>{$row.bctrl__clients_name}</b>
		</td>
		<td  width="30%">
			<b>{$row.bctrl__cities_name}</b>
		</td>
		<td  width="30%">
			<b>{$row.bctrl__countries_name}</b>
		</td>
		<td  width="10%">
			<b>{$row.bctrl__itemsCount}</b>
		</td>
	</tr>
	<tr>
		<td colspan="4" style="border-top: 1px solid silver;">
		</td>
	</tr>
{else}
	{assign var="items_total" value=$items_total+$row.bctrl__itemsCount}
	<tr>
		<td>
			{$row.bctrl__clients_name}
		</td>
		<td>
			{$row.bctrl__cities_name}
		</td>
		<td>
			{$row.bctrl__countries_name}
		</td>
		<td  width="10%">
			{$row.bctrl__itemsCount}
		</td>
	</tr>
{/if}
{/foreach}
	<tr>
		<td colspan="3">
			<b>Всего не загружено</b>
		</td>
		<td width="10%">
			<b>{$items_total}</b>
		</td>
	</tr>
</table>
</center>
</form>
