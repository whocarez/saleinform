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
        a_clients = ClientsList().getList()
        c.a_operation_status = self.a_operation_status
        page = paginate.Page(a_clients, format="~10~", items_per_page=10, item_count=len(a_clients), page=request.GET.get("page", 1))
        c.a_pager = page.pager()
        c.a_clients = page.items
        c.a_template_name = 'clients_list.mako' 
        return render('/admin/layouts/clients.mako')
