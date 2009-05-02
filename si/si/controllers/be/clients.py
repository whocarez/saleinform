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
        if request.POST.get('save', None):
            #save processing
            pass
        c.subtempl = 'clients_edit'
        return render('be/layouts/clients.html')
        
    def _processingClients(self, rid=None):
        """Создание/Редактирование данных"""
        #try:
        if rid:
            client = meta.Session.query(sidb.Client).filter(sidb.Client.rid==rid).first()
        else: 
            client = sidb.Client()
        client.name = request.POST.get('name', None)
        client._cities_rid = request.params['_cities_rid']
        client.address = request.params['address']
        client.phones = request.params['phones']
        client.skype = request.params['skype']
        client.icq = request.params['icq']
        client.url = request.params['url']
        client.creadits_info = request.POST.get('creadits_info', False)
        client.delivery_info = request.params['delivery_info']
        client.worktime_info = request.params['worktime_info']
        client.descr = request.params['descr']
        client.isloaded = request.POST.get('isloaded', False)
        client.actual_days = request.params['actual_days']
        client.price_email = request.params['price_email']
        client.price_url = request.params['price_url']
        client.contact_phones = request.params['contact_phones']
        client.contact_email = request.params['contact_email']
        client.contact_person = request.params['contact_person']
        client.active = request.POST.get('active', False)
        client.popularity = request.params['popularity']
        si.meta.Session.add(client)
        si.meta.Session.commit()
        logoFile = open(os.path.join(config['pylons.paths']['static_files'], 'img', 'cllogos', 'original', str(client.rid)+'_'+request.params['logo'].filename), 'w')
        
        shutil.copyfileobj(request.params['logo'].file, logoFile)
        request.params['logo'].file.close()
        logoFile.close()
        client.logo = '/img/cllogos/'+str(client.rid)+'_'+request.params['logo'].filename
        #self.logoImageProcessing(logoFile, client.logo)
        si.meta.Session.add(client)
        si.meta.Session.commit()
        return client.rid
        #except:
        #    si.meta.Session.rollback()
        #    return False

