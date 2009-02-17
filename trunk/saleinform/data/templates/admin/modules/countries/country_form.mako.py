from mako import runtime, filters, cache
UNDEFINED = runtime.UNDEFINED
__M_dict_builtin = dict
__M_locals_builtin = locals
_magic_number = 5
_modified_time = 1234891641.376653
_template_filename='/home/mazvv/Projects/Python/Pylons/saleinform/saleinform/templates/admin/modules/countries/country_form.mako'
_template_uri='/admin/modules/countries/country_form.mako'
_template_cache=cache.Cache(__name__, _modified_time)
_source_encoding='utf-8-'
from webhelpers.html import escape
_exports = []


# SOURCE LINE 41




def render_body(context,**pageargs):
    context.caller_stack._push_frame()
    try:
        __M_locals = __M_dict_builtin(pageargs=pageargs)
        h = context.get('h', UNDEFINED)
        c = context.get('c', UNDEFINED)
        cHecked = context.get('cHecked', UNDEFINED)
        _ = context.get('_', UNDEFINED)
        __M_writer = context.writer()
        # SOURCE LINE 4
        __M_writer(u'\n<h3>\u0414\u043e\u0431\u0430\u0432\u043b\u0435\u043d\u0438\u0435 \u0441\u0442\u0440\u0430\u043d\u044b</h3>\n')
        # SOURCE LINE 6
        if c.a_operation_status==True:
            # SOURCE LINE 7
            __M_writer(u'<div class="message-save-success">\n\t')
            # SOURCE LINE 8
            __M_writer(escape(_(u'\u0418\u0437\u043c\u0435\u043d\u0435\u043d\u0438\u044f \u0443\u0441\u043f\u0435\u0448\u043d\u043e \u0441\u043e\u0445\u0440\u0430\u043d\u0435\u043d\u044b')))
            __M_writer(u'\n</div>\n')
            # SOURCE LINE 10
        elif c.a_operation_status==False:
            # SOURCE LINE 11
            __M_writer(u'<div class="message-save-failure">\n\t')
            # SOURCE LINE 12
            __M_writer(escape(_(u'\u0418\u0437\u043c\u0435\u043d\u0435\u043d\u0438\u044f \u043d\u0435 \u0441\u043e\u0445\u0440\u0430\u043d\u0435\u043d\u044b, \u0441\u043a\u043e\u0440\u0435\u0435 \u0432\u0441\u0435\u0433\u043e \u0438\u0437-\u0437\u0430 \u043d\u0430\u043b\u0438\u0447\u0438\u044f \u0437\u0430\u0432\u0438\u0441\u0438\u043c\u044b\u0445 \u0437\u0430\u043f\u0438\u0441\u0435\u0439.')))
            __M_writer(u'\n</div>\n')
        # SOURCE LINE 15
        __M_writer(u'\n')
        # SOURCE LINE 16
        __M_writer(escape(h.h_tags.form(url='/admin/geography/action', method="post", id="countries")))
        __M_writer(u'\n')
        # SOURCE LINE 17
        __M_writer(escape(h.h_tags.hidden('action','add')))
        __M_writer(u'\n<div class="country-processing">\n\t<table width="30%">\n\t<tr>\n\t\t<td width="40%">\n\t\t\t<label for="code">')
        # SOURCE LINE 22
        __M_writer(escape(_(u'\u041a\u043e\u0434 \u0441\u0442\u0440\u0430\u043d\u044b')))
        __M_writer(u'</label>\n\t\t</td>\n\t\t<td>\n\t\t\t')
        # SOURCE LINE 25
        __M_writer(escape(h.h_tags.text('code', value=c.a_country.code or "", id="code")))
        __M_writer(u'\n\t\t</td>\n\t</tr>\n\t<tr>\n\t\t<td>\n\t\t\t<label for="name">')
        # SOURCE LINE 30
        __M_writer(escape(_(u'\u041d\u0430\u0437\u0432\u0430\u043d\u0438\u0435 \u0441\u0442\u0440\u0430\u043d\u044b')))
        __M_writer(u'</label>\n\t\t</td>\n\t\t<td>\n\t\t\t')
        # SOURCE LINE 33
        __M_writer(escape(h.h_tags.text('name', value=c.a_country.name or "", id="name")))
        __M_writer(u'\n\t\t</td>\n\t</tr>\n\t<tr>\n\t\t<td>\n\t\t\t<label for="_currency_rid">')
        # SOURCE LINE 38
        __M_writer(escape(_(u'\u0412\u0430\u043b\u044e\u0442\u0430')))
        __M_writer(u'</label>\n\t\t</td>\n\t\t<td>\n')
        # SOURCE LINE 43
        __M_writer(u'\n')
        # SOURCE LINE 44
        for currency in c.a_currencies:
            # SOURCE LINE 45
            __M_writer(u'\t\t\t\t')
            __M_writer(escape(h.h_tags.radio('_currency_rid', value=currency.rid, id="_currency_rid", label=currency.code, checked=cHecked(c.a_country._currencies_rid) or False)))
            __M_writer(u'<br>\t\n')
        # SOURCE LINE 47
        __M_writer(u'\t\t</td>\n\t\t\n\t</tr>\n\t<tr>\n\t\t<td>\n\t\t\t<label for="image_name">')
        # SOURCE LINE 52
        __M_writer(escape(_(u'\u0418\u0437\u043e\u0431\u0440\u0430\u0436\u0435\u043d\u0438\u0435 \u0441\u0442\u0440\u0430\u043d\u044b')))
        __M_writer(u'</label>\n\t\t</td>\n\t\t<td>\n\t\t\t')
        # SOURCE LINE 55
        __M_writer(escape(h.h_tags.text('image_name', value="", id="image_name")))
        __M_writer(u'\n\t\t</td>\t\n\t</tr>\n\t<tr>\n\t\t<td> \n\t\t\t<label for="archive">')
        # SOURCE LINE 60
        __M_writer(escape(_(u'\u0410\u0440\u0445\u0438\u0432\u043d\u044b\u0439')))
        __M_writer(u'</label>\n\t\t</td>\n\t\t<td>\n\t\t\t')
        # SOURCE LINE 63
        __M_writer(escape(h.h_tags.checkbox('archive', value=c.a_country.archive or False, id="archive")))
        __M_writer(u'\n\t\t</td>\t\n\t</tr>\n\t</table>\n\t')
        # SOURCE LINE 67
        __M_writer(escape(h.h_tags.submit('submit', _(u'\u0421\u043e\u0445\u0440\u0430\u043d\u0438\u0442\u044c'))))
        __M_writer(u'\n</div>\n')
        # SOURCE LINE 69
        __M_writer(escape(h.h_tags.end_form()))
        __M_writer(u'\n\n')
        return ''
    finally:
        context.caller_stack._pop_frame()


