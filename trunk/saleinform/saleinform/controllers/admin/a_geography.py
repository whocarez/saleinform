#-*-coding: utf-8 -*-
import logging
from pylons.i18n import get_lang, set_lang, _
from pylons import request, response, session, tmpl_context as c
from pylons.controllers.util import abort, redirect_to

from saleinform.lib.base import BaseController, render
from saleinform.model import si
from saleinform.lib.modules.countries import CountriesList

log = logging.getLogger(__name__)

class AGeographyController(BaseController):
    """Управление географическими справочниками
        Страны
        Регионы
        Города
        Валюты
    """
    def index(self):
        c.a_operation_status = None
        if request.POST.get('action', None):
            c.a_operation_status = True
            if not CountriesList().deleteCountries(request.POST.getall('check_countries')): c.a_operation_status = False # удалим отмеченные
            if not CountriesList().fromArchive(): c.a_operation_status = False # сначала все страны вынесем из архива    
            if not CountriesList().toArchive(request.POST.getall('archive')): c.a_operation_status = False # а теперь отправим в архив нужные
        c.a_countries = CountriesList().getList()            
        return render('/admin/layouts/geography.mako')
        
        
