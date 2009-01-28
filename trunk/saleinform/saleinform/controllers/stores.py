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

class StoresController(BaseController):
    def renderModules(self):
        c.SEARCHBAR = Search().renderSearchBar()
        c.CATEGORIES_LIST = Category().renderTopMenu()
        pass

    def index(self):
        self.renderModules()
        return render('/layouts/stores.mako')