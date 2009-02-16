#-*- coding: utf-8 -*-
"""
Mazvv 22-01-2009
Category 
"""
from pylons import request, response, session, tmpl_context as c
from saleinform.lib.base import render
from pylons.i18n import get_lang, set_lang
from saleinform.model import si
from sqlalchemy.sql import func, and_
from sqlalchemy.sql import expression

class CountriesList(object):

    def __init__(self, sort=None):
        self.defaultSort = sort or si.Countries.name

    def getList(self):
        """Возвращает список стран
        """
        countries = si.meta.Session.query(si.Countries.rid, si.Countries.name, si.Countries.code, si.Countries.archive, si.Currency.code.label('currency_code')).\
                    join((si.Currency, si.Currency.rid==si.Countries._currency_rid)).\
                    order_by(self.defaultSort).all()
        return countries
    
    def toArchive(self, countries = []):
        """Отправить страны в архив
        """
        si.meta.Session.update().values({si.Countries.archive:False})
        si.meta.Session.commit()
        return countries

    def fromArchive(self, countries = []):
        """Вынести все страны из архива
        """
        si.meta.Session.update().values({si.Countries.archive:False})
        si.meta.Session.commit()
        return countries
