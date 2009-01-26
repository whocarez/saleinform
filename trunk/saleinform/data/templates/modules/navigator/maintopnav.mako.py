from mako import runtime, filters, cache
UNDEFINED = runtime.UNDEFINED
__M_dict_builtin = dict
__M_locals_builtin = locals
_magic_number = 5
_modified_time = 1232874960.5929999
_template_filename='D:\\PROJECTS\\ECLIPSE\\PYLONS\\saleinform\\saleinform\\templates/modules/navigator/maintopnav.mako'
_template_uri='/modules/navigator/maintopnav.mako'
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
        __M_writer(u'<div class="top_nav">\n\t<div class="navigator_container">\n\t\t<ul class="navigator_items">\n\t\t\t<li><a target="_self" title="')
        # SOURCE LINE 5
        __M_writer(escape(_(u'\u041f\u043e\u043c\u043e\u0449\u044c')))
        __M_writer(u'" href="/help"><span>')
        __M_writer(escape(_(u'\u041f\u043e\u043c\u043e\u0449\u044c')))
        __M_writer(u'</span></a></li>\n\t\t\t<li class="navimember"><a target="_self" title="')
        # SOURCE LINE 6
        __M_writer(escape(_(u'\u0412\u043e\u0439\u0442\u0438')))
        __M_writer(u'" href="/login"><span>')
        __M_writer(escape(_(u'\u0412\u043e\u0439\u0442\u0438')))
        __M_writer(u'</span></a></li>\n\t\t\t<li class="navimember"><a target="_self" title="')
        # SOURCE LINE 7
        __M_writer(escape(_(u'\u0420\u0435\u0433\u0438\u0441\u0442\u0440\u0430\u0446\u0438\u044f')))
        __M_writer(u'" href="/reg"><span>')
        __M_writer(escape(_(u'\u0420\u0435\u0433\u0438\u0441\u0442\u0440\u0430\u0446\u0438\u044f')))
        __M_writer(u'</span></a></li>\n\t\t\t<li><a target="_self" title="')
        # SOURCE LINE 8
        __M_writer(escape(_(u'\u041d\u0430\u0439\u0441\u0442\u0440\u043e\u0438\u0442\u044c')))
        __M_writer(u'" href="/top_video_reviews.php"><span>')
        __M_writer(escape(_(u'\u041d\u0430\u0439\u0441\u0442\u0440\u043e\u0438\u0442\u044c')))
        __M_writer(u'</span></a></li>\n\t\t\t<li><a target="_self" title="')
        # SOURCE LINE 9
        __M_writer(escape(_(u'\u041c\u0430\u0433\u0430\u0437\u0438\u043d\u044b')))
        __M_writer(u'" href="/product_lists_overview.php"><span>')
        __M_writer(escape(_(u'\u041c\u0430\u0433\u0430\u0437\u0438\u043d\u044b')))
        __M_writer(u'</span></a></li>\n\t\t\t<li class="navifirst"><a target="_self" title="')
        # SOURCE LINE 10
        __M_writer(escape(_(u'\u0421\u0440\u0430\u0432\u043d\u0438\u0442\u044c \u0446\u0435\u043d\u044b')))
        __M_writer(u'" href="/"><span>')
        __M_writer(escape(_(u'\u0421\u0440\u0430\u0432\u043d\u0438\u0442\u044c \u0446\u0435\u043d\u044b')))
        __M_writer(u'</span></a></li>\n\t\t</ul>\n\t</div>\t\n\t<div class="logo">\n\t\t<img src="../img/logo.gif">\n\t</div>\n</div>')
        return ''
    finally:
        context.caller_stack._pop_frame()


