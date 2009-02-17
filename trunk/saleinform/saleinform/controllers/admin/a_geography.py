#-*-coding: utf-8 -*-
import logging
from pylons.i18n import get_lang, set_lang, _
from pylons import request, response, session, tmpl_context as c
from pylons.controllers.util import abort, redirect_to

from saleinform.lib.base import BaseController, render
from saleinform.model import si
from saleinform.lib.modules.countries import CountriesList, CurrenciesList
from pylons.decorators import validate
from saleinform.lib.validators import countries as v_countries

log = logging.getLogger(__name__)

class AGeographyController(BaseController):
    a_operation_status = None
    """Управление географическими справочниками
        Страны
        Регионы
        Города
        Валюты
    """
    def index(self):
        if request.POST.get('action', None):
            self.a_operation_status = True
            if not CountriesList().deleteCountries(request.POST.getall('check_countries')): self.a_operation_status = False # удалим отмеченные
            if not CountriesList().fromArchive(): self.a_operation_status = False # сначала все страны вынесем из архива    
            if not CountriesList().toArchive(request.POST.getall('archive')): self.a_operation_status = False # а теперь отправим в архив нужные
        c.a_countries = CountriesList().getList()    
        c.a_operation_status = self.a_operation_status
        c.a_template_name = 'list.mako' 
        return render('/admin/layouts/geography.mako')

    @validate(schema=v_countries.CountryForm(), form='processing')
    def processing(self, rid=None):
        """Создание или редактирование записи"""
        c.a_currencies = CurrenciesList().getCurrencies()
        if rid: 
            c.a_country = CountriesList().getCountry(rid)
            c.a_template_name = 'country_edit.mako'
        else:
            c.a_template_name = 'country_add.mako'            
        if request.POST.get('action', None):
            self.a_operation_status = True
            if rid:
                """Редактирование"""
                if not CountriesList().processingCountry(rid): 
                    self.a_operation_status = False
            else:
                """Создание новой записи"""
                newRid = CountriesList().processingCountry() 
                if not newRid: 
                    self.a_operation_status = False
                else:
                    redirect_to('action/'+str(newRid))
        c.a_operation_status = self.a_operation_status
        return render('/admin/layouts/geography.mako')
        
                
