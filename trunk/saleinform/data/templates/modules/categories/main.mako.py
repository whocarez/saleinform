from mako import runtime, filters, cache
UNDEFINED = runtime.UNDEFINED
__M_dict_builtin = dict
__M_locals_builtin = locals
_magic_number = 5
_modified_time = 1233401598.4679999
_template_filename='D:\\PROJECTS\\ECLIPSE\\PYLONS\\saleinform\\saleinform\\templates/modules/categories/main.mako'
_template_uri='/modules/categories/main.mako'
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
        len = context.get('len', UNDEFINED)
        __M_writer = context.writer()
        # SOURCE LINE 2
        __M_writer(u'<div class="catslist">\n\t<ul>\n')
        # SOURCE LINE 4
        for cat in c.categories:
            # SOURCE LINE 5
            __M_writer(u'\t\t<li>\n\t\t\t<div>\n\t\t\t<h4>\n\t\t\t\t')
            # SOURCE LINE 8
            __M_writer(escape(h.h_tags.link_to(cat.name, url='/categories/'+cat.slug)))
            __M_writer(u'\n\t\t\t</h4>\n\t\t\t')
            # SOURCE LINE 10

            rest_length = 25
            subs = []
            for z in c.subcategories: 
                    if z._parent_rid == cat.rid:
                            if rest_length > 0: 
                                    link_text = h.h_text.truncate(z.name, length=rest_length, indicator='...', whole_word=True)
                                    subs.append(h.h_tags.link_to(link_text, url='/categories/'+z.slug, title=z.name))
                                    rest_length = rest_length - len(z.name)
                            else: break
            
            
            __M_locals.update(__M_dict_builtin([(__M_key, __M_locals_builtin()[__M_key]) for __M_key in ['rest_length','z','link_text','subs'] if __M_key in __M_locals_builtin()]))
            # SOURCE LINE 20
            __M_writer(u'\n\t\t\t')
            # SOURCE LINE 21
            __M_writer(escape(h.h_builder.literal(', '.join(subs))))
            __M_writer(u'\n\t\t\t</div>\n\t\t</li>\n')
        # SOURCE LINE 25
        __M_writer(u"\t\t<li class='last-cat-item'>\n\t\t\t<div>\n\t\t\t<h4>\n\t\t\t\t")
        # SOURCE LINE 28
        __M_writer(escape(h.h_tags.link_to(_(u'\u0412\u0441\u0435 \u043a\u0430\u0442\u0435\u0433\u043e\u0440\u0438\u0438'), url='/categories')))
        __M_writer(u'\n\t\t\t</h4>\n\t\t\t</div>\n\t\t</li>\n\t</ul>\n</div>\n<div class="CategoryBrowserFooter"></div> \n\n')
        return ''
    finally:
        context.caller_stack._pop_frame()


