from mako import runtime, filters, cache
UNDEFINED = runtime.UNDEFINED
__M_dict_builtin = dict
__M_locals_builtin = locals
_magic_number = 5
_modified_time = 1233609089.234
_template_filename='D:\\PROJECTS\\ECLIPSE\\PYLONS\\saleinform\\saleinform\\templates/layouts/welcome.mako'
_template_uri='/layouts/welcome.mako'
_template_cache=cache.Cache(__name__, _modified_time)
_source_encoding='utf-8'
from webhelpers.html import escape
_exports = []


def render_body(context,**pageargs):
    context.caller_stack._push_frame()
    try:
        __M_locals = __M_dict_builtin(pageargs=pageargs)
        h = context.get('h', UNDEFINED)
        __M_writer = context.writer()
        # SOURCE LINE 2
        __M_writer(u'<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"\n"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">\n<html>\n<head>\n\t<title></title>\n\t<meta name="description" content="">\n\t<meta name="keywords" content="">\n\t<meta http-equiv="Content-Type" content="text/html; charset=utf-8">\n\t')
        # SOURCE LINE 10
        __M_writer(escape(h.h_tags.stylesheet_link('/css/style.css')))
        __M_writer(u'\n\t')
        # SOURCE LINE 11
        __M_writer(escape(h.h_tags.stylesheet_link('/css/navigator.css')))
        __M_writer(u'\n\t')
        # SOURCE LINE 12
        __M_writer(escape(h.h_tags.stylesheet_link('/css/categories.css')))
        __M_writer(u'\n\t')
        # SOURCE LINE 13
        __M_writer(escape(h.h_tags.stylesheet_link('/css/search.css')))
        __M_writer(u'\n\t<link rel="SHORTCUT ICON" href="../img/si.png">\n</head>\n<body id="mainBody">\n\t<div class="md" id="" style="">\n\t\t<div id="main_cnt">\n\t\t\t<div>\n\t\t\t\t')
        # SOURCE LINE 20
        runtime._include_file(context, '/modules/navigator/maintopnav.mako', _template_uri)
        __M_writer(u'\n\t\t\t</div>\n\t\t\t<div>\n\t\t\t\t')
        # SOURCE LINE 23
        runtime._include_file(context, '/modules/search/searchbar.mako', _template_uri)
        __M_writer(u'\n\t\t\t</div>\n\t\t\t<table width="100%" border="0" cellpadding="0" cellspacing="0">\n\t\t\t\t<tr>\n\t\t\t\t\t<td id="left" style="width: 280px;">\n\t\t\t\t\t\t')
        # SOURCE LINE 28
        runtime._include_file(context, '/modules/categories/main.mako', _template_uri)
        __M_writer(u'\n\t\t\t\t\t</td>\n\t\t\t\t\t<td class="cTD">\n\t\t\t\t\t</td>\n\t\t\t\t\t<td class="right" width="240">\n\t\t\t\t\t</td>\n\t\t\t\t</tr>\n\t\t\t</table>\n\t\t</div>\n\t\t<div>\n\t\t\t')
        # SOURCE LINE 38
        runtime._include_file(context, '/modules/navigator/footernav.mako', _template_uri)
        __M_writer(u'\n\t\t</div>\n\t</div>\n</body>\n</html>')
        return ''
    finally:
        context.caller_stack._pop_frame()


