<?php /* Smarty version 2.6.10, created on 2007-07-05 19:50:23
         compiled from menuwares/rightpanel.tpl */ ?>

<table width="100%">
<tr>
   	<td valign="top">
	    <div class="info"><a class="info" href="controller.php?view=admin.wares.brands.BVbrands">БРЕНДЫ</a></div>
   		<p>Справочник брендов. Один из главнейших справочников верхнего уровня для товаров. Этот справочник независим.
   		Имеет зависимости для справочника товаров.
   		</p>
   	</td>
	<td width="50%" valign="top">	
	    <div class="info"><a class="info" href="controller.php?view=admin.wares.brandsassoc.BVbrandsassoc">СИНОНИМЫ БРЕНДОВ</a></div>
   		<p>Справочник синонимов брендов. Справочник содержит синонимы брендов для идентификации брендов в
   		прайсах клиентов. К примеру HP = Hewlett Packard и т.д.
   		</p>
   	</td>
</tr>
<tr>
   	<td valign="top">
	    <div class="info"><a class="info" href="controller.php?view=admin.wares.categories.BVcategories">СПРАВОЧНИК КАТЕГОРИЙ</a></div>
   		<p>Категории товаров. Справочник содержит категории и средства управления категориями.
   		</p>
   	</td>
   	<td valign="top">
	    <div class="info"><a class="info" href="controller.php?view=admin.wares.wares.BVwares_warespars">СПРАВОЧНИК ТОВАРОВ</a></div>
   		<p>Справочник товаров. Справочник содержит категории и товары в разрезе категорий. Это самый главный справочник
   		раздела, и один из главнейших справочников системы вцелом.
   		</p>
   	</td>
</tr>
<tr>
	<td width="50%" valign="top">
	    <div class="info"><a class="info" href="controller.php?view=admin.wares.categoriesimages.BVcategoriesimages">ИЗОБРАЖЕНИЯ КАТЕГОРИЙ</a></div>
   		<p>Изображения категорий. Содержит изображения, которые могут быть использованы как фоновый рисунок для категорий.
   		Содержит связь один ко многим со справочником категорий (для каждой категории может быть задано произвольное коичество
   		изображений)
   		</p>
   	</td>
	<td width="50%" valign="top">
	    <div class="info"><a class="info" href="controller.php?view=admin.wares.pars.BVpars">СПРАВОЧНИК ПАРАМЕТРОВ</a></div>
   		<p>Справочник параметров. Содержит параметры, которые могут быть использованы в качестве параметров категорий и 
   		соответсвенно параметров товаров. Таким образом унифицируется подход к описаниям товаров одной категории.
   		</p>
   	</td>
</tr>
<tr>
	<td width="50%" valign="top">
	    <div class="info"><a class="info" href="controller.php?view=admin.wares.relatedcats.BVrelatedcats">РОДСТВЕННЫЕ КАТЕГОРИИ</a></div>
   		<p>Справочник родственных категорий. Связан и зависит непостредственно от справочника категорий. Содержит 
   		данные о категориях которые будут отображаться в связанных продуктах.
   		</p>
   	</td>
	<td width="50%" valign="top">
	    <div class="info"><a class="info" href="controller.php?view=admin.wares.guides.BVguides">СОВЕТЫ ПОКУПАТЕЛЯМ</a></div>
   		<p>Статьи советы покупателям. Связан и зависит непостредственно от справочника категорий. 
   		Содержит контент статей для отображения советов покупателям по каждой из категорий.   		
   		</p>
   	</td>
</tr>
<tr>
   	<td valign="top">
	    <div class="info"><a class="info" href="controller.php?view=admin.wares.catpars.BVcatpars">ПАРАМЕТРЫ КАТЕГОРИЙ</a></div>
   		<p>Параметры категорий. Справочник содержит парметры категорий из которых состоит описание товаров данной 
   		категории.
   		</p>
   	</td>
	<td width="50%" valign="top">
	    <div class="info"><a class="info" href="controller.php?view=admin.wares.guides.BVguides"></a></div>
   		<p>
   		</p>
   	</td>
</tr>
</table>   		                        