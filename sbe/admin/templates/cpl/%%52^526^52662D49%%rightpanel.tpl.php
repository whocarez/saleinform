<?php /* Smarty version 2.6.10, created on 2007-04-24 16:23:30
         compiled from menuprices/rightpanel.tpl */ ?>

<table width="100%">
<tr>
   	<td valign="top">
	    <div class="info"><a class="info" href="controller.php?view=admin.prices.prtypes.BVprtypes">ТИПЫ ЦЕН</a></div>
   		<p>Справочник типов цен. Содержит типы цен для цен клиентов. Может иметь бесконечное число значений и соответственно
   		в прайсах может быть много типов цен (розница, опт, диллер и т.д.). Этот справочник для данного раздела заполняется
   		в первую очередь.
   		</p>
   	</td>
	<td width="50%" valign="top">	
	    <div class="info"><a class="info" href="controller.php?view=admin.prices.availabletypes.BVavailabletypes">ТИПЫ НАЛИЧИЯ</a></div>
   		<p>Справочник типов наличия. Содержит типы наличия товара на складах клиента. То есть этот параметр определяет
   		есть ли товар на складе продавца или его нету, или же товар можна приобрести под заказ и т.д. Заполняется
   		для данного раздела одним из первых.
   		</p>
   	</td>
</tr>
<tr>
   	<td valign="top">
	    <div class="info"><a class="info" href="controller.php?view=admin.prices.tmppritems.BVtmppritems">ВРЕМЕННОЕ ХРАНИЛИЩЕ</a></div>
   		<p>Временное хранилище цен. Предназначено для временного хранения закачанных цен клиентов, до того как
   		они попадут в основное хранилище. При закачке прайсов система пытается автоматически определить товар, если он 
   		есть в справочнике. Если товар найден, то его ID прописывается во временное хранилище. Если товар при загрузке не определен, то
   		данные о бренде берутся с данных клиентаб  а поле Товар остается пустым.
   		</p>
   	</td>
   	<td>
	    <div class="info"><a class="info" href="controller.php?view=admin.prices.pritems.BVpritems">ХРАНИЛИЩЕ ЦЕН</a></div>
   		<p>Хранилище цен. Предназначено для хранения закачанных цен клиентов, после перекачки из временного хранилища.
   		Перегрузка из временного хранилища в основное не предусматривает никаких операций с данными. Данные просто
   		мигрируют между хранилищами. Основные операции работы с данными происходят при загрузке во временное хранилище.  
   		</p>
   	</td>
</tr>
</table>   		                        