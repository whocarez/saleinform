#-*- coding: utf-8 -*-
"""
Mazvv 22-01-2009
Stores
"""
from pylons import request, response, session, tmpl_context as c
from pylons.i18n import get_lang, set_lang
from saleinform.model import si
from sqlalchemy.sql import func, expression, or_, and_ 
import string

class Store:
    
    def __init__(self):
        pass

class StoresContainer:
    
    def __init__(self):
        pass
    
    def renderPopularStores(self):
        pass

    def renderNewStores(self):
        pass

    def renderStoresList(self, letter=u'A'):
        c.letter = letter
        sLetter = letter.lower()+'%'
        bLetter = letter.upper()+'%'
        c.stores = si.meta.Session.query(si.Clients, si.Cities, si.Regions, si.Countries).\
                    join((si.Cities, si.Cities.rid==si.Clients._cities_rid)).\
                    join((si.Regions, si.Regions.rid==si.Cities._regions_rid)).\
                    join((si.Countries, si.Countries.rid==si.Regions._countries_rid)).\
                    filter(or_(si.Clients.name.like(sLetter), si.Clients.name.like(bLetter))).\
                    all();
         
