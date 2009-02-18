#-*-coding: utf-8 -*-
import logging

from pylons import request, response, session, tmpl_context as c
from pylons.controllers.util import abort, redirect_to

from saleinform.lib.base import BaseController, render
from saleinform.lib.modules.currency import CurrencyList
from saleinform.lib.modules.countries import CountriesList
from pylons.decorators import validate
from saleinform.lib.validators import currency as v_currency

log = logging.getLogger(__name__)

class ACurrencyController(BaseController):
    a_operation_status = None
    a_coperation_status = None
    """Управление валютами
    """
    def index(self):
        if request.POST.get('action', None):
            self.a_operation_status = True
            if not CurrencyList().deleteCurrency(request.POST.getall('check_currency')): self.a_operation_status = False # удалим отмеченные
        c.a_currency = CurrencyList().getList()    
        c.a_operation_status = self.a_operation_status
        c.a_template_name = 'currency_list.mako' 
        self.cources()
        return render('/admin/layouts/currency.mako')

    @validate(schema=v_currency.CurrencyForm(), form='processing')
    def processing(self, rid=None):
        """Создание или редактирование записи"""
        self.cources()
        if rid: 
            c.a_currency = CurrencyList().getCurrency(rid)
            c.a_template_name = 'currency_edit.mako'
        else:
            c.a_template_name = 'currency_add.mako'            
        if request.POST.get('action', None):
            self.a_operation_status = True
            if rid:
                """Редактирование"""
                if not CurrencyList().processingCurrency(rid): 
                    self.a_operation_status = False
            else:
                """Создание новой записи"""
                newRid = CurrencyList().processingCurrency() 
                if not newRid: 
                    self.a_operation_status = False
                else:
                    redirect_to('action/'+str(newRid))
        c.a_operation_status = self.a_operation_status
        return render('/admin/layouts/currency.mako')
    
    def cources(self):
        if request.POST.get('caction', None):
            self.a_coperation_status = True
            if not CurrencyList().updateOfficialCources(): self.a_coperation_status = False # обновление курсов валют
        c.a_countriesList = CountriesList().getList()
        c.a_currencyList = CurrencyList().getList()
        c.a_cources = CurrencyList().getOfficalCources()
        c.a_coperation_status = self.a_coperation_status
        return
        
