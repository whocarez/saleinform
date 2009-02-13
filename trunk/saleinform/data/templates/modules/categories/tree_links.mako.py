from mako import runtime, filters, cache
UNDEFINED = runtime.UNDEFINED
__M_dict_builtin = dict
__M_locals_builtin = locals
_magic_number = 5
_modified_time = 1234545906.047435
_template_filename='/home/mazvv/Projects/Python/Pylons/saleinform/saleinform/templates/modules/categories/tree_links.mako'
_template_uri='/modules/categories/tree_links.mako'
_template_cache=cache.Cache(__name__, _modified_time)
_source_encoding='utf-8'
from webhelpers.html import escape
_exports = ['treeBuilder']


def render_body(context,**pageargs):
    context.caller_stack._push_frame()
    try:
        __M_locals = __M_dict_builtin(pageargs=pageargs)
        __M_writer = context.writer()
        return ''
    finally:
        context.caller_stack._pop_frame()


def render_treeBuilder(context,node,lvl=0):
    context.caller_stack._push_frame()
    try:
        h = context.get('h', UNDEFINED)
        c = context.get('c', UNDEFINED)
        len = context.get('len', UNDEFINED)
        str = context.get('str', UNDEFINED)
        def treeBuilder(node,lvl=0):
            return render_treeBuilder(context,node,lvl)
        __M_writer = context.writer()
        # SOURCE LINE 1
        __M_writer(u'\n<table class="wd750">\n<tr>\n')
        # SOURCE LINE 4

        index = 0
        
        
        # SOURCE LINE 6
        __M_writer(u'\n<td class="websrccat">\n')
        # SOURCE LINE 8
        for n in node.children:
            # SOURCE LINE 9
            if not lvl:
                # SOURCE LINE 10
                __M_writer(u'\t\t\t')

                index += 1
                
                
                # SOURCE LINE 12
                __M_writer(u'\n')
                # SOURCE LINE 13
                if not index%c.a_col_quan:
                    # SOURCE LINE 14
                    __M_writer(u'\t\t\t\t</td>\n\t\t\t\t<td class="websrccat">\t\t\n')
            # SOURCE LINE 18
            if len(n.children) <= 0:
                # SOURCE LINE 19
                __M_writer(u'        \t')
                __M_writer(escape(h.h_tags.link_to(n.category.name, url='/categories/'+n.category.slug, title=n.category.meta_title, class_="tree-link level"+str(lvl))))
                __M_writer(u'<br>\n')
                # SOURCE LINE 20
            else: 
                # SOURCE LINE 21
                __M_writer(u'\t\t\t<div class="tree-link-bold level')
                __M_writer(escape(lvl))
                __M_writer(u'">')
                __M_writer(escape(h.h_tags.link_to(n.category.name, url='/categories/'+n.category.slug, title=n.category.meta_title)))
                __M_writer(u'</div>        \n        \t')
                # SOURCE LINE 22
                __M_writer(escape(treeBuilder(n, lvl+1)))
                __M_writer(u'\n')
        # SOURCE LINE 25
        __M_writer(u'</td>\n</tr>\n</table>\n')
        return ''
    finally:
        context.caller_stack._pop_frame()


