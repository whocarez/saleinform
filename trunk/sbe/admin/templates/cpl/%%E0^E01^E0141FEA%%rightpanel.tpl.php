<?php /* Smarty version 2.6.10, created on 2007-07-05 21:12:33
         compiled from menuclients/rightpanel.tpl */ ?>

<table width="100%">
<tr>
   	<td valign="top">
	    <div class="info"><a class="info" href="controller.php?view=admin.yelowpages.cltypes.BVcltypes">ТИПЫ КЛИЕНТОВ</a></div>
   		<p>Справочник типов клиентов. Каждый клиент должен иметь тип - интернет-магазин,
   		оптово розничный и т.д. Этот справочник содержит эти типы. Справочник независим.
   		Связанные справочники: Справочник клиентов
   		</p>
   	</td>
	<td width="50%" valign="top">	
	    <div class="info"><a class="info" href="controller.php?view=admin.yelowpages.urforms.BVurforms">ФОРМЫ СОБСТВЕННОСТИ</a></div>
   		<p>Справочник юридических форм собственности. Сожержит наименования и абревиатуры
   		юридичесских форм собственности. Справочник независим. Связанные справочники: 
   		Справочник клиентов</p>
   	</td>
</tr>
<tr>
   	<td valign="top">
	    <div class="info"><a class="info" href="controller.php?view=admin.yelowpages.clients.BVclients">КЛИЕНТЫ</a></div>
   		<p>Справочник клиентов. Содержит данные по клиентам, контактные данные, разрешения на загрузку прайсов,
   		и прочие необходимые данные. Связан со многими справочниками системы. Через справочник населенных пунктов
   		связан со правочниками регионов и стран, со правочником юридичесских форм, справочником типов клиентов.</p>
   	</td>
	<td width="50%" valign="top">
	    <div class="info"><a class="info" href="controller.php?view=admin.yelowpages.users.BVusers">УЧЕТНЫЕ ЗАПИСИ КЛИЕНТОВ</a></div>
   		<p>Справочник учетных записей клиентов. Каждый клиент может иметь несколько учетных записей, что позволит сотрудникам 
   		клиента вносить необходимую информацию о своей компании независимо от других пользователей системы.</p>
   	</td>
</tr>
<tr>
   	<td valign="top">
	    <div class="info"><a class="info" href="controller.php?view=admin.yelowpages.cluopinions.BVcluopinions">ОТЗЫВЫ ПОЛЬЗОВАТЕЛЕЙ</a></div>
   		<p>Отзывы пользователей. Содержит отзывы пользователей о клиентах. Используется в основном для просмотра и контроля за 
   		отзывами пользователей. Связан со справочниками клиентов и справочником зарегистрированых пользователей системы.</p>
   	</td>
	<td width="50%" valign="top">
	    <div class="info"><a class="info" href="controller.php?view=admin.yelowpages.prloadsorganizer.BVprloadsorganizer">СТАТУСЫ ЗАГРУЗКИ</a></div>
   		<p>Статусы загрузок. Показывает информацию о загрузках прайсов в разрезе клиентов. Содержит информацию о прошлых
   		и будущих загрузках, количестве загруженых товаров, ошибках загрузки и т.д.
   		</p>
   	</td>
</tr>
</table>   		                        