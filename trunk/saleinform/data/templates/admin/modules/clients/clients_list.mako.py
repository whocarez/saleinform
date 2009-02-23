from mako import runtime, filters, cache
UNDEFINED = runtime.UNDEFINED
__M_dict_builtin = dict
__M_locals_builtin = locals
_magic_number = 5
_modified_time = 1235390625.6790559
_template_filename='/home/mazvv/Projects/Python/Pylons/saleinform/saleinform/templates/admin/modules/clients/clients_list.mako'
_template_uri='/admin/modules/clients/clients_list.mako'
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
        __M_writer(u'\t\t\t<div class="clients-container">\n\t\t\t\t<h3>\u041a\u043b\u0438\u0435\u043d\u0442\u044b</h3>\n')
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
        __M_writer(u'\t\t\t\t<div class="clients-toolbar">\n\t\t\t\t\t<div class="add-tool">')
        # SOURCE LINE 13
        __M_writer(escape(h.h_tags.link_to(_(u'\u0414\u043e\u0431\u0430\u0432\u0438\u0442\u044c'), url='/admin/countries/action')))
        __M_writer(u'</div>\n\t\t\t\t</div>\n\t\t\t\t')
        # SOURCE LINE 15
        __M_writer(escape(h.h_tags.form(url='/admin/countries', method="post", id="countries")))
        __M_writer(u'\n\t\t\t\t')
        # SOURCE LINE 16
        __M_writer(escape(h.h_tags.hidden('action','save')))
        __M_writer(u'\n\t\t\t\t<table class="admin-clients" cellpadding="0" cellspacing="0">\n\t\t\t\t\t<thead>\n\t\t\t\t\t\t<tr>\n\t\t\t\t\t\t\t<th>')
        # SOURCE LINE 20
        __M_writer(escape(h.h_tags.checkbox('check_all', value=0, checked=False, label=None, id="check_all")))
        __M_writer(u'</th>\n\t\t\t\t\t\t\t<th>')
        # SOURCE LINE 21
        __M_writer(escape(_(u'\u041b\u043e\u0433\u043e')))
        __M_writer(u'</th>\n\t\t\t\t\t\t\t<th>')
        # SOURCE LINE 22
        __M_writer(escape(_(u'\u041d\u0430\u0438\u043c\u0435\u043d\u043e\u0432\u0430\u043d\u0438\u0435')))
        __M_writer(u'</th>\n\t\t\t\t\t\t\t<th></th>\n\t\t\t\t\t\t\t<th>')
        # SOURCE LINE 24
        __M_writer(escape(_(u'\u041c\u0435\u0441\u0442\u043e')))
        __M_writer(u'</th>\n\t\t\t\t\t\t\t<th>')
        # SOURCE LINE 25
        __M_writer(escape(_(u'\u0422\u0435\u043b\u0435\u0444\u043e\u043d')))
        __M_writer(u'</th>\n\t\t\t\t\t\t\t<th>')
        # SOURCE LINE 26
        __M_writer(escape(_(u'Email')))
        __M_writer(u'</th>\n\t\t\t\t\t\t\t<th>')
        # SOURCE LINE 27
        __M_writer(escape(_(u'\u041a\u043e\u043d\u0442\u0430\u043a\u0442\u043d\u043e\u0435 \u043b\u0438\u0446\u043e')))
        __M_writer(u'</th>\n\t\t\t\t\t\t\t<th>')
        # SOURCE LINE 28
        __M_writer(escape(_(u'\u041f\u0440\u0430\u0439\u0441')))
        __M_writer(u'</th>\n\t\t\t\t\t\t\t<th>')
        # SOURCE LINE 29
        __M_writer(escape(_(u'\u0410\u043a\u0442\u0438\u0432\u043d\u044b\u0439')))
        __M_writer(u'</th>\n\t\t\t\t\t\t\t<th></th>\n\t\t\t\t\t\t\t<th></th>\n\t\t\t\t\t\t</tr>\n\t\t\t\t\t</thead>\n')
        # SOURCE LINE 34
        for row in c.a_clients:
            # SOURCE LINE 35
            __M_writer(u'\t\t\t\t\t<tr>\n\t\t\t\t\t\t<td>')
            # SOURCE LINE 36
            __M_writer(escape(h.h_tags.checkbox('check_clients', value=row.rid, checked=False, label=None)))
            __M_writer(u'</td>\n\t\t\t\t\t\t<td></td>\n\t\t\t\t\t\t<td>')
            # SOURCE LINE 38
            __M_writer(escape(row.name))
            __M_writer(u'</td>\n\t\t\t\t\t\t<td>')
            # SOURCE LINE 39
            __M_writer(escape(h.h_tags.image(row.image_name, alt=row.countryName)))
            __M_writer(u'</td>\n\t\t\t\t\t\t<td>')
            # SOURCE LINE 40
            __M_writer(escape(row.cityName))
            __M_writer(u'<br>')
            __M_writer(escape(row.regionName))
            __M_writer(u'</td>\n\t\t\t\t\t\t<td>')
            # SOURCE LINE 41
            __M_writer(escape(row.contact_phones))
            __M_writer(u'</td>\n\t\t\t\t\t\t<td>')
            # SOURCE LINE 42
            __M_writer(escape(row.contact_email))
            __M_writer(u'</td>\n\t\t\t\t\t\t<td>')
            # SOURCE LINE 43
            __M_writer(escape(row.contact_person))
            __M_writer(u'</td>\n\t\t\t\t\t\t<td>')
            # SOURCE LINE 44
            __M_writer(escape(h.h_tags.checkbox('isloaded', value=row.isloaded, checked=row.isloaded, label=None)))
            __M_writer(u'</td>\n\t\t\t\t\t\t<td>')
            # SOURCE LINE 45
            __M_writer(escape(h.h_tags.checkbox('active', value=row.active, checked=row.active, label=None)))
            __M_writer(u'</td>\n\t\t\t\t\t\t<td>')
            # SOURCE LINE 46
            __M_writer(escape(h.h_tags.link_to(h.h_tags.image('/img/icons/pencil.png', _(u'\u0420\u0435\u0434\u0430\u043a\u0442\u0438\u0440\u043e\u0432\u0430\u0442\u044c \u0437\u0430\u043f\u0438\u0441\u044c'), border="0"), '/admin/countries/action/'+str(row.rid), title=_(u'\u0420\u0435\u0434\u0430\u043a\u0442\u0438\u0440\u043e\u0432\u0430\u0442\u044c \u0437\u0430\u043f\u0438\u0441\u044c'))))
            __M_writer(u'</td>\n\t\t\t\t\t\t<td>\n\t\t\t\t\t\t\t<div class="btnR">\n\t\t\t\t\t\t\t\t')
            # SOURCE LINE 49
            __M_writer(escape(h.h_tags.link_to(_(u"\u041f\u0435\u0440\u0435\u0439\u0442\u0438 >"), row.url, class_='btnL', target="_blank")))
            __M_writer(u'\n\t\t\t\t\t\t\t</div>\n\t\t\t\t\t\t</td>\n\t\t\t\t\t</tr>\n')
        # SOURCE LINE 54
        __M_writer(u'\t\t\t\t</table>\n\t\t\t\t')
        # SOURCE LINE 55
        __M_writer(escape(h.h_tags.submit('submit',_(u'\u0421\u043e\u0445\u0440\u0430\u043d\u0438\u0442\u044c'))))
        __M_writer(u'\n\t\t\t\t')
        # SOURCE LINE 56
        __M_writer(escape(h.h_tags.end_form()))
        __M_writer(u'\n\t\t\t\t<div class="pager">\n\t\t\t\t\t')
        # SOURCE LINE 58
        __M_writer(escape(h.h_builder.literal(c.a_pager)))
        __M_writer(u'\n\t\t\t\t</div>\n\t\t\t</div>\n\t\t\t\n\t\t\t<script type="text/javascript">\n                $(document).ready(function(){\n                        $("#countries > table > thead > tr > th > #check_all").click(function(){\n                                var checked_status = this.checked;\n                                $("input[name=\'check_countries\']").each(function(){\n                                        this.checked = checked_status;\n                                });\n                        });\n                });\n\t\t\t</script>\n\t\t\t\n\t\t\t\n')
        return ''
    finally:
        context.caller_stack._pop_frame()


