from mako import runtime, filters, cache
UNDEFINED = runtime.UNDEFINED
__M_dict_builtin = dict
__M_locals_builtin = locals
_magic_number = 5
_modified_time = 1235325385.5368371
_template_filename='/home/mazvv/Projects/Python/Pylons/saleinform/saleinform/templates/admin/modules/regions/regions_sublist.mako'
_template_uri='/admin/modules/regions/regions_sublist.mako'
_template_cache=cache.Cache(__name__, _modified_time)
_source_encoding='utf-8-'
from webhelpers.html import escape
_exports = []


def render_body(context,**pageargs):
    context.caller_stack._push_frame()
    try:
        __M_locals = __M_dict_builtin(pageargs=pageargs)
        h = context.get('h', UNDEFINED)
        c = context.get('c', UNDEFINED)
        _ = context.get('_', UNDEFINED)
        __M_writer = context.writer()
        # SOURCE LINE 2
        __M_writer(u'<ul>\n')
        # SOURCE LINE 3
        for region in c.a_regions:
            # SOURCE LINE 4
            __M_writer(u"\t<li id='region")
            __M_writer(escape(region.rid))
            __M_writer(u"'><span>")
            __M_writer(escape(region.name))
            __M_writer(u'</span>\n\t')
            # SOURCE LINE 5
            __M_writer(escape(h.h_tags.link_to(h.h_tags.image('/img/icons/add.png', alt=_(u'\u0414\u043e\u0431\u0430\u0432\u0438\u0442\u044c \u0433\u043e\u0440\u043e\u0434'), border="0"), '/admin/regions/cp?_regions_rid=%s'%(region.rid), title=_(u'\u0414\u043e\u0431\u0430\u0432\u0438\u0442\u044c \u0433\u043e\u0440\u043e\u0434'))))
            __M_writer(u'\n\t')
            # SOURCE LINE 6
            __M_writer(escape(h.h_tags.link_to(h.h_tags.image('/img/icons/pencil.png', alt=_(u'\u0420\u0435\u0434\u0430\u043a\u0442\u0438\u0440\u043e\u0432\u0430\u0442\u044c \u0440\u0435\u0433\u0438\u043e\u043d'), border="0"), '/admin/regions/rp/%s?_countries_rid=%s'%(region.rid, region._countries_rid), title=_(u'\u0420\u0435\u0434\u0430\u043a\u0442\u0438\u0440\u043e\u0432\u0430\u0442\u044c \u0440\u0435\u0433\u0438\u043e\u043d'))))
            __M_writer(u'\n\t')
            # SOURCE LINE 7
            __M_writer(escape(h.h_tags.link_to(h.h_tags.image('/img/icons/delete.png', alt=_(u'\u0423\u0434\u0430\u043b\u0438\u0442\u044c \u0440\u0435\u0433\u0438\u043e\u043d'), border="0"), '/admin/regions/rr/%s'%region.rid, title=_(u'\u0423\u0434\u0430\u043b\u0438\u0442\u044c \u0440\u0435\u0433\u0438\u043e\u043d'))))
            __M_writer(u'\n\t\t<ul class="ajax">\n\t\t\t<li>{url:/admin/regions/get?region=')
            # SOURCE LINE 9
            __M_writer(escape(region.rid))
            __M_writer(u'}</li>\n\t\t</ul>\n\t</li>\n')
        # SOURCE LINE 13
        __M_writer(u'</ul>\n')
        return ''
    finally:
        context.caller_stack._pop_frame()


