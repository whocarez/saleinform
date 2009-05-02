import logging

from pylons import request, response, session, tmpl_context as c
from pylons.controllers.util import abort, redirect_to

from sqlalchemy import func
from si.lib.base import BaseController, render
from si.model import meta, sidb

from webhelpers import paginate
log = logging.getLogger(__name__)

class ClientsController(BaseController):

    def index(self):
        c.clients_quan = meta.Session.query(sidb.Client).count()
        clients_list = meta.Session.query(sidb.Client, sidb.City, sidb.Country, sidb.Clientlogo,
                                            sidb.Tmppricesstorage.tmpitems_quan, sidb.Tmppricesstorage.price_date).\
                                           join((sidb.City, sidb.Client._cities_rid == sidb.City.rid)).\
                                           join((sidb.Region, sidb.City._regions_rid == sidb.Region.rid)).\
                                           join((sidb.Country, sidb.Region._countries_rid == sidb.Country.rid)).\
                                           outerjoin((sidb.Clientlogo, sidb.Clientlogo._clients_rid == sidb.Client.rid)).\
                                           outerjoin((sidb.Tmppricesstorage, sidb.Tmppricesstorage._clients_rid == sidb.Client.rid)).\
                                           group_by(sidb.Client.rid).\
                                           order_by(sidb.Client.name)
        page = paginate.Page(clients_list, items_per_page=20, page=request.GET.get("page", 1))
        c.pager = page.pager()
        c.clients_list = page.items
        c.subtempl = 'clients_list'
        return render('be/layouts/clients.html')
    
    def price(self, clrid = None):
        if not clrid: redirect_to('/be/clients')
        action = request.GET.get("action", 1)
        if not action: redirect_to('/be/clients')
        print "*********************************"
        try:
            update_dict = {sidb.Client.pr_load:False}
            if action == 'active': update_dict = {sidb.Client.pr_load:True}
            meta.Session.query(sidb.Client).filter(sidb.Client.rid==clrid).update(update_dict) 
            meta.Session.commit()
        except:
            meta.Session.rollback()
        redirect_to('/be/clients')

    def active(self, clrid = None):
        if not clrid: redirect_to('/be/clients')
        action = request.GET.get("action", 1)
        if not action: redirect_to('/be/clients')
        print "*********************************"
        try:
            update_dict = {sidb.Client.active:False}
            if action == 'active': update_dict = {sidb.Client.active:True}
            meta.Session.query(sidb.Client).filter(sidb.Client.rid==clrid).update(update_dict) 
            meta.Session.commit()
        except:
            meta.Session.rollback()
        redirect_to('/be/clients')
        
    def edit(self, clrid = None):
        if not clrid: redirect_to('/be/clients')
        c.client = meta.Session.query(sidb.Client).filter(sidb.Client.rid==clrid).first()
        if not c.client: redirect_to('/be/clients')
        c.subtempl = 'clients_edit'
        return render('be/layouts/clients.html')
        
