import logging

from pylons.i18n import get_lang, set_lang
from pylons import request, response, session, tmpl_context as c
from pylons.controllers.util import abort, redirect_to

 
from saleinform.lib.base import BaseController, render
import saleinform.lib.modules as S_Modules

log = logging.getLogger(__name__)

class WelcomeController(BaseController):
    
    def renderModules(self):
        S_Modules.Search().renderSearchBar()
        S_Modules.CategoriesList().getMainMenu()
        pass
        
    def index(self):
        self.renderModules()
        return render('/layouts/welcome.mako')

