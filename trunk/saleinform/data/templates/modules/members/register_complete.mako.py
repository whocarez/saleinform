from mako import runtime, filters, cache
UNDEFINED = runtime.UNDEFINED
__M_dict_builtin = dict
__M_locals_builtin = locals
_magic_number = 5
_modified_time = 1234208930.9452629
_template_filename='/home/mazvv/Projects/Python/Pylons/saleinform/saleinform/templates/modules/members/register_complete.mako'
_template_uri='/modules/members/register_complete.mako'
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
        __M_writer(u'</h3>\n\t</div>\n\n\n\t<div class="registerComplete">\n\t\t<div class="ThankYouIcon">\n\t\t\t')
        # SOURCE LINE 17
        __M_writer(escape(h.h_tags.image('/img/register_mailicon_big.gif', _(u'\u0421\u043e\u043e\u0431\u0449\u0435\u043d\u0438\u0435'))))
        __M_writer(u'\n\t\t</div>\n\t\t<div class="ThankYouIconText"><div>')
        # SOURCE LINE 19
        __M_writer(escape(_(u'\u0412\u0430\u043c \u043e\u0442\u043f\u0440\u0430\u0432\u043b\u0435\u043d\u043e \u0441\u043e\u043e\u0431\u0449\u0435\u043d\u0438\u0435.\u041f\u043e\u0436\u0430\u043b\u0443\u0439\u0441\u0442\u0430, \u043f\u0440\u043e\u0432\u0435\u0440\u044c\u0442\u0435 \u0412\u0430\u0448 \u044d\u043b\u0435\u043a\u0442\u0440\u043e\u043d\u043d\u044b\u0439 \u044f\u0449\u0438\u043a, \u043a\u043e\u0442\u043e\u0440\u044b\u0439 \u0412\u044b \u0443\u043a\u0430\u0437\u0430\u043b\u0438 \u043f\u0440\u0438 \u0440\u0435\u0433\u0438\u0441\u0442\u0440\u0430\u0446\u0438\u0438')))
        __M_writer(u'</div></div>\n\t\t<div style="clear: both;"></div>\n\n\t\t<div class="registerIntro">\n\t\t\t<p>')
        # SOURCE LINE 23
        __M_writer(escape(_(u'\u041f\u0438\u0441\u044c\u043c\u043e \u0441\u043e\u0434\u0435\u0440\u0436\u0438\u0442 \u0441\u0441\u044b\u043b\u043a\u0443 (URL). \u041f\u043e\u0436\u0430\u043b\u0443\u0439\u0441\u0442\u0430, \u043f\u0435\u0440\u0435\u0439\u0434\u0438\u0442\u0435 \u043f\u043e \u044d\u0442\u043e\u0439 \u0441\u0441\u044b\u043b\u043a\u0435 \u0434\u043b\u044f \u0437\u0430\u0432\u0435\u0440\u0448\u0435\u043d\u0438\u044f \u0440\u0435\u0433\u0438\u0441\u0442\u0440\u0430\u0446\u0438\u0438 \u043d\u0430 Saleinform.')))
        __M_writer(u'</p>\n\t\t\t<p>\n\t\t\t<strong>')
        # SOURCE LINE 25
        __M_writer(escape(_(u'\u0412\u0430\u0436\u043d\u043e:')))
        __M_writer(u'</strong> ')
        __M_writer(escape(_(u'\u041f\u043e\u0436\u0430\u043b\u0443\u0439\u0441\u0442\u0430, \u043f\u0440\u043e\u0432\u0435\u0440\u044c\u0442\u0435 \u0432\u0430\u0448\u0438 \u0441\u043f\u0430\u043c \u0444\u0438\u043b\u044c\u0442\u0440\u044b \u0438 \u0443\u0431\u0435\u0434\u0438\u0442\u0435\u0441\u044c, \u0447\u0442\u043e \u043f\u0438\u0441\u044c\u043c\u0430 \u0438\u0437 \u0443\u043a\u0430\u0437\u0430\u043d\u043d\u044b\u0445 \u043d\u0438\u0436\u0435 \u0430\u0434\u0440\u0435\u0441\u043e\u0432 \u043f\u0440\u0438\u0445\u043e\u0434\u044f\u0442 \u043d\u0430 \u0412\u0430\u0448 \u044d\u043b\u0435\u043a\u0442\u0440\u043e\u043d\u043d\u044b\u0439 \u0430\u0434\u0440\u0435\u0441:')))
        __M_writer(u'<br/>\n\t\t\t<br/>\n\t\t\t')
        # SOURCE LINE 27
        __M_writer(escape(h.h_tags.image('/img/register_mailicon_small.gif', _(u'Email'))))
        __M_writer(u'\n\t\t\t<strong>')
        # SOURCE LINE 28
        __M_writer(escape(h.h_tools.mail_to('info@saleinform.com', u'info@saleinform.com', encode='hex')))
        __M_writer(u'</strong><br/>\n\t\t\t')
        # SOURCE LINE 29
        __M_writer(escape(_(u'\u0414\u043b\u044f \u0430\u043a\u0442\u0438\u0432\u0430\u0446\u0438\u0438 \u0443\u0447\u0435\u0442\u043d\u043e\u0439 \u0437\u0430\u043f\u0438\u0441\u0438 \u0438 \u043f\u043e\u043b\u0443\u0447\u0435\u043d\u0438\u044f \u0432\u0430\u0436\u043d\u044b\u0445 \u0441\u043e\u043e\u0431\u0449\u0435\u043d\u0438\u0439 \u0442\u0430\u043a\u0438\u0445 \u043a\u0430\u043a \u0438\u0437\u043c\u0435\u043d\u0435\u043d\u0438\u0435 \u043f\u0430\u0440\u043e\u043b\u044f, \u0441\u043e\u0442\u043e\u044f\u043d\u0438\u044f \u0437\u0430\u043a\u0430\u0437\u043e\u0432 \u0438 \u0437\u0430\u043f\u0440\u043e\u0441\u043e\u0432 \u0438 \u0434\u0440.')))
        __M_writer(u'\n\t\t\t<br/>\n\t\t\t<br/>\n\t\t\t')
        # SOURCE LINE 32
        __M_writer(escape(h.h_tags.image('/img/register_mailicon_small.gif', _(u'Email'))))
        __M_writer(u'\n\t\t\t<strong>')
        # SOURCE LINE 33
        __M_writer(escape(h.h_tools.mail_to('newsletters@saleinform.com', u'newsletters@saleinform.com', encode='hex')))
        __M_writer(u'</strong><br/>\n\t\t\t')
        # SOURCE LINE 34
        __M_writer(escape(_(u'\u0414\u043b\u044f \u043f\u043e\u043b\u0443\u0447\u0435\u043d\u0438\u044f \u0432\u0430\u0436\u043d\u044b\u0445 \u0440\u0430\u0441\u0441\u044b\u043b\u043e\u043a \u043d\u0430\u0448\u0435\u0433\u043e \u043f\u043e\u0440\u0442\u0430\u043b\u0430.')))
        __M_writer(u'</p>\n\t\t</div>\n\t</div>\n\t<div class="LowerModuleBorder">\n\t\t<div class="FooterBar">\n\t\t\t<div class="RightCorner"></div>\n\t\t</div>\n\t</div>\t\n\t\n</div>\n\n')
        return ''
    finally:
        context.caller_stack._pop_frame()


