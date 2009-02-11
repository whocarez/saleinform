from mako import runtime, filters, cache
UNDEFINED = runtime.UNDEFINED
__M_dict_builtin = dict
__M_locals_builtin = locals
_magic_number = 5
_modified_time = 1234301294.8099959
_template_filename='/home/mazvv/Projects/Python/Pylons/saleinform/saleinform/templates/modules/categories/list.mako'
_template_uri='/modules/categories/list.mako'
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
    # SOURCE LINE 5
    ns = runtime.Namespace('subcats', context._clean_inheritance_tokens(), templateuri='subcats_links.mako', callables=None, calling_uri=_template_uri, module=None)
    context.namespaces[(__name__, 'subcats')] = ns

def render_body(context,**pageargs):
    context.caller_stack._push_frame()
    try:
        __M_locals = __M_dict_builtin(pageargs=pageargs)
        c = context.get('c', UNDEFINED)
        int = context.get('int', UNDEFINED)
        h = context.get('h', UNDEFINED)
        len = context.get('len', UNDEFINED)
        subcats = _mako_get_namespace(context, 'subcats')
        xrange = context.get('xrange', UNDEFINED)
        _ = context.get('_', UNDEFINED)
        __M_writer = context.writer()
        # SOURCE LINE 4
        __M_writer(u'\r\n')
        # SOURCE LINE 5
        __M_writer(u'\r\n<table class="layoutshell">\r\n\t<tr>\r\n\t\t<td class="layoutL">\r\n\t\t\t<div id="Node_BreadCrumb" class="breadCrumb2-US">\r\n\t\t\t\t')
        # SOURCE LINE 10
        __M_writer(escape(h.h_tags.link_to(_(u'\u0414\u043e\u043c\u0430\u0448\u043d\u044f\u044f'), url='/', title=_(u'\u041f\u043e\u0438\u0441\u043a \u0442\u043e\u0432\u0430\u0440\u043e\u0432, \u0441\u0440\u0430\u0432\u043d\u0435\u043d\u0438\u0435 \u0446\u0435\u043d'))))
        __M_writer(u'\r\n\t\t\t\t<span class="grey">></span> \r\n\t\t\t\t<span class="greyb">')
        # SOURCE LINE 12
        __M_writer(escape(_(u'\u0412\u0441\u0435 \u043a\u0430\u0442\u0435\u0433\u043e\u0440\u0438\u0438')))
        __M_writer(u'</span>\r\n\t\t\t</div>\r\n\t\t\t<br><br>\r\n\t\t\t<table class="wd510">\r\n          \t\t<tr>\r\n          \t\t\t<td class="hdlpad1">\r\n          \t\t\t\t<span class="headline">')
        # SOURCE LINE 18
        __M_writer(escape(_(u'\u041e\u0431\u0437\u043e\u0440 \u043a\u0430\u0442\u0435\u0433\u043e\u0440\u0438\u0439')))
        __M_writer(u'</span>\r\n          \t\t\t\t<hr noshade="noshade">\r\n          \t\t\t</td>\r\n          \t\t</tr>\r\n        \t</table>\r\n        \t<table id="categories_list" class="wd510">\r\n        \t\t')
        # SOURCE LINE 24

        middle = len(c.a_categories)/2
        if middle - int(middle) > 0: middle = int(middle)+1
        categories = c.a_categories
                                
        
        __M_locals.update(__M_dict_builtin([(__M_key, __M_locals_builtin()[__M_key]) for __M_key in ['middle','categories'] if __M_key in __M_locals_builtin()]))
        # SOURCE LINE 28
        __M_writer(u'\r\n')
        # SOURCE LINE 29
        for i in xrange(middle):
            # SOURCE LINE 30
            __M_writer(u'        \t\t<tr>\r\n        \t\t\t<td style="vertical-align: top; text-align: left; width: 50%;">\r\n        \t\t\t\t')
            # SOURCE LINE 32
            __M_writer(escape(h.h_tags.link_to(categories[i].name, url=''.join(['/categories/', categories[i].slug]), title=categories[i].meta_title, class_='cathdl')))
            __M_writer(u'\r\n        \t\t\t\t<br>\r\n        \t\t\t\t')
            # SOURCE LINE 34
            __M_writer(escape(subcats.subcatsAnchors(c.a_subcategories, categories[i].rid, rest_length=40)))
            __M_writer(u'\r\n        \t\t\t\t<br><br>\r\n        \t\t\t</td>\r\n        \t\t\t<td style="vertical-align: top; text-align: left; width: 50%;">\r\n        \t\t\t\t')
            # SOURCE LINE 38
            __M_writer(escape(h.h_tags.link_to(categories[i+middle].name, url=''.join(['/categories/', categories[i+middle].slug]), title=categories[i+middle].meta_title, class_='cathdl')))
            __M_writer(u'\r\n        \t\t\t\t<br>\r\n        \t\t\t\t')
            # SOURCE LINE 40
            __M_writer(escape(subcats.subcatsAnchors(c.a_subcategories, categories[i+middle].rid, rest_length=40)))
            __M_writer(u'\r\n        \t\t\t\t<br><br>\r\n        \t\t\t</td>\r\n        \t\t</tr>\r\n')
        # SOURCE LINE 45
        __M_writer(u'        \t\t\r\n\t\t\t\t<tr>\r\n\t\t\t\t\t<td colspan="2">\r\n\t\t\t\t\t\t<br>\r\n\t\t\t\t\t\t<div class="ctr">\r\n\t\t\t\t\t\t\t')
        # SOURCE LINE 50
        __M_writer(escape(h.h_tags.link_to(_(u'\u0421\u043c\u043e\u0442\u0440\u0435\u0442\u044c \u0432\u0441\u0451 \u0434\u0435\u0440\u0435\u0432\u043e \u043a\u0430\u0442\u0435\u0433\u043e\u0440\u0438\u0439'), url='/categories/details', title=_(u'\u0421\u043c\u043e\u0442\u0440\u0435\u0442\u044c \u0432\u0441\u0451 \u0434\u0435\u0440\u0435\u0432\u043e \u043a\u0430\u0442\u0435\u0433\u043e\u0440\u0438\u0439'), class_='hdl')))
        __M_writer(u'\r\n\t\t\t\t\t\t</div>\r\n\t\t\t\t\t</td>\r\n\t\t\t\t</tr>        \t\t\r\n        \t</table>\r\n        </td>\r\n\t\t<td class="layoutM">\xa0\r\n\t\t</td>\r\n\t\t<td class="layoutR">\r\n\t\t\t<table class="topprod">\r\n\t\t\t\t<tr>\r\n\t\t\t\t\t<td class="topprodhdl bgdark" colspan="3">\r\n\t\t\t\t\t\t<span class="subhdl">')
        # SOURCE LINE 62
        __M_writer(escape(_(u'\u041f\u043e\u043f\u0443\u043b\u044f\u0440\u043d\u044b\u0435 \u0442\u043e\u0432\u0430\u0440\u044b')))
        __M_writer(u'</span>\r\n\t\t\t\t\t</td>\r\n\t\t\t\t</tr>\r\n\t\t\t</table>\r\n \t\t</td>\r\n\t</tr>\r\n</table>\r\n\r\n<table class="wd750">\r\n\t<tr> \r\n\t    <td>\r\n\t    \t<br>\r\n\t\t\t<hr noshade="noshade">\r\n\t\t</td>\r\n\t</tr>\r\n</table>')
        return ''
    finally:
        context.caller_stack._pop_frame()


