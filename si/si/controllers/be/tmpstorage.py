#-*-coding: utf-8 -*-
import logging

from pylons import request, response, session, tmpl_context as c
from pylons.controllers.util import abort, redirect_to
from pylons.i18n import get_lang, set_lang, _
from si.lib.base import BaseController, render
import si.lib.helpers as h

from si.model import meta, sidb 
from sqlalchemy import func, and_
from sqlalchemy.sql import expression
log = logging.getLogger(__name__)

class TmpstorageController(BaseController):

    def index(self):
        c.pquan = meta.Session.query(sidb.Tmppricesstorage).count()
        c.prices_list = meta.Session.query(sidb.Tmppricesstorage.rid, sidb.Client.name.label('client_name'), sidb.Country.name.label('country_name'),\
                                           sidb.City.name.label('city_name'), func.count(sidb.Pritem.rid).label('items_quan'),\
                                           sidb.Tmppricesstorage.tmpitems_quan, sidb.Tmppricesstorage.price_date, sidb.Client.rid.label('client_rid')).\
                                           join((sidb.Client, sidb.Tmppricesstorage._clients_rid == sidb.Client.rid)).\
                                           join((sidb.City, sidb.Client._cities_rid == sidb.City.rid)).\
                                           join((sidb.Region, sidb.City._regions_rid == sidb.Region.rid)).\
                                           join((sidb.Country, sidb.Region._countries_rid == sidb.Country.rid)).\
                                           outerjoin((sidb.Pritem, sidb.Pritem._clients_rid == sidb.Client.rid)).\
                                           group_by(sidb.Tmppricesstorage.rid).order_by(sidb.Client.name).all()
        c.subtempl = 'prices_list' 
        return render('be/layouts/tmpstorage.html')
    
    def currency(self, storage = None):
        if not storage: redirect_to('/be/tmpstorage')
        c.price = meta.Session.query(sidb.Tmppricesstorage.rid, sidb.Client.name.label('client_name'), sidb.Country.name.label('country_name'), sidb.City.name.label('city_name')).\
                                    join((sidb.Client, sidb.Tmppricesstorage._clients_rid == sidb.Client.rid)).\
                                    join((sidb.City, sidb.Client._cities_rid == sidb.City.rid)).\
                                    join((sidb.Region, sidb.City._regions_rid == sidb.Region.rid)).\
                                    join((sidb.Country, sidb.Region._countries_rid == sidb.Country.rid)).\
                                    filter(sidb.Tmppricesstorage.rid==storage).first()
        if not c.price: redirect_to('/be/tmpstorage')
        c.currency = meta.Session.query(sidb.Tmppritemscource.cource, sidb.Currency.name).\
                                    join((sidb.Currency, sidb.Tmppritemscource._currency_rid == sidb.Currency.rid)).\
                                    filter(sidb.Tmppritemscource._tmppricesstorage_rid==storage).all()
        c.subtempl = 'cources_list'
        return render('be/layouts/tmpstorage.html')
        

    def categories(self, client = None):
        if not client: redirect_to('/be/tmpstorage')
        parent = request.GET.get('parent', 0)  
        c.price = meta.Session.query(sidb.Tmppricesstorage.rid, sidb.Client.name.label('client_name'), sidb.Country.name.label('country_name'), sidb.City.name.label('city_name'), sidb.Client.rid.label('client_rid')).\
                                    join((sidb.Client, sidb.Tmppricesstorage._clients_rid == sidb.Client.rid)).\
                                    join((sidb.City, sidb.Client._cities_rid == sidb.City.rid)).\
                                    join((sidb.Region, sidb.City._regions_rid == sidb.Region.rid)).\
                                    join((sidb.Country, sidb.Region._countries_rid == sidb.Country.rid)).\
                                    filter(sidb.Tmppricesstorage._clients_rid==client).first()
        c.clcatparents = meta.Session.query(sidb.Clcatparents, sidb.Clcategory.name.label('category_name')).\
                                            join((sidb.Clcategory, and_(sidb.Clcategory.clrid==sidb.Clcatparents._parent_rid, sidb.Clcategory._clients_rid==client))).\
                                            filter(and_(sidb.Clcatparents._clients_rid == client, sidb.Clcatparents.clrid==parent)).\
                                            order_by(sidb.Clcatparents.level).all()
        sub = meta.Session.query(sidb.Clcatparents._parent_rid, func.count(sidb.Tmppritem.rid).label('tmpitems_quan1')).\
                                            join((sidb.Clcategory, and_(sidb.Clcategory.clrid==sidb.Clcatparents.clrid, sidb.Clcategory._clients_rid==client))).\
                                            outerjoin((sidb.Tmppritem, sidb.Tmppritem._clcategories_rid==sidb.Clcategory.rid)).\
                                            filter(sidb.Clcatparents._clients_rid==client).group_by(sidb.Clcatparents._parent_rid).subquery()
        c.clcategories = meta.Session.query(sidb.Clcategory, sidb.Category.name.label('category_name'), sub.c.tmpitems_quan1).\
                                            outerjoin((sub, sub.c._parent_rid==sidb.Clcategory.clrid)).\
                                            outerjoin((sidb.Category, sidb.Category.rid==sidb.Clcategory._categories_rid)).\
                                            filter(and_(sidb.Clcategory._clients_rid == client, sidb.Clcategory._clcategories_rid==parent)).\
                                            order_by(sidb.Clcategory.name).all()
        c.currentcategory = meta.Session.query(sidb.Clcategory).filter(and_(sidb.Clcategory._clients_rid == client, sidb.Clcategory.clrid==parent)).first()
        clause = ~sidb.Clcategory.clrid.in_(expression.select([sidb.Clcategory._clcategories_rid], sidb.Clcategory._clients_rid == client).group_by(sidb.Clcategory._clcategories_rid))
        leafs = meta.Session.query(sidb.Clcategory.clrid).filter(and_(sidb.Clcategory._clients_rid == client, sidb.Clcategory._clcategories_rid==parent, clause))
        c.leafs = [l.clrid for l in leafs ]
        c.subtempl = 'categories_list'
        return render('be/layouts/tmpstorage.html')
    
    def remove(self, storage=None):
        if not storage: redirect_to('/be/tmpstorage')
        meta.Session.query(sidb.Tmppricesstorage).filter(sidb.Tmppricesstorage.rid==storage).delete()
        meta.Session.commit()
        h.flash = _(u'Прайс удален из временного хранилища')
        redirect_to('/be/tmpstorage')
   