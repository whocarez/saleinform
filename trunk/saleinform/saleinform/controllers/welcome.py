import logging

from pylons.i18n import get_lang, set_lang
from pylons import request, response, session, tmpl_context as c
from pylons.controllers.util import abort, redirect_to

 
from saleinform.lib.base import BaseController, render
#from saleinform import model
#load libraries
from saleinform.lib.navigator import Navigator
from saleinform.lib.search import Search
from saleinform.lib.category import Category

log = logging.getLogger(__name__)

class WelcomeController(BaseController):
    
    def renderModules(self):
        c.TOPNAVIGATOR = Navigator().renderMainTopNavigator() 
        c.FOOTERNAVIGATOR = Navigator().renderFooterNavigator() 
        c.SEARCHBAR = Search().renderSearchBar()
        c.CATEGORIES_LIST = Category().renderCategoriesMain()
        pass
        
    def index(self):
        self.renderModules()
        return render('/layouts/welcome.mako')

