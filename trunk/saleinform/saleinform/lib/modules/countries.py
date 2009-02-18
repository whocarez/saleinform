#-*- coding: utf-8 -*-
"""
Mazvv 22-01-2009
Category 
"""
from pylons import request, response, session, tmpl_context as c, config
from saleinform.lib.base import render
from pylons.i18n import get_lang, set_lang
from saleinform.model import si
from sqlalchemy.sql import func, and_
from sqlalchemy.sql import expression
import os, shutil

class CountriesList(object):

    def __init__(self, sort=None):
        self.defaultSort = sort or si.Countries.name

    def getList(self):
        """Возвращает список стран
        """
        countries = si.meta.Session.query(si.Countries.rid, si.Countries.name, si.Countries.image_name, si.Countries.code, si.Countries.archive, si.Currency.code.label('currency_code')).\
                    join((si.Currency, si.Currency.rid==si.Countries._currency_rid)).\
                    order_by(self.defaultSort).all()
        return countries
    
    def toArchive(self, rids):
        """Отправить страны в архив
        """
        try:
            countries = si.meta.Session.query(si.Countries).filter(si.Countries.rid.in_(rids)).update({si.Countries.archive:True})        
            si.meta.Session.commit()
        except:
            si.meta.Session.rollback()
            return False
        return True

    def fromArchive(self):
        """Вынести все страны из архива
        """
        try:
            countries = si.meta.Session.query(si.Countries).update({si.Countries.archive:False})
            si.meta.Session.commit()
        except:
            si.meta.Session.rollback()
            return False
        return True

    def deleteCountries(self, rids):
        """Удалить страны
        """
        try:
            countries = si.meta.Session.query(si.Countries).filter(si.Countries.rid.in_(rids)).delete()        
            si.meta.Session.commit()
            return True
        except:
            si.meta.Session.rollback()
            return False
        
    
    def processingCountry(self, rid=None):
        """Создание/Редактирование данных"""
        try:
            if rid:
                country = si.meta.Session.query(si.Countries).filter(si.Countries.rid==rid).first()
            else: 
                country = si.Countries()
                country.code=request.params['code']
                country.name=request.params['name'] 
                country.image_name='/img/flags/'+request.params['code']+'_'+request.params['image_name'].filename
                country._currency_rid=request.params['_currency_rid']
                country.archive=request.params.get('archive', False)
                si.meta.Session.add(country)
                si.meta.Session.commit()
                flagFile = open(os.path.join(config['pylons.paths']['static_files'], 'img', 'flags', request.params['code']+'_'+request.params['image_name'].filename), 'w')
                shutil.copyfileobj(request.params['image_name'].file, flagFile)
                request.params['image_name'].file.close()
                flagFile.close()
            return country.rid
        except:
            si.meta.Session.rollback()
            return False

    def getCountry(self, rid):
        return si.meta.Session.query(si.Countries).filter(si.Countries.rid==rid).first()
        
