#-*-coding: utf-8-*-
<div class="top_nav">
	<div class="navigator_container">
		<ul class="navigator_items">
			<li>${h.h_tags.link_to(h.h_builder.literal(''.join(['<span>',_(u'Помощь'),'</span>'])), url='/help', title=_(u'Помощь'))}</li>
			<li class="navimember">${h.h_tags.link_to(h.h_builder.literal(''.join(['<span>',_(u'Регистрация'),'</span>'])), url='/members/register', title=_(u'Регистрация'))}</li>
			<li class="navimember">${h.h_tags.link_to(h.h_builder.literal(''.join(['<span>',_(u'Войти'),'</span>'])), url='/members', title=_(u'Войти'))}</li>
			<li>${h.h_tags.link_to(h.h_builder.literal(''.join(['<span>',_(u'Настроить'),'</span>'])), url='/members/options', title=_(u'Настроить'))}</li>
			<li>${h.h_tags.link_to(h.h_builder.literal(''.join(['<span>',_(u'Магазины'),'</span>'])), url='/stores', title=_(u'Магазины'))}</li>
			<li class="navifirst">${h.h_tags.link_to(h.h_builder.literal(''.join(['<span>',_(u'Сравнить цены'),'</span>'])), url='/', title=_(u'Сравнить цены'))}</li>
		</ul>
	</div>	
	<div class="logo">
		<a target="_self" title="${_(u'Сравнение цен интернет магазинов, поиск товаров')}" href="/">
			${h.h_tags.image('/img/logo.gif', u'Сравнение цен интернет магазинов, поиск товаров', border="0")}
		</a>
	</div>
</div>