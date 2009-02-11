#-*-coding: utf-8-*-
<div class="top_nav">
	<div class="navigator_container">
		<ul class="simple_items">
			<li>
				${h.h_tags.link_to(h.h_builder.literal(''.join(['<span>',_(u'Помощь'),'</span>'])), url='/help', title=_(u'Помощь'), class_='grayUs')}
			</li>
			<li>
				${h.h_tags.link_to(h.h_builder.literal(''.join(['<span>',_(u'Войти'),'</span>'])), url='/members', title=_(u'Войти'), class_='orangeUs')}
			</li>
			<li>
				${h.h_tags.link_to(h.h_builder.literal(''.join(['<span>',_(u'Настроить'),'</span>'])), url='/members/options', title=_(u'Настроить'), class_='grayUs')}
			</li>
		</ul>
	</div>	
	<div class="logo">
		<a target="_self" title="${_(u'Сравнение цен интернет магазинов, поиск товаров')}" href="/">
			${h.h_tags.image('/img/logo.gif', u'Сравнение цен интернет магазинов, поиск товаров', border="0")}
		</a>
	</div>
</div>