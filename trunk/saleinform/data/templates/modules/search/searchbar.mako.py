from mako import runtime, filters, cache
UNDEFINED = runtime.UNDEFINED
__M_dict_builtin = dict
__M_locals_builtin = locals
_magic_number = 5
_modified_time = 1232874960.625
_template_filename='D:\\PROJECTS\\ECLIPSE\\PYLONS\\saleinform\\saleinform\\templates/modules/search/searchbar.mako'
_template_uri='/modules/search/searchbar.mako'
_template_cache=cache.Cache(__name__, _modified_time)
_source_encoding='utf-8'
from webhelpers.html import escape
_exports = []


def render_body(context,**pageargs):
    context.caller_stack._push_frame()
    try:
        __M_locals = __M_dict_builtin(pageargs=pageargs)
        h = context.get('h', UNDEFINED)
        _ = context.get('_', UNDEFINED)
        __M_writer = context.writer()
        # SOURCE LINE 2
        __M_writer(u'<div class="zs">\n\t<div class="home-top-left">\n\t</div>\n\t<div class="home-top-right">\n\t</div>\n\t<div class="home-slogan">\n\t</div>\n\t<div class="fq2">\n\t<h4>')
        # SOURCE LINE 10
        __M_writer(escape(_(u'\u041f\u043e\u0438\u0441\u043a \u0442\u043e\u0432\u0430\u0440\u043e\u0432, \u043b\u0443\u0447\u0448\u0438\u0445 \u0446\u0435\u043d \u0438 \u043e\u0442\u0437\u044b\u0432\u043e\u0432')))
        __M_writer(u'</h4>\n\t')
        # SOURCE LINE 11
        __M_writer(escape(h.form('/', multipart=False)))
        __M_writer(u'\n\t\t<input id="searchString" name="searchString" class="mainQ" value="" type="text">\n\t\t<input id="categoryRid" name="categoryRid" value="" type="hidden">\n\t\t<input type="button" name="searchBtn" class="searchSubmit" value="')
        # SOURCE LINE 14
        __M_writer(escape(_(u'\u041d\u0430\u0439\u0442\u0438')))
        __M_writer(u'"/>\n\t')
        # SOURCE LINE 15
        __M_writer(escape(h.end_form()))
        __M_writer(u'\n\t</div>\n</div>\n\n')
        return ''
    finally:
        context.caller_stack._pop_frame()


