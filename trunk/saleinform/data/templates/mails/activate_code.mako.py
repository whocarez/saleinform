from mako import runtime, filters, cache
UNDEFINED = runtime.UNDEFINED
__M_dict_builtin = dict
__M_locals_builtin = locals
_magic_number = 5
_modified_time = 1234219810.1426189
_template_filename='/home/mazvv/Projects/Python/Pylons/saleinform/saleinform/templates/mails/activate_code.mako'
_template_uri='/mails/activate_code.mako'
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
        # SOURCE LINE 2
        __M_writer(u'<html>\n  <head>\n\t<meta name="description" content="">\n\t<meta name="keywords" content="">\n\t<meta http-equiv="Content-Type" content="text/html; charset=utf-8">\n  </head>\n  <body>\n    <p>')
        # SOURCE LINE 9
        __M_writer(escape(_(u'\u0414\u043e\u0431\u0440\u043e \u043f\u043e\u0436\u0430\u043b\u043e\u0432\u0430\u0442\u044c, \u043d\u0430 Saleinform')))
        __M_writer(u'</p>\n       ')
        # SOURCE LINE 10
        __M_writer(escape(_(u'\u041f\u0440\u043e\u0446\u0435\u0441\u0441 \u0440\u0435\u0433\u0438\u0441\u0442\u0440\u0430\u0446\u0438\u0438 \u043f\u043e\u0447\u0442\u0438 \u0437\u0430\u0432\u0435\u0440\u0448\u0435\u043d. \u0414\u043b\u044f \u0430\u043a\u0442\u0438\u0432\u0430\u0446\u0438\u0438 \u0412\u0430\u0448\u0435\u0439 \u0443\u0447\u043d\u0442\u043d\u043e\u0439 \u0437\u0430\u043f\u0438\u0441\u0438\u0441, \u043f\u043e\u0436\u0430\u043b\u0443\u0439\u0441\u0442\u0430, \u043a\u043b\u0438\u043a\u043d\u0438\u0442\u0435 \u043d\u0430 \u0441\u0441\u044b\u043b\u043a\u0443 \u0438\u043b\u0438 \u0436\u0435 \u0441\u043a\u043e\u043f\u0438\u0440\u0443\u0439\u0442\u0435 \u0438 \u0432\u0441\u0442\u0430\u0432\u044c\u0442\u0435 \u0435\u0451 \u0432 \u0412\u0430\u0448 \u0431\u0440\u0430\u0443\u0437\u0435\u0440.')))
        __M_writer(u'\n       <br>\n       ')
        # SOURCE LINE 12
        __M_writer(escape(_(u'\u0421\u0441\u044b\u043b\u043a\u0430 \u0434\u043b\u044f \u0430\u043a\u0442\u0438\u0432\u0430\u0446\u0438\u0438')))
        __M_writer(u'\n       ')
        # SOURCE LINE 13
        __M_writer(escape(h.h_tags.link_to('/members/activate?code='+c.code)))
        __M_writer(u'\n       <br>\n       <br>\n\t\t')
        # SOURCE LINE 16
        __M_writer(escape(_(u'\u041a\u043e\u043c\u0430\u043d\u0434\u0430 Saleinform')))
        __M_writer(u'\n\t\t<br>\n\t\t<strong>')
        # SOURCE LINE 18
        __M_writer(escape(_(u'\u0412\u0430\u0436\u043d\u043e:')))
        __M_writer(u'</strong>\n\t\t')
        # SOURCE LINE 19
        __M_writer(escape(_(u'\u0441\u0441\u044b\u043b\u043a\u0430 \u0434\u0435\u0439\u0441\u0442\u0432\u0438\u0442\u0435\u043b\u044c\u043d\u0430 \u0432 \u0442\u0435\u0447\u0435\u043d\u0438\u0438 7 \u0434\u043d\u0435\u0439, \u043f\u043e\u0441\u043b\u0435 \u0447\u0435\u0433\u043e \u0431\u0443\u0434\u0435\u0442 \u0443\u0434\u0430\u043b\u0435\u043d\u0430. \u0415\u0441\u043b\u0438 \u0412\u044b \u043d\u0435 \u0430\u043a\u0442\u0438\u0432\u0438\u0440\u043e\u0432\u0430\u043b\u0438 \u0441\u0432\u043e\u0439 \u0430\u043a\u043a\u0430\u0443\u043d\u0442 \u043d\u0430 \u043f\u0440\u043e\u0442\u044f\u0436\u0435\u043d\u0438\u0438 \u044d\u0442\u043e\u0433\u043e \u0432\u0440\u0435\u043c\u0435\u043d\u0438, \u0412\u0430\u043c \u043d\u0435\u043e\u0431\u0445\u043e\u0434\u0438\u043c\u043e \u043f\u043e\u0432\u0442\u043e\u0440\u0438\u0442\u044c \u043f\u0440\u043e\u0446\u0435\u0441\u0441 \u0440\u0435\u0433\u0438\u0441\u0442\u0440\u0430\u0446\u0438\u0438')))
        __M_writer(u'\n  </body>\n</html>\n')
        return ''
    finally:
        context.caller_stack._pop_frame()


