from mako import runtime, filters, cache
UNDEFINED = runtime.UNDEFINED
__M_dict_builtin = dict
__M_locals_builtin = locals
_magic_number = 5
_modified_time = 1234030963.751317
_template_filename='/home/mazvv/Projects/Python/Pylons/saleinform/saleinform/templates/modules/members/login_form.mako'
_template_uri='/modules/members/login_form.mako'
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
        __M_writer(u'\n<div id="logPageUs"></div>\n<div id="Node_BreadCrumb" class="breadCrumb2-US">\n<a href="/">')
        # SOURCE LINE 7
        __M_writer(escape(_(u'\u0414\u043e\u043c\u0430\u0448\u043d\u044f\u044f')))
        __M_writer(u'</a>\n>\n<span class="grey">')
        # SOURCE LINE 9
        __M_writer(escape(_(u'\u0412\u043e\u0439\u0442\u0438 \u043d\u0430 \u0441\u0430\u0439\u0442')))
        __M_writer(u'</span>\n</div>\n<div style="clear: both;"></div>\n\n<table class="wd750">\n\t<tr>\n\t\t<td class="hdlpad1">\n\t\t\t<span class="headline">')
        # SOURCE LINE 16
        __M_writer(escape(_(u'\u0412\u043e\u0439\u0442\u0438 \u043d\u0430 \u0441\u0430\u0439\u0442')))
        __M_writer(u'</span>\n\t\t</td>\n\t</tr>\n</table>\n\n<table cellspacing="1" cellpadding="0" class="wd750nopad bg12dark">\n\t<tr> \n\t\t<td class="loginHD1"><span class="subhdl">')
        # SOURCE LINE 23
        __M_writer(escape(_(u'\u041d\u043e\u0432\u044b\u0439 \u043f\u043e\u043b\u044c\u0437\u043e\u0432\u0430\u0442\u0435\u043b\u044c?')))
        __M_writer(u'</span></td>\n\t\t<td class="loginHD1"><span class="subhdl">')
        # SOURCE LINE 24
        __M_writer(escape(_(u'\u0423\u0436\u0435 \u0437\u0430\u0440\u0435\u0433\u0438\u0441\u0442\u0440\u0438\u0440\u043e\u0432\u0430\u043d\u044b \u043d\u0430 \u0441\u0430\u0439\u0442\u0435?')))
        __M_writer(u'</span></td>\n\t</tr>\n\t<tr>\n\t\t<td class="loginCOL1 bg12light">\n\t\t\t')
        # SOURCE LINE 28
        __M_writer(escape(_(u'\u0415\u0441\u043b\u0438 \u0443 \u0412\u0430\u0441 \u0435\u0449\u0435 \u043d\u0435\u0442 \u0443\u0447\u0435\u0442\u043d\u043e\u0439 \u0437\u0430\u043f\u0438\u0441\u0438 \u043d\u0430 \u043d\u0430\u0448\u0435\u043c \u0441\u0430\u0439\u0442\u0435, \u043f\u043e\u0436\u0430\u043b\u0443\u0439\u0441\u0442\u0430, \u0441\u043f\u0435\u0440\u0432\u0430 \u0437\u0430\u0440\u0435\u0433\u0438\u0441\u0442\u0440\u0438\u0440\u0443\u0439\u0442\u0435\u0441\u044c.')))
        __M_writer(u'<br/><br/>\n\t\t\t')
        # SOURCE LINE 29
        __M_writer(escape(_(u'\u0420\u0435\u0433\u0438\u0441\u0442\u0440\u0430\u0446\u0438\u044f \u0437\u0430\u0439\u043c\u0435\u0442 \u0432\u0441\u0435\u0433\u043e \u043d\u0435\u0441\u043a\u043e\u043b\u044c\u043a\u043e \u0441\u0435\u043a\u0443\u043d\u0434')))
        __M_writer(u'<br/>\n\t\t\t<strong>')
        # SOURCE LINE 30
        __M_writer(escape(_(u'\u0438 \u043d\u0438 \u043a \u0447\u0435\u043c\u0443 \u0412\u0430\u0441 \u043d\u0435 \u043e\u0431\u044f\u0437\u044b\u0432\u0430\u0435\u0442')))
        __M_writer(u'</strong>.<br/><br/>\n\t\t\t<b>')
        # SOURCE LINE 31
        __M_writer(escape(_(u'\u0418\u043c\u0435\u044f \u0443\u0447\u0435\u0442\u043d\u0443\u044e \u0437\u0430\u043f\u0438\u0441\u044c \u043d\u0430 \u043d\u0430\u0448\u0435\u043c \u0441\u0430\u0439\u0442\u0435, \u0412\u044b \u043c\u043e\u0436\u0435\u0442\u0435:')))
        __M_writer(u'</b> \n\t\t\t<ul class="loginLIST">\n  \t\t\t\t<li>')
        # SOURCE LINE 33
        __M_writer(escape(_(u'\u041e\u0441\u0442\u0430\u0432\u043b\u044f\u0442\u044c \u043e\u0442\u0437\u044b\u0432\u044b \u043d\u0430 \u0442\u043e\u0432\u0430\u0440\u044b')))
        __M_writer(u'</li>\n  \t\t\t\t<li>')
        # SOURCE LINE 34
        __M_writer(escape(_(u'\u041e\u0446\u0435\u043d\u0438\u0432\u0430\u0442\u044c \u0442\u043e\u0432\u0430\u0440\u044b \u0438 \u043c\u0430\u0433\u0430\u0437\u0438\u043d\u044b')))
        __M_writer(u'</li>\n  \t\t\t\t<li>')
        # SOURCE LINE 35
        __M_writer(escape(_(u'\u0424\u043e\u0440\u043c\u0438\u0440\u043e\u0432\u0430\u0442\u044c \u0437\u0430\u043a\u0430\u0437\u044b')))
        __M_writer(u'</li>\n  \t\t\t\t<li>')
        # SOURCE LINE 36
        __M_writer(escape(_(u'\u0438 \u043c\u043d\u043e\u0433\u043e\u0435 \u0434\u0440\u0443\u0433\u043e\u0435...')))
        __M_writer(u'</li>\n\t\t\t</ul>\n\t\t\t<div class="padT5">\n\t\t\t\t')
        # SOURCE LINE 39
        __M_writer(escape(h.h_tags.form('/members/register', target='_self', method="post")))
        __M_writer(u'\n\t\t\t\t')
        # SOURCE LINE 40
        __M_writer(escape(h.h_tags.submit('Submit', value=_(u'\u0420\u0435\u0433\u0438\u0441\u0442\u0440\u0430\u0446\u0438\u044f >'), tabindex="3", maxlength="255", size="40", class_='w150')))
        __M_writer(u'\n\t\t\t\t')
        # SOURCE LINE 41
        __M_writer(escape(h.h_tags.end_form()))
        __M_writer(u'\n\t\t\t</div>\n\t\t</td>\n\t\t<td class="loginCOL2 bgwhite">\n\t\t\t')
        # SOURCE LINE 45
        __M_writer(escape(h.h_tags.form('/members/login', target='_self', method="get")))
        __M_writer(u'\n\t\t\t')
        # SOURCE LINE 46
        __M_writer(escape(_(u'\u041f\u043e\u0436\u0430\u043b\u0443\u0439\u0441\u0442\u0430, \u0432\u0432\u0435\u0434\u0438\u0442\u0435 \u0412\u0430\u0448\u0438 \u043b\u043e\u0433\u0438\u043d')))
        __M_writer(u' <br/>')
        __M_writer(escape(_(u'\u0438 \u043f\u0430\u0440\u043e\u043b\u044c.')))
        __M_writer(u'<br/><br/>\n\t\t\t')
        # SOURCE LINE 47
        __M_writer(escape(h.h_tags.hidden('loginAction', value="todo")))
        __M_writer(u'<br/>\n\t\t\t<span class="subhdl">')
        # SOURCE LINE 48
        __M_writer(escape(_(u'\u041b\u043e\u0433\u0438\u043d')))
        __M_writer(u'</span><br/>\n\t\t\t')
        # SOURCE LINE 49
        __M_writer(escape(h.h_tags.text('login', value="", tabindex="1", maxlength="255", size="40")))
        __M_writer(u'<br/>\n\t\t\t<span class="subgrey">')
        # SOURCE LINE 50
        __M_writer(escape(_(u'\u0417\u0430\u0431\u044b\u043b\u0438 \u0412\u0430\u0448')))
        __M_writer(u'</span> \n\t\t\t<a class="small" href="send_password.php">')
        # SOURCE LINE 51
        __M_writer(escape(_(u'\u043b\u043e\u0433\u0438\u043d')))
        __M_writer(u'</a>\n\t\t\t<span class="subgrey">?</span><br/><br/>\n\t\t\t<span class="subhdl">')
        # SOURCE LINE 53
        __M_writer(escape(_(u'\u041f\u0430\u0440\u043e\u043b\u044c')))
        __M_writer(u'</span><br/>\n\t\t\t')
        # SOURCE LINE 54
        __M_writer(escape(h.h_tags.password('password', value="", tabindex="2", maxlength="255", size="40")))
        __M_writer(u'<br/>\n\t\t\t<span class="subgrey">\u0412\u0430\u0436\u043d\u043e: \u0412\u0430\u0448\u0438 \u043b\u043e\u0433\u0438\u043d \u0438 \u043f\u0430\u0440\u043e\u043b\u044c \u0440\u0435\u0433\u0438\u0441\u0442\u0440\u043e\u0437\u0430\u0432\u0438\u0441\u0438\u043c\u044b</span><br/>\n\t\t\t<span class="subgrey">')
        # SOURCE LINE 56
        __M_writer(escape(_(u'\u0417\u0430\u0431\u044b\u043b\u0438 \u0412\u0430\u0448')))
        __M_writer(u'</span> \n\t\t\t<a class="small" href="send_password.php">')
        # SOURCE LINE 57
        __M_writer(escape(_(u'\u043f\u0430\u0440\u043e\u043b\u044c')))
        __M_writer(u'</a><span class="subgrey">?</span><br/>\n\t\t\t<br/>\n\t\t\t')
        # SOURCE LINE 59
        __M_writer(escape(h.h_tags.submit('Submit', value=_(u'\u0412\u043e\u0439\u0442\u0438 >'), tabindex="3", maxlength="255", size="40", class_='w150')))
        __M_writer(u'<br/>\n\t\t\t<br/>\n\t\t\t<br/>\n\t\t\t<div class="floatchkbx1">\n\t\t\t\t')
        # SOURCE LINE 63
        __M_writer(escape(h.h_tags.checkbox('autologin', value='1', tabindex="4")))
        __M_writer(u'\n\t\t\t</div>\n\t\t\t<span class="subgrey">')
        # SOURCE LINE 65
        __M_writer(escape(_(u'\u0417\u0430\u043f\u043e\u043c\u043d\u0438\u0442\u044c \u043c\u0435\u043d\u044f \u043d\u0430 \u044d\u0442\u043e\u043c \u043a\u043e\u043c\u043f\u044c\u044e\u0442\u0435\u0440\u0435')))
        __M_writer(u'</span>\n\t\t\t')
        # SOURCE LINE 66
        __M_writer(escape(h.h_tags.end_form()))
        __M_writer(u'\n\t\t</td>\n\t</tr>\n</table>')
        return ''
    finally:
        context.caller_stack._pop_frame()


