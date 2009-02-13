#-*-coding: utf-8 -*-
import logging

from pylons import request, response, session, tmpl_context as c
from pylons.controllers.util import abort, redirect_to

from saleinform.lib.base import BaseController, render
from saleinform import model

log = logging.getLogger(__name__)

import saleinform.lib.modules as S_Modules

class StoresController(BaseController):
    def renderModules(self):
        S_Modules.Search().renderSearchBar()
        S_Modules.CategoriesList().getTopMenu()
        pass

    def index(self, letter=u'A'):
        self.renderModules()
        S_Modules.StoresList().getList(letter)
        return render('/layouts/stores.mako')
    
