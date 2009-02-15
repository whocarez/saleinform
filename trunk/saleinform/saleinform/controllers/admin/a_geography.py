#-*-coding: utf-8 -*-
import logging
from pylons.i18n import get_lang, set_lang, _
from pylons import request, response, session, tmpl_context as c
from pylons.controllers.util import abort, redirect_to

from saleinform.lib.base import BaseController, render
from saleinform.model import si

from formalchemy.tables import Grid
from formalchemy.forms import FieldSet

log = logging.getLogger(__name__)

class AGeographyController(BaseController):
    """Управление географическими справочниками
        Страны
        Регионы
        Города
        Валюты
    """
    def index(self):
        countries = Grid(si.Countries)
        countries.configure(options=[countries.name.label(_(u'Наименование')).required(), 
                                     countries.code.label(_(u'Код')).required(),
                                     countries.archive.label(_(u'Архив')),], 
                                     exclude = [countries.createdt], readonly=False)
        record = si.meta.Session.query(si.Countries).all()
        c.a_countries = countries.bind(record, data=request.POST or None)
        if request.POST and c.a_countries.validate():
            c.a_countries.sync()
            #si.meta.Session.update(record)
            #si.meta.Session.commit()
        
        return render('/admin/layouts/geography.mako')
        
        
    def save(self, rid = None):
        countries = FieldSet(si.Countries)
        countries.configure(options=[countries.name.label(_(u'Наименование')).required(), 
                                     countries.code.label(_(u'Код')).required(),
                                     countries.archive.label(_(u'Архив')),], 
                                     exclude = [countries.createdt], readonly=False)
        record = si.meta.Session.query(si.Countries).first()
        c.a_countries = countries.bind(record, data=request.params or None)
        if request.params and c.a_countries.validate():
            c.a_countries.sync()
            si.meta.Session.update(record)
            si.meta.Session.commit()
        
        return render('/admin/layouts/geography.mako')
