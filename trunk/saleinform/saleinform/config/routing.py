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
    map.connect('/admin/geography', controller='admin/a_geography', action='index') # categories
    

    map.connect('/{controller}/{action}')
    map.connect('/{controller}/{action}/{id}')

    return map
