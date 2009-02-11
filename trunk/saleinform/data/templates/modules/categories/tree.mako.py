from mako import runtime, filters, cache
UNDEFINED = runtime.UNDEFINED
__M_dict_builtin = dict
__M_locals_builtin = locals
_magic_number = 5
_modified_time = 1234352264.4506099
_template_filename='/home/mazvv/Projects/Python/Pylons/saleinform/saleinform/templates/modules/categories/tree.mako'
_template_uri='/modules/categories/tree.mako'
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
        # SOURCE LINE 4
        __M_writer(u'\r\n<table class="wd750">\r\n\t<tr>\r\n    \t<td align="center" class="bcrumbhdl">\r\n    \t</td>\r\n  \t</tr>\r\n  \t<tr>\r\n    \t<td class="bcrumbhdl">\r\n    \t\t')
        # SOURCE LINE 12
        __M_writer(escape(h.h_tags.link_to(_(u'\u0414\u043e\u043c\u0430\u0448\u043d\u044f\u044f'), url='/', title=_(u'\u041f\u043e\u0438\u0441\u043a \u0442\u043e\u0432\u0430\u0440\u043e\u0432, \u0441\u0440\u0430\u0432\u043d\u0435\u043d\u0438\u0435 \u0446\u0435\u043d'))))
        __M_writer(u' > \r\n    \t\t<span class="greyb">')
        # SOURCE LINE 13
        __M_writer(escape(_(u'\u0414\u0435\u0440\u0435\u0432\u043e \u043a\u0430\u0442\u0435\u0433\u043e\u0440\u0438\u0439')))
        __M_writer(u'</span><br/><br/>\r\n        \t<span class="headline">')
        # SOURCE LINE 14
        __M_writer(escape(_(u'\u0414\u0435\u0440\u0435\u0432\u043e \u043a\u0430\u0442\u0435\u0433\u043e\u0440\u0438\u0439')))
        __M_writer(u'</span>\r\n        \t<hr noshade="noshade"/>\r\n    \t</td>\r\n\t</tr>\r\n</table>')
        return ''
    finally:
        context.caller_stack._pop_frame()


