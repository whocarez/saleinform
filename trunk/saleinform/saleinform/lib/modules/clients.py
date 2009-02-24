#-*- coding: utf-8 -*-
"""
Mazvv 22-02-2009
Clients
"""
from pylons import request, response, session, tmpl_context as c, config
from saleinform.lib.base import render
from pylons.i18n import get_lang, set_lang
from saleinform.model import si
from sqlalchemy.sql import func, and_, or_
from sqlalchemy.sql import expression
import os, shutil, Image


class ClientsList(object):
    logoSize = 90, 30 # размер логотипа
    
    def __init__(self):
        self.sortabledCols = {'name':si.Clients.name, 'createdt':si.Clients.createdt}
        self.defaultSort = si.Clients.name
        self.defaultSortRule = 'asc'
        if session.get('clients_sort_rule', None):
            if session['clients_sort_rule']['column'] in self.sortabledCols.keys():
                self.defaultSort = self.sortabledCols.get(session['clients_sort_rule']['column'])
            self.defaultSortRule = session['clients_sort_rule']['rule']

    def getList(self, **kargs):
        """Возвращает список клиентов
        """
        clients = si.meta.Session.query(si.Clients.rid, si.Clients.name, si.Clients.logo, si.Clients.address, si.Clients.phones,\
                                          si.Clients.skype, si.Clients.icq, si.Clients.url, si.Clients.isloaded, si.Clients.active,\
                                          si.Clients.contact_phones, si.Clients.contact_email, si.Clients.contact_person, si.Clients.createdt,
                                          si.Cities.name.label('cityName'), si.Regions.name.label('regionName'), si.Countries.name.label('countryName'),\
                                          si.Countries.image_name).\
                    join((si.Cities, si.Cities.rid==si.Clients._cities_rid),\
                         (si.Regions, si.Regions.rid==si.Cities._regions_rid),\
                         (si.Countries, si.Countries.rid==si.Regions._countries_rid))
        
        if session.has_key('clients_search_rule'):
            searchRule = session.get('clients_search_rule')
            print searchRule
            for key, rule in searchRule.iteritems():
                if key == 'name': clients = clients.filter(si.Clients.name.like('%'+rule+'%'))
                if key == 'place': clients = clients.filter(or_(si.Cities.name.like('%'+rule+'%'), si.Regions.name.like('%'+rule+'%'), si.Countries.name.like('%'+rule+'%')))
        if self.defaultSortRule=='asc':
            clients = clients.order_by(self.defaultSort.asc()).all()
        else:
            clients = clients.order_by(self.defaultSort.desc()).all()
        return clients
    
    def toActive(self, rids):
        """Сделать активными
        """
        try:
            clients = si.meta.Session.query(si.Clients).filter(si.Clients.rid.in_(rids)).update({si.Clients.active:True})
            si.meta.Session.commit()
        except:
            si.meta.Session.rollback()
            return False
        return True

    def fromActive(self, rids):
        """Сделать неактивными
        """
        try:
            clients = si.meta.Session.query(si.Clients).filter(si.Clients.rid.in_(rids)).update({si.Clients.active:False}) 
            si.meta.Session.commit()
        except:
            si.meta.Session.rollback()
            return False
        return True

    def toIsloaded(self, rids):
        try:
            clients = si.meta.Session.query(si.Clients).filter(si.Clients.rid.in_(rids)).update({si.Clients.isloaded:True})
            si.meta.Session.commit()
        except:
            si.meta.Session.rollback()
            return False
        return True

    def fromIsloaded(self, rids):
        try:
            clients = si.meta.Session.query(si.Clients).filter(si.Clients.rid.in_(rids)).update({si.Clients.isloaded:False}) 
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
        
    
    def processingClients(self, rid=None):
        """Создание/Редактирование данных"""
        #try:
        if rid:
            client = si.meta.Session.query(si.Clients).filter(si.Clients.rid==rid).first()
        else: 
            client = si.Clients()
        client.name = request.params['name']
        client._cities_rid = request.params['_cities_rid']
        client.address = request.params['address']
        client.phones = request.params['phones']
        client.skype = request.params['skype']
        client.icq = request.params['icq']
        client.url = request.params['url']
        client.creadits_info = request.POST.get('creadits_info', False)
        client.delivery_info = request.params['delivery_info']
        client.worktime_info = request.params['worktime_info']
        client.descr = request.params['descr']
        client.isloaded = request.POST.get('isloaded', False)
        client.actual_days = request.params['actual_days']
        client.price_email = request.params['price_email']
        client.price_url = request.params['price_url']
        client.contact_phones = request.params['contact_phones']
        client.contact_email = request.params['contact_email']
        client.contact_person = request.params['contact_person']
        client.active = request.POST.get('active', False)
        client.popularity = request.params['popularity']
        si.meta.Session.add(client)
        si.meta.Session.commit()
        logoFile = open(os.path.join(config['pylons.paths']['static_files'], 'img', 'cllogos', 'original', str(client.rid)+'_'+request.params['logo'].filename), 'w')
        
        shutil.copyfileobj(request.params['logo'].file, logoFile)
        request.params['logo'].file.close()
        logoFile.close()
        client.logo = '/img/cllogos/'+str(client.rid)+'_'+request.params['logo'].filename
        #self.logoImageProcessing(logoFile, client.logo)
        si.meta.Session.add(client)
        si.meta.Session.commit()
        return client.rid
        #except:
        #    si.meta.Session.rollback()
        #    return False

    def getClient(self, rid):
        return si.meta.Session.query(si.Clients).filter(si.Clients.rid==rid).first()
        

    def logoImageProcessing(self, sourcePath, destPath):
        """Обработка изображения логотипа
        """
        #try:
        im = Image.open(sourcePath)
        im.thumbnail(self.logoSize)
        im.save(destPath)
        return True
        #except:
        #    return False
        
        