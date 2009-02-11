from mako import runtime, filters, cache
UNDEFINED = runtime.UNDEFINED
__M_dict_builtin = dict
__M_locals_builtin = locals
_magic_number = 5
_modified_time = 1234304416.4320619
_template_filename='/home/mazvv/Projects/Python/Pylons/saleinform/saleinform/templates/modules/navigator/footernav.mako'
_template_uri='/modules/navigator/footernav.mako'
_template_cache=cache.Cache(__name__, _modified_time)
_source_encoding='utf-8-'
from webhelpers.html import escape
_exports = []


# SOURCE LINE 2

def getYear():
        import time
        return time.strftime('%Y', time.localtime())


def render_body(context,**pageargs):
    context.caller_stack._push_frame()
    try:
        __M_locals = __M_dict_builtin(pageargs=pageargs)
        h = context.get('h', UNDEFINED)
        _ = context.get('_', UNDEFINED)
        __M_writer = context.writer()
        # SOURCE LINE 6
        __M_writer(u'\r\n<div class="footer_nav">\r\n\t<div class="footer_items">\r\n\t\t<a href="/" title="')
        # SOURCE LINE 9
        __M_writer(escape(_(u'\u041e \u043f\u0440\u043e\u0435\u043a\u0442\u0435')))
        __M_writer(u'">')
        __M_writer(escape(_(u'\u041e \u043f\u0440\u043e\u0435\u043a\u0442\u0435')))
        __M_writer(u'</a>&nbsp;-&nbsp;\r\n\t\t<a href="/" title="')
        # SOURCE LINE 10
        __M_writer(escape(_(u'\u041c\u0430\u0433\u0430\u0437\u0438\u043d\u0430\u043c')))
        __M_writer(u'">')
        __M_writer(escape(_(u'\u041c\u0430\u0433\u0430\u0437\u0438\u043d\u0430\u043c')))
        __M_writer(u'</a>&nbsp;-&nbsp;\r\n\t\t<a href="/" title="')
        # SOURCE LINE 11
        __M_writer(escape(_(u'\u0414\u043e\u0431\u0430\u0432\u0438\u0442\u044c \u043c\u0430\u0433\u0430\u0437\u0438\u043d')))
        __M_writer(u'">')
        __M_writer(escape(_(u'\u0414\u043e\u0431\u0430\u0432\u0438\u0442\u044c \u043c\u0430\u0433\u0430\u0437\u0438\u043d')))
        __M_writer(u'</a>&nbsp;-&nbsp;\r\n\t\t<a href="/" title="')
        # SOURCE LINE 12
        __M_writer(escape(_(u'\u0423\u0441\u043b\u043e\u0432\u0438\u044f \u0438\u0441\u043f\u043e\u043b\u044c\u0437\u043e\u0432\u0430\u043d\u0438\u044f')))
        __M_writer(u'">')
        __M_writer(escape(_(u'\u0423\u0441\u043b\u043e\u0432\u0438\u044f \u0438\u0441\u043f\u043e\u043b\u044c\u0437\u043e\u0432\u0430\u043d\u0438\u044f')))
        __M_writer(u'</a>&nbsp;-&nbsp;\r\n\t\t<a href="/" title="')
        # SOURCE LINE 13
        __M_writer(escape(_(u'FAQ')))
        __M_writer(u'">')
        __M_writer(escape(_(u'FAQ')))
        __M_writer(u'</a>&nbsp;-&nbsp;\r\n\t\t<a href="/" title="')
        # SOURCE LINE 14
        __M_writer(escape(_(u'\u0420\u0435\u043a\u043b\u0430\u043c\u0430')))
        __M_writer(u'">')
        __M_writer(escape(_(u'\u0420\u0435\u043a\u043b\u0430\u043c\u0430')))
        __M_writer(u'</a>\r\n\t</div>\r\n\tCopyright &copy; 2006-')
        # SOURCE LINE 16
        __M_writer(escape(getYear()))
        __M_writer(u'\r\n\t')
        # SOURCE LINE 17
        __M_writer(escape(h.h_tags.link_to('Saleinform', url="/", title=_(u"\u0421\u0440\u0430\u0432\u043d\u0435\u043d\u0438\u0435 \u0446\u0435\u043d \u0438\u043d\u0442\u0435\u0440\u043d\u0435\u0442 \u043c\u0430\u0433\u0430\u0437\u0438\u043d\u043e\u0432"))))
        __M_writer(u'&nbsp;&nbsp;All rights reserved\r\n</div>')
        return ''
    finally:
        context.caller_stack._pop_frame()


