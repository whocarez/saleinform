from mako import runtime, filters, cache
UNDEFINED = runtime.UNDEFINED
__M_dict_builtin = dict
__M_locals_builtin = locals
_magic_number = 5
_modified_time = 1234210570.2760539
_template_filename='/home/mazvv/Projects/Python/Pylons/saleinform/saleinform/templates/modules/members/register_error.mako'
_template_uri='/modules/members/register_error.mako'
_template_cache=cache.Cache(__name__, _modified_time)
_source_encoding='utf-8-'
from webhelpers.html import escape
_exports = []


def render_body(context,**pageargs):
    context.caller_stack._push_frame()
    try:
        __M_locals = __M_dict_builtin(pageargs=pageargs)
        h = context.get('h', UNDEFINED)
        _ = context.get('_', UNDEFINED)
        __M_writer = context.writer()
        # SOURCE LINE 4
        __M_writer(u'\n<div id="logPageUs"></div>\n\n<div class="registerContainer">\n\t<div class="headerBar">\n\t\t<div class="RightCorner"></div>\n\t\t<div class="RightControlArea"></div>\n\t\t<h3 class="ModuleTitle">')
        # SOURCE LINE 11
        __M_writer(escape(_(u'\u0421\u043f\u0430\u0441\u0438\u0431\u043e \u0437\u0430 \u0440\u0435\u0433\u0438\u0441\u0442\u0440\u0430\u0446\u0438\u044e')))
        __M_writer(u'</h3>\n\t</div>\n\n\n\t<div class="registerComplete">\n\t\t<div class="registerIntro">\n\t\t\t<p>\n\t\t\t\u0418\u0437\u0432\u0438\u043d\u0438\u0442\u0435, \u043d\u043e \u0432\u043e \u0432\u0440\u0435\u043c\u044f \u0432\u044b\u043f\u043e\u043b\u043d\u0435\u043d\u0438\u044f \u043e\u043f\u0435\u0440\u0430\u0446\u0438\u0438 \u043f\u0440\u043e\u0438\u0437\u043e\u0448\u043b\u0430 \u043e\u0448\u0438\u0431\u043a\u0430. \u041f\u043e\u043f\u0440\u043e\u0431\u0443\u0439\u0442\u0435 \u043f\u043e\u0432\u0442\u043e\u0440\u0438\u0442\u044c \u043f\u0440\u043e\u0446\u0435\u0441\u0441 \u0440\u0435\u0433\u0438\u0441\u0442\u0440\u0430\u0446\u0438\u0438 \u043d\u0435\u043c\u043d\u043e\u0433\u043e \u043f\u043e\u0437\u0436\u0435. \n\t\t\t\u0415\u0441\u043b\u0438 \u043f\u0440\u043e\u0431\u043b\u0435\u043c\u0430 \u043f\u043e\u0432\u0442\u043e\u0440\u044f\u0435\u0442\u0441\u044f, \u043f\u043e\u0436\u0430\u043b\u0443\u0439\u0441\u0442\u0430 \u043d\u0430\u043f\u0438\u0448\u0438\u0442\u0435 \u043d\u0430\u043c.\n\t\t\t<br/>\n\t\t\t')
        # SOURCE LINE 21
        __M_writer(escape(h.h_tags.image('/img/register_mailicon_small.gif', _(u'Email'))))
        __M_writer(u'\n\t\t\t<strong>')
        # SOURCE LINE 22
        __M_writer(escape(h.h_tools.mail_to('support@saleinform.com', u'support@saleinform.com', encode='hex')))
        __M_writer(u'</strong><br/>\n\t\t</div>\n\t</div>\n\t<div class="LowerModuleBorder">\n\t\t<div class="FooterBar">\n\t\t\t<div class="RightCorner"></div>\n\t\t</div>\n\t</div>\t\n\t\n</div>\n\n')
        return ''
    finally:
        context.caller_stack._pop_frame()


