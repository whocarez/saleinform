from mako import runtime, filters, cache
UNDEFINED = runtime.UNDEFINED
__M_dict_builtin = dict
__M_locals_builtin = locals
_magic_number = 5
_modified_time = 1234127120.7596259
_template_filename='/home/mazvv/Projects/Python/Pylons/saleinform/saleinform/templates/modules/members/register_form.mako'
_template_uri='/modules/members/register_form.mako'
_template_cache=cache.Cache(__name__, _modified_time)
_source_encoding='utf-8-'
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
        # SOURCE LINE 4
        __M_writer(u'\n<div id="logPageUs"></div>\n<div id="Node_BreadCrumb" class="breadCrumb2-US">\n<a href="/">')
        # SOURCE LINE 7
        __M_writer(escape(_(u'\u0414\u043e\u043c\u0430\u0448\u043d\u044f\u044f')))
        __M_writer(u'</a>\n>\n<span class="grey">')
        # SOURCE LINE 9
        __M_writer(escape(_(u'\u0420\u0435\u0433\u0438\u0441\u0442\u0440\u0430\u0446\u0438\u044f')))
        __M_writer(u'</span>\n</div>\n<div style="clear: both;">\n</div>\n<div class="registerContainer">\n\t<script type="text/javascript">\n\t<!--\n\tfunction InfoProcessing(blockName){\n\t\tif($(\'#info_\'+blockName).css(\'display\')==\'block\') $(\'#info_\'+blockName).hide(\'slow\');\n\t\telse $(\'#info_\'+blockName).show(\'slow\');\n\t}\n\n\tfunction ReloadCaptcha(){\n\t\t$.ajax({\n\t\t\t  type: "POST",\n\t\t\t  url: "gencaptcha",\n\t\t\t  data: "",\n\t\t\t  success: function(img){\n\t\t\t\t$(\'#i_captcha\').attr(\'src\', \'/img/ajax-loader.gif\');\n\t\t\t    //$(\'#i_captcha\').attr(\'src\', img);\n\t\t\t  }\n\t\t\t});\n\t}\n\t//-->\n\t</script>\n\t<div class="headerBar">\n\t\t<div class="RightCorner"></div>\n\t\t<div class="RightControlArea"></div>\n\t\t<h3 class="ModuleTitle">')
        # SOURCE LINE 37
        __M_writer(escape(_(u'\u0420\u0435\u0433\u0438\u0441\u0442\u0440\u0430\u0446\u0438\u044f \u043d\u043e\u0432\u043e\u0433\u043e \u043f\u043e\u043b\u044c\u0437\u043e\u0432\u0430\u0442\u0435\u043b\u044f')))
        __M_writer(u'</h3>\n\t</div>\n\t')
        # SOURCE LINE 39
        __M_writer(escape(h.h_tags.form('/members/signup', target='_self', method="post")))
        __M_writer(u'\n\t<div class="registerBody">\n\t\t<div class="registerLine1">\n\t\t\t<label for="login">')
        # SOURCE LINE 42
        __M_writer(escape(_(u'\u041b\u043e\u0433\u0438\u043d')))
        __M_writer(u'</label>\n\t\t\t')
        # SOURCE LINE 43
        __M_writer(escape(h.h_tags.text('login', value="", id="login")))
        __M_writer(u'<a href="javascript: void(0);" onClick="InfoProcessing(\'login\');" title="')
        __M_writer(escape(_(u'\u041f\u043e\u043c\u043e\u0449\u044c')))
        __M_writer(u'">')
        __M_writer(escape(h.h_tags.image('/img/info.png', _(u'\u041f\u043e\u043c\u043e\u0449\u044c'), border="0", class_="infoIcon")))
        __M_writer(u'</a>\n\t\t\t<div class="registerInfo subgrey" id="info_login" style="display: none;">\n\t\t\t\t<strong>')
        # SOURCE LINE 45
        __M_writer(escape(_(u'\u041d\u0430\u043f\u0440\u0438\u043c\u0435\u0440:')))
        __M_writer(u'</strong> superstar123<br>\n\t\t\t\t')
        # SOURCE LINE 46
        __M_writer(escape(_(u'\u0412\u0441\u0435 \u0412\u0430\u0448\u0438 \u043e\u0442\u0437\u044b\u0432\u044b \u0438 \u043a\u043e\u043c\u043c\u0435\u043d\u0442\u0430\u0440\u0438\u0438 \u0431\u0443\u0434\u0443\u0442 \u043f\u043e\u0434\u043f\u0438\u0441\u0430\u043d\u044b \u044d\u0442\u0438\u043c \u0438\u043c\u0435\u043d\u0435\u043c.')))
        __M_writer(u'<br>\n\t\t\t\t<strong>')
        # SOURCE LINE 47
        __M_writer(escape(_(u'\u0412\u0430\u0436\u043d\u043e:')))
        __M_writer(u'</strong>\n\t\t\t\t')
        # SOURCE LINE 48
        __M_writer(escape(_(u'\u043f\u043e\u0436\u0430\u043b\u0443\u0439\u0441\u0442\u0430, \u043d\u0435 \u0438\u0441\u043f\u043e\u043b\u044c\u0437\u0443\u0439\u0442\u0435 \u0432 \u043a\u0430\u0447\u0435\u0441\u0442\u0432\u0435 \u043b\u043e\u0433\u0438\u043d\u0430 \u0412\u0430\u0448 \u0430\u0434\u0440\u0435\u0441 \u044d\u043b\u0435\u043a\u0442\u0440\u043e\u043d\u043d\u043e\u0439 \u043f\u043e\u0447\u0442\u044b.')))
        __M_writer(u'\n\t\t\t</div>\n\t\t</div>\n\t\t\n\t\t<div class="registerLine2">\n\t\t\t<label for="email">')
        # SOURCE LINE 53
        __M_writer(escape(_(u'\u0412\u0430\u0448 E-mail')))
        __M_writer(u'</label>\n\t\t\t')
        # SOURCE LINE 54
        __M_writer(escape(h.h_tags.text('email', value="", id="email")))
        __M_writer(u'\n\t\t</div>\n\n\t\t<div class="registerLine1">\n\t\t\t<label for="password">')
        # SOURCE LINE 58
        __M_writer(escape(_(u'\u041f\u0430\u0440\u043e\u043b\u044c')))
        __M_writer(u'</label>\n\t\t\t')
        # SOURCE LINE 59
        __M_writer(escape(h.h_tags.password('password', value="", id="password")))
        __M_writer(u'\n\t\t\t<div class="passwordInfo subgrey" id="info_password">\n\t\t\t\t')
        # SOURCE LINE 61
        __M_writer(escape(_(u'\u041f\u0430\u0440\u043e\u043b\u044c \u0434\u043e\u043b\u0436\u0435\u043d \u0441\u043e\u0434\u0435\u0440\u0436\u0430\u0442\u044c \u043d\u0435 \u043c\u0435\u043d\u0435\u0435 4-\u0445 \u0441\u0438\u043c\u0432\u043e\u043b\u043e\u0432')))
        __M_writer(u'<br>\n\t\t\t</div>\n\t\t</div>\n\n\t\t<div class="registerLine2">\n\t\t\t<label for="confirm_password">')
        # SOURCE LINE 66
        __M_writer(escape(_(u'\u041f\u043e\u0434\u0442\u0432\u0435\u0440\u0436\u0434\u0435\u043d\u0438\u0435 \u043f\u0430\u0440\u043e\u043b\u044f')))
        __M_writer(u'</label>\n\t\t\t')
        # SOURCE LINE 67
        __M_writer(escape(h.h_tags.password('confirm_password', value="", id="confirm_password")))
        __M_writer(u'\n\t\t</div>\n\n\t\t<div class="registerLine1">\n\t\t\t<label for="gender">')
        # SOURCE LINE 71
        __M_writer(escape(_(u'\u0412\u0430\u0448 \u043f\u043e\u043b')))
        __M_writer(u'</label>\n\t\t\t')
        # SOURCE LINE 72
        __M_writer(escape(h.h_tags.radio('gender', value="M", checked=True, class_='registerRadio')))
        __M_writer(u'<span class="registerRadio">')
        __M_writer(escape(_(u'\u041c\u0443\u0436\u0441\u043a\u043e\u0439')))
        __M_writer(u'</span>\n\t\t\t')
        # SOURCE LINE 73
        __M_writer(escape(h.h_tags.radio('gender', value="F", class_='registerRadio')))
        __M_writer(u'<span class="registerRadio">')
        __M_writer(escape(_(u'\u0416\u0435\u043d\u0441\u043a\u0438\u0439')))
        __M_writer(u'</span>\n\t\t</div>\n\n\t\t<div class="registerLine2">\n\t\t\t<div class="leftSide">\n\t\t\t\t<label for="captcha">')
        # SOURCE LINE 78
        __M_writer(escape(_(u'\u041f\u043e\u0436\u0430\u043b\u0443\u0439\u0441\u0442\u0430, \u0432\u0432\u0435\u0434\u0438\u0442\u0435 \u0441\u043b\u043e\u0432\u043e, \u0438\u0437\u043e\u0431\u0440\u0430\u0436\u0435\u043d\u043d\u043e\u0435 \u043d\u0430 \u043a\u0430\u0440\u0442\u0438\u043d\u043a\u0435')))
        __M_writer(u'</label>\n\t\t\t\t')
        # SOURCE LINE 79
        __M_writer(escape(h.h_tags.image(c.captcha, _(u'\u0412\u0432\u0435\u0434\u0438\u0442\u0435 \u0441\u0438\u043c\u0432\u043e\u043b\u044b, \u0438\u0437\u043e\u0431\u0440\u0430\u0436\u0435\u043d\u043d\u044b\u0435 \u043d\u0430 \u043a\u0430\u0440\u0442\u0438\u043d\u043a\u0435'), border="0", id="i_captcha")))
        __M_writer(u'\n\t\t\t\t')
        # SOURCE LINE 80
        __M_writer(escape(h.h_tags.text('captcha', value="", id="confirm_password", class_="registerCaptcha")))
        __M_writer(u'\n\t\t\t</div>\n\t\t\t<div class="captchaExplainText">\n\t\t\t\t<span class="subgrey">')
        # SOURCE LINE 83
        __M_writer(escape(_(u'\u041f\u043b\u043e\u0445\u043e \u0440\u0430\u0437\u043b\u0438\u0447\u0438\u043c\u043e \u0438\u0437\u043e\u0431\u0440\u0430\u0436\u0435\u043d\u0438\u0435?')))
        __M_writer(u'</span>\n\t\t\t\t')
        # SOURCE LINE 84
        __M_writer(escape(h.h_tags.link_to(_(u'\u041f\u0435\u0440\u0435\u0433\u0435\u043d\u0435\u0440\u0438\u0440\u043e\u0432\u0430\u0442\u044c \u0438\u0437\u043e\u0431\u0440\u0430\u0436\u0435\u043d\u0438\u0435'), url='javascript:void(0);', onClick="ReloadCaptcha();")))
        __M_writer(u'\n\t\t\t</div>\n\t\t\t<div style="clear: both;"></div>\n\t\t</div>\n\t\t\n\t\t<div>\n\t\t\t')
        # SOURCE LINE 90
        __M_writer(escape(h.h_tags.submit('signup', _(u'\u041e\u0442\u043f\u0440\u0430\u0432\u0438\u0442\u044c'), id="signup_btn")))
        __M_writer(u'\n\t\t</div>\n\t</div>\n\t')
        # SOURCE LINE 93
        __M_writer(escape(h.h_tags.end_form()))
        __M_writer(u'\n\t<div class="LowerModuleBorder">\n\t\t<div class="FooterBar">\n\t\t\t<div class="RightCorner"></div>\n\t\t</div>\n\t</div>\t\n</div>\n\n')
        return ''
    finally:
        context.caller_stack._pop_frame()


