from mako import runtime, filters, cache
UNDEFINED = runtime.UNDEFINED
__M_dict_builtin = dict
__M_locals_builtin = locals
_magic_number = 5
_modified_time = 1234973524.1469381
_template_filename='/home/mazvv/Projects/Python/Pylons/saleinform/saleinform/templates/admin/modules/navigation/hnavigator.mako'
_template_uri='/admin/modules/navigation/hnavigator.mako'
_template_cache=cache.Cache(__name__, _modified_time)
_source_encoding='utf-8'
from webhelpers.html import escape
_exports = []


def render_body(context,**pageargs):
    context.caller_stack._push_frame()
    try:
        __M_locals = __M_dict_builtin(pageargs=pageargs)
        h = context.get('h', UNDEFINED)
        _ = context.get('_', UNDEFINED)
        __M_writer = context.writer()
        # SOURCE LINE 1
        __M_writer(u'<div class="logo">\n\t<a target="_self" title="')
        # SOURCE LINE 2
        __M_writer(escape(_(u'\u0421\u0440\u0430\u0432\u043d\u0435\u043d\u0438\u0435 \u0446\u0435\u043d \u0438\u043d\u0442\u0435\u0440\u043d\u0435\u0442 \u043c\u0430\u0433\u0430\u0437\u0438\u043d\u043e\u0432, \u043f\u043e\u0438\u0441\u043a \u0442\u043e\u0432\u0430\u0440\u043e\u0432')))
        __M_writer(u'" href="/">\n\t\t')
        # SOURCE LINE 3
        __M_writer(escape(h.h_tags.image('/img/logo.gif', u'\u0421\u0440\u0430\u0432\u043d\u0435\u043d\u0438\u0435 \u0446\u0435\u043d \u0438\u043d\u0442\u0435\u0440\u043d\u0435\u0442 \u043c\u0430\u0433\u0430\u0437\u0438\u043d\u043e\u0432, \u043f\u043e\u0438\u0441\u043a \u0442\u043e\u0432\u0430\u0440\u043e\u0432', border="0")))
        __M_writer(u'\n\t</a>\n</div>\n\n<div class="glowingtabs" id="glowmenu">\n\t<ul>\n\t\t<li>\n\t\t\t')
        # SOURCE LINE 10
        __M_writer(escape(h.h_tags.link_to(h.h_builder.literal('<span>'+_(u'\u0414\u043e\u043c\u0430\u0448\u043d\u044f\u044f')+'</span>'), url='/admin/geography', title=_(u'\u0414\u043e\u043c\u0430\u0448\u043d\u044f\u044f'))))
        __M_writer(u'\n\t\t</li>\n\t\t<li class="">\n\t\t\t')
        # SOURCE LINE 13
        __M_writer(escape(h.h_tags.link_to(h.h_builder.literal('<span>'+_(u'\u0413\u0435\u043e\u0433\u0440\u0430\u0444\u0438\u044f')+'</span>'), url='/admin/countries', title=_(u'\u0413\u0435\u043e\u0433\u0440\u0430\u0444\u0438\u044f'), rel="dropmenu1_d")))
        __M_writer(u'\n\t\t</li>\n\t\t<li class="">\n\t\t\t')
        # SOURCE LINE 16
        __M_writer(escape(h.h_tags.link_to(h.h_builder.literal('<span>'+_(u'\u0413\u0435\u043e\u0433\u0440\u0430\u0444\u0438\u044f')+'</span>'), url='/admin/geography', title=_(u'\u0413\u0435\u043e\u0433\u0440\u0430\u0444\u0438\u044f'), rel="dropmenu2_d")))
        __M_writer(u'\n\t\t</li>\n\t\t<li>\n\t\t\t')
        # SOURCE LINE 19
        __M_writer(escape(h.h_tags.link_to(h.h_builder.literal('<span>'+_(u'\u0413\u0435\u043e\u0433\u0440\u0430\u0444\u0438\u044f')+'</span>'), url='', title=_(u'\u0413\u0435\u043e\u0433\u0440\u0430\u0444\u0438\u044f'), rel="dropmenu1_d")))
        __M_writer(u'\n\t\t</li>\n\t</ul>\n</div>\n\n<div class="dropmenudiv_d" id="dropmenu1_d" style="top: 830px; left: 252px; visibility: hidden;">\n\t')
        # SOURCE LINE 25
        __M_writer(escape(h.h_tags.link_to(_(u'\u0421\u0442\u0440\u0430\u043d\u044b'), url='/admin/countries', title=_(u'\u0421\u0442\u0440\u0430\u043d\u044b'), rel="dropmenu1_d", style="border-top-width: 0pt;")))
        __M_writer(u'\n\t')
        # SOURCE LINE 26
        __M_writer(escape(h.h_tags.link_to(_(u'\u0412\u0430\u043b\u044e\u0442\u044b'), url='/admin/currency', title=_(u'\u0412\u0430\u043b\u044e\u0442\u044b'), rel="dropmenu1_d", style="border-top-width: 0pt;")))
        __M_writer(u'\n</div>\n\n<div style="width: 150px; top: 830px; left: 351px; visibility: hidden;" class="dropmenudiv_d" id="dropmenu2_d">\n\t<a href="http://www.cssdrive.com" style="border-top-width: 0pt;">CSS Drive</a>\n\t<a href="http://www.javascriptkit.com">JavaScript Kit</a>\n\t<a href="http://www.codingforums.com">Coding Forums</a>\n\t<a href="http://www.javascriptkit.com/jsref/">JavaScript Reference</a>\n</div>\n\n<script type="text/javascript">\n<!--\n\ttabdropdown.init("glowmenu", "auto")\n//->\n</script>')
        return ''
    finally:
        context.caller_stack._pop_frame()


