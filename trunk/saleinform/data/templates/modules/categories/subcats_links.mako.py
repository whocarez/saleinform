from mako import runtime, filters, cache
UNDEFINED = runtime.UNDEFINED
__M_dict_builtin = dict
__M_locals_builtin = locals
_magic_number = 5
_modified_time = 1234297747.401037
_template_filename='/home/mazvv/Projects/Python/Pylons/saleinform/saleinform/templates/modules/categories/subcats_links.mako'
_template_uri='/modules/categories/subcats_links.mako'
_template_cache=cache.Cache(__name__, _modified_time)
_source_encoding='utf-8'
from webhelpers.html import escape
_exports = ['subcatsAnchors']


def render_body(context,**pageargs):
    context.caller_stack._push_frame()
    try:
        __M_locals = __M_dict_builtin(pageargs=pageargs)
        __M_writer = context.writer()
        # SOURCE LINE 4
        __M_writer(u'\n')
        return ''
    finally:
        context.caller_stack._pop_frame()


def render_subcatsAnchors(context,subcatsList,catRid,rest_length=30):
    context.caller_stack._push_frame()
    try:
        h = context.get('h', UNDEFINED)
        len = context.get('len', UNDEFINED)
        __M_writer = context.writer()
        # SOURCE LINE 5
        __M_writer(u'\n')
        # SOURCE LINE 6

        subs = []
        for z in subcatsList: 
                if z._parent_rid == catRid:
                        if rest_length > 0: 
                                subs.append(h.h_tags.link_to(z.name, url='/categories/'+z.slug, title=z.name, title=z.meta_title))
                                rest_length = rest_length - len(z.name)
                        else: break
        
        
        # SOURCE LINE 14
        __M_writer(u'\n')
        # SOURCE LINE 15
        __M_writer(escape(h.h_builder.literal(', '.join(subs))))
        __M_writer(u'...\n')
        return ''
    finally:
        context.caller_stack._pop_frame()


