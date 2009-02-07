#-*-coding: utf-8 -*-
import logging

from pylons import request, response, session, tmpl_context as c
from pylons.controllers.util import abort, redirect_to

from saleinform.lib.base import BaseController, render
#from saleinform import model
log = logging.getLogger(__name__)
from pylons.decorators import validate
from saleinform.lib.navigator import Navigator
from saleinform.lib.validators import members

class MembersController(BaseController):
    def renderModules(self):
        pass

    def index(self):
        return render('/layouts/login.mako')

    @validate(schema=members.LoginForm(), form='index')
    def login(self):
        #TODO: доделать
        return 'login form'
    
    def register(self):
        return render('/layouts/register.mako')
        
