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
import os
from saleinform.lib.modules.imgprocessing import Img


class ClientsList(object):
    logo_size = 90, 30 # размер логотипа
    logo_path = os.path.join('data', 'clients', 'logos')
    
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
                if key == 'name': clients = clients.filter(si.Clients.name.ilike('%'+rule+'%'))
                if key == 'place': clients = clients.filter(or_(si.Cities.name.ilike('%'+rule+'%'), si.Regions.name.ilike('%'+rule+'%'), si.Countries.name.ilike('%'+rule+'%')))
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
        try:
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
            if request.params['logo'] != '':
                client.logo = Img(self.logo_path).save_img(field_name='logo', size=self.logo_size)
                si.meta.Session.add(client)
                si.meta.Session.commit()
            return client.rid
        except:
            si.meta.Session.rollback()
            return False

    def optionsClients(self, rid):
        try:
            si.meta.Session.query(si.Clcategories).filter(si.Clcategories._clients_rid==rid).delete()
            si.meta.Session.query(si.Clcountries).filter(si.Clcountries._clients_rid==rid).delete()
            si.meta.Session.query(si.Clregions).filter(si.Clregions._clients_rid==rid).delete()
            si.meta.Session.query(si.Clcities).filter(si.Clcities._clients_rid==rid).delete()
            categories_list, countries_list, regions_list, cities_list = [], [], [], []
            for _categories_rid in request.params.getall('_categories_rid'):
                categories_list.append(si.Clcategories(_categories_rid=_categories_rid, _clients_rid=rid))
            for _countries_rid in request.params.getall('_countries_rid'):
                countries_list.append(si.Clcountries(_countries_rid=_countries_rid, _clients_rid=rid))
            for _regions_rid in request.params.getall('_regions_rid'):
                regions_list.append(si.Clregions(_regions_rid=_regions_rid, _clients_rid=rid))
            for _cities_rid in request.params.getall('_cities_rid'):
                cities_list.append(si.Clcities(_cities_rid=_cities_rid, _clients_rid=rid))
            si.meta.Session.add_all(categories_list)
            si.meta.Session.add_all(countries_list)
            si.meta.Session.add_all(regions_list)
            si.meta.Session.add_all(cities_list)
            si.meta.Session.commit()
        except:
            si.meta.Session.rollback()
            return False
            
        
    def getClcategories(self, rid):
        return si.meta.Session.query(si.Clcategories).filter(si.Clcategories._clients_rid==rid).all()

    def getClcountries(self, rid):
        return si.meta.Session.query(si.Clcountries).filter(si.Clcountries._clients_rid==rid).all()

    def getClregions(self, rid):
        return si.meta.Session.query(si.Clregions).filter(si.Clregions._clients_rid==rid).all()

    def getClcities(self, rid):
        return si.meta.Session.query(si.Clcities).filter(si.Clcities._clients_rid==rid).all()

    def getClient(self, rid):
        return si.meta.Session.query(si.Clients).filter(si.Clients.rid==rid).first()
