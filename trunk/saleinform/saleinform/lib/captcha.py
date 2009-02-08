#-*-coding: utf-8 -*-
from pylons import session, config
import os
from saleinform.lib.Captcha.Visual.Tests import PseudoGimpy, AngryGimpy, AntiSpam

class SCaptcha:
    captchaPath = '/img/captcha/'
    captchaImg = None
    
    def __init__(self):
        g = PseudoGimpy()
        i = g.render([199, 78])
        session['captcha'] = g.solutions
        session.save()
        print g.solutions
        i.save(''.join([config['pylons.paths']['static_files'], self.captchaPath, session.id, '.png']))
        self.captchaImg = ''.join([self.captchaPath, session.id, '.png'])

    def get(self):
        return self.captchaImg