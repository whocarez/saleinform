#-*- coding: utf-8 -*-
"""
Mazvv 22-01-2009
search system
"""
from saleinform.lib.base import render
from pylons.i18n import get_lang, set_lang
class Search:
    
    def __init__(self):
        pass
    
    def renderSearchBar(self):
        return render('/modules/search/searchbar.mako')