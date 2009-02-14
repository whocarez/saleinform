from mako import runtime, filters, cache
UNDEFINED = runtime.UNDEFINED
__M_dict_builtin = dict
__M_locals_builtin = locals
_magic_number = 5
_modified_time = 1234631614.9879651
_template_filename='/home/mazvv/Projects/Python/Pylons/saleinform/saleinform/templates/admin/modules/navigation/hnavigator.mako'
_template_uri='/admin/modules/navigation/hnavigator.mako'
_template_cache=cache.Cache(__name__, _modified_time)
_source_encoding='utf-8'
from webhelpers.html import escape
_exports = []


def render_body(context,**pageargs):
    context.caller_stack._push_frame()
    try:
        __M_locals = __M_dict_builtin(pageargs=pageargs)
        __M_writer = context.writer()
        # SOURCE LINE 1
        __M_writer(u'<div id="smoothmenu1" class="ddsmoothmenu">\n<ul>\n<li><a href="http://www.dynamicdrive.com">Item 1</a></li>\n<li><a href="#">Folder 0</a>\n  <ul>\n  <li><a href="#">Sub Item 1.1</a></li>\n  <li><a href="#">Sub Item 1.2</a></li>\n  <li><a href="#">Sub Item 1.3</a></li>\n  <li><a href="#">Sub Item 1.4</a></li>\n  <li><a href="#">Sub Item 1.2</a></li>\n  <li><a href="#">Sub Item 1.3</a></li>\n  <li><a href="#">Sub Item 1.4</a></li>\n  </ul>\n</li>\n<li><a href="#">Folder 1</a>\n  <ul>\n  <li><a href="#">Sub Item 1.1</a></li>\n  <li><a href="#">Sub Item 1.2</a></li>\n  <li><a href="#">Sub Item 1.3</a></li>\n  <li><a href="#">Sub Item 1.4</a></li>\n  <li><a href="#">Sub Item 1.2</a></li>\n  <li><a href="#">Sub Item 1.3</a></li>\n  <li><a href="#">Sub Item 1.4</a></li>\n  </ul>\n</li>\n<li><a href="#">Item 3</a></li>\n<li><a href="#">Folder 2</a>\n  <ul>\n  <li><a href="#">Sub Item 2.1</a></li>\n  <li><a href="#">Folder 2.1</a>\n    <ul>\n    <li><a href="#">Sub Item 2.1.1</a></li>\n    <li><a href="#">Sub Item 2.1.2</a></li>\n    <li><a href="#">Folder 3.1.1</a>\n\t\t<ul>\n    \t\t<li><a href="#">Sub Item 3.1.1.1</a></li>\n    \t\t<li><a href="#">Sub Item 3.1.1.2</a></li>\n    \t\t<li><a href="#">Sub Item 3.1.1.3</a></li>\n    \t\t<li><a href="#">Sub Item 3.1.1.4</a></li>\n    \t\t<li><a href="#">Sub Item 3.1.1.5</a></li>\n\t\t</ul>\n    </li>\n    <li><a href="#">Sub Item 2.1.4</a></li>\n    </ul>\n  </li>\n  </ul>\n</li>\n<li><a href="http://www.dynamicdrive.com/style/">Item 4</a></li>\n</ul>\n<br style="clear: left" />\n</div>')
        return ''
    finally:
        context.caller_stack._pop_frame()


