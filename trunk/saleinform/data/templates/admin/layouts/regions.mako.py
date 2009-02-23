from mako import runtime, filters, cache
UNDEFINED = runtime.UNDEFINED
__M_dict_builtin = dict
__M_locals_builtin = locals
_magic_number = 5
_modified_time = 1235320526.501339
_template_filename='/home/mazvv/Projects/Python/Pylons/saleinform/saleinform/templates/admin/layouts/regions.mako'
_template_uri='/admin/layouts/regions.mako'
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
        __M_writer = context.writer()
        # SOURCE LINE 2
        __M_writer(u'<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"\r\n"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">\r\n<html>\r\n<head>\r\n\t<title></title>\r\n\t<meta name="description" content="">\r\n\t<meta name="keywords" content="">\r\n\t<meta http-equiv="Content-Type" content="text/html; charset=utf-8">\r\n\t')
        # SOURCE LINE 10
        __M_writer(escape(h.h_tags.javascript_link('/js/jquery-1.3.1.min.js')))
        __M_writer(u'\r\n\t')
        # SOURCE LINE 11
        __M_writer(escape(h.h_tags.javascript_link('/js/dropdowntabs.js')))
        __M_writer(u'\r\n\t')
        # SOURCE LINE 12
        __M_writer(escape(h.h_tags.javascript_link('/js/jquery.simple.tree.js')))
        __M_writer(u'\r\n\t')
        # SOURCE LINE 13
        __M_writer(escape(h.h_tags.stylesheet_link('/css/style.css')))
        __M_writer(u'\r\n\t')
        # SOURCE LINE 14
        __M_writer(escape(h.h_tags.stylesheet_link('/css/glowtabs.css')))
        __M_writer(u'\r\n\t')
        # SOURCE LINE 15
        __M_writer(escape(h.h_tags.stylesheet_link('/css/simpletree.css')))
        __M_writer(u'\r\n\t')
        # SOURCE LINE 16
        __M_writer(escape(h.h_tags.stylesheet_link('/css/admin_regions.css')))
        __M_writer(u'\r\n\t<link rel="SHORTCUT ICON" href="../img/si.png">\r\n</head>\r\n<body id="mainBody">\r\n\t<div class="md" id="" style="">\r\n\t\t<div id="main_cnt">\r\n\t\t\t<div>\r\n\t\t\t\t')
        # SOURCE LINE 23
        runtime._include_file(context, '/admin/modules/navigation/hnavigator.mako', _template_uri)
        __M_writer(u'\r\n\t\t\t</div>\r\n\t\t\t<div style="clear: both;">\r\n\t\t\t\t<div>\r\n\t\t\t\t\t')
        # SOURCE LINE 27
        runtime._include_file(context, '/admin/modules/regions/' + (c.a_template_name), _template_uri)
        __M_writer(u'\r\n\t\t\t\t</div>\r\n\t\t\t</div>\r\n\t\t</div>\r\n\t\t<div>\r\n\t\t</div>\r\n\t</div>\r\n</body>\r\n</html>')
        return ''
    finally:
        context.caller_stack._pop_frame()


