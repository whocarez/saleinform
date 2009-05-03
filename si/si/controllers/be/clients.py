#-*- coding: utf-8 -*-
import logging

from pylons import request, response, session, tmpl_context as c
from pylons.controllers.util import abort, redirect_to

from sqlalchemy import func
from si.lib.base import BaseController, render
from si.model import meta, sidb
from pylons.decorators import validate
from si.model.forms.be import clients as v_clients, cluser as v_cluser
import string
from random import Random

from webhelpers import paginate
log = logging.getLogger(__name__)

class ClientsController(BaseController):

    def index(self):
        c.clients_quan = meta.Session.query(sidb.Client).count()
        clients_list = meta.Session.query(sidb.Client, sidb.City, sidb.Country, sidb.Clientlogo, sidb.User,
                                            sidb.Tmppricesstorage.tmpitems_quan, sidb.Tmppricesstorage.price_date).\
                                           join((sidb.City, sidb.Client._cities_rid == sidb.City.rid)).\
                                           join((sidb.Region, sidb.City._regions_rid == sidb.Region.rid)).\
                                           join((sidb.Country, sidb.Region._countries_rid == sidb.Country.rid)).\
                                           outerjoin((sidb.User, sidb.User._clients_rid == sidb.Client.rid)).\
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
        try:
            update_dict = {sidb.Client.active:False}
            if action == 'active': update_dict = {sidb.Client.active:True}
            meta.Session.query(sidb.Client).filter(sidb.Client.rid==clrid).update(update_dict) 
            meta.Session.commit()
        except:
            meta.Session.rollback()
        redirect_to('/be/clients')
        
    @validate(schema=v_clients.ClientsForm(), form="edit")
    def edit(self, clrid = None):
        if not clrid: redirect_to('/be/clients')
        c.oper_status = None
        c.client = meta.Session.query(sidb.Client, sidb.Region.rid.label('region_rid'), sidb.Country.rid.label('country_rid')).filter(sidb.Client.rid==clrid).\
                                        join((sidb.City, sidb.Client._cities_rid == sidb.City.rid)).\
                                        join((sidb.Region, sidb.City._regions_rid == sidb.Region.rid)).\
                                        join((sidb.Country, sidb.Region._countries_rid == sidb.Country.rid)).\
                                        first()
        if not c.client: redirect_to('/be/clients')
        c.urforms_list = meta.Session.query(sidb.Urform).order_by(sidb.Urform.name).all()
        c.cltypes_list = meta.Session.query(sidb.Cltype).order_by(sidb.Cltype.name).all()
        c.countries_list = meta.Session.query(sidb.Country).order_by(sidb.Country.name).all()
        c.regions_list = meta.Session.query(sidb.Region).filter(sidb.Region._countries_rid==c.client.country_rid).order_by(sidb.Region.name).all()
        c.cities_list = meta.Session.query(sidb.City).filter(sidb.City._regions_rid==c.client.region_rid).order_by(sidb.City.name).all()
        if request.POST.get('save', None):
            if self._processingClients(clrid):
                c.oper_status = True
            else:
                c.oper_status = False
        c.subtempl = 'clients_edit'
        return render('be/layouts/clients.html')

    @validate(schema=v_clients.ClientsForm(), form="add")
    def add(self):
        c.oper_status = None
        c.urforms_list = meta.Session.query(sidb.Urform).order_by(sidb.Urform.name).all()
        c.cltypes_list = meta.Session.query(sidb.Cltype).order_by(sidb.Cltype.name).all()
        c.countries_list = meta.Session.query(sidb.Country).order_by(sidb.Country.name).all()
        #c.regions_list = meta.Session.query(sidb.Region).filter(sidb.Region._countries_rid==c.client.country_rid).order_by(sidb.Region.name).all()
        #c.cities_list = meta.Session.query(sidb.City).filter(sidb.City._regions_rid==c.client.region_rid).order_by(sidb.City.name).all()
        if request.POST.get('save', None):
            new_clrid = self._processingClients() 
            if new_clrid:
                redirect_to('/be/clients/edit/%s'%new_clrid)
            else:
                c.oper_status = False
        c.subtempl = 'clients_add'
        return render('be/layouts/clients.html')

    def get_regions(self):
        country_rid = request.POST.get('_countries_rid')
        regions_list = meta.Session.query(sidb.Region).filter(sidb.Region._countries_rid==country_rid).order_by(sidb.Region.name).all()
        res = '';
        for region in regions_list:
            res += """<option value="%(region_rid)s">%(region_name)s</option>"""%{'region_rid':region.rid, 'region_name':region.name} 
        return res 
        
    def get_cities(self):
        region_rid = request.POST.get('_regions_rid')
        cities_list = meta.Session.query(sidb.City).filter(sidb.City._regions_rid==region_rid).order_by(sidb.City.name).all()
        res = '';
        for city in cities_list:
            res += """<option value="%(city_rid)s">%(city_name)s</option>"""%{'city_rid':city.rid, 'city_name':city.name} 
        return res 
    
    def remove(self, clrid=None):
        if not clrid: redirect_to('/be/clients')
        meta.Session.query(sidb.Client).filter(sidb.Client.rid==clrid).delete()
        meta.Session.commit()
        redirect_to('/be/clients')
    
    def _processingClients(self, rid=None):
        try:
            if rid:
                client = meta.Session.query(sidb.Client).filter(sidb.Client.rid==rid).first()
            else: 
                client = sidb.Client()
            client.name = request.POST.get('name', None)
            client._urforms_rid = request.POST.get('_urforms_rid', None)
            client._cltypes_rid = request.POST.get('_cltypes_rid', None)
            client._cities_rid = request.POST.get('_cities_rid', None)
            client.zip = request.POST.get('zip', None)
            client.street = request.POST.get('street', None)
            client.build = request.POST.get('build', None)
            client.wphones = request.POST.get('wphones', None)
            client.skype = request.POST.get('skype', None)
            client.icq = request.POST.get('icq', None)
            client.url = request.POST.get('url', None)
            client.creadits_info = request.POST.get('creadits_info', False)
            client.delivery_info = request.POST.get('delivery_info', None)
            client.worktime_info = request.POST.get('worktime_info', None)
            client.descr = request.POST.get('descr', None)
            client.pr_load = request.POST.get('pr_load', False)
            client.pr_actual_days = request.POST.get('pr_actual_days', 14)
            client.pr_url = request.POST.get('pr_url', None)
            client.contact_phones = request.POST.get('contact_phones', None)
            client.contact_email = request.POST.get('contact_email', None)
            client.contact_person = request.POST.get('contact_person', None)
            client.active = request.POST.get('active', False)
            client.popularity = request.POST.get('popularity', 0)
            meta.Session.add(client)
            meta.Session.commit()
            return client.rid
        except:
            meta.Session.rollback()
            return False
        
    @validate(schema=v_cluser.CluserForm(), form='user')
    def user(self, clrid=None):
        if not clrid: redirect_to('/be/clients')
        c.oper_status = None
        c.client = meta.Session.query(sidb.Client).filter(sidb.Client.rid==clrid).first()
        c.cluser = meta.Session.query(sidb.User).filter(sidb.User._clients_rid == clrid).first()
        if request.POST.get('save', None):
            if not c.cluser:
                c.cluser = sidb.User()
                c.cluser._clients_rid = c.client.rid
            try:
                c.cluser.login = request.POST.get('login', False)
                c.cluser.passwd = request.POST.get('passwd', False)
                meta.Session.add(c.cluser)
                meta.Session.commit()
                c.oper_status = True
            except:
                meta.Session.rollback()
                c.oper_status = False
        c.subtempl = 'cluser_form'
        return render('be/layouts/clients.html')
        
    def gen_passwd(self):
        newpasswd = ''.join(Random().sample(string.letters+string.digits, 6))
        return newpasswd
        
