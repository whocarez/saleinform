#-*- coding: utf-8 -*-
"""
Mazvv 18-02-2009
"""
from pylons import request, response, session, tmpl_context as c, config
from saleinform.lib.base import render
from pylons.i18n import get_lang, set_lang
from saleinform.model import si
from sqlalchemy.sql import func, and_
from sqlalchemy.sql import expression

class CurrencyList(object):

    def __init__(self, sort=None):
        self.defaultSort = sort or si.Currency.name

    def getList(self):
        """Возвращает список валют
        """
        currency = si.meta.Session.query(si.Currency).\
                    order_by(self.defaultSort).all()
        return currency
    
    def deleteCurrency(self, rids):
        """Удалить валюты
        """
        try:
            currency = si.meta.Session.query(si.Currency).filter(si.Currency.rid.in_(rids)).delete()        
            si.meta.Session.commit()
            return True
        except:
            si.meta.Session.rollback()
            return False
        
    
    def processingCurrency(self, rid=None):
        """Создание/Редактирование данных"""
        try:
            if rid:
                currency = si.meta.Session.query(si.Currency).filter(si.Currency.rid==rid).first()
            else: 
                currency = si.Currency()
            currency.code=request.params['code']
            currency.name=request.params['name'] 
            currency.endword=request.params['endword']
            si.meta.Session.add(currency)
            si.meta.Session.commit()
            return currency.rid
        except:
            si.meta.Session.rollback()
            return False

    def getCurrency(self, rid):
        return si.meta.Session.query(si.Currency).filter(si.Currency.rid==rid).first()
    
    def getOfficalCources(self):
        """Получить оффициальные курсы валют
        """
        oc = si.meta.Session.query(si.Officialcources).\
                all()
        return oc
        
    def updateOfficialCources(self):
        """Создание/Редактирование данных"""
        try:
            currency = si.meta.Session.query(si.Officialcources).delete()
            for key, par in request.POST.items():
                if not str(key).startswith('cources') or not par: continue
                l = str(key).split('-')
                oc = si.Officialcources()
                oc._currency_rid=l[-2]
                oc._countries_rid=l[-1]
                oc.cource=par
                si.meta.Session.add(oc)
            si.meta.Session.commit()
            return True
        except:
            si.meta.Session.rollback()
            return False
        
        
