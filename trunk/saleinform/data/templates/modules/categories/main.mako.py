from mako import runtime, filters, cache
UNDEFINED = runtime.UNDEFINED
__M_dict_builtin = dict
__M_locals_builtin = locals
_magic_number = 5
_modified_time = 1234297731.5492339
_template_filename='/home/mazvv/Projects/Python/Pylons/saleinform/saleinform/templates/modules/categories/main.mako'
_template_uri='/modules/categories/main.mako'
_template_cache=cache.Cache(__name__, _modified_time)
_source_encoding='utf-8'
from webhelpers.html import escape
_exports = []


def _mako_get_namespace(context, name):
    try:
        return context.namespaces[(__name__, name)]
    except KeyError:
        _mako_generate_namespaces(context)
        return context.namespaces[(__name__, name)]
def _mako_generate_namespaces(context):
    # SOURCE LINE 2
    ns = runtime.Namespace('subcats', context._clean_inheritance_tokens(), templateuri='subcats_links.mako', callables=None, calling_uri=_template_uri, module=None)
    context.namespaces[(__name__, 'subcats')] = ns

def render_body(context,**pageargs):
    context.caller_stack._push_frame()
    try:
        __M_locals = __M_dict_builtin(pageargs=pageargs)
        h = context.get('h', UNDEFINED)
        c = context.get('c', UNDEFINED)
        subcats = _mako_get_namespace(context, 'subcats')
        _ = context.get('_', UNDEFINED)
        __M_writer = context.writer()
        __M_writer(u'\r\n<div class="catslist">\r\n\t<ul>\r\n')
        # SOURCE LINE 5
        for cat in c.categories:
            # SOURCE LINE 6
            __M_writer(u'\t\t<li>\r\n\t\t\t')
            # SOURCE LINE 7
            __M_writer(escape(h.h_tags.link_to(h.h_tags.image('/img/categories/icons/empty.png', cat.name, border="0"), url='/categories/'+cat.slug)))
            __M_writer(u'\r\n\t\t\t<div>\r\n\t\t\t<h4>\r\n\t\t\t\t')
            # SOURCE LINE 10
            __M_writer(escape(h.h_tags.link_to(cat.name, url='/categories/'+cat.slug)))
            __M_writer(u'\r\n\t\t\t</h4>\r\n\t\t\t')
            # SOURCE LINE 12
            __M_writer(escape(subcats.subcatsAnchors(c.subcategories, cat.rid, rest_length=30)))
            __M_writer(u'\r\n\t\t\t</div>\r\n\t\t</li>\r\n')
        # SOURCE LINE 16
        __M_writer(u"\t\t<li class='last-cat-item'>\r\n\t\t\t<div>\r\n\t\t\t<h4>\r\n\t\t\t\t")
        # SOURCE LINE 19
        __M_writer(escape(h.h_tags.link_to(_(u'\u0412\u0441\u0435 \u043a\u0430\u0442\u0435\u0433\u043e\u0440\u0438\u0438'), url='/categories')))
        __M_writer(u'\r\n\t\t\t</h4>\r\n\t\t\t</div>\r\n\t\t</li>\r\n\t</ul>\r\n</div>\r\n<div class="CategoryBrowserFooter"></div> \r\n\r\n')
        return ''
    finally:
        context.caller_stack._pop_frame()


