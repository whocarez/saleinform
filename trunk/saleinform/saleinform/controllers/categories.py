#-*-coding:utf-8-*-
import logging

from pylons import request, response, session, tmpl_context as c
from pylons.controllers.util import abort, redirect_to

from saleinform.lib.base import BaseController, render
#from saleinform import model
import saleinform.lib.modules as S_Modules

log = logging.getLogger(__name__)

class CategoriesController(BaseController):

    def index(self, slug = ''):
        c_list = S_Modules.CategoriesList()
        c_list.getTopMenu(slug)
        c_list.getAlphabetCategories()
        return render('/layouts/categories_list.mako')
    
    def details(self):
        """показать все категории в виде дерева"""
        c_list = S_Modules.CategoriesList()
        c_list.getTopMenu()
        c_list.getCategoriesTree()
        return render('/layouts/categories_tree.mako')
        
