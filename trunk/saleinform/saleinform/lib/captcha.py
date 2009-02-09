#-*-coding: utf-8 -*-
from pylons import session, config
import os, time
from saleinform.lib.Captcha.Visual.Tests import PseudoGimpy, AngryGimpy, AntiSpam

class SCaptcha:
    captchaPath = '/img/captcha/'
    captchaImg = None
    
    def __init__(self):
        pass

    def get(self):
        g = PseudoGimpy()
        i = g.render([199, 78])
        session['captcha'] = g.solutions[0]
        session.save()
        imgName = ''.join([str(time.time()).replace('.', ''), '.png'])
        i.save(''.join([config['pylons.paths']['static_files'], self.captchaPath, imgName]))
        self.captchaImg = ''.join([self.captchaPath,  imgName])
        return self.captchaImg
    
    def validate(self, captchaValue = None):
        """
        Проверка валидности 
        """
        if session['captcha'] == captchaValue:
            return True
        return False