from mako import runtime, filters, cache
UNDEFINED = runtime.UNDEFINED
__M_dict_builtin = dict
__M_locals_builtin = locals
_magic_number = 5
_modified_time = 1234997599.638974
_template_filename='/home/mazvv/Projects/Python/Pylons/saleinform/saleinform/templates/admin/modules/currency/cources_list.mako'
_template_uri='/admin/modules/currency/cources_list.mako'
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
        __M_writer(u'\t\t\t<div class="currency-container">\n\t\t\t\t<h3>')
        # SOURCE LINE 2
        __M_writer(escape(_(u'\u041e\u0444\u0444\u0438\u0446\u0438\u0430\u043b\u044c\u043d\u044b\u0435 \u043a\u0443\u0440\u0441\u044b \u0432\u0430\u043b\u044e\u0442\u044b')))
        __M_writer(u'</h3>\n')
        # SOURCE LINE 3
        if c.a_coperation_status==True:
            # SOURCE LINE 4
            __M_writer(u'\t\t\t\t<div class="message-save-success">\n\t\t\t\t\t')
            # SOURCE LINE 5
            __M_writer(escape(_(u'\u0418\u0437\u043c\u0435\u043d\u0435\u043d\u0438\u044f \u0443\u0441\u043f\u0435\u0448\u043d\u043e \u0441\u043e\u0445\u0440\u0430\u043d\u0435\u043d\u044b')))
            __M_writer(u'\n\t\t\t\t</div>\n')
            # SOURCE LINE 7
        elif c.a_coperation_status==False:
            # SOURCE LINE 8
            __M_writer(u'\t\t\t\t<div class="message-save-failure">\n\t\t\t\t\t')
            # SOURCE LINE 9
            __M_writer(escape(_(u'\u0418\u0437\u043c\u0435\u043d\u0435\u043d\u0438\u044f \u043d\u0435 \u0441\u043e\u0445\u0440\u0430\u043d\u0435\u043d\u044b, \u0441\u043a\u043e\u0440\u0435\u0435 \u0432\u0441\u0435\u0433\u043e \u0438\u0437-\u0437\u0430 \u043e\u0448\u0438\u0431\u043e\u043a \u0437\u0430\u043f\u043e\u043b\u043d\u0435\u043d\u0438\u044f.')))
            __M_writer(u'\n\t\t\t\t</div>\n')
        # SOURCE LINE 12
        __M_writer(u'\t\t\t\t<div class="currency-toolbar">\n\t\t\t\t\t<div class="refresh-tool">')
        # SOURCE LINE 13
        __M_writer(escape(h.h_tags.link_to(_(u'\u041e\u0431\u043d\u043e\u0432\u0438\u0442\u044c \u043a\u0443\u0440\u0441\u044b'), url='/admin/currency/refresh')))
        __M_writer(u'</div>\n\t\t\t\t</div>\n\t\t\t\t')
        # SOURCE LINE 15
        __M_writer(escape(h.h_tags.form(url='/admin/currency', method="post", id="currency")))
        __M_writer(u'\n\t\t\t\t')
        # SOURCE LINE 16
        __M_writer(escape(h.h_tags.hidden('caction','save')))
        __M_writer(u'\n\t\t\t\t<table class="admin-cources" cellpadding="0" cellspacing="0" id="one-column-emphasis">\n\t\t\t\t\t<colgroup>\n\t\t\t\t\t\t<col class="oce-first"/>\n\t\t\t\t\t</colgroup>\n\t\t\t\t\t<thead>\n\t\t\t\t\t\t<tr>\n\t\t\t\t\t\t\t<th scope="col">')
        # SOURCE LINE 23
        __M_writer(escape(_(u'\u0421\u0442\u0440\u0430\u043d\u0430')))
        __M_writer(u'</th>\n')
        # SOURCE LINE 24
        for currency in c.a_currencyList:
            # SOURCE LINE 25
            __M_writer(u'\t\t\t\t\t\t\t\t<th scope="col">')
            __M_writer(escape(currency.code))
            __M_writer(u'</th>\n')
        # SOURCE LINE 27
        __M_writer(u'\t\t\t\t\t\t</tr>\n')
        # SOURCE LINE 28
        for country in c.a_countriesList:
            # SOURCE LINE 29
            __M_writer(u'\t\t\t\t\t\t<tr>\n\t\t\t\t\t\t\t<td>')
            # SOURCE LINE 30
            __M_writer(escape(country.name))
            __M_writer(u'</td>\n')
            # SOURCE LINE 31
            for currency in c.a_currencyList:
                # SOURCE LINE 32
                __M_writer(u'\t\t\t\t\t\t\t')

                flag = False
                                                                        
                
                __M_locals.update(__M_dict_builtin([(__M_key, __M_locals_builtin()[__M_key]) for __M_key in ['flag'] if __M_key in __M_locals_builtin()]))
                # SOURCE LINE 34
                __M_writer(u'\n\t\t\t\t\t\t\t<td>\n')
                # SOURCE LINE 36
                for cource in c.a_cources:
                    # SOURCE LINE 37
                    if cource._currency_rid == currency.rid and cource._countries_rid == country.rid:
                        # SOURCE LINE 38
                        __M_writer(u'\t\t\t\t\t\t\t\t\t\t')
                        __M_writer(escape(h.h_tags.text("cources-%s-%s"%(cource._currency_rid, cource._countries_rid), cource.cource)))
                        __M_writer(u'\n\t\t\t\t\t\t\t\t\t\t')
                        # SOURCE LINE 39

                        flag = True
                                                                                                        
                        
                        __M_locals.update(__M_dict_builtin([(__M_key, __M_locals_builtin()[__M_key]) for __M_key in ['flag'] if __M_key in __M_locals_builtin()]))
                        # SOURCE LINE 41
                        __M_writer(u'\n')
                # SOURCE LINE 44
                if not flag:
                    # SOURCE LINE 45
                    __M_writer(u'\t\t\t\t\t\t\t\t\t')
                    __M_writer(escape(h.h_tags.text("cources-%s-%s"%(currency.rid, country.rid), None)))
                    __M_writer(u'\n')
                # SOURCE LINE 47
                __M_writer(u'\t\t\t\t\t\t\t</td>\n')
            # SOURCE LINE 49
            __M_writer(u'\t\t\t\t\t\t</tr>\n')
        # SOURCE LINE 51
        __M_writer(u'\t\t\t\t\t</thead>\n\t\t\t\t</table>\n\t\t\t\t')
        # SOURCE LINE 53
        __M_writer(escape(h.h_tags.submit('submit',_(u'\u0421\u043e\u0445\u0440\u0430\u043d\u0438\u0442\u044c'))))
        __M_writer(u'\n\t\t\t\t')
        # SOURCE LINE 54
        __M_writer(escape(h.h_tags.end_form()))
        __M_writer(u'\n\t\t\t</div>\n\t\t\t\n\t\t\t<script type="text/javascript">\n                $(document).ready(function(){\n                        $("#currency > table > thead > tr > th > #check_all").click(function(){\n                                var checked_status = this.checked;\n                                $("input[name=\'check_currency\']").each(function(){\n                                        this.checked = checked_status;\n                                });\n                        });\n                });\n\t\t\t</script>\n\t\t\t\n\t\t\t\n')
        return ''
    finally:
        context.caller_stack._pop_frame()


