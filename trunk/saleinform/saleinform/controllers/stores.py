#-*-coding: utf-8 -*-
import logging

from pylons import request, response, session, tmpl_context as c
from pylons.controllers.util import abort, redirect_to

from saleinform.lib.base import BaseController, render
from saleinform import model

log = logging.getLogger(__name__)

from saleinform.lib.navigator import Navigator
from saleinform.lib.search import Search
from saleinform.lib.category import Category
from saleinform.lib.stores import StoresContainer 

class StoresController(BaseController):
    def renderModules(self):
        Search().renderSearchBar()
        Category().renderTopMenu()
        pass

    def index(self):
        self.renderModules()
        StoresContainer().renderStoresList()
        return render('/layouts/stores.mako')
    
    def letter(self, letter=u'A'):
        self.renderModules()
        StoresContainer().renderStoresList(letter)
        return render('/layouts/stores.mako')    