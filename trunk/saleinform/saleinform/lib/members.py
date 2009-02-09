#-*- coding: utf-8 -*-
"""
Mazvv 22-01-2009
Members 
"""
from pylons import request, response, session, config, tmpl_context as c
from saleinform.lib.base import render
from pylons.i18n import get_lang, set_lang, _
from saleinform.model import si
from sqlalchemy.sql import func, expression, or_, and_
from saleinform.lib import popularity
import smtplib
from email.mime.multipart import MIMEMultipart
from email.mime.text import MIMEText


class MembersContainer:
    
    def __init__(self):
        pass

    def renderLoginForm(self):
        return
    
    
    def getTopCategories(self):
        """получить первые N самых популярных категорий"""
        subquery = si.meta.Session.query(si.Categories.popularity, si.Catparents._parent_rid).\
                        join((si.Catparents, si.Catparents._categories_rid==si.Categories.rid)).subquery()
        clause = ~si.Categories.rid.in_(expression.select([si.Catparents._categories_rid]))
        categories = si.meta.Session.query(si.Categories.rid, si.Categories.name, si.Categories.slug, (func.sum(si.Categories.popularity)+func.sum(subquery.c.popularity)).label('popularity')).\
                        filter(subquery.c._parent_rid == si.Categories.rid).\
                        filter(clause).\
                        group_by(si.Categories.rid, si.Categories.name, si.Categories.slug).order_by('popularity desc').\
                        limit(self.mainListLimit).\
                        all()
        return categories

    def getSecondLevelCategories(self):
        """Получить подкатегории второго уровня"""
        subquery = si.meta.Session.query(si.Catparents._parent_rid, si.Categories.name, si.Categories.slug).\
                        join((si.Categories, si.Catparents._parent_rid==si.Categories.rid)).\
                        filter(si.Catparents.level == 2).\
                        group_by(si.Catparents._parent_rid, si.Categories.name, si.Categories.slug).\
                        subquery()
        subcategories = si.meta.Session.query(si.Catparents._categories_rid, subquery.c.slug, subquery.c.name, si.Catparents._parent_rid).\
                            filter(subquery.c._parent_rid == si.Catparents._categories_rid).\
                            filter(si.Catparents.level == 1).\
                            order_by(func.random()).\
                            all() 
        return subcategories
    
    def createAccount(self):
        """Создать аккаунт пользователя
        """
        self.sendACode(request.params['login'], request.params['email'])
        try:
            newAccount = si.Members()
            newAccount.email = request.params['email']
            newAccount.login = request.params['login']
            newAccount.password = request.params['password']
            newAccount.gender = request.params['gender']
            newAccount.acode = unicode(session.id)
            newAccount.active = False
            si.meta.Session.add(newAccount)
            si.meta.Session.commit()
            return True
        except:
            si.meta.Session.rollback()
            return False

    def sendACode(self, login_to, email_to):
        c.code = session.id
        msg = MIMEMultipart('alternative')
        msg['Subject'] = "Активация учетной записи на Saleinform.com"
        msg['From'] = u'Saleinform.com'
        msg['To'] = login_to
        html = '' #render('/mails/activate_code.mako')
        part = MIMEText(html, 'html')
        msg.attach(part)
        SMTPServer = smtplib.SMTP(config['smtp_server'])
        SMTPServer.sendmail(config['info_email_from'], email_to, msg.as_string())
        SMTPServer.quit()
        