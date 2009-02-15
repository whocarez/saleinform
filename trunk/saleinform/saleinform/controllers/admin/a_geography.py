#-*-coding: utf-8 -*-
import logging

from pylons import request, response, session, tmpl_context as c
from pylons.controllers.util import abort, redirect_to

from saleinform.lib.base import BaseController, render
from saleinform.model import si

from formalchemy.tables import Grid

log = logging.getLogger(__name__)

class AGeographyController(BaseController):
    """Управление географическими справочниками
        Страны
        Регионы
        Города
        Валюты
    """
    def index(self):
        countries = si.meta.Session.query(si.Countries).all()
        g = Grid(si.Countries, countries)
        g.configure(exclude = [g.regions, g.currency, g.createdt], readonly=True)
        c.a_countries = g.render() 
        return render('/admin/layouts/geography.mako')
        
        
