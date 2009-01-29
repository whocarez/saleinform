from mako import runtime, filters, cache
UNDEFINED = runtime.UNDEFINED
__M_dict_builtin = dict
__M_locals_builtin = locals
_magic_number = 5
_modified_time = 1233240177.331012
_template_filename='/home/mazvv/Projects/PYLONS/saleinform/saleinform/templates/modules/search/narrowbar.mako'
_template_uri='/modules/search/narrowbar.mako'
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
        __M_writer(u'<div class="zs-narrow">\r\n\t<div class="home-slogan">\r\n\t\t<ul id="navigationUs">\r\n\t\t\t\t<li>\r\n\t\t\t\t\t<a rel="nofollow" class="navLinkUs" title="latest videos" href="/top_video_reviews.php">latest videos</a>\r\n\t\t\t\t</li>\r\n\t\t\t\t\t\t\t<li>\r\n\t\t\t\t\t<a rel="nofollow" class="navLinkUs" title="best picks" href="/product_lists_overview.php">best picks</a>\r\n\t\t\t\t</li>\r\n\t\t\t\t\t\t\t<li>\r\n\t\t\t\t\t<a class="navLinkUs" title="latest reviews" href="/top20_opinion.php">latest reviews</a>\r\n\t\t\t\t</li>\r\n\t\t\t\t\t\t\t<li class="last">\r\n\t\t\t\t\t<a class="navLinkUs" title="price comparison" href="/">price comparison</a>\r\n\t\t\t\t</li>\r\n\t\t\t\t\t\t\t\t\r\n\t\t</ul>\r\n\t</div>\r\n\t<div class="fq2-narrow">\r\n\t<h4>')
        # SOURCE LINE 21
        __M_writer(escape(_(u'\u041f\u043e\u0438\u0441\u043a \u0442\u043e\u0432\u0430\u0440\u043e\u0432, \u043b\u0443\u0447\u0448\u0438\u0445 \u0446\u0435\u043d \u0438 \u043e\u0442\u0437\u044b\u0432\u043e\u0432')))
        __M_writer(u'</h4>\r\n\t')
        # SOURCE LINE 22
        __M_writer(escape(h.h_tags.form('/', multipart=False)))
        __M_writer(u'\r\n\t\t<input id="searchString" name="searchString" class="mainQ" value="" type="text">\r\n\t\t<input id="categoryRid" name="categoryRid" value="" type="hidden">\r\n\t\t<input type="button" name="searchBtn" class="searchSubmitSmall" value="')
        # SOURCE LINE 25
        __M_writer(escape(_(u'\u041d\u0430\u0439\u0442\u0438')))
        __M_writer(u'"/>\r\n\t')
        # SOURCE LINE 26
        __M_writer(escape(h.h_tags.end_form()))
        __M_writer(u'\r\n\t</div>\r\n</div>\r\n\r\n')
        return ''
    finally:
        context.caller_stack._pop_frame()


