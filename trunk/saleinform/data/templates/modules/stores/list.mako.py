from mako import runtime, filters, cache
UNDEFINED = runtime.UNDEFINED
__M_dict_builtin = dict
__M_locals_builtin = locals
_magic_number = 5
_modified_time = 1233485436.8280001
_template_filename='D:\\PROJECTS\\ECLIPSE\\PYLONS\\saleinform\\saleinform\\templates/modules/stores/list.mako'
_template_uri='/modules/stores/list.mako'
_template_cache=cache.Cache(__name__, _modified_time)
_source_encoding='utf-8-'
from webhelpers.html import escape
_exports = []


def render_body(context,**pageargs):
    context.caller_stack._push_frame()
    try:
        __M_locals = __M_dict_builtin(pageargs=pageargs)
        url = context.get('url', UNDEFINED)
        h = context.get('h', UNDEFINED)
        c = context.get('c', UNDEFINED)
        _ = context.get('_', UNDEFINED)
        __M_writer = context.writer()
        # SOURCE LINE 4
        __M_writer(u'\n<h1 class="h1 default">')
        # SOURCE LINE 5
        __M_writer(escape(_(u'\u0412\u0441\u0435 \u043c\u0430\u0433\u0430\u0437\u0438\u043d\u044b \u043d\u0430 Saleinform, \u043d\u0430\u0447\u0438\u043d\u0430\u044e\u0449\u0438\u0435\u0441\u044f \u043d\u0430 ')))
        __M_writer(u'"')
        __M_writer(escape(c.letter))
        __M_writer(u'"</h1>\n<table cellspacing="0" class="resultrangetop3bd bg2norm">\n\t<tbody>\n\t\t<tr>\n\t\t\t<td class="letterShopsNavHead">\n\t\t\t\t')
        # SOURCE LINE 10
        __M_writer(escape(h.h_tags.link_to_unless(c.letter==u'A', u'A', url='/stores/letter/%s'%u'A')))
        __M_writer(u'\n\t\t\t\t')
        # SOURCE LINE 11
        __M_writer(escape(h.h_tags.link_to_unless(c.letter==u'B', u'B', url='/stores/letter/%s'%u'B')))
        __M_writer(u'\n\t\t\t\t')
        # SOURCE LINE 12
        __M_writer(escape(h.h_tags.link_to_unless(c.letter==u'C', u'C', url='/stores/letter/%s'%u'C')))
        __M_writer(u'\n\t\t\t\t')
        # SOURCE LINE 13
        __M_writer(escape(h.h_tags.link_to_unless(c.letter==u'D', u'D', url='/stores/letter/%s'%u'D')))
        __M_writer(u'\n\t\t\t\t')
        # SOURCE LINE 14
        __M_writer(escape(h.h_tags.link_to_unless(c.letter==u'E', u'E', url='/stores/letter/%s'%u'E')))
        __M_writer(u'\n\t\t\t\t')
        # SOURCE LINE 15
        __M_writer(escape(h.h_tags.link_to_unless(c.letter==u'F', u'F', url='/stores/letter/%s'%u'F')))
        __M_writer(u'\n\t\t\t\t')
        # SOURCE LINE 16
        __M_writer(escape(h.h_tags.link_to_unless(c.letter==u'G', u'G', url='/stores/letter/%s'%u'G')))
        __M_writer(u'\n\t\t\t\t')
        # SOURCE LINE 17
        __M_writer(escape(h.h_tags.link_to_unless(c.letter==u'H', u'H', url='/stores/letter/%s'%u'H')))
        __M_writer(u'\n\t\t\t\t')
        # SOURCE LINE 18
        __M_writer(escape(h.h_tags.link_to_unless(c.letter==u'I', u'I', url='/stores/letter/%s'%u'I')))
        __M_writer(u'\n\t\t\t\t')
        # SOURCE LINE 19
        __M_writer(escape(h.h_tags.link_to_unless(c.letter==u'J', u'J', url='/stores/letter/%s'%u'J')))
        __M_writer(u'\n\t\t\t\t')
        # SOURCE LINE 20
        __M_writer(escape(h.h_tags.link_to_unless(c.letter==u'K', u'K', url='/stores/letter/%s'%u'K')))
        __M_writer(u'\n\t\t\t\t')
        # SOURCE LINE 21
        __M_writer(escape(h.h_tags.link_to_unless(c.letter==u'L', u'L', url='/stores/letter/%s'%u'L')))
        __M_writer(u'\n\t\t\t\t')
        # SOURCE LINE 22
        __M_writer(escape(h.h_tags.link_to_unless(c.letter==u'M', u'M', url='/stores/letter/%s'%u'M')))
        __M_writer(u'\n\t\t\t\t')
        # SOURCE LINE 23
        __M_writer(escape(h.h_tags.link_to_unless(c.letter==u'N', u'N', url='/stores/letter/%s'%u'N')))
        __M_writer(u'\n\t\t\t\t')
        # SOURCE LINE 24
        __M_writer(escape(h.h_tags.link_to_unless(c.letter==u'O', u'O', url='/stores/letter/%s'%u'O')))
        __M_writer(u'\n\t\t\t\t')
        # SOURCE LINE 25
        __M_writer(escape(h.h_tags.link_to_unless(c.letter==u'P', u'P', url='/stores/letter/%s'%u'P')))
        __M_writer(u'\n\t\t\t\t')
        # SOURCE LINE 26
        __M_writer(escape(h.h_tags.link_to_unless(c.letter==u'Q', u'Q', url='/stores/letter/%s'%u'Q')))
        __M_writer(u'\n\t\t\t\t')
        # SOURCE LINE 27
        __M_writer(escape(h.h_tags.link_to_unless(c.letter==u'R', u'R', url='/stores/letter/%s'%u'R')))
        __M_writer(u'\n\t\t\t\t')
        # SOURCE LINE 28
        __M_writer(escape(h.h_tags.link_to_unless(c.letter==u'S', u'S', url='/stores/letter/%s'%u'S')))
        __M_writer(u'\n\t\t\t\t')
        # SOURCE LINE 29
        __M_writer(escape(h.h_tags.link_to_unless(c.letter==u'T', u'T', url='/stores/letter/%s'%u'T')))
        __M_writer(u'\n\t\t\t\t')
        # SOURCE LINE 30
        __M_writer(escape(h.h_tags.link_to_unless(c.letter==u'U', u'U', url='/stores/letter/%s'%u'U')))
        __M_writer(u'\n\t\t\t\t')
        # SOURCE LINE 31
        __M_writer(escape(h.h_tags.link_to_unless(c.letter==u'V', u'V', url='/stores/letter/%s'%u'V')))
        __M_writer(u'\n\t\t\t\t')
        # SOURCE LINE 32
        __M_writer(escape(h.h_tags.link_to_unless(c.letter==u'W', u'W', url='/stores/letter/%s'%u'W')))
        __M_writer(u'\n\t\t\t\t')
        # SOURCE LINE 33
        __M_writer(escape(h.h_tags.link_to_unless(c.letter==u'X', u'X', url='/stores/letter/%s'%u'X')))
        __M_writer(u'\n\t\t\t\t')
        # SOURCE LINE 34
        __M_writer(escape(h.h_tags.link_to_unless(c.letter==u'Y', u'Y', url='/stores/letter/%s'%u'Y')))
        __M_writer(u'\n\t\t\t\t')
        # SOURCE LINE 35
        __M_writer(escape(h.h_tags.link_to_unless(c.letter==u'Z', u'Z', url='/stores/letter/%s'%u'Z')))
        __M_writer(u'\n\t\t\t\t&nbsp;&nbsp;|&nbsp;&nbsp;\n\t\t\t\t')
        # SOURCE LINE 37
        __M_writer(escape(h.h_tags.link_to_unless(c.letter==u'\u0410', u'\u0410', url='/stores/letter/%s'%u'\u0410')))
        __M_writer(u'\n\t\t\t\t')
        # SOURCE LINE 38
        __M_writer(escape(h.h_tags.link_to_unless(c.letter==u'\u0411', u'\u0411', url='/stores/letter/%s'%u'\u0411')))
        __M_writer(u'\n\t\t\t\t')
        # SOURCE LINE 39
        __M_writer(escape(h.h_tags.link_to_unless(c.letter==u'\u0412', u'\u0412', url='/stores/letter/%s'%u'\u0412')))
        __M_writer(u'\n\t\t\t\t')
        # SOURCE LINE 40
        __M_writer(escape(h.h_tags.link_to_unless(c.letter==u'\u0413', u'\u0413', url='/stores/letter/%s'%u'\u0413')))
        __M_writer(u'\n\t\t\t\t')
        # SOURCE LINE 41
        __M_writer(escape(h.h_tags.link_to_unless(c.letter==u'\u0414', u'\u0414', url='/stores/letter/%s'%u'\u0414')))
        __M_writer(u'\n\t\t\t\t')
        # SOURCE LINE 42
        __M_writer(escape(h.h_tags.link_to_unless(c.letter==u'\u042d', u'\u042d', url='/stores/letter/%s'%u'\u042d')))
        __M_writer(u'\n\t\t\t\t')
        # SOURCE LINE 43
        __M_writer(escape(h.h_tags.link_to_unless(c.letter==u'\u0415', u'\u0415', url='/stores/letter/%s'%u'\u0415')))
        __M_writer(u'\n\t\t\t\t')
        # SOURCE LINE 44
        __M_writer(escape(h.h_tags.link_to_unless(c.letter==u'\u0416', u'\u0416', url='/stores/letter/%s'%u'\u0416')))
        __M_writer(u'\n\t\t\t\t')
        # SOURCE LINE 45
        __M_writer(escape(h.h_tags.link_to_unless(c.letter==u'\u0417', u'\u0417', url='/stores/letter/%s'%u'\u0417')))
        __M_writer(u'\n\t\t\t\t')
        # SOURCE LINE 46
        __M_writer(escape(h.h_tags.link_to_unless(c.letter==u'\u0418', u'\u0418', url='/stores/letter/%s'%u'\u0418')))
        __M_writer(u'\n\t\t\t\t')
        # SOURCE LINE 47
        __M_writer(escape(h.h_tags.link_to_unless(c.letter==u'\u0419', u'\u0419', url='/stores/letter/%s'%u'\u0419')))
        __M_writer(u'\n\t\t\t\t')
        # SOURCE LINE 48
        __M_writer(escape(h.h_tags.link_to_unless(c.letter==u'\u041a', u'\u041a', url='/stores/letter/%s'%u'\u041a')))
        __M_writer(u'\n\t\t\t\t')
        # SOURCE LINE 49
        __M_writer(escape(h.h_tags.link_to_unless(c.letter==u'\u041b', u'\u041b', url='/stores/letter/%s'%u'\u041b')))
        __M_writer(u'\n\t\t\t\t')
        # SOURCE LINE 50
        __M_writer(escape(h.h_tags.link_to_unless(c.letter==u'\u041c', u'\u041c', url='/stores/letter/%s'%u'\u041c')))
        __M_writer(u'\n\t\t\t\t')
        # SOURCE LINE 51
        __M_writer(escape(h.h_tags.link_to_unless(c.letter==u'\u041d', u'\u041d', url='/stores/letter/%s'%u'\u041d')))
        __M_writer(u'\n\t\t\t\t')
        # SOURCE LINE 52
        __M_writer(escape(h.h_tags.link_to_unless(c.letter==u'\u041e', u'\u041e', url='/stores/letter/%s'%u'\u041e')))
        __M_writer(u'\n\t\t\t\t')
        # SOURCE LINE 53
        __M_writer(escape(h.h_tags.link_to_unless(c.letter==u'\u041f', u'\u041f', url='/stores/letter/%s'%u'\u041f')))
        __M_writer(u'\n\t\t\t\t')
        # SOURCE LINE 54
        __M_writer(escape(h.h_tags.link_to_unless(c.letter==u'\u0420', u'\u0420', url='/stores/letter/%s'%u'\u0420')))
        __M_writer(u'\n\t\t\t\t')
        # SOURCE LINE 55
        __M_writer(escape(h.h_tags.link_to_unless(c.letter==u'\u0421', u'\u0421', url='/stores/letter/%s'%u'\u0421')))
        __M_writer(u'\n\t\t\t\t')
        # SOURCE LINE 56
        __M_writer(escape(h.h_tags.link_to_unless(c.letter==u'\u0422', u'\u0422', url='/stores/letter/%s'%u'\u0422')))
        __M_writer(u'\n\t\t\t\t')
        # SOURCE LINE 57
        __M_writer(escape(h.h_tags.link_to_unless(c.letter==u'\u0423', u'\u0423', url='/stores/letter/%s'%u'\u0423')))
        __M_writer(u'\n\t\t\t\t')
        # SOURCE LINE 58
        __M_writer(escape(h.h_tags.link_to_unless(c.letter==u'\u0424', u'\u0424', url='/stores/letter/%s'%u'\u0424')))
        __M_writer(u'\n\t\t\t\t')
        # SOURCE LINE 59
        __M_writer(escape(h.h_tags.link_to_unless(c.letter==u'\u0425', u'\u0425', url='/stores/letter/%s'%u'\u0425')))
        __M_writer(u'\n\t\t\t\t')
        # SOURCE LINE 60
        __M_writer(escape(h.h_tags.link_to_unless(c.letter==u'\u0426', u'\u0426', url='/stores/letter/%s'%u'\u0426')))
        __M_writer(u'\n\t\t\t\t')
        # SOURCE LINE 61
        __M_writer(escape(h.h_tags.link_to_unless(c.letter==u'\u0427', u'\u0427', url='/stores/letter/%s'%u'\u0427')))
        __M_writer(u'\n\t\t\t\t')
        # SOURCE LINE 62
        __M_writer(escape(h.h_tags.link_to_unless(c.letter==u'\u0428', u'\u0428', url='/stores/letter/%s'%u'\u0428')))
        __M_writer(u'\n\t\t\t\t')
        # SOURCE LINE 63
        __M_writer(escape(h.h_tags.link_to_unless(c.letter==u'\u0429', u'\u0429', url='/stores/letter/%s'%u'\u0429')))
        __M_writer(u'\n\t\t\t\t')
        # SOURCE LINE 64
        __M_writer(escape(h.h_tags.link_to_unless(c.letter==u'\u042e', u'\u042e', url='/stores/letter/%s'%u'\u042e')))
        __M_writer(u'\n\t\t\t\t')
        # SOURCE LINE 65
        __M_writer(escape(h.h_tags.link_to_unless(c.letter==u'\u042f', u'\u042f', url='/stores/letter/%s'%u'\u042f')))
        __M_writer(u'\n\t\t\t\t')
        # SOURCE LINE 66
        __M_writer(escape(h.h_tags.link_to_unless(c.letter==u'0-9', u'0-9', url='/stores/letter/%s'%u'0-9')))
        __M_writer(u'\n\t\t\t</td>\n\t\t</tr>\n\t</tbody>\n</table>\n\n<table cellspacing="1" class="common">\n\t<thead>\n    \t<tr>\n\t\t\t<th>')
        # SOURCE LINE 75
        __M_writer(escape(_(u'\u041b\u043e\u0433\u043e\u0442\u0438\u043f')))
        __M_writer(u'</th>\n\t\t\t<th>')
        # SOURCE LINE 76
        __M_writer(escape(_(u'\u041d\u0430\u0437\u0432\u0430\u043d\u0438\u0435 \u043c\u0430\u0433\u0430\u0437\u0438\u043d\u0430')))
        __M_writer(u'</th>\n\t\t\t<th>')
        # SOURCE LINE 77
        __M_writer(escape(_(u'\u041c\u0435\u0441\u0442\u043e \u0440\u0430\u0437\u043c\u0435\u0449\u0435\u043d\u0438\u044f')))
        __M_writer(u'</th>\n\t\t\t<th>')
        # SOURCE LINE 78
        __M_writer(escape(_(u'\u0420\u0435\u0439\u0442\u0438\u043d\u0433')))
        __M_writer(u'</th>\n\t\t\t<th>')
        # SOURCE LINE 79
        __M_writer(escape(_(u'\u0422\u043e\u0432\u0430\u0440\u044b')))
        __M_writer(u'</th>\n\t\t\t<th>')
        # SOURCE LINE 80
        __M_writer(escape(_(u'\u0421\u0430\u0439\u0442 \u043c\u0430\u0433\u0430\u0437\u0438\u043d\u0430')))
        __M_writer(u'</th>\n\t\t</tr>\n\t</thead>\n')
        # SOURCE LINE 83
        for store in c.stores:
            # SOURCE LINE 84
            __M_writer(u'\t<tr>\n\t\t<td>\n\t\t</td>\n\t\t<td class="alignLeft">\n\t\t\t')
            # SOURCE LINE 88
            __M_writer(escape(store.name))
            __M_writer(u'\n\t\t</td>\n\t\t<td class="alignLeft">\n\t\t\t')
            # SOURCE LINE 91
            __M_writer(escape(store.name))
            __M_writer(u'\n\t\t</td>\n        <td class="noWrap">\n        \t')
            # SOURCE LINE 94
            __M_writer(escape(store.popularity))
            __M_writer(u'\n        \t<img alt="" src="http://images.us.ciao.com/ius/images/stars/2003/stars40.gif"/><br/>\n        \t<small><a href="http://www.ciao.com/Adorama_com__15482215">15 Ratings</a>        \t\t\t\t\t</small>\n        </td>\n        <td class="noWrap">\n\t\t\t<b><a href="http://www.ciao.com/shopping_partners/Adorama_com__5030188">')
            # SOURCE LINE 99
            __M_writer(escape(_(u'\u041f\u043e\u043a\u0430\u0437\u0430\u0442\u044c \u0442\u043e\u0432\u0430\u0440\u044b')))
            __M_writer(u'</a></b>\n   \t\t</td>\n        <td class="maintabCOLnar2">\n        \t')
            # SOURCE LINE 102
            __M_writer(escape(h.h_tools.button_to(_(u'\u041f\u0435\u0440\u0435\u0439\u0442\u0438 >'), url(controller='statistic', action='store', id=store.rid), class_='to-store-btn')))
            __M_writer(u'\n\t\t</td>\n\t</tr>\n')
        # SOURCE LINE 106
        __M_writer(u'</table>\n\n<table cellspacing="0" class="resultrangedownbg3 bg2norm">\n\t<tr>\n\t\t<td class="rangenextpage">\n\t\t</td>\n\t</tr>\n</table>\n\n')
        return ''
    finally:
        context.caller_stack._pop_frame()


