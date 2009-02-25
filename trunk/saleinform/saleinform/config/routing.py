"""Routes configuration

The more specific and detailed routes should be defined first so they
may take precedent over the more generic routes. For more information
refer to the routes manual at http://routes.groovie.org/docs/
"""
from pylons import config
from routes import Mapper

def make_map():
    """Create, configure and return the routes Mapper"""
    map = Mapper(directory=config['pylons.paths']['controllers'],
                 always_scan=config['debug'])
    map.minimization = False
    
    # The ErrorController route (handles 404/500 error pages); it should
    # likely stay at the top, ensuring it can always be resolved
    map.connect('/error/{action}', controller='error')
    map.connect('/error/{action}/{id}', controller='error')

    # CUSTOM ROUTES HERE
    map.connect('/', controller='welcome', action='index') # default controller
    
    map.connect('/stores', controller='stores', action='index') # stores
    map.connect('/stores/{letter}', controller='stores', action='index') # stores

    map.connect('/categories', controller='categories', action='index') # categories
    map.connect('/categories/details', controller='categories', action='details') # categories tree
    map.connect('/categories/{slug}', controller='categories', action='index') # category
    

    map.connect('/members', controller='members', action='index') # members
    map.connect('/members/{action}/{id}', controller='members') # members

    # ------------------------ Admin -------------------------------
    # Countries
    map.connect('/admin/countries', controller='admin/a_countries', action='index')
    map.connect('/admin/countries/action', controller='admin/a_countries', action='processing')
    map.connect('/admin/countries/action/{rid}', controller='admin/a_countries', action='processing')
    
    # Currency
    map.connect('/admin/currency', controller='admin/a_currency', action='index')
    map.connect('/admin/currency/action', controller='admin/a_currency', action='processing')
    map.connect('/admin/currency/action/{rid}', controller='admin/a_currency', action='processing')
    map.connect('/admin/currency/refresh', controller='admin/a_currency', action='refresh')

    # Regions
    map.connect('/admin/regions', controller='admin/a_regions', action='index')
    map.connect('/admin/regions/action', controller='admin/a_regions', action='processing')
    map.connect('/admin/regions/action/{rid}', controller='admin/a_regions', action='processing')
    map.connect('/admin/regions/get', controller='admin/a_regions', action='get')
    map.connect('/admin/regions/rp', controller='admin/a_regions', action='regions_processing')
    map.connect('/admin/regions/rp/{rid}', controller='admin/a_regions', action='regions_processing')
    map.connect('/admin/regions/cp', controller='admin/a_regions', action='cities_processing')
    map.connect('/admin/regions/cp/{rid}', controller='admin/a_regions', action='cities_processing')
    map.connect('/admin/regions/rr/{rid}', controller='admin/a_regions', action='rr')
    map.connect('/admin/regions/rc/{rid}', controller='admin/a_regions', action='rc')

    # Clients
    map.connect('/admin/clients', controller='admin/a_clients', action='index')
    map.connect('/admin/clients/action', controller='admin/a_clients', action='processing')
    map.connect('/admin/clients/action/{rid}', controller='admin/a_clients', action='processing')
    map.connect('/admin/clients/refresh', controller='admin/a_clients', action='refresh')
    map.connect('/admin/clients/sort', controller='admin/a_clients', action='sort')
    map.connect('/admin/clients/options/{rid}', controller='admin/a_clients', action='options')


    map.connect('/{controller}/{action}')
    map.connect('/{controller}/{action}/{id}')

    return map
