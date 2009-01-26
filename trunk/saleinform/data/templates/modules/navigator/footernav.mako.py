from mako import runtime, filters, cache
UNDEFINED = runtime.UNDEFINED
__M_dict_builtin = dict
__M_locals_builtin = locals
_magic_number = 5
_modified_time = 1232874960.609
_template_filename='D:\\PROJECTS\\ECLIPSE\\PYLONS\\saleinform\\saleinform\\templates/modules/navigator/footernav.mako'
_template_uri='/modules/navigator/footernav.mako'
_template_cache=cache.Cache(__name__, _modified_time)
_source_encoding='utf-8-'
from webhelpers.html import escape
_exports = []


def render_body(context,**pageargs):
    context.caller_stack._push_frame()
    try:
        __M_locals = __M_dict_builtin(pageargs=pageargs)
        _ = context.get('_', UNDEFINED)
        __M_writer = context.writer()
        # SOURCE LINE 2
        __M_writer(u'<div class="footer_nav">\n\t<div class="footer_items">\n\t\t<a href="/" title="')
        # SOURCE LINE 4
        __M_writer(escape(_(u'\u041e \u043f\u0440\u043e\u0435\u043a\u0442\u0435')))
        __M_writer(u'">')
        __M_writer(escape(_(u'\u041e \u043f\u0440\u043e\u0435\u043a\u0442\u0435')))
        __M_writer(u'</a>&nbsp;-&nbsp;\n\t\t<a href="/" title="')
        # SOURCE LINE 5
        __M_writer(escape(_(u'\u041c\u0430\u0433\u0430\u0437\u0438\u043d\u0430\u043c')))
        __M_writer(u'">')
        __M_writer(escape(_(u'\u041c\u0430\u0433\u0430\u0437\u0438\u043d\u0430\u043c')))
        __M_writer(u'</a>&nbsp;-&nbsp;\n\t\t<a href="/" title="')
        # SOURCE LINE 6
        __M_writer(escape(_(u'\u0414\u043e\u0431\u0430\u0432\u0438\u0442\u044c \u043c\u0430\u0433\u0430\u0437\u0438\u043d')))
        __M_writer(u'">')
        __M_writer(escape(_(u'\u0414\u043e\u0431\u0430\u0432\u0438\u0442\u044c \u043c\u0430\u0433\u0430\u0437\u0438\u043d')))
        __M_writer(u'</a>&nbsp;-&nbsp;\n\t\t<a href="/" title="')
        # SOURCE LINE 7
        __M_writer(escape(_(u'\u0423\u0441\u043b\u043e\u0432\u0438\u044f \u0438\u0441\u043f\u043e\u043b\u044c\u0437\u043e\u0432\u0430\u043d\u0438\u044f')))
        __M_writer(u'">')
        __M_writer(escape(_(u'\u0423\u0441\u043b\u043e\u0432\u0438\u044f \u0438\u0441\u043f\u043e\u043b\u044c\u0437\u043e\u0432\u0430\u043d\u0438\u044f')))
        __M_writer(u'</a>&nbsp;-&nbsp;\n\t\t<a href="/" title="')
        # SOURCE LINE 8
        __M_writer(escape(_(u'FAQ')))
        __M_writer(u'">')
        __M_writer(escape(_(u'FAQ')))
        __M_writer(u'</a>&nbsp;-&nbsp;\n\t\t<a href="/" title="')
        # SOURCE LINE 9
        __M_writer(escape(_(u'\u0420\u0435\u043a\u043b\u0430\u043c\u0430')))
        __M_writer(u'">')
        __M_writer(escape(_(u'\u0420\u0435\u043a\u043b\u0430\u043c\u0430')))
        __M_writer(u'</a>\n\t</div>\n\t\t\n\tCopyright &copy; 2006-2009 <a href="" class="c69" style="font-size: 100%;">Saleinform</a>&nbsp;&nbsp;All rights reserved\n</div>')
        return ''
    finally:
        context.caller_stack._pop_frame()


