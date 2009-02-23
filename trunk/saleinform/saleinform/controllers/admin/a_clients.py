#-*-coding: utf-8-*-
import logging

from pylons import request, response, session, tmpl_context as c
from pylons.controllers.util import abort, redirect_to

from saleinform.lib.base import BaseController, render
from saleinform.lib.modules.clients import ClientsList

from webhelpers import paginate



log = logging.getLogger(__name__)

class AClientsController(BaseController):
    a_operation_status = None
    
    def index(self):
        """Рисуем список клиентов
        """
        if request.POST.get('action', None):
            self.a_operation_status = True
            if not ClientsList().deleteClients(request.POST.getall('check_clients')): self.a_operation_status = False
            if not ClientsList().fromArchive(): self.a_operation_status = False    
            if not ClientsList().toArchive(request.POST.getall('archive')): self.a_operation_status = False
        
        a_clients = ClientsList().getList()
        c.a_operation_status = self.a_operation_status
        page = paginate.Page(a_clients, format="~10~", items_per_page=10, item_count=len(a_clients), page=request.GET.get("page", 1))
        c.a_pager = page.pager()
        c.a_clients = page.items
        c.a_template_name = 'clients_list.mako' 
        return render('/admin/layouts/clients.mako')

    def processing(self, rid=None):
        """Создание или редактирование записи"""
        c.a_currencies = CurrencyList().getList()
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
        return render('/admin/layouts/countries.mako')
