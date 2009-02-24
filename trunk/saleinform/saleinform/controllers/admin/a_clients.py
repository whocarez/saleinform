#-*-coding: utf-8-*-
import logging

from pylons import request, response, session, tmpl_context as c
from pylons.controllers.util import abort, redirect_to

from saleinform.lib.base import BaseController, render
from saleinform.lib.modules.clients import ClientsList
from saleinform.lib.modules.countries import CountriesList
from saleinform.lib.modules.regions import RegionsList, CitiesList
from pylons.decorators import validate
from saleinform.lib.validators import clients as v_clients

from webhelpers import paginate



log = logging.getLogger(__name__)

class AClientsController(BaseController):
    a_operation_status = None
    
    def index(self):
        """Рисуем список клиентов
        """
        if request.POST.get('action', None):
            if request.POST.get('action') == 'save':
                self.a_operation_status = True
                if not ClientsList().deleteClients(request.POST.getall('check_clients')): self.a_operation_status = False
                if not ClientsList().fromActive(request.POST.getall('client_rid')): self.a_operation_status = False    
                if not ClientsList().toActive(request.POST.getall('active')): self.a_operation_status = False
                if not ClientsList().fromIsloaded(request.POST.getall('client_rid')): self.a_operation_status = False    
                if not ClientsList().toIsloaded(request.POST.getall('isloaded')): self.a_operation_status = False
            if request.POST.get('action') == 'search':
                searchRule = {}
                if request.POST.get('s_name', None)!=u'': searchRule['name'] = request.POST.get('s_name')
                if request.POST.get('s_place', None)!=u'': searchRule['place'] = request.POST.get('s_place')
                session['clients_search_rule'] = searchRule
                session.save()
        sortRule = session.get('clients_sort_rule')
        cList = ClientsList()
        a_clients = cList.getList()
        c.a_sort = cList.defaultSort
        c.a_sortrule = cList.defaultSortRule
        c.a_operation_status = self.a_operation_status
        page = paginate.Page(a_clients, items_per_page=10, item_count=len(a_clients), page=request.GET.get("page", 1))
        c.a_pager = page.pager()
        c.a_clients = page.items
        c.a_template_name = 'clients_list.mako' 
        return render('/admin/layouts/clients.mako')

    @validate(schema=v_clients.ClientsForm(), form="processing")
    def processing(self, rid=None):
        """Создание или редактирование записи"""
        c.a_cities = CitiesList().getList()
        if rid: 
            c.a_client = ClientsList().getClient(rid)
            if not c.a_client: redirect_to('/admin/clients') 
            c.a_template_name = 'clients_edit.mako'
        else:
            c.a_template_name = 'clients_add.mako'            
        if request.POST.get('action', None):
            self.a_operation_status = True
            if rid:
                """Редактирование"""
                if not ClientsList().processingClients(rid): 
                    self.a_operation_status = False
            else:
                """Создание новой записи"""
                newRid = ClientsList().processingClients()
                if not newRid: 
                    self.a_operation_status = False
                else:
                    redirect_to('action/'+str(newRid))
        c.a_operation_status = self.a_operation_status
        return render('/admin/layouts/clients.mako')

    def refresh(self):
        if session.has_key('clients_search_rule'):
            del session['clients_search_rule'] 
            session.save()
        redirect_to('/admin/clients')
        
    def sort(self):
        if request.GET.get('s', None):
            if session.has_key('clients_sort_rule'):
                sortRule = session.get('clients_sort_rule')
                if sortRule.get('column', None) ==  request.GET.get('s'):
                    if sortRule.get('rule') == 'asc': sortRule['rule']='desc'
                    else: sortRule['rule']='asc'
                    session['clients_sort_rule'] = sortRule
                else:
                    session['clients_sort_rule'] = {'column':request.GET.get('s'), 'rule':'asc'}
            else: session['clients_sort_rule'] = {'column':request.GET.get('s'), 'rule':'asc'}
            session.save()
        redirect_to('/admin/clients')        