#-*-coding:utf-8-*-
<%doc>
	список всех категорий
</%doc>
<%namespace name="subcats" file="subcats_links.mako"/>
<table class="layoutshell">
	<tr>
		<td class="layoutL">
			<div id="Node_BreadCrumb" class="breadCrumb2-US">
				${h.h_tags.link_to(_(u'Домашняя'), url='/', title=_(u'Поиск товаров, сравнение цен'))}
				<span class="grey">></span> 
				<span class="greyb">${_(u'Все категории')}</span>
			</div>
			<br><br>
			<table class="wd510">
          		<tr>
          			<td class="hdlpad1">
          				<span class="headline">${_(u'Обзор категорий')}</span>
          				<hr noshade="noshade">
          			</td>
          		</tr>
        	</table>
        	<table id="categories_list" class="wd510">
        		<%
        			middle = len(c.a_categories)/2
        			if middle - int(middle) > 0: middle = int(middle)+1
        			categories = c.a_categories
        		%>
        		% for i in xrange(middle):
        		<tr>
        			<td style="vertical-align: top; text-align: left; width: 50%;">
        				${h.h_tags.link_to(categories[i].name, url=''.join(['/categories/', categories[i].slug]), title=categories[i].meta_title, class_='cathdl')}
        				<br>
        				${subcats.subcatsAnchors(c.a_subcategories, categories[i].rid, rest_length=40)}
        				<br><br>
        			</td>
        			<td style="vertical-align: top; text-align: left; width: 50%;">
        				${h.h_tags.link_to(categories[i+middle].name, url=''.join(['/categories/', categories[i+middle].slug]), title=categories[i+middle].meta_title, class_='cathdl')}
        				<br>
        				${subcats.subcatsAnchors(c.a_subcategories, categories[i+middle].rid, rest_length=40)}
        				<br><br>
        			</td>
        		</tr>
        		% endfor
        		
				<tr>
					<td colspan="2">
						<br>
						<div class="ctr">
							${h.h_tags.link_to(_(u'Смотреть всё дерево категорий'), url='/categories/details', title=_(u'Смотреть всё дерево категорий'), class_='hdl')}
						</div>
					</td>
				</tr>        		
        	</table>
        </td>
		<td class="layoutM"> 
		</td>
		<td class="layoutR">
			<table class="topprod">
				<tr>
					<td class="topprodhdl bgdark" colspan="3">
						<span class="subhdl">${_(u'Популярные товары')}</span>
					</td>
				</tr>
			</table>
 		</td>
	</tr>
</table>

<table class="wd750">
	<tr> 
	    <td>
	    	<br>
			<hr noshade="noshade">
		</td>
	</tr>
</table>