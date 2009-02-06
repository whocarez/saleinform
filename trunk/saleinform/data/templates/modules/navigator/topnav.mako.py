from mako import runtime, filters, cache
UNDEFINED = runtime.UNDEFINED
__M_dict_builtin = dict
__M_locals_builtin = locals
_magic_number = 5
_modified_time = 1233956046.1448669
_template_filename='/home/mazvv/Projects/Python/Pylons/saleinform/saleinform/templates/modules/navigator/topnav.mako'
_template_uri='/modules/navigator/topnav.mako'
_template_cache=cache.Cache(__name__, _modified_time)
_source_encoding='utf-8-'
from webhelpers.html import escape
_exports = []


def render_body(context,**pageargs):
    context.caller_stack._push_frame()
    try:
        __M_locals = __M_dict_builtin(pageargs=pageargs)
        h = context.get('h', UNDEFINED)
        _ = context.get('_', UNDEFINED)
        __M_writer = context.writer()
        # SOURCE LINE 2
        __M_writer(u'<div class="top_nav">\r\n\t<div class="navigator_container">\r\n\t\t<ul class="simple_items">\r\n\t\t\t<li><a target="_self" class="grayUs" title="')
        # SOURCE LINE 5
        __M_writer(escape(_(u'\u041f\u043e\u043c\u043e\u0449\u044c')))
        __M_writer(u'" href="/help"><span>')
        __M_writer(escape(_(u'\u041f\u043e\u043c\u043e\u0449\u044c')))
        __M_writer(u'</span></a></li>\r\n\t\t\t<li><a target="_self" class="orangeUs" title="')
        # SOURCE LINE 6
        __M_writer(escape(_(u'\u0412\u043e\u0439\u0442\u0438')))
        __M_writer(u'" href="/members"><span>')
        __M_writer(escape(_(u'\u0412\u043e\u0439\u0442\u0438')))
        __M_writer(u'</span></a></li>\r\n\t\t\t<li><a target="_self" class="grayUs" title="')
        # SOURCE LINE 7
        __M_writer(escape(_(u'\u041d\u0430\u0441\u0442\u0440\u043e\u0438\u0442\u044c')))
        __M_writer(u'" href="/top_video_reviews.php"><span>')
        __M_writer(escape(_(u'\u041d\u0430\u0441\u0442\u0440\u043e\u0438\u0442\u044c')))
        __M_writer(u'</span></a></li>\r\n\t\t</ul>\r\n\t</div>\t\r\n\t<div class="logo">\r\n\t\t<a target="_self" title="')
        # SOURCE LINE 11
        __M_writer(escape(_(u'\u0421\u0440\u0430\u0432\u043d\u0435\u043d\u0438\u0435 \u0446\u0435\u043d \u0438\u043d\u0442\u0435\u0440\u043d\u0435\u0442 \u043c\u0430\u0433\u0430\u0437\u0438\u043d\u043e\u0432, \u043f\u043e\u0438\u0441\u043a \u0442\u043e\u0432\u0430\u0440\u043e\u0432')))
        __M_writer(u'" href="/">\r\n\t\t\t')
        # SOURCE LINE 12
        __M_writer(escape(h.h_tags.image('/img/logo.gif', u'\u0421\u0440\u0430\u0432\u043d\u0435\u043d\u0438\u0435 \u0446\u0435\u043d \u0438\u043d\u0442\u0435\u0440\u043d\u0435\u0442 \u043c\u0430\u0433\u0430\u0437\u0438\u043d\u043e\u0432, \u043f\u043e\u0438\u0441\u043a \u0442\u043e\u0432\u0430\u0440\u043e\u0432', border="0")))
        __M_writer(u'\r\n\t\t</a>\r\n\t</div>\r\n</div>')
        return ''
    finally:
        context.caller_stack._pop_frame()


