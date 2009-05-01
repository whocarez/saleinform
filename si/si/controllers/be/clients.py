import logging

from pylons import request, response, session, tmpl_context as c
from pylons.controllers.util import abort, redirect_to

from si.lib.base import BaseController, render
from si.model import meta, sidb

log = logging.getLogger(__name__)

class ClientsController(BaseController):

    def index(self):
        c.clients_list = meta.Session.query(sidb.Client, sidb.City, sidb.Country).\
                                           join((sidb.City, sidb.Client._cities_rid == sidb.City.rid)).\
                                           join((sidb.Region, sidb.City._regions_rid == sidb.Region.rid)).\
                                           join((sidb.Country, sidb.Region._countries_rid == sidb.Country.rid)).\
                                           all()

        c.subtempl = 'clients_list'
        return render('be/layouts/clients.html')
