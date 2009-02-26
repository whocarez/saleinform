from mako import runtime, filters, cache
UNDEFINED = runtime.UNDEFINED
__M_dict_builtin = dict
__M_locals_builtin = locals
_magic_number = 5
_modified_time = 1235659040.2366731
_template_filename='/home/mazvv/Projects/Python/Pylons/saleinform/saleinform/templates/admin/modules/clients/clients_options.mako'
_template_uri='/admin/modules/clients/clients_options.mako'
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
        # SOURCE LINE 2
        __M_writer(u'\n')
        # SOURCE LINE 5
        __M_writer(u'\n<h3>')
        # SOURCE LINE 6
        __M_writer(escape(_(u'\u041e\u043f\u0446\u0438\u0438 \u043a\u043b\u0438\u0435\u043d\u0442\u0430')))
        __M_writer(u' ')
        __M_writer(escape(c.a_client.name))
        __M_writer(u'</h3>\n<div class="back-link">\n\t')
        # SOURCE LINE 8
        __M_writer(escape(h.h_tags.link_to(_(u'\u041d\u0430\u0437\u0430\u0434 \u043a \u0441\u043f\u0438\u0441\u043a\u0443 \u043a\u043b\u0438\u0435\u043d\u0442\u043e\u0432'), '/admin/clients')))
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
        __M_writer(escape(h.h_tags.form(url='/admin/clients/options/'+str(c.a_client.rid), method="post", multipart=True, id="clients")))
        __M_writer(u'\n')
        # SOURCE LINE 21
        __M_writer(escape(h.h_tags.hidden('action','options')))
        __M_writer(u'\n')
        # SOURCE LINE 22
        __M_writer(escape(h.h_tags.hidden('_clients_rid',c.a_client.rid)))
        __M_writer(u'\n<div class="clients-options">\n<script type="text/javascript">\n<!--\n\n$(document).ready(function(){\n$("ul.delivery-tree").checkTree({\n\t});\n});\n\n//-->\n</script>\n\t<table width="100%">\n\t\t<tr>\n\t\t\t<td width="50%" valign="top">\n\t\t\t\t<h4>')
        # SOURCE LINE 37
        __M_writer(escape(_(u'\u041a\u0430\u0442\u0435\u0433\u043e\u0440\u0438\u0438 \u043a\u043b\u0438\u0435\u043d\u0442\u0430')))
        __M_writer(u'</h4>\n\t\t\t\t<span class="subgrey">')
        # SOURCE LINE 38
        __M_writer(escape(_(u'\u0412\u044b\u0431\u0435\u0440\u0438\u0442\u0435 \u043d\u0435 \u0431\u043e\u043b\u0435\u0435 \u0442\u0440\u0435\u0445 \u043a\u0430\u0442\u0435\u0433\u043e\u0440\u0438\u0439, \u043a\u043e\u0442\u043e\u0440\u044b\u0435 \u043d\u0430\u0438\u0431\u043e\u043b\u0435\u0435 \u0442\u043e\u0447\u043d\u043e \u043e\u0442\u0432\u0435\u0447\u0430\u044e\u0442 \u0441\u0430\u0439\u0442\u0443 \u043a\u043b\u0438\u0435\u043d\u0442\u0430')))
        __M_writer(u'</span><br>\n')
        # SOURCE LINE 39
        for category in c.a_categories:
            # SOURCE LINE 40
            __M_writer(u'\t\t\t\t')
            __M_writer(escape(h.h_tags.checkbox('_categories_rid', category.rid, label=category.name, checked=category.rid in c.a_clcategories)))
            __M_writer(u'<br>\n')
        # SOURCE LINE 42
        __M_writer(u'\t\t\t</td>\n\t\t\t<td valign="top">\n\t\t\t\t<h4>')
        # SOURCE LINE 44
        __M_writer(escape(_(u'\u0420\u0435\u0433\u0438\u043e\u043d\u044b \u0434\u043e\u0441\u0442\u0430\u0432\u043a\u0438')))
        __M_writer(u'</h4>\n\t\t\t\t<ul class="delivery-tree">\n')
        # SOURCE LINE 46
        for country in c.a_countries:
            # SOURCE LINE 47
            __M_writer(u'\t\t\t\t\t<li>\n\t\t\t\t\t\t')
            # SOURCE LINE 48
            __M_writer(escape(h.h_tags.checkbox('_countries_rid', country.rid, checked = country.rid in c.a_clcountries)))
            __M_writer(u'\n\t\t\t\t\t\t<label>')
            # SOURCE LINE 49
            __M_writer(escape(country.name))
            __M_writer(u'</label>\n\t\t\t\t\t\t<ul >\n')
            # SOURCE LINE 51
            for region in c.a_regions:
                # SOURCE LINE 52
                if region._countries_rid==country.rid:
                    # SOURCE LINE 53
                    __M_writer(u'\t\t\t\t\t\t\t<li>\n\t\t\t\t\t\t\t')
                    # SOURCE LINE 54
                    __M_writer(escape(h.h_tags.checkbox('_regions_rid', region.rid, checked = region.rid in c.a_clregions)))
                    __M_writer(u'\n\t\t\t\t\t\t\t<label>')
                    # SOURCE LINE 55
                    __M_writer(escape(region.name))
                    __M_writer(u'</label>\n\t\t\t\t\t\t\t<ul>\n')
                    # SOURCE LINE 57
                    for city in c.a_cities:
                        # SOURCE LINE 58
                        if city.Cities._regions_rid==region.rid:
                            # SOURCE LINE 59
                            __M_writer(u'\t\t\t\t\t\t\t\t<li>\n\t\t\t\t\t\t\t\t')
                            # SOURCE LINE 60
                            __M_writer(escape(h.h_tags.checkbox('_cities_rid', city.Cities.rid, checked = city.Cities.rid in c.a_clcities)))
                            __M_writer(u'\n\t\t\t\t\t\t\t\t<label>')
                            # SOURCE LINE 61
                            __M_writer(escape(city.Cities.name))
                            __M_writer(u'</label>\n')
                        # SOURCE LINE 63
                        __M_writer(u'\t\t\t\t\t\t\t\t</li>\n')
                    # SOURCE LINE 65
                    __M_writer(u'\t\t\t\t\t\t\t</ul>\n\t\t\t\t\t\t\t</li>\n')
            # SOURCE LINE 69
            __M_writer(u'\t\t\t\t\t\t</ul>\n\t\t\t\t\t</li>\t\t\t\t\t\t\t\n')
        # SOURCE LINE 72
        __M_writer(u'\t\t\t\t</ul>\n\t\t\t</td>\n\t\t</tr>\n\t</table>\n\t')
        # SOURCE LINE 76
        __M_writer(escape(h.h_tags.submit('submit', _(u'\u0421\u043e\u0445\u0440\u0430\u043d\u0438\u0442\u044c'))))
        __M_writer(u'\n</div>\n')
        # SOURCE LINE 78
        __M_writer(escape(h.h_tags.end_form()))
        __M_writer(u'\n\n')
        return ''
    finally:
        context.caller_stack._pop_frame()


