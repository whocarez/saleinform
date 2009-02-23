#-*- coding: utf-8 -*-
"""
Mazvv 22-02-2009
Regions
"""
from pylons import request, response, session, tmpl_context as c, config
from saleinform.lib.base import render
from pylons.i18n import get_lang, set_lang
from saleinform.model import si
from sqlalchemy.sql import func, and_
from sqlalchemy.sql import expression

class RegionsList(object):

    def __init__(self, sort=None):
        self.defaultSort = sort or si.Regions.name

    def getList(self, countryRid = None):
        """Возвращает список регионов
        """
        if countryRid:
            regions = si.meta.Session.query(si.Regions).filter(si.Regions._countries_rid==countryRid).order_by(self.defaultSort).all()
        else:
            regions = si.meta.Session.query(si.Regions).order_by(self.defaultSort).all() 
        return regions
    
    def processingRegions(self, rid=None):
        """Создание/Редактирование данных"""
        try:
            if rid:
                region = si.meta.Session.query(si.Regions).filter(si.Regions.rid==rid).first()
            else: 
                region = si.Regions()
            region.name=request.params['name'] 
            region._countries_rid=request.params['_countries_rid']
            si.meta.Session.add(region)
            si.meta.Session.commit()
            return region.rid   
        except:
            si.meta.Session.rollback()
            return False
    
    def getRegion(self, rid):
        return si.meta.Session.query(si.Regions).filter(si.Regions.rid==rid).first()
        
    def removeRegion(self, rid):
        si.meta.Session.query(si.Regions).filter(si.Regions.rid==rid).delete()
        si.meta.Session.commit()

class CitiesList(object):

    def __init__(self, sort=None):
        self.defaultSort = sort or si.Cities.name

    def getList(self, regionRid = None):
        """Возвращает список городов
        """
        if regionRid:
            cities = si.meta.Session.query(si.Cities).filter(si.Cities._regions_rid==regionRid).order_by(self.defaultSort).all()
        else:
            cities = si.meta.Session.query(si.Cities, si.Regions.name.label('regionName'), si.Countries.name.label('countryName')).order_by(self.defaultSort).\
            join((si.Regions, si.Regions.rid==si.Cities._regions_rid), (si.Countries, si.Countries.rid==si.Regions._countries_rid)).\
            all() 
        return cities 

    def processingCities(self, rid=None):
        """Создание/Редактирование данных"""
        try:
            if rid:
                city = si.meta.Session.query(si.Cities).filter(si.Cities.rid==rid).first()
            else: 
                city = si.Cities()
            city.name=request.params['name'] 
            city._regions_rid=request.params['_regions_rid']
            si.meta.Session.add(city)
            si.meta.Session.commit()
            return city.rid
        except:
            si.meta.Session.rollback()
            return False
    
    def getCity(self, rid):
        return si.meta.Session.query(si.Cities).filter(si.Cities.rid==rid).first()

    def removeCity(self, rid):
        si.meta.Session.query(si.Cities).filter(si.Cities.rid==rid).delete()
        si.meta.Session.commit()

