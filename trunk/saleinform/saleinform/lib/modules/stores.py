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

class StoresList:
    
    def __init__(self):
        pass
    
    def getList(self, letter=u'A'):
        c.letter = letter
        EXPR = u''
        if letter == u'0-9':
            EXPR = u'([0-9])%'
        else:
            sLetter = letter.lower()
            bLetter = letter.upper()
            EXPR = u'('+sLetter+u'|'+bLetter+u')%'
        c.stores = si.meta.Session.query(si.Clients, si.Cities, si.Regions, si.Countries).\
                    join((si.Cities, si.Cities.rid==si.Clients._cities_rid)).\
                    join((si.Regions, si.Regions.rid==si.Cities._regions_rid)).\
                    join((si.Countries, si.Countries.rid==si.Regions._countries_rid)).\
                    filter(u"_clients.name SIMILAR TO :value").\
                    params(value=EXPR).\
                    all()
        return
         
