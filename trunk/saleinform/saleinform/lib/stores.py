#-*- coding: utf-8 -*-
"""
Mazvv 22-01-2009
Stores
"""
from pylons import request, response, session, tmpl_context as c
from pylons.i18n import get_lang, set_lang
from saleinform.model import si
from sqlalchemy.sql import func
from sqlalchemy.sql import expression

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
