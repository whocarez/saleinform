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

    # { FE
    # } FE

    # { BE
    map.connect('/be/tmpstorage', controller='be/tmpstorage')
    map.connect('/be/tmpstorage/currency/{storage}', controller='be/tmpstorage', action='currency')
    map.connect('/be/tmpstorage/remove/{storage}', controller='be/tmpstorage', action='remove')
    map.connect('/be/tmpstorage/categories/{client}', controller='be/tmpstorage', action='categories')
    
    map.connect('/be/clients', controller='be/clients')
    map.connect('/be/clients/price/{clrid}', controller='be/clients', action='price')
    map.connect('/be/clients/active/{clrid}', controller='be/clients', action='active')
    map.connect('/be/clients/edit/{clrid}', controller='be/clients', action='edit')
    map.connect('/be/clients/add', controller='be/clients', action='add')
    map.connect('/be/clients/get_regions', controller='be/clients', action='get_regions')
    map.connect('/be/clients/get_cities', controller='be/clients', action='get_cities')
    
    map.connect('/be/clients/remove/{clrid}', controller='be/clients', action='remove')
    
    map.connect('/be/clients/user/{clrid}', controller='be/clients', action='user')
    map.connect('/be/clients/gen_passwd', controller='be/clients', action='gen_passwd')
    map.connect('/be/clients/logo/{clrid}', controller='be/clients', action='logo')
    map.connect('/be/clients/clcats/{clrid}', controller='be/clients', action='clcats')
    
    map.connect('/be/clients/categories/{client}', controller='be/clients', action='categories')
    map.connect('/be/clients/currency/{storage}', controller='be/clients', action='currency')
    
    map.connect('/be/clients/removestorage/{storage}', controller='be/clients', action='removestorage')
    # } BE
    
    map.connect('/{controller}/{action}')
    map.connect('/{controller}/{action}/{id}')
    
    return map
