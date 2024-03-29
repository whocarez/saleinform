#-*-coding: utf-8 -*-
from si.model.meta import metadata, engine
from sqlalchemy import Table, orm, func
from sqlalchemy.sql import expression
import time 

urforms = Table('_urforms', metadata, autoload = True, autoload_with=engine)
cltypes = Table('_cltypes', metadata, autoload = True, autoload_with=engine)
clcats = Table('_clcats', metadata, autoload = True, autoload_with=engine)
clcatparents = Table('_clcatparents', metadata, autoload = True, autoload_with=engine)
categories = Table('_categories', metadata, autoload = True, autoload_with=engine)
catparents = Table('_catparents', metadata, autoload = True, autoload_with=engine)
currency = Table('_currency', metadata, autoload = True, autoload_with=engine)
countries = Table('_countries', metadata, autoload = True, autoload_with=engine)
regions = Table('_regions', metadata, autoload = True, autoload_with=engine)
cities = Table('_cities', metadata, autoload = True, autoload_with=engine)
clients = Table('_clients', metadata, autoload = True, autoload_with=engine)
users = Table('_users', metadata, autoload = True, autoload_with=engine)
clientslogos = Table('_clientslogos', metadata, autoload = True, autoload_with=engine)
clcategories = Table('_clcategories', metadata, autoload = True, autoload_with=engine)
pritems = Table('_pritems', metadata, autoload = True, autoload_with=engine)
tmppricesstorage = Table('_tmppricesstorage', metadata, autoload = True, autoload_with=engine)
tmppritems = Table('_tmppritems', metadata, autoload = True, autoload_with=engine)
tmpprices = Table('_tmpprices', metadata, autoload = True, autoload_with=engine)
tmppritemscources = Table('_tmppritemscources', metadata, autoload = True, autoload_with=engine)
tmppritemsattrs = Table('_tmppritemsattrs', metadata, autoload = True, autoload_with=engine)
tmppritemsimgs = Table('_tmppritemsimgs', metadata, autoload = True, autoload_with=engine)
prloadsorganizer = Table('_prloadsorganizer', metadata, autoload = True, autoload_with=engine)
wares = Table('_wares', metadata, autoload = True, autoload_with=engine)

class Urform(object): pass
class Cltype(object): pass
class Clcatparents(object): pass
class Category(object): pass
class Catparent(object): pass
class Currency(object): pass
class Country(object): pass
class Region(object): pass
class City(object): pass
class Pritem(object): pass
class Client(object): pass
class Clcat(object): pass
class User(object): pass
class Clientlogo(object): pass
class Clcategory(object): pass
class Tmppricesstorage(object): pass
class Tmppritem(object): pass
class Tmpprice(object): pass
class Tmppritemscource(object): pass
class Tmppritemsattr(object): pass
class Tmppritemsimg(object): pass
class Prloadsorganizer(object): pass
class Ware(object): pass

orm.mapper(Cltype, cltypes)
orm.mapper(Urform, urforms)
orm.mapper(Clcatparents, clcatparents)
orm.mapper(Catparent, catparents)
orm.mapper(Category, categories)
orm.mapper(Currency, currency)
orm.mapper(Country, countries)
orm.mapper(Region, regions)
orm.mapper(City, cities)
orm.mapper(Pritem, pritems)
orm.mapper(Client, clients, properties={'items_quan': orm.column_property(expression.select([func.count('*')], pritems.c._clients_rid==clients.c.rid).label('items_quan'))})
orm.mapper(Clcat, clcats)
orm.mapper(User, users)
orm.mapper(Clientlogo, clientslogos)
orm.mapper(Clcategory, clcategories, properties={'tmpitems_quan': orm.column_property(expression.select([func.count('*')], tmppritems.c._clcategories_rid==clcategories.c.rid).label('tmpitems_quan'))})
orm.mapper(Tmppricesstorage, tmppricesstorage,  properties={'tmpitems_quan': orm.column_property(expression.select([func.count('*')], tmppritems.c._tmppricesstorage_rid==tmppricesstorage.c.rid).label('tmpitems_quan'))})
orm.mapper(Tmppritem, tmppritems)
orm.mapper(Tmpprice, tmpprices)
orm.mapper(Tmppritemscource, tmppritemscources)
orm.mapper(Tmppritemsattr, tmppritemsattrs)
orm.mapper(Tmppritemsimg, tmppritemsimgs)
orm.mapper(Prloadsorganizer, prloadsorganizer)
orm.mapper(Ware, wares)
    