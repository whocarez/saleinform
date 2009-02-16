from mako import runtime, filters, cache
UNDEFINED = runtime.UNDEFINED
__M_dict_builtin = dict
__M_locals_builtin = locals
_magic_number = 5
_modified_time = 1234788108.1005061
_template_filename='/home/mazvv/Projects/Python/Pylons/saleinform/saleinform/templates/admin/modules/countries/list.mako'
_template_uri='/admin/modules/countries/list.mako'
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
        str = context.get('str', UNDEFINED)
        _ = context.get('_', UNDEFINED)
        __M_writer = context.writer()
        # SOURCE LINE 1
        __M_writer(u'\t\t\t<div class="countries-container">\n\t\t\t\t<h3>\u0421\u0442\u0440\u0430\u043d\u044b</h3>\n\t\t\t\t')
        # SOURCE LINE 3
        __M_writer(escape(h.h_tags.form(url='/admin/geography', method="post", id="countries")))
        __M_writer(u'\n\t\t\t\t<div class="countries-toolbar">\n\t\t\t\t\t')
        # SOURCE LINE 5
        __M_writer(escape(h.h_tags.link_to(h.h_tags.image(url='/img/icons/add.png', alt=_(u'\u0414\u043e\u0431\u0430\u0432\u0438\u0442\u044c \u0441\u0442\u0440\u0430\u043d\u0443'), border="0"), url='/admin/geography/add', title=_(u"\u0414\u043e\u0431\u0430\u0432\u0438\u0442\u044c \u0441\u0442\u0440\u0430\u043d\u0443"))))
        __M_writer(u'\n\t\t\t\t</div>\n\t\t\t\t')
        # SOURCE LINE 7
        __M_writer(escape(h.h_tags.hidden('action','save')))
        __M_writer(u'\n\t\t\t\t<table class="admin-countries" cellpadding="0" cellspacing="0">\n\t\t\t\t\t<thead>\n\t\t\t\t\t\t<tr>\n\t\t\t\t\t\t\t<th>')
        # SOURCE LINE 11
        __M_writer(escape(_(u'\u041d\u0430\u0438\u043c\u0435\u043d\u043e\u0432\u0430\u043d\u0438\u0435')))
        __M_writer(u'</th>\n\t\t\t\t\t\t\t<th>')
        # SOURCE LINE 12
        __M_writer(escape(_(u'\u041a\u043e\u0434')))
        __M_writer(u'</th>\n\t\t\t\t\t\t\t<th>')
        # SOURCE LINE 13
        __M_writer(escape(_(u'\u0412\u0430\u043b\u044e\u0442\u0430')))
        __M_writer(u'</th>\n\t\t\t\t\t\t\t<th>')
        # SOURCE LINE 14
        __M_writer(escape(_(u'\u0410\u0440\u0445\u0438\u0432')))
        __M_writer(u'</th>\n\t\t\t\t\t\t</tr>\n\t\t\t\t\t</thead>\n')
        # SOURCE LINE 17
        for row in c.a_countries:
            # SOURCE LINE 18
            __M_writer(u'\t\t\t\t\t<tr>\n\t\t\t\t\t\t<td>')
            # SOURCE LINE 19
            __M_writer(escape(row.name))
            __M_writer(u'</td>\n\t\t\t\t\t\t<td>')
            # SOURCE LINE 20
            __M_writer(escape(row.code))
            __M_writer(u'</td>\n\t\t\t\t\t\t<td>')
            # SOURCE LINE 21
            __M_writer(escape(row.currency_code))
            __M_writer(u'</td>\n\t\t\t\t\t\t<td>')
            # SOURCE LINE 22
            __M_writer(escape(h.h_tags.checkbox('archive_'+str(row.rid), value=row.rid, checked=row.archive, label=None)))
            __M_writer(u'</td>\n\t\t\t\t\t</tr>\n')
        # SOURCE LINE 25
        __M_writer(u'\t\t\t\t</table>\n\t\t\t\t')
        # SOURCE LINE 26
        __M_writer(escape(h.h_tags.submit('submit',_(u'\u0421\u043e\u0445\u0440\u0430\u043d\u0438\u0442\u044c'))))
        __M_writer(u'\n\t\t\t\t')
        # SOURCE LINE 27
        __M_writer(escape(h.h_tags.end_form()))
        __M_writer(u'\n\t\t\t</div>\n<script type="text/javascript">\n<!--\n$(document).ready(function(){\n\t  $(\'#countries\').FormObserve();\n});\n//-->\n</script>\n\t\t\t\n')
        return ''
    finally:
        context.caller_stack._pop_frame()


