from mako import runtime, filters, cache
UNDEFINED = runtime.UNDEFINED
__M_dict_builtin = dict
__M_locals_builtin = locals
_magic_number = 5
_modified_time = 1233247097.1337049
_template_filename='/home/mazvv/Projects/PYLONS/saleinform/saleinform/templates/modules/stores/list.mako'
_template_uri='/modules/stores/list.mako'
_template_cache=cache.Cache(__name__, _modified_time)
_source_encoding='utf-8-'
from webhelpers.html import escape
_exports = []


def render_body(context,**pageargs):
    context.caller_stack._push_frame()
    try:
        __M_locals = __M_dict_builtin(pageargs=pageargs)
        map = context.get('map', UNDEFINED)
        h = context.get('h', UNDEFINED)
        range = context.get('range', UNDEFINED)
        chr = context.get('chr', UNDEFINED)
        str = context.get('str', UNDEFINED)
        ord = context.get('ord', UNDEFINED)
        _ = context.get('_', UNDEFINED)
        __M_writer = context.writer()
        # SOURCE LINE 4
        __M_writer(u'\r\n<h1 class="h1 default">')
        # SOURCE LINE 5
        __M_writer(escape(_(u'\u0412\u0441\u0435 \u043c\u0430\u0433\u0430\u0437\u0438\u043d\u044b \u043d\u0430 Saleinform, \u043d\u0430\u0447\u0438\u043d\u0430\u044e\u0449\u0438\u0435\u0441\u044f \u043d\u0430 ')))
        __M_writer(u'</h1>\r\n<table cellspacing="0" class="resultrangetop3bd bg2norm">\r\n\t<tbody>\r\n\t\t<tr>\r\n\t\t\t<td class="letterShopsNavHead">\r\n')
        # SOURCE LINE 10
        for l in map(chr, range(65, 91)):
            # SOURCE LINE 11
            __M_writer(u'\t\t\t\t')
            __M_writer(escape(h.h_tags.link_to(l, url='/stores/letter/'+str(ord(l)))))
            __M_writer(u'\r\n')
        # SOURCE LINE 13
        __M_writer(u'\t\t\t</td>\r\n\t\t</tr>\r\n\t</tbody>\r\n</table>\r\n\r\n<table cellspacing="1" class="common">\r\n\t<thead>\r\n    \t<tr>\r\n\t\t\t<th>')
        # SOURCE LINE 21
        __M_writer(escape(_(u'\u041b\u043e\u0433\u043e\u0442\u0438\u043f')))
        __M_writer(u'</th>\r\n\t\t\t<th>')
        # SOURCE LINE 22
        __M_writer(escape(_(u'\u041d\u0430\u0437\u0432\u0430\u043d\u0438\u0435 \u043c\u0430\u0433\u0430\u0437\u0438\u043d\u0430')))
        __M_writer(u'</th>\r\n\t\t\t<th>')
        # SOURCE LINE 23
        __M_writer(escape(_(u'\u0420\u0435\u0439\u0442\u0438\u043d\u0433')))
        __M_writer(u'</th>\r\n\t\t\t<th>')
        # SOURCE LINE 24
        __M_writer(escape(_(u'\u0422\u043e\u0432\u0430\u0440\u044b')))
        __M_writer(u'</th>\r\n\t\t\t<th>')
        # SOURCE LINE 25
        __M_writer(escape(_(u'\u0421\u0430\u0439\u0442 \u043c\u0430\u0433\u0430\u0437\u0438\u043d\u0430')))
        __M_writer(u'</th>\r\n\t\t</tr>\r\n\t</thead>\r\n\t<tr>\r\n\t\t<td>\r\n\t\t</td>\r\n\t\t<td class="alignLeft">\r\n\t\t\tAdorama.com\r\n\t\t</td>\r\n        <td class="noWrap">\r\n        \t<img alt="" src="http://images.us.ciao.com/ius/images/stars/2003/stars40.gif"/><br/>\r\n        \t<small><a href="http://www.ciao.com/Adorama_com__15482215">15 Ratings</a>        \t\t\t\t\t</small>\r\n        </td>\r\n        <td class="noWrap">\r\n\t\t\t<b><a href="http://www.ciao.com/shopping_partners/Adorama_com__5030188">Show Products</a></b>\r\n   \t\t</td>\r\n        <td class="maintabCOLnar2">\r\n\t\t</td>\r\n\t</tr>\r\n\t<tr>\r\n    \t<td>\r\n\t\t</td>\r\n\t\t<td class="alignLeft">Amazon.com</td>\r\n    \t<td class="noWrap">\r\n        <img alt="" src="http://images.us.ciao.com/ius/images/stars/2003/stars45.gif"/><br/>\r\n        \t<small><a href="http://www.ciao.com/Amazon_com__15446580">281 Ratings</a>        \t\t\t\t\t</small>\r\n        </td>\r\n        <td class="noWrap">\r\n\t\t\t<b><a href="http://www.ciao.com/shopping_partners/Amazon_com__5030062">Show Products</a></b>\r\n        </td>\r\n        <td class="maintabCOLnar2">\r\n\t\t</td>\r\n\t</tr>\r\n</table>\r\n\r\n<table cellspacing="0" class="resultrangedownbg3 bg2norm">\r\n\t<tr>\r\n\t\t<td class="rangenextpage">\r\n\t\t</td>\r\n\t</tr>\r\n</table>\r\n\r\n')
        return ''
    finally:
        context.caller_stack._pop_frame()


