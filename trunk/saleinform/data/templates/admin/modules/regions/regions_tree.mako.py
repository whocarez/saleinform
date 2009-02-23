from mako import runtime, filters, cache
UNDEFINED = runtime.UNDEFINED
__M_dict_builtin = dict
__M_locals_builtin = locals
_magic_number = 5
_modified_time = 1235320526.5198259
_template_filename='/home/mazvv/Projects/Python/Pylons/saleinform/saleinform/templates/admin/modules/regions/regions_tree.mako'
_template_uri='/admin/modules/regions/regions_tree.mako'
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
        __M_writer(u'<script type="text/javascript">\n<!--\nvar simpleTreeCollection;\n$(document).ready(function(){\n\tsimpleTreeCollection = $(\'.simpleTree\').simpleTree({\n\t\tautoclose: true,\n\t\tafterClick:function(node){\n\t\t\t//alert("text-"+$(\'span:first\',node).text());\n\t\t},\n\t\tafterDblClick:function(node){\n\t\t\t//alert("text-"+$(\'span:first\',node).text());\n\t\t},\n\t\tafterMove:function(destination, source, pos){\n\t\t\t//alert("destination-"+destination.attr(\'id\')+" source-"+source.attr(\'id\')+" pos-"+pos);\n\t\t},\n\t\tafterAjax:function()\n\t\t{\n\t\t\t//alert(\'Loaded\');\n\t\t},\n\t\tanimate:true\n\t\t//,docToFolderConvert:true\n\t});\n});\n//-->\n</script>\n<br>\n<h3>')
        # SOURCE LINE 27
        __M_writer(escape(_(u'\u0420\u0435\u0433\u0438\u043e\u043d\u044b \u0438 \u0433\u043e\u0440\u043e\u0434\u0430')))
        __M_writer(u'</h3>\n<ul class="simpleTree">\n<li class="root"><span>')
        # SOURCE LINE 29
        __M_writer(escape(_(u'\u0421\u0442\u0440\u0430\u043d\u044b, \u0440\u0435\u0433\u0438\u043e\u043d\u044b \u0438 \u0433\u043e\u0440\u043e\u0434\u0430')))
        __M_writer(u'</span>\n\t<ul>\n')
        # SOURCE LINE 31
        for country in c.a_countries:
            # SOURCE LINE 32
            __M_writer(u"\t\t<li id='country")
            __M_writer(escape(country.rid))
            __M_writer(u"'><span>")
            __M_writer(escape(country.name))
            __M_writer(u'(')
            __M_writer(escape(country.code))
            __M_writer(u')</span>\n\t\t\t')
            # SOURCE LINE 33
            __M_writer(escape(h.h_tags.link_to(h.h_tags.image('/img/icons/add.png', alt=_(u'\u0414\u043e\u0431\u0430\u0432\u0438\u0442\u044c \u0440\u0435\u0433\u0438\u043e\u043d'), border="0"), '/admin/regions/rp?_countries_rid=%s'%country.rid, title=_(u'\u0414\u043e\u0431\u0430\u0432\u0438\u0442\u044c \u0440\u0435\u0433\u0438\u043e\u043d'))))
            __M_writer(u'\n\t\t\t<ul class="ajax">\n\t\t\t\t<li>{url:/admin/regions/get?country=')
            # SOURCE LINE 35
            __M_writer(escape(country.rid))
            __M_writer(u'}</li>\n\t\t\t</ul>\n\t\t</li>\n')
        # SOURCE LINE 39
        __M_writer(u'\t</ul>\n</li>\n</ul>\n')
        return ''
    finally:
        context.caller_stack._pop_frame()


