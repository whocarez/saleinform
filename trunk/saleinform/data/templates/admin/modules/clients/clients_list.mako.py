from mako import runtime, filters, cache
UNDEFINED = runtime.UNDEFINED
__M_dict_builtin = dict
__M_locals_builtin = locals
_magic_number = 5
_modified_time = 1235428527.904197
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
        __M_writer(escape(h.h_tags.link_to(_(u'\u0414\u043e\u0431\u0430\u0432\u0438\u0442\u044c'), url='/admin/clients/action')))
        __M_writer(u'</div>\n\t\t\t\t\t<div class="refresh-tool">')
        # SOURCE LINE 14
        __M_writer(escape(h.h_tags.link_to(_(u'\u041e\u0431\u043d\u043e\u0432\u0438\u0442\u044c'), url='/admin/clients/refresh')))
        __M_writer(u'</div>\n\t\t\t\t</div>\n\t\t\t\t<div class="search-bar">\n\t\t\t\t\t<h3>')
        # SOURCE LINE 17
        __M_writer(escape(_(u'\u041f\u043e\u0438\u0441\u043a \u043a\u043b\u0438\u0435\u043d\u0442\u043e\u0432')))
        __M_writer(u'</h3>\n\t\t\t\t\t')
        # SOURCE LINE 18
        __M_writer(escape(h.h_tags.form(url='/admin/clients', method="post", id="clients")))
        __M_writer(u'\n\t\t\t\t\t')
        # SOURCE LINE 19
        __M_writer(escape(h.h_tags.hidden('action','search')))
        __M_writer(u'\n\t\t\t\t\t<table cellpadding="5" cellspacing="2">\n\t\t\t\t\t\t<tr>\n\t\t\t\t\t\t\t<td>\n\t\t\t\t\t\t\t\t')
        # SOURCE LINE 23
        __M_writer(escape(_(u'\u041d\u0430\u0438\u043c\u0435\u043d\u043e\u0432\u0430\u043d\u0438\u0435')))
        __M_writer(u'\n\t\t\t\t\t\t\t\t')
        # SOURCE LINE 24
        __M_writer(escape(h.h_tags.text('s_name', '', id="s_name")))
        __M_writer(u'\n\t\t\t\t\t\t\t</td>\n\t\t\t\t\t\t\t<td>\n\t\t\t\t\t\t\t\t')
        # SOURCE LINE 27
        __M_writer(escape(_(u'\u041c\u0435\u0441\u0442\u043e')))
        __M_writer(u'\n\t\t\t\t\t\t\t\t')
        # SOURCE LINE 28
        __M_writer(escape(h.h_tags.text('s_place', '', id="s_place")))
        __M_writer(u'\n\t\t\t\t\t\t\t</td>\n\t\t\t\t\t\t\t<td>')
        # SOURCE LINE 30
        __M_writer(escape(h.h_tags.submit('submit',_(u'\u041d\u0430\u0439\u0442\u0438'))))
        __M_writer(u'</td>\n\t\t\t\t\t\t</tr>\n\t\t\t\t\t</table>\n\t\t\t\t\t')
        # SOURCE LINE 33
        __M_writer(escape(h.h_tags.end_form()))
        __M_writer(u'\n\t\t\t\t</div>\n\t\t\t\t')
        # SOURCE LINE 35
        __M_writer(escape(h.h_tags.form(url='/admin/clients', method="post", id="clients")))
        __M_writer(u'\n\t\t\t\t')
        # SOURCE LINE 36
        __M_writer(escape(h.h_tags.hidden('action','save')))
        __M_writer(u'\n\t\t\t\t<table class="admin-clients" cellpadding="0" cellspacing="0">\n\t\t\t\t\t<thead>\n\t\t\t\t\t\t<tr>\n\t\t\t\t\t\t\t<th>')
        # SOURCE LINE 40
        __M_writer(escape(h.h_tags.checkbox('check_all', value=0, checked=False, label=None, id="check_all")))
        __M_writer(u'</th>\n\t\t\t\t\t\t\t<th>')
        # SOURCE LINE 41
        __M_writer(escape(_(u'\u041b\u043e\u0433\u043e')))
        __M_writer(u'</th>\n\t\t\t\t\t\t\t<th>\n\t\t\t\t\t\t\t\t')
        # SOURCE LINE 43
        __M_writer(escape(h.h_tags.link_to(_(u'\u041d\u0430\u0438\u043c\u0435\u043d\u043e\u0432\u0430\u043d\u0438\u0435'), '/admin/clients/sort?s=name', title=_(u'\u0421\u043e\u0440\u0442\u0438\u0440\u043e\u0432\u0430\u0442\u044c'))))
        __M_writer(u'&nbsp;\n')
        # SOURCE LINE 44
        if c.a_sort=='name':
            # SOURCE LINE 45
            if c.a_sortrule=='asc':
                # SOURCE LINE 46
                __M_writer(u'\t\t\t\t\t\t\t\t\t\t')
                __M_writer(escape(h.h_tags.image('/img/icons/arrow_down.png', _(u'\u0421\u043e\u0440\u0442\u0438\u0440\u043e\u0432\u0430\u0442\u044c'), border="0")))
                __M_writer(u'\n')
                # SOURCE LINE 47
            else: 
                # SOURCE LINE 48
                __M_writer(u'\t\t\t\t\t\t\t\t\t\t')
                __M_writer(escape(h.h_tags.image('/img/icons/arrow_up.png', _(u'\u0421\u043e\u0440\u0442\u0438\u0440\u043e\u0432\u0430\u0442\u044c'), border="0")))
                __M_writer(u'\n')
        # SOURCE LINE 51
        __M_writer(u'\t\t\t\t\t\t\t</th>\n\t\t\t\t\t\t\t<th></th>\n\t\t\t\t\t\t\t<th>')
        # SOURCE LINE 53
        __M_writer(escape(_(u'\u041c\u0435\u0441\u0442\u043e')))
        __M_writer(u'</th>\n\t\t\t\t\t\t\t<th>')
        # SOURCE LINE 54
        __M_writer(escape(_(u'\u0422\u0435\u043b\u0435\u0444\u043e\u043d')))
        __M_writer(u'</th>\n\t\t\t\t\t\t\t<th>')
        # SOURCE LINE 55
        __M_writer(escape(_(u'\u041a\u043e\u043d\u0442\u0430\u043a\u0442\u043d\u043e\u0435 \u043b\u0438\u0446\u043e')))
        __M_writer(u'</th>\n\t\t\t\t\t\t\t<th>')
        # SOURCE LINE 56
        __M_writer(escape(_(u'\u041f\u0440\u0430\u0439\u0441')))
        __M_writer(u'</th>\n\t\t\t\t\t\t\t<th>')
        # SOURCE LINE 57
        __M_writer(escape(_(u'\u0410\u043a\u0442\u0438\u0432\u043d\u044b\u0439')))
        __M_writer(u'</th>\n\t\t\t\t\t\t\t<th>\n\t\t\t\t\t\t\t\t')
        # SOURCE LINE 59
        __M_writer(escape(h.h_tags.link_to(_(u'\u0414\u043e\u0431\u0430\u0432\u043b\u0435\u043d'), '/admin/clients/sort?s=createdt', title=_(u'\u0421\u043e\u0440\u0442\u0438\u0440\u043e\u0432\u0430\u0442\u044c'))))
        __M_writer(u'&nbsp;\n')
        # SOURCE LINE 60
        if c.a_sort=='createdt':
            # SOURCE LINE 61
            if c.a_sortrule=='asc':
                # SOURCE LINE 62
                __M_writer(u'\t\t\t\t\t\t\t\t\t\t')
                __M_writer(escape(h.h_tags.image('/img/icons/arrow_down.png', _(u'\u0421\u043e\u0440\u0442\u0438\u0440\u043e\u0432\u0430\u0442\u044c'), border="0")))
                __M_writer(u'\n')
                # SOURCE LINE 63
            else: 
                # SOURCE LINE 64
                __M_writer(u'\t\t\t\t\t\t\t\t\t\t')
                __M_writer(escape(h.h_tags.image('/img/icons/arrow_up.png', _(u'\u0421\u043e\u0440\u0442\u0438\u0440\u043e\u0432\u0430\u0442\u044c'), border="0")))
                __M_writer(u'\n')
        # SOURCE LINE 67
        __M_writer(u'\t\t\t\t\t\t\t</th>\n\t\t\t\t\t\t\t<th></th>\n\t\t\t\t\t\t\t<th></th>\n\t\t\t\t\t\t\t<th></th>\n\t\t\t\t\t\t</tr>\n\t\t\t\t\t</thead>\n')
        # SOURCE LINE 73
        for row in c.a_clients:
            # SOURCE LINE 74
            __M_writer(u'\t\t\t\t\t<tr>\n\t\t\t\t\t\t<td>\n\t\t\t\t\t\t\t')
            # SOURCE LINE 76
            __M_writer(escape(h.h_tags.checkbox('check_clients', value=row.rid, checked=False, label=None)))
            __M_writer(u'\n\t\t\t\t\t\t\t')
            # SOURCE LINE 77
            __M_writer(escape(h.h_tags.hidden('client_rid', value=row.rid, checked=False, label=None)))
            __M_writer(u'\n\t\t\t\t\t\t</td>\n\t\t\t\t\t\t<td>\n')
            # SOURCE LINE 80
            if row.logo==u'':
                # SOURCE LINE 81
                __M_writer(u'\t\t\t\t\t\t\t')
                __M_writer(escape(h.h_tags.image('/img/cllogos/nologo2.gif', alt=row.name)))
                __M_writer(u'\n')
                # SOURCE LINE 82
            else:
                # SOURCE LINE 83
                __M_writer(u'\t\t\t\t\t\t\t')
                __M_writer(escape(h.h_tags.image(row.logo, alt=row.name)))
                __M_writer(u'\n')
            # SOURCE LINE 85
            __M_writer(u'\t\t\t\t\t\t</td>\n\t\t\t\t\t\t<td>')
            # SOURCE LINE 86
            __M_writer(escape(row.name))
            __M_writer(u'</td>\n\t\t\t\t\t\t<td>')
            # SOURCE LINE 87
            __M_writer(escape(h.h_tags.image(row.image_name, alt=row.countryName)))
            __M_writer(u'</td>\n\t\t\t\t\t\t<td>')
            # SOURCE LINE 88
            __M_writer(escape(row.cityName))
            __M_writer(u'<br>')
            __M_writer(escape(row.regionName))
            __M_writer(u'</td>\n\t\t\t\t\t\t<td>')
            # SOURCE LINE 89
            __M_writer(escape(row.contact_phones))
            __M_writer(u'</td>\n\t\t\t\t\t\t<td>')
            # SOURCE LINE 90
            __M_writer(escape(row.contact_person))
            __M_writer(u'</td>\n\t\t\t\t\t\t<td>')
            # SOURCE LINE 91
            __M_writer(escape(h.h_tags.checkbox('isloaded', value=row.rid, checked=row.isloaded, label=None)))
            __M_writer(u'</td>\n\t\t\t\t\t\t<td>')
            # SOURCE LINE 92
            __M_writer(escape(h.h_tags.checkbox('active', value=row.rid, checked=row.active, label=None)))
            __M_writer(u'</td>\n\t\t\t\t\t\t<td>')
            # SOURCE LINE 93
            __M_writer(escape(row.createdt.strftime('%d/%m/%Y')))
            __M_writer(u'</td>\n\t\t\t\t\t\t<td>')
            # SOURCE LINE 94
            __M_writer(escape(h.h_tools.mail_to(row.contact_email, h.h_tags.image('/img/icons/email_go.png', _(u'\u041e\u0442\u043f\u0440\u0430\u0432\u0438\u0442\u044c \u043f\u0438\u0441\u044c\u043c\u043e'), border="0"), encode = "hex")))
            __M_writer(u'</td>\t\t\t\t\t\t\n\t\t\t\t\t\t<td>')
            # SOURCE LINE 95
            __M_writer(escape(h.h_tags.link_to(h.h_tags.image('/img/icons/pencil.png', _(u'\u0420\u0435\u0434\u0430\u043a\u0442\u0438\u0440\u043e\u0432\u0430\u0442\u044c \u0437\u0430\u043f\u0438\u0441\u044c'), border="0"), '/admin/countries/action/'+str(row.rid), title=_(u'\u0420\u0435\u0434\u0430\u043a\u0442\u0438\u0440\u043e\u0432\u0430\u0442\u044c \u0437\u0430\u043f\u0438\u0441\u044c'))))
            __M_writer(u'</td>\n\t\t\t\t\t\t<td>')
            # SOURCE LINE 96
            __M_writer(escape(h.h_tags.link_to(h.h_tags.image('/img/icons/arrow_right.png', _(u'\u041f\u0435\u0440\u0435\u0439\u0442\u0438 \u043d\u0430 \u0441\u0430\u0439\u0442'), border="0"), row.url, title=_(u'\u041f\u0435\u0440\u0435\u0439\u0442\u0438 \u043d\u0430 \u0441\u0430\u0439\u0442'))))
            __M_writer(u'</td>\n\t\t\t\t\t</tr>\n')
        # SOURCE LINE 99
        __M_writer(u'\t\t\t\t</table>\n\t\t\t\t')
        # SOURCE LINE 100
        __M_writer(escape(h.h_tags.submit('submit',_(u'\u0421\u043e\u0445\u0440\u0430\u043d\u0438\u0442\u044c'))))
        __M_writer(u'\n\t\t\t\t')
        # SOURCE LINE 101
        __M_writer(escape(h.h_tags.end_form()))
        __M_writer(u'\n\t\t\t\t<div class="pager">\n\t\t\t\t\t')
        # SOURCE LINE 103
        __M_writer(escape(h.h_builder.literal(c.a_pager)))
        __M_writer(u'\n\t\t\t\t</div>\n\t\t\t</div>\n\t\t\t\n\t\t\t<script type="text/javascript">\n                $(document).ready(function(){\n                        $("#countries > table > thead > tr > th > #check_all").click(function(){\n                                var checked_status = this.checked;\n                                $("input[name=\'check_countries\']").each(function(){\n                                        this.checked = checked_status;\n                                });\n                        });\n                });\n\t\t\t</script>\n\t\t\t\n\t\t\t\n')
        return ''
    finally:
        context.caller_stack._pop_frame()


