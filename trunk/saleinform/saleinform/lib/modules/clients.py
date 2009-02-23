#-*- coding: utf-8 -*-
"""
Mazvv 22-02-2009
Clients
"""
from pylons import request, response, session, tmpl_context as c, config
from saleinform.lib.base import render
from pylons.i18n import get_lang, set_lang
from saleinform.model import si
from sqlalchemy.sql import func, and_
from sqlalchemy.sql import expression
import os, shutil

class ClientsList(object):

    def __init__(self, sort=None):
        self.defaultSort = sort or si.Clients.name

    def getList(self, **kargs):
        """Возвращает список клиентов
        """
        clients = si.meta.Session.query(si.Clients.rid, si.Clients.name, si.Clients.logo, si.Clients.address, si.Clients.phones,\
                                          si.Clients.skype, si.Clients.icq, si.Clients.url, si.Clients.isloaded, si.Clients.active,\
                                          si.Clients.contact_phones, si.Clients.contact_email, si.Clients.contact_person,
                                          si.Cities.name.label('cityName'), si.Regions.name.label('regionName'), si.Countries.name.label('countryName'),\
                                          si.Countries.image_name).\
                    join((si.Cities, si.Cities.rid==si.Clients._cities_rid),\
                         (si.Regions, si.Regions.rid==si.Cities._regions_rid),\
                         (si.Countries, si.Countries.rid==si.Regions._countries_rid)).\
                    order_by(self.defaultSort).all()
        return clients
    
    def toActive(self, rids):
        """Отправить страны в архив
        """
        try:
            countries = si.meta.Session.query(si.Countries).filter(si.Countries.rid.in_(rids)).update({si.Countries.archive:True})        
            si.meta.Session.commit()
        except:
            si.meta.Session.rollback()
            return False
        return True

    def fromActive(self):
        """Вынести все страны из архива
        """
        try:
            countries = si.meta.Session.query(si.Countries).update({si.Countries.archive:False})
            si.meta.Session.commit()
        except:
            si.meta.Session.rollback()
            return False
        return True

    def deleteClients(self, rids):
        """Удалить клиентов
        """
        try:
            clients = si.meta.Session.query(si.Clients).filter(si.Clients.rid.in_(rids)).delete()        
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
        
