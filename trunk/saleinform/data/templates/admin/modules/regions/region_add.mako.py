from mako import runtime, filters, cache
UNDEFINED = runtime.UNDEFINED
__M_dict_builtin = dict
__M_locals_builtin = locals
_magic_number = 5
_modified_time = 1235321471.7611811
_template_filename='/home/mazvv/Projects/Python/Pylons/saleinform/saleinform/templates/admin/modules/regions/region_add.mako'
_template_uri='/admin/modules/regions/region_add.mako'
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
        # SOURCE LINE 4
        __M_writer(u'\n<div class="regions-container">\n<h3>')
        # SOURCE LINE 6
        __M_writer(escape(_(u'\u0414\u043e\u0431\u0430\u0432\u043b\u0435\u043d\u0438\u0435 \u0440\u0435\u0433\u0438\u043e\u043d\u043e\u0432')))
        __M_writer(u'</h3>\n<div class="back-link">\n\t')
        # SOURCE LINE 8
        __M_writer(escape(h.h_tags.link_to(_(u'\u041d\u0430\u0437\u0430\u0434 \u043a \u0434\u0435\u0440\u0435\u0432\u0443 \u0440\u0435\u0433\u0438\u043e\u043d\u043e\u0432'), '/admin/regions')))
        __M_writer(u'\n</div>\n')
        # SOURCE LINE 10
        if c.a_operation_status==True:
            # SOURCE LINE 11
            __M_writer(u'<div class="message-save-success">\n\t')
            # SOURCE LINE 12
            __M_writer(escape(_(u'\u0418\u0437\u043c\u0435\u043d\u0435\u043d\u0438\u044f \u0443\u0441\u043f\u0435\u0448\u043d\u043e \u0441\u043e\u0445\u0440\u0430\u043d\u0435\u043d\u044b')))
            __M_writer(u'\n</div>\n')
            # SOURCE LINE 14
        elif c.a_operation_status==False:
            # SOURCE LINE 15
            __M_writer(u'<div class="message-save-failure">\n\t')
            # SOURCE LINE 16
            __M_writer(escape(_(u'\u0418\u0437\u043c\u0435\u043d\u0435\u043d\u0438\u044f \u043d\u0435 \u0441\u043e\u0445\u0440\u0430\u043d\u0435\u043d\u044b \u0438\u0437-\u0437\u0430 \u043e\u0448\u0438\u0431\u043e\u043a.')))
            __M_writer(u'\n</div>\n')
        # SOURCE LINE 19
        __M_writer(u'\n')
        # SOURCE LINE 20
        __M_writer(escape(h.h_tags.form(url='/admin/regions/rp?_countries_rid=%s'%c.a_country.rid, method="post", multipart=True, id="regions")))
        __M_writer(u'\n')
        # SOURCE LINE 21
        __M_writer(escape(h.h_tags.hidden('action','add')))
        __M_writer(u'\n<div class="regions-processing">\n\t<table width="50%">\n\t<tr>\n\t\t<td width="40%">\n\t\t\t<label for="code">')
        # SOURCE LINE 26
        __M_writer(escape(_(u'\u0421\u0442\u0440\u0430\u043d\u0430')))
        __M_writer(u'</label>\n\t\t</td>\n\t\t<td>\n\t\t\t')
        # SOURCE LINE 29
        __M_writer(escape(c.a_country.name))
        __M_writer(u'\n\t\t</td>\n\t</tr>\n\t<tr>\n\t\t<td>\n\t\t\t<label for="name">')
        # SOURCE LINE 34
        __M_writer(escape(_(u'\u041d\u0430\u0437\u0432\u0430\u043d\u0438\u0435 \u0440\u0435\u0433\u0438\u043e\u043d\u0430')))
        __M_writer(u'</label>\n\t\t</td>\n\t\t<td>\n\t\t\t')
        # SOURCE LINE 37
        __M_writer(escape(h.h_tags.text('name', value="", id="name")))
        __M_writer(u'\n\t\t</td>\n\t</tr>\n\t</table>\n\t')
        # SOURCE LINE 41
        __M_writer(escape(h.h_tags.submit('submit', _(u'\u0421\u043e\u0445\u0440\u0430\u043d\u0438\u0442\u044c'))))
        __M_writer(u'\n</div>\n')
        # SOURCE LINE 43
        __M_writer(escape(h.h_tags.end_form()))
        __M_writer(u'\n</div>\n')
        return ''
    finally:
        context.caller_stack._pop_frame()


