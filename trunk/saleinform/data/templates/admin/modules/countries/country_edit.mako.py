from mako import runtime, filters, cache
UNDEFINED = runtime.UNDEFINED
__M_dict_builtin = dict
__M_locals_builtin = locals
_magic_number = 5
_modified_time = 1234973261.467335
_template_filename='/home/mazvv/Projects/Python/Pylons/saleinform/saleinform/templates/admin/modules/countries/country_edit.mako'
_template_uri='/admin/modules/countries/country_edit.mako'
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
        str = context.get('str', UNDEFINED)
        _ = context.get('_', UNDEFINED)
        __M_writer = context.writer()
        # SOURCE LINE 4
        __M_writer(u'\n<h3>\u0420\u0435\u0434\u0430\u043a\u0442\u0438\u0440\u043e\u0432\u0430\u043d\u0438\u0435 \u0441\u0442\u0440\u0430\u043d\u044b</h3>\n<div class="back-link">\n\t')
        # SOURCE LINE 7
        __M_writer(escape(h.h_tags.link_to(_(u'\u041d\u0430\u0437\u0430\u0434 \u043a \u0441\u043f\u0438\u0441\u043a\u0443 \u0441\u0442\u0440\u0430\u043d'), '/admin/countries')))
        __M_writer(u'\n</div>\n\n')
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
            __M_writer(escape(_(u'\u0412\u043e \u0432\u0440\u0435\u043c\u044f \u043e\u0431\u0440\u0430\u0431\u043e\u0442\u043a\u0438 \u043f\u0440\u043e\u0438\u0437\u043e\u0448\u043b\u0430 \u043e\u0448\u0438\u0431\u043a\u0430.')))
            __M_writer(u'\n</div>\n')
        # SOURCE LINE 19
        __M_writer(u'\n')
        # SOURCE LINE 20
        __M_writer(escape(h.h_tags.form(url='/admin/countries/action/'+str(c.a_country.rid), method="post", multipart=True, id="countries")))
        __M_writer(u'\n')
        # SOURCE LINE 21
        __M_writer(escape(h.h_tags.hidden('action','add')))
        __M_writer(u'\n<div class="country-processing">\n\t<table width="50%">\n\t<tr>\n\t\t<td width="40%">\n\t\t\t<label for="code">')
        # SOURCE LINE 26
        __M_writer(escape(_(u'\u041a\u043e\u0434 \u0441\u0442\u0440\u0430\u043d\u044b')))
        __M_writer(u'</label>\n\t\t</td>\n\t\t<td>\n\t\t\t')
        # SOURCE LINE 29
        __M_writer(escape(h.h_tags.text('code', value=c.a_country.code, id="code")))
        __M_writer(u'\n\t\t</td>\n\t</tr>\n\t<tr>\n\t\t<td>\n\t\t\t<label for="name">')
        # SOURCE LINE 34
        __M_writer(escape(_(u'\u041d\u0430\u0437\u0432\u0430\u043d\u0438\u0435 \u0441\u0442\u0440\u0430\u043d\u044b')))
        __M_writer(u'</label>\n\t\t</td>\n\t\t<td>\n\t\t\t')
        # SOURCE LINE 37
        __M_writer(escape(h.h_tags.text('name', value=c.a_country.name, id="name")))
        __M_writer(u'\n\t\t</td>\n\t</tr>\n\t<tr>\n\t\t<td>\n\t\t\t<label for="_currency_rid">')
        # SOURCE LINE 42
        __M_writer(escape(_(u'\u0412\u0430\u043b\u044e\u0442\u0430')))
        __M_writer(u'</label>\n\t\t</td>\n\t\t<td>\n')
        # SOURCE LINE 45
        for currency in c.a_currencies:
            # SOURCE LINE 46
            __M_writer(u'\t\t\t\t')
            __M_writer(escape(h.h_tags.radio('_currency_rid', value=currency.rid, id="_currency_rid", label=currency.code, checked=currency.rid==c.a_country._currency_rid)))
            __M_writer(u'<br>\t\n')
        # SOURCE LINE 48
        __M_writer(u'\t\t</td>\n\t\t\n\t</tr>\n\t<tr>\n\t\t<td>\n\t\t\t<label for="image_name">')
        # SOURCE LINE 53
        __M_writer(escape(_(u'\u0424\u043b\u0430\u0433 \u0441\u0442\u0440\u0430\u043d\u044b')))
        __M_writer(u'</label>\n\t\t</td>\n\t\t<td>\n\t\t\t')
        # SOURCE LINE 56
        __M_writer(escape(h.h_tags.file('image_name', value="", id="image_name")))
        __M_writer(u'<br>\n\t\t\t')
        # SOURCE LINE 57
        __M_writer(escape(h.h_tags.image(c.a_country.image_name, alt=_(u'\u0424\u043b\u0430\u0433 \u0441\u0442\u0440\u0430\u043d\u044b'))))
        __M_writer(u'\n\t\t</td>\t\n\t</tr>\n\t<tr>\n\t\t<td> \n\t\t\t<label for="archive">')
        # SOURCE LINE 62
        __M_writer(escape(_(u'\u0410\u0440\u0445\u0438\u0432\u043d\u044b\u0439')))
        __M_writer(u'</label>\n\t\t</td>\n\t\t<td>\n\t\t\t')
        # SOURCE LINE 65
        __M_writer(escape(h.h_tags.checkbox('archive', value=c.a_country.archive, id="archive")))
        __M_writer(u'\n\t\t</td>\t\n\t</tr>\n\t</table>\n\t')
        # SOURCE LINE 69
        __M_writer(escape(h.h_tags.submit('submit', _(u'\u0421\u043e\u0445\u0440\u0430\u043d\u0438\u0442\u044c'))))
        __M_writer(u'\n</div>\n')
        # SOURCE LINE 71
        __M_writer(escape(h.h_tags.end_form()))
        __M_writer(u'\n\n')
        return ''
    finally:
        context.caller_stack._pop_frame()


