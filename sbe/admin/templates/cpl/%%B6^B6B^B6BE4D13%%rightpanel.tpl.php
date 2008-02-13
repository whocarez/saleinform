<?php /* Smarty version 2.6.10, created on 2007-04-26 12:15:06
         compiled from menugeography/rightpanel.tpl */ ?>

<table width="100%">
<tr>
   	<td valign="top">
	    <div class="info"><a class="info" href="controller.php?view=admin.yelowpages.countries.BVcountries">СТРАНЫ</a></div>
   		<p>Справочник стран. В иерархии данного раздела занимает главное место. Независим от других справочников данного раздела.
		Имеет зависимость от справочника валют.
   		</p>
   	</td>
	<td width="50%" valign="top">	
	    <div class="info"><a class="info" href="controller.php?view=admin.yelowpages.regions.BVregions">РЕГИОНЫ</a></div>
   		<p>Справочник регионов. Содержит регионы по странам. Имеет связь со справочником стран. 
		От этого справочника есть связь на справочник городов.
		</p>
   	</td>
</tr>
<tr>
   	<td valign="top">
	    <div class="info"><a class="info" href="controller.php?view=admin.yelowpages.cities.BVcities">НАСЕЛЕННЫЕ ПУНКТЫ</a></div>
   		<p>Справочник городов. Занимает низшее место в иерархии географичесских справочников и содержит наименования населенных пунктов.
		Заполняется после того как заполнены справочники Стран и Регионов
		</p>
   	</td>
	<td width="50%" valign="top">	
   	</td>
</tr>
</table>   		                        