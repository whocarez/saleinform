from mako import runtime, filters, cache
UNDEFINED = runtime.UNDEFINED
__M_dict_builtin = dict
__M_locals_builtin = locals
_magic_number = 5
_modified_time = 1233075045.6886079
_template_filename='/home/mazvv/Projects/PYLONS/saleinform/saleinform/templates/modules/categories/main.mako'
_template_uri='/modules/categories/main.mako'
_template_cache=cache.Cache(__name__, _modified_time)
_source_encoding='utf-8'
from webhelpers.html import escape
_exports = []


def render_body(context,**pageargs):
    context.caller_stack._push_frame()
    try:
        __M_locals = __M_dict_builtin(pageargs=pageargs)
        h = context.get('h', UNDEFINED)
        c = context.get('c', UNDEFINED)
        z = context.get('z', UNDEFINED)
        _ = context.get('_', UNDEFINED)
        __M_writer = context.writer()
        # SOURCE LINE 2
        __M_writer(u'<div class="catslist">\r\n\t<ul>\r\n')
        # SOURCE LINE 4
        for cat in c.categories:
            # SOURCE LINE 5
            __M_writer(u'\t\t<li>\r\n\t\t\t<h4>\r\n\t\t\t\t')
            # SOURCE LINE 7
            __M_writer(escape(h.h_tags.link_to(cat.name, url='/categories/'+cat.slug)))
            __M_writer(u'\r\n\t\t\t\t')
            # SOURCE LINE 8
            __M_writer(escape(h.h_text.truncate(', '.join([h.h_tags.link_to(z.name, url='/categories/'+z.slug) for z in c.subcategories]), length=50, indicator='...', whole_word=True)))
            __M_writer(u'\t\t\t\t\r\n\t\t\t</h4>\r\n\t\t</li>\r\n')
        # SOURCE LINE 12
        __M_writer(u"\t\t<li class='last-cat-item'>\r\n\t\t\t<h4>\r\n\t\t\t\t")
        # SOURCE LINE 14
        __M_writer(escape(h.h_tags.link_to(_(u'\u0412\u0441\u0435 \u043a\u0430\u0442\u0435\u0433\u043e\u0440\u0438\u0438'), url='/categories')))
        __M_writer(u'\r\n\t\t\t</h4>\r\n\t\t</li>\r\n\t</ul>\r\n</div>\r\n<div class="CategoryBrowserFooter"></div> \r\n\r\n')
        return ''
    finally:
        context.caller_stack._pop_frame()


