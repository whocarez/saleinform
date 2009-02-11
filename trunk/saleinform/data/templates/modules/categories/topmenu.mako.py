from mako import runtime, filters, cache
UNDEFINED = runtime.UNDEFINED
__M_dict_builtin = dict
__M_locals_builtin = locals
_magic_number = 5
_modified_time = 1234352319.2821679
_template_filename='/home/mazvv/Projects/Python/Pylons/saleinform/saleinform/templates/modules/categories/topmenu.mako'
_template_uri='/modules/categories/topmenu.mako'
_template_cache=cache.Cache(__name__, _modified_time)
_source_encoding='utf-8'
from webhelpers.html import escape
_exports = ['setId']


def render_body(context,**pageargs):
    context.caller_stack._push_frame()
    try:
        __M_locals = __M_dict_builtin(pageargs=pageargs)
        h = context.get('h', UNDEFINED)
        c = context.get('c', UNDEFINED)
        def setId(slug,c_slug):
            return render_setId(context.locals_(__M_locals),slug,c_slug)
        _ = context.get('_', UNDEFINED)
        __M_writer = context.writer()
        # SOURCE LINE 2
        __M_writer(u'<div id="menuContent">\r\n<div id="mainNavUs">\r\n<ul class="mainMenuUs">\r\n')
        # SOURCE LINE 9
        __M_writer(u' \r\n')
        # SOURCE LINE 10
        for cat in c.categories:
            # SOURCE LINE 11
            __M_writer(u'\t<li ')
            __M_writer(escape(setId(cat.slug, c.currentCategorySlug)))
            __M_writer(u'>\r\n\t\t')
            # SOURCE LINE 12
            __M_writer(escape(h.h_tags.link_to(h.h_builder.literal(''.join(['<span>',cat.name,'</span>'])), url=''.join(["/categories/",cat.slug]), title=cat.meta_title, target="_parent")))
            __M_writer(u'\r\n\t</li>\r\n')
        # SOURCE LINE 15
        __M_writer(u'\t<li ')
        __M_writer(escape(setId(u'', c.currentCategorySlug)))
        __M_writer(u'>\r\n\t\t')
        # SOURCE LINE 16
        __M_writer(escape(h.h_tags.link_to(h.h_builder.literal(''.join(['<span><strong>',_(u'\u0415\u0449\u0435...'),'</strong></span>'])), url="/categories", target="_parent", title=_(u'\u041f\u043e\u043a\u0430\u0437\u0430\u0442\u044c \u0432\u0441\u0435 \u043a\u0430\u0442\u0435\u0433\u043e\u0440\u0438\u0438'))))
        __M_writer(u'\r\n\t</li>\r\n</ul>\r\n</div>\r\n</div>\r\n')
        return ''
    finally:
        context.caller_stack._pop_frame()


def render_setId(context,slug,c_slug):
    context.caller_stack._push_frame()
    try:
        __M_writer = context.writer()
        # SOURCE LINE 5
        __M_writer(u'\r\n')
        # SOURCE LINE 6
        if slug == c_slug:
            # SOURCE LINE 7
            __M_writer(u'\t\tid="current"\r\n')
        return ''
    finally:
        context.caller_stack._pop_frame()


