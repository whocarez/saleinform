<form id={$name} name={$name}>
<table cellspacing=2 cellpadding=0><tr>
{foreach item=btn from=$toolbar}
  <td>{$btn}</td>
{/foreach}
<td><div id='{$name}.load_disp' style="display:none"><img src="../images/indicator.white.gif"/></div></td>
</tr></table>
<center>
<table width=100% border=0 cellspacing=5 cellpadding=1 bgcolor="white" style="">
<tr><td colspan=10 class="title">{$title}</td></tr>
{assign var="evt" value=""}
{assign var="i" value="0"}
{assign var="num" value="0"}
{assign var="currCountry" value=""}
{assign var="items_total" value="0"}
{foreach from=$table item=row}
{if $i == 0 }
	{assign var="i" value="1"}
	<tr>
		<td  width="5%">
			<b>№</b>
		</td>
		<td  width="30%">
			<b>{$row.bctrl__clients_name}</b>
		</td>
		<td  width="30%">
			<b>{$row.bctrl__cities_name}</b>
		</td>
		<td  width="25%">
			<b>{$row.bctrl__countries_name}</b>
		</td>
		<td  width="10%">
			<b>{$row.bctrl__itemsCount}</b>
		</td>
	</tr>
	<tr>
		<td colspan="5" style="border-top: 1px solid silver;">
		</td>
	</tr>
{else}
	{assign var="items_total" value=$items_total+$row.bctrl__itemsCount}
	{assign var="num" value=$num+1}
	<tr>
		<td>
			{$num}
		</td>
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
		<td colspan="4">
			<b>Всего загружено</b>
		</td>
		<td width="10%">
			<b>{$items_total}</b>
		</td>
	</tr>
</table>
</center>
</form>
