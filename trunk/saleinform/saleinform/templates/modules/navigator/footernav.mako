#-*-coding: utf-8-*-
<%!
	def getYear():
		import time
		return time.strftime('%Y', time.localtime())
%>
<div class="footer_nav">
	<div class="footer_items">
		<a href="/" title="${_(u'О проекте')}">${_(u'О проекте')}</a>&nbsp;-&nbsp;
		<a href="/" title="${_(u'Магазинам')}">${_(u'Магазинам')}</a>&nbsp;-&nbsp;
		<a href="/" title="${_(u'Добавить магазин')}">${_(u'Добавить магазин')}</a>&nbsp;-&nbsp;
		<a href="/" title="${_(u'Условия использования')}">${_(u'Условия использования')}</a>&nbsp;-&nbsp;
		<a href="/" title="${_(u'FAQ')}">${_(u'FAQ')}</a>&nbsp;-&nbsp;
		<a href="/" title="${_(u'Реклама')}">${_(u'Реклама')}</a>
	</div>
	Copyright &copy; 2006-${getYear()}
	${h.h_tags.link_to('Saleinform', url="/", title=_(u"Сравнение цен интернет магазинов"))}&nbsp;&nbsp;All rights reserved
</div>