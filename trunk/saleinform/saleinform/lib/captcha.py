#-*-coding: utf-8 -*-
from pylons import session, config
import os
from saleinform.lib.Captcha.Visual.Tests import PseudoGimpy
class SCaptcha:
    captchaPath = '/img/captcha/'
    def __init__(self):
        g = PseudoGimpy()
        i = g.render()
        session['captcha'] = g.solutions
        session.save()
        i.save(''.join([config['pylons.paths']['static_files'], self.captchaPath, session.id, '.png']))

    def get(self):
        pass