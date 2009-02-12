from mako import runtime, filters, cache
UNDEFINED = runtime.UNDEFINED
__M_dict_builtin = dict
__M_locals_builtin = locals
_magic_number = 5
_modified_time = 1234476364.17361
_template_filename='/home/mazvv/Projects/Python/Pylons/saleinform/saleinform/templates/modules/categories/tree.mako'
_template_uri='/modules/categories/tree.mako'
_template_cache=cache.Cache(__name__, _modified_time)
_source_encoding='utf-8-'
from webhelpers.html import escape
_exports = []


def _mako_get_namespace(context, name):
    try:
        return context.namespaces[(__name__, name)]
    except KeyError:
        _mako_generate_namespaces(context)
        return context.namespaces[(__name__, name)]
def _mako_generate_namespaces(context):
    # SOURCE LINE 6
    ns = runtime.Namespace('tree', context._clean_inheritance_tokens(), templateuri='tree_links.mako', callables=None, calling_uri=_template_uri, module=None)
    context.namespaces[(__name__, 'tree')] = ns

def render_body(context,**pageargs):
    context.caller_stack._push_frame()
    try:
        __M_locals = __M_dict_builtin(pageargs=pageargs)
        h = context.get('h', UNDEFINED)
        c = context.get('c', UNDEFINED)
        tree = _mako_get_namespace(context, 'tree')
        _ = context.get('_', UNDEFINED)
        __M_writer = context.writer()
        # SOURCE LINE 2
        __M_writer(u'\r\n')
        # SOURCE LINE 5
        __M_writer(u'\r\n')
        # SOURCE LINE 6
        __M_writer(u'\r\n<table class="wd750">\r\n\t<tr>\r\n    \t<td align="center" class="bcrumbhdl">\r\n    \t</td>\r\n  \t</tr>\r\n  \t<tr>\r\n    \t<td class="bcrumbhdl">\r\n    \t\t')
        # SOURCE LINE 14
        __M_writer(escape(h.h_tags.link_to(_(u'\u0414\u043e\u043c\u0430\u0448\u043d\u044f\u044f'), url='/', title=_(u'\u041f\u043e\u0438\u0441\u043a \u0442\u043e\u0432\u0430\u0440\u043e\u0432, \u0441\u0440\u0430\u0432\u043d\u0435\u043d\u0438\u0435 \u0446\u0435\u043d'))))
        __M_writer(u' > \r\n    \t\t<span class="greyb">')
        # SOURCE LINE 15
        __M_writer(escape(_(u'\u0414\u0435\u0440\u0435\u0432\u043e \u043a\u0430\u0442\u0435\u0433\u043e\u0440\u0438\u0439')))
        __M_writer(u'</span><br/><br/>\r\n        \t<span class="headline">')
        # SOURCE LINE 16
        __M_writer(escape(_(u'\u0414\u0435\u0440\u0435\u0432\u043e \u043a\u0430\u0442\u0435\u0433\u043e\u0440\u0438\u0439')))
        __M_writer(u'</span>\r\n        \t<hr noshade="noshade"/>\r\n    \t</td>\r\n\t</tr>\r\n\t<tr>\r\n\t\t<td>\r\n\t\t\t')
        # SOURCE LINE 22
        __M_writer(escape(tree.treeBuilder(c.a_categories_tree.Root)))
        __M_writer(u'\r\n\t\t</td>\r\n\t</tr>\r\n</table>')
        return ''
    finally:
        context.caller_stack._pop_frame()


