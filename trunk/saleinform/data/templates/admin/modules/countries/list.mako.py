from mako import runtime, filters, cache
UNDEFINED = runtime.UNDEFINED
__M_dict_builtin = dict
__M_locals_builtin = locals
_magic_number = 5
_modified_time = 1234822418.3061481
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
        _ = context.get('_', UNDEFINED)
        __M_writer = context.writer()
        # SOURCE LINE 1
        __M_writer(u'\t\t\t<div class="countries-container">\n\t\t\t\t<h3>\u0421\u0442\u0440\u0430\u043d\u044b</h3>\n')
        # SOURCE LINE 3
        if c.a_operation_status==True:
            # SOURCE LINE 4
            __M_writer(u'\t\t\t\t<div class="message-save-success">\n\t\t\t\t\t')
            # SOURCE LINE 5
            __M_writer(escape(_(u'\u0418\u0437\u043c\u0435\u043d\u0435\u043d\u0438\u044f \u0443\u0441\u043f\u0435\u0448\u043d\u043e \u0441\u043e\u0445\u0440\u0430\u043d\u0435\u043d\u044b')))
            __M_writer(u'\n\t\t\t\t</div>\n')
            # SOURCE LINE 7
        elif c.a_operation_status==False:
            # SOURCE LINE 8
            __M_writer(u'\t\t\t\t<div class="message-save-failure">\n\t\t\t\t\t')
            # SOURCE LINE 9
            __M_writer(escape(_(u'\u0418\u0437\u043c\u0435\u043d\u0435\u043d\u0438\u044f \u043d\u0435 \u0441\u043e\u0445\u0440\u0430\u043d\u0435\u043d\u044b, \u0441\u043a\u043e\u0440\u0435\u0435 \u0432\u0441\u0435\u0433\u043e \u0438\u0437-\u0437\u0430 \u043d\u0430\u043b\u0438\u0447\u0438\u044f \u0437\u0430\u0432\u0438\u0441\u0438\u043c\u044b\u0445 \u0437\u0430\u043f\u0438\u0441\u0435\u0439.')))
            __M_writer(u'\n\t\t\t\t</div>\n')
        # SOURCE LINE 12
        __M_writer(u'\t\t\t\t')
        __M_writer(escape(h.h_tags.form(url='/admin/geography', method="post", id="countries")))
        __M_writer(u'\n\t\t\t\t')
        # SOURCE LINE 13
        __M_writer(escape(h.h_tags.hidden('action','save')))
        __M_writer(u'\n\t\t\t\t<table class="admin-countries" cellpadding="0" cellspacing="0">\n\t\t\t\t\t<thead>\n\t\t\t\t\t\t<tr>\n\t\t\t\t\t\t\t<th>')
        # SOURCE LINE 17
        __M_writer(escape(h.h_tags.checkbox('check_all', value=0, checked=False, label=None, id="check_all")))
        __M_writer(u'</th>\n\t\t\t\t\t\t\t<th>')
        # SOURCE LINE 18
        __M_writer(escape(_(u'\u041d\u0430\u0438\u043c\u0435\u043d\u043e\u0432\u0430\u043d\u0438\u0435')))
        __M_writer(u'</th>\n\t\t\t\t\t\t\t<th>')
        # SOURCE LINE 19
        __M_writer(escape(_(u'\u041a\u043e\u0434')))
        __M_writer(u'</th>\n\t\t\t\t\t\t\t<th>')
        # SOURCE LINE 20
        __M_writer(escape(_(u'\u0412\u0430\u043b\u044e\u0442\u0430')))
        __M_writer(u'</th>\n\t\t\t\t\t\t\t<th>')
        # SOURCE LINE 21
        __M_writer(escape(_(u'\u0410\u0440\u0445\u0438\u0432')))
        __M_writer(u'</th>\n\t\t\t\t\t\t</tr>\n\t\t\t\t\t</thead>\n')
        # SOURCE LINE 24
        for row in c.a_countries:
            # SOURCE LINE 25
            __M_writer(u'\t\t\t\t\t<tr>\n\t\t\t\t\t\t<td>')
            # SOURCE LINE 26
            __M_writer(escape(h.h_tags.checkbox('check_countries', value=row.rid, checked=False, label=None)))
            __M_writer(u'</td>\n\t\t\t\t\t\t<td>')
            # SOURCE LINE 27
            __M_writer(escape(row.name))
            __M_writer(u'</td>\n\t\t\t\t\t\t<td>')
            # SOURCE LINE 28
            __M_writer(escape(row.code))
            __M_writer(u'</td>\n\t\t\t\t\t\t<td>')
            # SOURCE LINE 29
            __M_writer(escape(row.currency_code))
            __M_writer(u'</td>\n\t\t\t\t\t\t<td>')
            # SOURCE LINE 30
            __M_writer(escape(h.h_tags.checkbox('archive', value=row.rid, checked=row.archive, label=None)))
            __M_writer(u'</td>\n\t\t\t\t\t</tr>\n')
        # SOURCE LINE 33
        __M_writer(u'\t\t\t\t</table>\n\t\t\t\t')
        # SOURCE LINE 34
        __M_writer(escape(h.h_tags.submit('submit',_(u'\u0421\u043e\u0445\u0440\u0430\u043d\u0438\u0442\u044c'))))
        __M_writer(u'\n\t\t\t\t')
        # SOURCE LINE 35
        __M_writer(escape(h.h_tags.end_form()))
        __M_writer(u'\n\t\t\t</div>\n\t\t\t\n\t\t\t<script type="text/javascript">\n                $(document).ready(function(){\n                        $("#countries > table > thead > tr > th > #check_all").click(function(){\n                                var checked_status = this.checked;\n                                $("input[name=\'check_countries\']").each(function(){\n                                        this.checked = checked_status;\n                                });\n                        });\n                });\n\t\t\t</script>\n\t\t\t\n\t\t\t\n')
        return ''
    finally:
        context.caller_stack._pop_frame()


