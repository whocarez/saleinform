from mako import runtime, filters, cache
UNDEFINED = runtime.UNDEFINED
__M_dict_builtin = dict
__M_locals_builtin = locals
_magic_number = 5
_modified_time = 1235420073.2446179
_template_filename='/home/mazvv/Projects/Python/Pylons/saleinform/saleinform/templates/admin/modules/clients/clients_add.mako'
_template_uri='/admin/modules/clients/clients_add.mako'
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
        city = context.get('city', UNDEFINED)
        __M_writer = context.writer()
        # SOURCE LINE 4
        __M_writer(u'\n<h3>\u0414\u043e\u0431\u0430\u0432\u043b\u0435\u043d\u0438\u0435 \u043a\u043b\u0438\u0435\u043d\u0442\u0430</h3>\n<div class="back-link">\n\t')
        # SOURCE LINE 7
        __M_writer(escape(h.h_tags.link_to(_(u'\u041d\u0430\u0437\u0430\u0434 \u043a \u0441\u043f\u0438\u0441\u043a\u0443 \u043a\u043b\u0438\u0435\u043d\u0442\u043e\u0432'), '/admin/clients')))
        __M_writer(u'\n</div>\n')
        # SOURCE LINE 9
        if c.a_operation_status==True:
            # SOURCE LINE 10
            __M_writer(u'<div class="message-save-success">\n\t')
            # SOURCE LINE 11
            __M_writer(escape(_(u'\u0418\u0437\u043c\u0435\u043d\u0435\u043d\u0438\u044f \u0443\u0441\u043f\u0435\u0448\u043d\u043e \u0441\u043e\u0445\u0440\u0430\u043d\u0435\u043d\u044b')))
            __M_writer(u'\n</div>\n')
            # SOURCE LINE 13
        elif c.a_operation_status==False:
            # SOURCE LINE 14
            __M_writer(u'<div class="message-save-failure">\n\t')
            # SOURCE LINE 15
            __M_writer(escape(_(u'\u0418\u0437\u043c\u0435\u043d\u0435\u043d\u0438\u044f \u043d\u0435 \u0441\u043e\u0445\u0440\u0430\u043d\u0435\u043d\u044b \u0438\u0437-\u0437\u0430 \u043e\u0448\u0438\u0431\u043e\u043a.')))
            __M_writer(u'\n</div>\n')
        # SOURCE LINE 18
        __M_writer(u'\n')
        # SOURCE LINE 19
        __M_writer(escape(h.h_tags.form(url='/admin/clients/action', method="post", multipart=True, id="clients")))
        __M_writer(u'\n')
        # SOURCE LINE 20
        __M_writer(escape(h.h_tags.hidden('action','add')))
        __M_writer(u'\n<div class="clients-processing">\n\t<table width="50%">\n\t<tr>\n\t\t<td width="40%">\n\t\t\t<label for="code">')
        # SOURCE LINE 25
        __M_writer(escape(_(u'\u041d\u0430\u0437\u0432\u0430\u043d\u0438\u0435')))
        __M_writer(u'</label>\n\t\t</td>\n\t\t<td>\n\t\t\t')
        # SOURCE LINE 28
        __M_writer(escape(h.h_tags.text('name', value="", id="name")))
        __M_writer(u'\n\t\t</td>\n\t</tr>\n\t<tr>\n\t\t<td width="40%">\n\t\t\t<label for="code">')
        # SOURCE LINE 33
        __M_writer(escape(_(u'\u041b\u043e\u0433\u043e\u0442\u0438\u043f')))
        __M_writer(u'</label>\n\t\t</td>\n\t\t<td>\n\t\t\t')
        # SOURCE LINE 36
        __M_writer(escape(h.h_tags.file('logo', value="", id="logo")))
        __M_writer(u'\n\t\t</td>\n\t</tr>\n\t<tr>\n\t\t<td width="40%">\n\t\t\t<label for="code">')
        # SOURCE LINE 41
        __M_writer(escape(_(u'\u0413\u043e\u0440\u043e\u0434')))
        __M_writer(u'</label>\n\t\t</td>\n\t\t<td>\n\t\t\t')
        # SOURCE LINE 44
        __M_writer(escape(h.h_tags.select('_cities_rid', "", [[city.Cities.rid, city.Cities.name+'-'+city.regionName+"-"+city.countryName] for city in c.a_cities], id="_cities_rid")))
        __M_writer(u'\n\t\t</td>\n\t</tr>\n\t<tr>\n\t\t<td width="40%">\n\t\t\t<label for="code">')
        # SOURCE LINE 49
        __M_writer(escape(_(u'\u0410\u0434\u0440\u0435\u0441')))
        __M_writer(u'</label>\n\t\t</td>\n\t\t<td>\n\t\t\t')
        # SOURCE LINE 52
        __M_writer(escape(h.h_tags.text('address', value="", id="address")))
        __M_writer(u'\n\t\t</td>\n\t</tr>\n\t<tr>\n\t\t<td width="40%">\n\t\t\t<label for="code">')
        # SOURCE LINE 57
        __M_writer(escape(_(u'\u0422\u0435\u043b\u0435\u0444\u043e\u043d\u044b')))
        __M_writer(u'</label>\n\t\t</td>\n\t\t<td>\n\t\t\t')
        # SOURCE LINE 60
        __M_writer(escape(h.h_tags.text('phones', value="", id="phones")))
        __M_writer(u'\n\t\t</td>\n\t</tr>\n\t<tr>\n\t\t<td width="40%">\n\t\t\t<label for="code">')
        # SOURCE LINE 65
        __M_writer(escape(_(u'Skype')))
        __M_writer(u'</label>\n\t\t</td>\n\t\t<td>\n\t\t\t')
        # SOURCE LINE 68
        __M_writer(escape(h.h_tags.text('skype', value="", id="skype")))
        __M_writer(u'\n\t\t</td>\n\t</tr>\n\t<tr>\n\t\t<td width="40%">\n\t\t\t<label for="code">')
        # SOURCE LINE 73
        __M_writer(escape(_(u'ICQ')))
        __M_writer(u'</label>\n\t\t</td>\n\t\t<td>\n\t\t\t')
        # SOURCE LINE 76
        __M_writer(escape(h.h_tags.text('icq', value="", id="icq")))
        __M_writer(u'\n\t\t</td>\n\t</tr>\n\t\n\t<tr>\n\t\t<td width="40%">\n\t\t\t<label for="code">')
        # SOURCE LINE 82
        __M_writer(escape(_(u'\u0421\u0430\u0439\u0442')))
        __M_writer(u'</label>\n\t\t</td>\n\t\t<td>\n\t\t\t')
        # SOURCE LINE 85
        __M_writer(escape(h.h_tags.text('url', value="", id="url")))
        __M_writer(u'\n\t\t</td>\n\t</tr>\n\t<tr>\n\t\t<td width="40%">\n\t\t\t<label for="code">')
        # SOURCE LINE 90
        __M_writer(escape(_(u'\u041a\u0440\u0435\u0434\u0438\u0442')))
        __M_writer(u'</label>\n\t\t</td>\n\t\t<td>\n\t\t\t')
        # SOURCE LINE 93
        __M_writer(escape(h.h_tags.checkbox('creadits_info', value=True, id="creadits_info")))
        __M_writer(u'\n\t\t</td>\n\t</tr>\n\t<tr>\n\t\t<td width="40%">\n\t\t\t<label for="code">')
        # SOURCE LINE 98
        __M_writer(escape(_(u'\u0414\u043e\u0441\u0442\u0430\u0432\u043a\u0430')))
        __M_writer(u'</label>\n\t\t</td>\n\t\t<td>\n\t\t\t')
        # SOURCE LINE 101
        __M_writer(escape(h.h_tags.textarea('delivery_info', value="", id="delivery_info")))
        __M_writer(u'\n\t\t</td>\n\t</tr>\n\t<tr>\n\t\t<td width="40%">\n\t\t\t<label for="code">')
        # SOURCE LINE 106
        __M_writer(escape(_(u'\u0412\u0440\u0435\u043c\u044f \u0440\u0430\u0431\u043e\u0442\u044b')))
        __M_writer(u'</label>\n\t\t</td>\n\t\t<td>\n\t\t\t')
        # SOURCE LINE 109
        __M_writer(escape(h.h_tags.textarea('worktime_info', value="", id="worktime_info")))
        __M_writer(u'\n\t\t</td>\n\t</tr>\n\t<tr>\n\t\t<td width="40%">\n\t\t\t<label for="code">')
        # SOURCE LINE 114
        __M_writer(escape(_(u'\u041e\u043f\u0438\u0441\u0430\u043d\u0438\u0435')))
        __M_writer(u'</label>\n\t\t</td>\n\t\t<td>\n\t\t\t')
        # SOURCE LINE 117
        __M_writer(escape(h.h_tags.textarea('descr', value="", id="descr")))
        __M_writer(u'\n\t\t</td>\n\t</tr>\n\t<tr>\n\t\t<td width="40%">\n\t\t\t<label for="code">')
        # SOURCE LINE 122
        __M_writer(escape(_(u'\u0417\u0430\u0433\u0440\u0443\u0437\u043a\u0430 \u043f\u0440\u0430\u0439\u0441\u043e\u0432')))
        __M_writer(u'</label>\n\t\t</td>\n\t\t<td>\n\t\t\t')
        # SOURCE LINE 125
        __M_writer(escape(h.h_tags.checkbox('isloaded', value=True, id="isloaded")))
        __M_writer(u'\n\t\t</td>\n\t</tr>\n\t<tr>\n\t\t<td width="40%">\n\t\t\t<label for="code">')
        # SOURCE LINE 130
        __M_writer(escape(_(u'\u0410\u043a\u0442\u0443\u0430\u043b\u044c\u043d\u043e\u0441\u0442\u044c \u043f\u0440\u0430\u0439\u0441\u0430')))
        __M_writer(u'</label>\n\t\t</td>\n\t\t<td>\n\t\t\t')
        # SOURCE LINE 133
        __M_writer(escape(h.h_tags.text('actual_days', value="", id="actual_days")))
        __M_writer(u'\n\t\t</td>\n\t</tr>\n\t<tr>\n\t\t<td width="40%">\n\t\t\t<label for="code">')
        # SOURCE LINE 138
        __M_writer(escape(_(u'Email \u043f\u0440\u0430\u0439\u0441\u0430')))
        __M_writer(u'</label>\n\t\t</td>\n\t\t<td>\n\t\t\t')
        # SOURCE LINE 141
        __M_writer(escape(h.h_tags.text('price_email', value="", id="price_email")))
        __M_writer(u'\n\t\t</td>\n\t</tr>\n\t<tr>\n\t\t<td width="40%">\n\t\t\t<label for="code">')
        # SOURCE LINE 146
        __M_writer(escape(_(u'\u0410\u0434\u0440\u0435\u0441 \u043f\u0440\u0430\u0439\u0441\u0430')))
        __M_writer(u'</label>\n\t\t</td>\n\t\t<td>\n\t\t\t')
        # SOURCE LINE 149
        __M_writer(escape(h.h_tags.text('price_url', value="", id="price_url")))
        __M_writer(u'\n\t\t</td>\n\t</tr>\n\t<tr>\n\t\t<td width="40%">\n\t\t\t<label for="code">')
        # SOURCE LINE 154
        __M_writer(escape(_(u'\u041a\u043e\u043d\u0442\u0430\u043a\u0442\u043d\u044b\u0435 \u0442\u0435\u043b\u0435\u0444\u043e\u043d\u044b')))
        __M_writer(u'</label>\n\t\t</td>\n\t\t<td>\n\t\t\t')
        # SOURCE LINE 157
        __M_writer(escape(h.h_tags.text('contact_phones', value="", id="contact_phones")))
        __M_writer(u'\n\t\t</td>\n\t</tr>\n\t<tr>\n\t\t<td width="40%">\n\t\t\t<label for="code">')
        # SOURCE LINE 162
        __M_writer(escape(_(u'\u041a\u043e\u043d\u0442\u0430\u043a\u0442\u043d\u044b\u0439 Email')))
        __M_writer(u'</label>\n\t\t</td>\n\t\t<td>\n\t\t\t')
        # SOURCE LINE 165
        __M_writer(escape(h.h_tags.text('contact_email', value="", id="contact_email")))
        __M_writer(u'\n\t\t</td>\n\t</tr>\n\t<tr>\n\t\t<td width="40%">\n\t\t\t<label for="code">')
        # SOURCE LINE 170
        __M_writer(escape(_(u'\u041a\u043e\u043d\u0442\u0430\u043a\u0442\u043d\u043e\u0435 \u043b\u0438\u0446\u043e')))
        __M_writer(u'</label>\n\t\t</td>\n\t\t<td>\n\t\t\t')
        # SOURCE LINE 173
        __M_writer(escape(h.h_tags.text('contact_person', value="", id="contact_person")))
        __M_writer(u'\n\t\t</td>\n\t</tr>\n\t<tr>\n\t\t<td width="40%">\n\t\t\t<label for="code">')
        # SOURCE LINE 178
        __M_writer(escape(_(u'\u0410\u043a\u0442\u0438\u0432\u043d\u044b\u0439')))
        __M_writer(u'</label>\n\t\t</td>\n\t\t<td>\n\t\t\t')
        # SOURCE LINE 181
        __M_writer(escape(h.h_tags.checkbox('active', value=True, id="active")))
        __M_writer(u'\n\t\t</td>\n\t</tr>\n\t<tr>\n\t\t<td width="40%">\n\t\t\t<label for="code">')
        # SOURCE LINE 186
        __M_writer(escape(_(u'\u041f\u043e\u043f\u0443\u043b\u044f\u0440\u043d\u043e\u0441\u0442\u044c')))
        __M_writer(u'</label>\n\t\t</td>\n\t\t<td>\n\t\t\t')
        # SOURCE LINE 189
        __M_writer(escape(h.h_tags.text('popularity', value="", id="popularity")))
        __M_writer(u'\n\t\t</td>\n\t</tr>\n\t</table>\n\t')
        # SOURCE LINE 193
        __M_writer(escape(h.h_tags.submit('submit', _(u'\u0421\u043e\u0445\u0440\u0430\u043d\u0438\u0442\u044c'))))
        __M_writer(u'\n</div>\n')
        # SOURCE LINE 195
        __M_writer(escape(h.h_tags.end_form()))
        __M_writer(u'\n\n')
        return ''
    finally:
        context.caller_stack._pop_frame()


