from mako import runtime, filters, cache
UNDEFINED = runtime.UNDEFINED
__M_dict_builtin = dict
__M_locals_builtin = locals
_magic_number = 5
_modified_time = 1233182580.7650001
_template_filename='D:\\Projects\\ECLIPSE\\PYLONS\\saleinform\\saleinform\\templates/modules/categories/topmenu.mako'
_template_uri='/modules/categories/topmenu.mako'
_template_cache=cache.Cache(__name__, _modified_time)
_source_encoding='utf-8'
from webhelpers.html import escape
_exports = []


def render_body(context,**pageargs):
    context.caller_stack._push_frame()
    try:
        __M_locals = __M_dict_builtin(pageargs=pageargs)
        c = context.get('c', UNDEFINED)
        _ = context.get('_', UNDEFINED)
        __M_writer = context.writer()
        # SOURCE LINE 2
        __M_writer(u'<div id="menuContent">\n<div id="mainNavUs">\n<ul class="mainMenuUs">\n')
        # SOURCE LINE 5
        for cat in c.categories:
            # SOURCE LINE 6
            __M_writer(u'\t<li>\n\t\t<a target="_parent" href="/categories/')
            # SOURCE LINE 7
            __M_writer(escape(cat.slug))
            __M_writer(u'"><span>')
            __M_writer(escape(cat.name))
            __M_writer(u'</span></a>\n\t</li>\n')
        # SOURCE LINE 10
        __M_writer(u'\t<li><a target="_parent" href="/categories/')
        __M_writer(escape(cat.slug))
        __M_writer(u'" title="')
        __M_writer(escape(_(u'\u041f\u043e\u043a\u0430\u0437\u0430\u0442\u044c \u0432\u0441\u0435 \u043a\u0430\u0442\u0435\u0433\u043e\u0440\u0438\u0438')))
        __M_writer(u'">\n\t\t\t<span><strong>')
        # SOURCE LINE 11
        __M_writer(escape(_(u'\u0415\u0449\u0435...')))
        __M_writer(u'</strong></span>\n\t\t</a>\n\t</li>\n</ul>\n</div>\n</div>\n')
        return ''
    finally:
        context.caller_stack._pop_frame()


