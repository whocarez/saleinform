<?php /* Smarty version 2.6.10, created on 2007-07-05 21:15:28
         compiled from menucurrency/rightpanel.tpl */ ?>
<table width="100%">
<tr>
   	<td valign="top">
	    <div class="info"><a class="info" href="controller.php?view=admin.yelowpages.currency.BVcurrency">СПРАВОЧНИК ВАЛЮТ</a></div>
   		<p>Справочник валют. Является одним из главных справочников. Содержит наименования валют. Имеет связи со многими справочниками системы.
		Должен заполнятся одним из первых.
   		</p>
   	</td>
	<td width="50%" valign="top">	
	    <div class="info"><a class="info" href="controller.php?view=admin.yelowpages.officialcources.BVofficialcources">ОФФИЦИАЛЬНЫЕ КУРСЫ ВАЛЮТ</a></div>
   		<p>Справочник оффициальных курсов валют. Содержит данные об оффициальных курсах валют. Работает используя специальные сервисы.	
   		</p>
   	</td>
</tr>
<tr>
   	<td valign="top">
	    <div class="info"><a class="info" href="controller.php?view=admin.yelowpages.currcources.BVcurrcources">КУРСЫ ВАЛЮТ КЛИЕНТОВ</a></div>
   		<p>
   		Справочник клиентских курсов валют. Является основным справочником для пересчета цен в разных валютах для 
   		клиентского прайса. Если эти курсы отсутствуют, то будет браться текущий официальный курс валют.
   		</p>
   	</td>
	<td width="50%" valign="top">	
   	</td>
</tr>
</table>   		                        
	