#-*-coding: utf-8 -*-
import sqlalchemy as sa
from sqlalchemy import orm
from sqlalchemy import schema
from saleinform.model import meta
from sqlalchemy.sql import func


# сессии
_sessions = sa.Table('_sessions', meta.metadata,
                         sa.Column(u'id', sa.types.Integer(), autoincrement=True, primary_key=True, nullable=False),
                         sa.Column(u'namespace', sa.types.String(length=255), primary_key=False),
                         sa.Column(u'accessed', sa.types.TIMESTAMP(timezone=False), primary_key=False, nullable=False),
                         sa.Column(u'created', sa.types.TIMESTAMP(timezone=False), primary_key=False, nullable=False),
                         sa.Column(u'data',  sa.types.Binary(length=None), primary_key=False),) 

# cистемные переменные
_options =  sa.Table('_options', meta.metadata,
                     sa.Column(u'rid', sa.types.Integer(),  autoincrement=True, primary_key=True, nullable=False),
                     sa.Column(u'name', sa.types.String(length=45), primary_key=False, nullable=False),
                     sa.Column(u'value', sa.types.String(length=2048), primary_key=False, nullable=False),
                     sa.Column(u'cod', sa.types.String(length=5), primary_key=False, nullable=False),
                     sa.Column(u'archive', sa.types.Boolean(), primary_key=False, nullable=False),)
sa.Index(u'_secondary46', _options.c.name, unique=True)

# пользователи портала
_members =  sa.Table('_members', meta.metadata,
                  sa.Column(u'rid', sa.types.Integer(),  autoincrement=True, primary_key=True, nullable=False),
                  sa.Column(u'email', sa.types.String(length=255), primary_key=False, nullable=False),
                  sa.Column(u'login', sa.types.String(length=255), primary_key=False, nullable=False),
                  sa.Column(u'password', sa.types.String(length=255), primary_key=False, nullable=False),
                  sa.Column(u'acode', sa.types.String(length=255), primary_key=False, nullable=False),
                  sa.Column(u'gender', sa.types.String(length=1), primary_key=False, nullable=False),
                  sa.Column(u'role', sa.types.Integer(), primary_key=False, nullable=False, default=3), #1 - Admin, 2 - Moderator, 3 - User
                  sa.Column(u'popularity', sa.types.Integer(), primary_key=False, nullable=False, default=0),
                  sa.Column(u'active', sa.types.Boolean(), primary_key=False),
                  sa.Column(u'createdt', sa.types.TIMESTAMP(timezone=False), primary_key=False, nullable=False, default=func.now()),)
sa.Index(u'secondary15', _members.c.login, unique=False)


# доступность
_availabletypes =  sa.Table('_availabletypes', meta.metadata,
                         sa.Column(u'rid', sa.types.Integer(), autoincrement=True, primary_key=True, nullable=False),
                         sa.Column(u'cod', sa.types.String(length=45), primary_key=False),
                         sa.Column(u'name', sa.types.String(length=255), primary_key=False),
                         sa.Column(u'archive', sa.types.Boolean(), primary_key=False, nullable=False),
                         sa.Column(u'descr', sa.types.Text(length=None), primary_key=False),)
sa.Index(u'_secondary1', _availabletypes.c.cod, unique=True)
sa.Index(u'_thierd1', _availabletypes.c.name, unique=True)

# категории  
_categories =  sa.Table('_categories', meta.metadata,
                     sa.Column(u'rid', sa.types.Integer(),  autoincrement=True, primary_key=True, nullable=False),
                     sa.Column(u'name', sa.types.String(length=45), primary_key=False, nullable=False),
                     sa.Column(u'popularity', sa.types.Integer(), primary_key=False, default=0),
                     sa.Column(u'slug', sa.types.String(length=64), primary_key=False, nullable=False),
                     sa.Column(u'keywords', sa.types.String(length=255), primary_key=False, nullable=True),
                     sa.Column(u'meta_title', sa.types.String(length=255), primary_key=False, nullable=True),
                     sa.Column(u'meta_description', sa.types.String(length=255), primary_key=False, nullable=True),
                     sa.Column(u'archive', sa.types.Boolean(), primary_key=False, nullable=False),
                     sa.Column(u'descr', sa.types.String(length=512), primary_key=False),
                     sa.Column(u'isgrouped', sa.types.Boolean(), primary_key=False),
                     sa.Column(u'iscompared', sa.types.Boolean(), primary_key=False),)
sa.Index(u'_secondary2', _categories.c.slug, unique=False)

# структура категорий  
_catparents =  sa.Table('_catparents', meta.metadata,
                     sa.Column(u'rid', sa.types.Integer(),  autoincrement=True, primary_key=True, nullable=False),
                     sa.Column(u'_categories_rid', sa.types.Integer(), primary_key=False, nullable=False),
                     sa.Column(u'_parent_rid', sa.types.Integer(), primary_key=False, nullable=False),
                     sa.Column(u'level', sa.types.Integer(), primary_key=False, nullable=False),
                     sa.ForeignKeyConstraint([u'_categories_rid'], [u'_categories.rid'], name=u'FK__catparents1', onupdate="CASCADE", ondelete="CASCADE"),
                     sa.ForeignKeyConstraint([u'_parent_rid'], [u'_categories.rid'], name=u'FK__catparents2', onupdate="CASCADE", ondelete="CASCADE"),)
sa.Index(u'_secondary2_1', _catparents.c._categories_rid, _catparents.c._parent_rid, unique=True)
sa.Index(u'_categories_rid2_1', _catparents.c._categories_rid, unique=False)
sa.Index(u'_parent_rid2_1', _catparents.c._parent_rid, unique=False)

# изображение категорий
_categoriesimages =  sa.Table('_categoriesimages', meta.metadata,
                           sa.Column(u'rid', sa.types.Integer(),  autoincrement=True, primary_key=True, nullable=False),
                           sa.Column(u'_categories_rid', sa.types.Integer(), primary_key=False, nullable=False),
                           sa.Column(u'name', sa.types.String(length=45), primary_key=False),
                           sa.Column(u'type', sa.types.String(length=45), primary_key=False),
                           sa.Column(u'size', sa.types.String(length=45), primary_key=False),
                           sa.Column(u'image', sa.types.Binary(length=None), primary_key=False),
                           sa.Column(u'archive', sa.types.Boolean(), primary_key=False),
                           sa.Column(u'descr', sa.types.Text(length=None), primary_key=False),
                           sa.Column(u'imgtype', sa.types.String(length=45), primary_key=False),
                           sa.ForeignKeyConstraint([u'_categories_rid'], [u'_categories.rid'], name=u'FK__categoriesimages', onupdate="CASCADE", ondelete="CASCADE"),
    )
sa.Index(u'FK__categoriesimages3', _categoriesimages.c._categories_rid, unique=False)

# города
_cities =  sa.Table('_cities', meta.metadata,
                 sa.Column(u'rid', sa.types.Integer(),  autoincrement=True, primary_key=True, nullable=False),
                 sa.Column(u'_regions_rid', sa.types.Integer(), schema.ForeignKey(u'_regions.rid', onupdate='cascade', ondelete="CASCADE"), primary_key=False, nullable=False),
                 sa.Column(u'name', sa.types.String(length=45), primary_key=False, nullable=False),
                 sa.Column(u'archive', sa.types.Boolean(), primary_key=False, nullable=False),
                 sa.ForeignKeyConstraint([u'_regions_rid'], [u'_regions.rid'], name=u'FK__cities_1', onupdate="CASCADE", ondelete="CASCADE"),)
sa.Index(u'_secondary4', _cities.c._regions_rid, _cities.c.name, unique=True)

# валюты
_currency =  sa.Table('_currency', meta.metadata,
                   sa.Column(u'rid', sa.types.Integer(),  autoincrement=True, primary_key=True, nullable=False),
                   sa.Column(u'code', sa.types.String(length=45), primary_key=False, nullable=False),
                   sa.Column(u'name', sa.types.String(length=45), primary_key=False, nullable=False),
                   sa.Column(u'endword', sa.types.String(length=45), primary_key=False),)
sa.Index(u'_secondary11', _currency.c.code, unique=True)
sa.Index(u'_thierd11', _currency.c.name, unique=True)

# страны
_countries =  sa.Table('_countries', meta.metadata,
                    sa.Column(u'rid', sa.types.Integer(),  autoincrement=True, primary_key=True, nullable=False),
                    sa.Column(u'_currency_rid', sa.types.Integer(), schema.ForeignKey(u'_currency.rid', onupdate="CASCADE", ondelete="CASCADE"), nullable=False),
                    sa.Column(u'image_name', sa.types.String(length=45), primary_key=False, nullable=True),
                    sa.Column(u'code', sa.types.String(length=45), primary_key=False, nullable=False),
                    sa.Column(u'name', sa.types.String(length=45), primary_key=False, nullable=False),
                    sa.Column(u'archive', sa.types.Boolean(), primary_key=False, nullable=False, default=False),
                    sa.Column(u'createdt', sa.types.TIMESTAMP(timezone=False), primary_key=False, nullable=False, default=func.now()),
                    sa.ForeignKeyConstraint([u'_currency_rid'], [u'_currency.rid'], name=u'FK__countries_1', onupdate="CASCADE", ondelete="CASCADE"),)
sa.Index(u'_secondary9', _countries.c.code, unique=True)
sa.Index(u'_thierd9', _countries.c.name, unique=True)
sa.Index(u'_currency_rid9', _countries.c._currency_rid, unique=False)

# регионы
_regions =  sa.Table('_regions', meta.metadata,
                  sa.Column(u'rid', sa.types.Integer(),  autoincrement=True, primary_key=True, nullable=False),
                  sa.Column(u'_countries_rid', sa.types.Integer(), schema.ForeignKey('_countries.rid', onupdate="CASCADE", ondelete="CASCADE"), primary_key=False, nullable=False),
                  sa.Column(u'name', sa.types.String(length=45), primary_key=False, nullable=False),
                  sa.Column(u'archive', sa.types.Boolean(), primary_key=False, nullable=False),
                  sa.Column(u'display_name', sa.types.String(length=45), primary_key=False, nullable=False),
                  sa.ForeignKeyConstraint([u'_countries_rid'], [u'_countries.rid'], name=u'FK__regions_1', onupdate="CASCADE", ondelete="CASCADE"),)
sa.Index(u'_secondary29', _regions.c._countries_rid, _regions.c.name, unique=True)

# категории клиента
"""указывают категории, в которых работают магазины"""
_clcategories =  sa.Table('_clcategories', meta.metadata,
                       sa.Column(u'rid', sa.types.Integer(),  autoincrement=True, primary_key=True, nullable=False),
                       sa.Column(u'_categories_rid', sa.types.Integer(), primary_key=False),
                       sa.Column(u'_clients_rid', sa.types.Integer(), primary_key=False, nullable=False),
                       sa.ForeignKeyConstraint([u'_clients_rid'], [u'_clients.rid'], name=u'FK__clcategories1', onupdate="CASCADE", ondelete="CASCADE"),
                       sa.ForeignKeyConstraint([u'_categories_rid'], [u'_categories.rid'], name=u'FK__clcategories2', onupdate="CASCADE", ondelete="CASCADE"),)
sa.Index(u'_categories_rid5', _clcategories.c._categories_rid, unique=False)
sa.Index(u'FK__clcategories5', _clcategories.c._clients_rid, unique=False)

# клиенты
_clients =  sa.Table('_clients', meta.metadata,
                  sa.Column(u'rid', sa.types.Integer(),  autoincrement=True, primary_key=True, nullable=False),
                  sa.Column(u'_cities_rid', sa.types.Integer(), primary_key=False, nullable=False),
                  sa.Column(u'name', sa.types.String(length=255), primary_key=False, nullable=False),
                  sa.Column(u'logo', sa.types.String(length=255), primary_key=False),
                  sa.Column(u'address', sa.types.String(length=255), primary_key=False, nullable=False),
                  sa.Column(u'phones', sa.types.String(length=255), primary_key=False, nullable=False),
                  sa.Column(u'skype', sa.types.String(length=255), primary_key=False),
                  sa.Column(u'icq', sa.types.String(length=255), primary_key=False),
                  sa.Column(u'url', sa.types.String(length=255), primary_key=False, nullable=False),
                  sa.Column(u'isloaded', sa.types.Boolean(), primary_key=False, nullable=False),
                  sa.Column(u'actual_days', sa.types.Integer(), primary_key=False),
                  sa.Column(u'price_email', sa.types.String(length=255), primary_key=False),
                  sa.Column(u'price_url', sa.types.String(length=255), primary_key=False),
                  sa.Column(u'creadits_info', sa.types.Boolean(), primary_key=False, nullable=False),
                  sa.Column(u'delivery_info', sa.types.String(length=512), primary_key=False, nullable=False),
                  sa.Column(u'worktime_info', sa.types.String(length=512), primary_key=False, nullable=False),
                  sa.Column(u'descr', sa.types.String(length=512), primary_key=False, nullable=False),
                  sa.Column(u'contact_phones', sa.types.String(length=255), primary_key=False),
                  sa.Column(u'contact_email', sa.types.String(length=255), primary_key=False),
                  sa.Column(u'contact_person', sa.types.String(length=255), primary_key=False),
                  sa.Column(u'createdt', sa.types.TIMESTAMP(timezone=False), primary_key=False, nullable=False),
                  sa.Column(u'active', sa.types.Boolean(), primary_key=False),
                  sa.Column(u'popularity', sa.types.Integer(), primary_key=False),
                  sa.ForeignKeyConstraint([u'_cities_rid'], [u'_cities.rid'], name=u'FK__clients_1', onupdate="CASCADE", ondelete="CASCADE"),)
sa.Index(u'_secondary6', _clients.c._cities_rid, _clients.c.name, unique=True)
sa.Index(u'FK__cities6', _clients.c._cities_rid, unique=False)

# отзывы на клиентов
_cluopinions =  sa.Table('_cluopinions', meta.metadata,
                      sa.Column(u'rid', sa.types.Integer(),  autoincrement=True, primary_key=True, nullable=False),
                      sa.Column(u'_clients_rid', sa.types.Integer(), primary_key=False, nullable=False),
                      sa.Column(u'opinion', sa.types.String(length=512), primary_key=False, nullable=False),
                      sa.Column(u'_members_rid', sa.types.Integer(), primary_key=False, nullable=False),
                      sa.Column(u'createdt', sa.types.TIMESTAMP(timezone=False), primary_key=False, nullable=False),
                      sa.Column(u'mark', sa.types.Integer(), primary_key=False, nullable=False),
                      sa.ForeignKeyConstraint([u'_clients_rid'], [u'_clients.rid'], name=u'FK__cluopinions_1', onupdate="CASCADE", ondelete="CASCADE"),
                      sa.ForeignKeyConstraint([u'_members_rid'], [u'_members.rid'], name=u'FK__cluopinions_2', onupdate="CASCADE", ondelete="CASCADE"), )
sa.Index(u'_clients_rid8', _cluopinions.c._clients_rid, unique=False)
sa.Index(u'FK__cluopinions_8', _cluopinions.c._members_rid, unique=False)

# оффициальные курсы валют
_officialcources =  sa.Table('_officialcources', meta.metadata,
                          sa.Column(u'rid', sa.types.Integer(),  autoincrement=True, primary_key=True, nullable=False),
                          sa.Column(u'_currency_rid', sa.types.Integer(), primary_key=False, nullable=False),
                          sa.Column(u'_countries_rid', sa.types.Integer(), primary_key=False, nullable=False),
                          sa.Column(u'cource', sa.types.Float(precision=None, asdecimal=False), primary_key=False, nullable=True, default=0),
                          sa.Column(u'createdt', sa.types.TIMESTAMP(timezone=False), primary_key=False, nullable=False, default=func.now()),
                          sa.ForeignKeyConstraint([u'_currency_rid'], [u'_currency.rid'], name=u'FK__officialcources_1', onupdate="CASCADE", ondelete="CASCADE"),
                          sa.ForeignKeyConstraint([u'_countries_rid'], [u'_countries.rid'], name=u'FK__officialcources_2', onupdate="CASCADE", ondelete="CASCADE"),)
sa.Index(u'_countries_rid18', _officialcources.c._countries_rid, unique=False)

_currcources =  sa.Table('_currcources', meta.metadata,
                      sa.Column(u'rid', sa.types.Integer(),  autoincrement=True, primary_key=True, nullable=False),
                      sa.Column(u'_clients_rid', sa.types.Integer(), primary_key=False, nullable=False),
                      sa.Column(u'_currency_rid', sa.types.Integer(), primary_key=False, nullable=False),
                      sa.Column(u'cource', sa.types.Float(precision=None, asdecimal=False), primary_key=False, nullable=False),
                      sa.Column(u'courcedate', sa.types.DateTime(timezone=False), primary_key=False, nullable=False),
                      sa.Column(u'archive', sa.types.Boolean(), primary_key=False, nullable=False),
                      sa.Column(u'descr', sa.types.Text(length=None), primary_key=False),
                      sa.Column(u'createdt', sa.types.TIMESTAMP(timezone=False), primary_key=False, nullable=False),
                      sa.ForeignKeyConstraint([u'_clients_rid'], [u'_clients.rid'], name=u'FK__currcources_1', onupdate="CASCADE", ondelete="CASCADE"),
                      sa.ForeignKeyConstraint([u'_currency_rid'], [u'_currency.rid'], name=u'FK__currcources_2', onupdate="CASCADE", ondelete="CASCADE"),)
sa.Index(u'_secondary10', _currcources.c._currency_rid, _currcources.c._clients_rid, _currcources.c.courcedate, unique=True)
sa.Index(u'_clients_rid10', _currcources.c._clients_rid, unique=False)


_findqueries =  sa.Table('_findqueries', meta.metadata,
                      sa.Column(u'rid', sa.types.Integer(),  autoincrement=True, primary_key=True, nullable=False),
                      sa.Column(u'query', sa.types.String(length=255), primary_key=False, nullable=False),
                      sa.Column(u'resquan', sa.types.Integer(), primary_key=False, nullable=False),
                      sa.Column(u'archive', sa.types.Boolean(), primary_key=False, nullable=False),
                      sa.Column(u'descr', sa.types.Text(length=None), primary_key=False),
                      sa.Column(u'createdt', sa.types.TIMESTAMP(timezone=False), primary_key=False, nullable=False),
                      sa.Column(u'_categories_rid', sa.types.Integer(), primary_key=False),
                      sa.ForeignKeyConstraint([u'_categories_rid'], [u'_categories.rid'], name=u'FK__findqueries', onupdate="CASCADE", ondelete="CASCADE"),)
sa.Index(u'FK__findqueries12', _findqueries.c._categories_rid, unique=False)


_geoipcountries =  sa.Table('_geoipcountries', meta.metadata,
                         sa.Column(u'rid', sa.types.Integer(),  autoincrement=True, primary_key=True, nullable=False),
                         sa.Column(u'begin_ip', sa.types.String(length=15), primary_key=False, nullable=False),
                         sa.Column(u'end_ip', sa.types.String(length=15), primary_key=False, nullable=False),
                         sa.Column(u'begin_num', sa.types.Integer(), primary_key=False, nullable=False),
                         sa.Column(u'end_num', sa.types.Integer(), primary_key=False, nullable=False),
                         sa.Column(u'country_cod', sa.types.String(length=2), primary_key=False, nullable=False),
                         sa.Column(u'country_name', sa.types.String(length=45), primary_key=False, nullable=False),)


_guides =  sa.Table('_guides', meta.metadata,
                sa.Column(u'rid', sa.types.Integer(),  autoincrement=True, primary_key=True, nullable=False),
                sa.Column(u'title', sa.types.String(length=256), primary_key=False, nullable=False),
                sa.Column(u'content', sa.types.Text(length=None), primary_key=False, nullable=False),
                sa.Column(u'archive', sa.types.Boolean(), primary_key=False, nullable=False),
                sa.Column(u'descr', sa.types.Text(length=None), primary_key=False),
                sa.Column(u'createdt', sa.types.TIMESTAMP(timezone=False), primary_key=False, nullable=False),
                sa.Column(u'_categories_rid', sa.types.Integer(), primary_key=False, nullable=False),
                sa.ForeignKeyConstraint([u'_categories_rid'], [u'_categories.rid'], name=u'FK__guides', onupdate="CASCADE", ondelete="CASCADE"),)
sa.Index(u'FK__advertises13', _guides.c._categories_rid, unique=False)



_guidesimages =  sa.Table('_guidesimages', meta.metadata,
                       sa.Column(u'rid', sa.types.Integer(),  autoincrement=True, primary_key=True, nullable=False),
                       sa.Column(u'_guides_rid', sa.types.Integer(), primary_key=False, nullable=False),
                       sa.Column(u'name', sa.types.String(length=45), primary_key=False),
                       sa.Column(u'type', sa.types.String(length=45), primary_key=False),
                       sa.Column(u'size', sa.types.String(length=45), primary_key=False),
                       sa.Column(u'image', sa.types.Binary(length=None), primary_key=False),
                       sa.Column(u'archive', sa.types.Boolean(), primary_key=False),
                       sa.Column(u'descr', sa.types.Text(length=None), primary_key=False),
                       sa.Column(u'createdt', sa.types.TIMESTAMP(timezone=False), primary_key=False),
                       sa.ForeignKeyConstraint([u'_guides_rid'], [u'_guides.rid'], name=u'FK__guidesimages', onupdate="CASCADE", ondelete="CASCADE"),)
sa.Index(u'FK__categoriesimages14', _guidesimages.c._guides_rid, unique=False)


_links =  sa.Table('_links', meta.metadata,
                sa.Column(u'rid', sa.types.Integer(),  autoincrement=True, primary_key=True, nullable=False),
                sa.Column(u'linktext', sa.types.String(length=255), primary_key=False, nullable=False),
                sa.Column(u'link', sa.types.String(length=255), primary_key=False, nullable=False),
                sa.Column(u'archive', sa.types.Boolean(), primary_key=False, nullable=False),
                sa.Column(u'descr', sa.types.Text(length=None), primary_key=False),
                sa.Column(u'createdt', sa.types.TIMESTAMP(timezone=False), primary_key=False, nullable=False),)


_linkstocategories =  sa.Table('_linkstocategories', meta.metadata,
                            sa.Column(u'rid', sa.types.Integer(),  autoincrement=True, primary_key=True, nullable=False),
                            sa.Column(u'_categories_rid', sa.types.Integer(), primary_key=False, nullable=False),
                            sa.Column(u'_links_rid', sa.types.Integer(), primary_key=False, nullable=False),
                            sa.Column(u'archive', sa.types.Boolean(), primary_key=False, nullable=False),
                            sa.Column(u'descr', sa.types.Text(length=None), primary_key=False),
                            sa.Column(u'createdt', sa.types.TIMESTAMP(timezone=False), primary_key=False, nullable=False),)


_news =  sa.Table('_news', meta.metadata,
               sa.Column(u'rid', sa.types.Integer(),  autoincrement=True, primary_key=True, nullable=False),
               sa.Column(u'title', sa.types.String(length=255), primary_key=False, nullable=False),
               sa.Column(u'new', sa.types.Text(length=None), primary_key=False, nullable=False),
               sa.Column(u'newdate', sa.types.DateTime(timezone=False), primary_key=False, nullable=False),
               sa.Column(u'archive', sa.types.Boolean(), primary_key=False, nullable=False),
               sa.Column(u'descr', sa.types.Text(length=None), primary_key=False),
               sa.Column(u'createdt', sa.types.TIMESTAMP(timezone=False), primary_key=False, nullable=False),
               sa.Column(u'_newscategories_rid', sa.types.Integer(), primary_key=False, nullable=False),
               sa.Column(u'image', sa.types.Binary(length=None), primary_key=False),
               sa.Column(u'name', sa.types.String(length=45), primary_key=False),
               sa.Column(u'type', sa.types.String(length=45), primary_key=False),
               sa.Column(u'size', sa.types.String(length=45), primary_key=False),
               sa.Column(u'author', sa.types.String(length=255), primary_key=False, nullable=False),
               sa.Column(u'source_name', sa.types.String(length=255), primary_key=False),
               sa.Column(u'source_link', sa.types.String(length=255), primary_key=False),
               sa.ForeignKeyConstraint([u'_newscategories_rid'], [u'_newscategories.rid'], name=u'FK__news', onupdate="CASCADE", ondelete="CASCADE"),)
sa.Index(u'FK__news16', _news.c._newscategories_rid, unique=False)



_newscategories =  sa.Table('_newscategories', meta.metadata,
                         sa.Column(u'rid', sa.types.Integer(),  autoincrement=True, primary_key=True, nullable=False),
                         sa.Column(u'_newscategories_rid', sa.types.Integer(), primary_key=False, nullable=False),
                         sa.Column(u'name', sa.types.String(length=45), primary_key=False, nullable=False),
                         sa.Column(u'image', sa.types.Binary(length=None), primary_key=False),
                         sa.Column(u'archive', sa.types.Boolean(), primary_key=False, nullable=False),
                         sa.Column(u'descr', sa.types.Text(length=None), primary_key=False),
                         sa.Column(u'createdt', sa.types.TIMESTAMP(timezone=False), primary_key=False, nullable=False),)
sa.Index(u'_secondary17', _newscategories.c.name, _newscategories.c._newscategories_rid, unique=True)
sa.Index(u'_categories_rid17', _newscategories.c._newscategories_rid, unique=False)



_pars =  sa.Table('_pars', meta.metadata,
               sa.Column(u'rid', sa.types.Integer(),  autoincrement=True, primary_key=True, nullable=False),
               sa.Column(u'name', sa.types.String(length=255), primary_key=False, nullable=False),
               sa.Column(u'tag', sa.types.String(length=45), primary_key=False),
               sa.Column(u'archive', sa.types.Boolean(), primary_key=False, nullable=False),
               sa.Column(u'descr', sa.types.Text(length=None), primary_key=False),
               sa.Column(u'createdt', sa.types.TIMESTAMP(timezone=False), primary_key=False, nullable=False),)
sa.Index(u'_secondary19', _pars.c.name, unique=True)
sa.Index(u'tag19', _pars.c.tag, unique=True)

_parsvalues =  sa.Table('_parsvalues', meta.metadata,
                     sa.Column(u'rid', sa.types.Integer(),  autoincrement=True, primary_key=True, nullable=False),
                     sa.Column(u'_pars_rid', sa.types.Integer(), primary_key=False, nullable=False),
                     sa.Column(u'value', sa.types.String(length=255), primary_key=False, nullable=False),
                     sa.Column(u'archive', sa.types.Boolean(), primary_key=False, nullable=False),
                     sa.Column(u'descr', sa.types.Text(length=None), primary_key=False),
                     sa.Column(u'createdt', sa.types.TIMESTAMP(timezone=False), primary_key=False, nullable=False),
                     sa.ForeignKeyConstraint([u'_pars_rid'], [u'_pars.rid'], name=u'FK__parsvalues', onupdate="CASCADE", ondelete="CASCADE"),)
sa.Index(u'_secondary20', _parsvalues.c._pars_rid, _parsvalues.c.value, unique=True)


_popularcategories =  sa.Table('_popularcategories', meta.metadata,
                            sa.Column(u'rid', sa.types.Integer(),  autoincrement=True, primary_key=True, nullable=False),
                            sa.Column(u'_categories_rid', sa.types.Integer(), primary_key=False, nullable=False),
                            sa.Column(u'archive', sa.types.Boolean(), primary_key=False),
                            sa.Column(u'createdt', sa.types.TIMESTAMP(timezone=False), primary_key=False),
                            sa.Column(u'sessionID', sa.types.String(length=112), primary_key=False, nullable=False),
                            sa.ForeignKeyConstraint([u'_categories_rid'], [u'_categories.rid'], name=u'FK__popularcategories', onupdate="CASCADE", ondelete="CASCADE"),)
sa.Index(u'_categories_rid21', _popularcategories.c._categories_rid, _popularcategories.c.sessionID, unique=True)



_popularwares =  sa.Table('_popularwares', meta.metadata,
                       sa.Column(u'rid', sa.types.Integer(),  autoincrement=True, primary_key=True, nullable=False),
                       sa.Column(u'_wares_rid', sa.types.Integer(), primary_key=False, nullable=False),
                       sa.Column(u'createdt', sa.types.TIMESTAMP(timezone=False), primary_key=False),
                       sa.Column(u'sessionID', sa.types.String(length=112), primary_key=False, nullable=False),
                       sa.ForeignKeyConstraint([u'_wares_rid'], [u'_wares.rid'], name=u'FK__popularwares', onupdate="CASCADE", ondelete="CASCADE"),
    )
sa.Index(u'_wares_rid23', _popularwares.c._wares_rid, _popularwares.c.sessionID, unique=True)


_prices =  sa.Table('_prices', meta.metadata,
                 sa.Column(u'rid', sa.types.Integer(),  autoincrement=True, primary_key=True, nullable=False),
                 sa.Column(u'_pritems_rid', sa.types.Integer(), primary_key=False, nullable=False),
                 sa.Column(u'_currency_rid', sa.types.Integer(), primary_key=False, nullable=False),
                 sa.Column(u'price', sa.types.Float(precision=None, asdecimal=False), primary_key=False),
                 sa.Column(u'archive', sa.types.Boolean(), primary_key=False, nullable=False),
                 sa.Column(u'descr', sa.types.Text(length=None), primary_key=False),
                 sa.Column(u'createdt', sa.types.TIMESTAMP(timezone=False), primary_key=False, nullable=False),
                 sa.ForeignKeyConstraint([u'_pritems_rid'], [u'_pritems.rid'], name=u'FK__prices_1', onupdate="CASCADE", ondelete="CASCADE"),
                 sa.ForeignKeyConstraint([u'_currency_rid'], [u'_currency.rid'], name=u'FK__prices_3', onupdate="CASCADE", ondelete="CASCADE"),
    
    )
sa.Index(u'_currency_rid24', _prices.c._currency_rid, unique=False)


_pritems =  sa.Table('_pritems', meta.metadata,
                  sa.Column(u'rid', sa.types.Integer(),  autoincrement=True, primary_key=True, nullable=False),
                  sa.Column(u'_clients_rid', sa.types.Integer(), primary_key=False, nullable=False),
                  sa.Column(u'_categories_rid', sa.types.Integer(), primary_key=False, nullable=False),
                  sa.Column(u'_wares_rid', sa.types.Integer(), primary_key=False),
                  sa.Column(u'_availabletypes_rid', sa.types.Integer(), primary_key=False, nullable=False),
                  sa.Column(u'name', sa.types.String(length=255), primary_key=False),
                  sa.Column(u'short_descr', sa.types.String(length=255), primary_key=False),
                  sa.Column(u'link_ware', sa.types.Text(length=None), primary_key=False),
                  sa.Column(u'prdate', sa.types.DateTime(timezone=False), primary_key=False),
                  sa.Column(u'archive', sa.types.Boolean(), primary_key=False, nullable=False),
                  sa.Column(u'descr', sa.types.Text(length=None), primary_key=False),
                  sa.Column(u'createdt', sa.types.TIMESTAMP(timezone=False), primary_key=False, nullable=False),
                  sa.Column(u'model', sa.types.String(length=255), primary_key=False, nullable=False),
                  sa.Column(u'delivery', sa.types.String(length=255), primary_key=False),
                  sa.Column(u'offer_id', sa.types.String(length=45), primary_key=False, nullable=False),
                  sa.Column(u'model_alias', sa.types.String(length=255), primary_key=False),
                  sa.ForeignKeyConstraint([u'_categories_rid'], [u'_categories.rid'], name=u'FK__pritems', onupdate="CASCADE", ondelete="CASCADE"),
                  sa.ForeignKeyConstraint([u'_clients_rid'], [u'_clients.rid'], name=u'FK__pritems_1', onupdate="CASCADE", ondelete="CASCADE"),
                  sa.ForeignKeyConstraint([u'_wares_rid'], [u'_wares.rid'], name=u'FK__pritems_4', onupdate="CASCADE", ondelete="CASCADE"),
                  sa.ForeignKeyConstraint([u'_availabletypes_rid'], [u'_availabletypes.rid'], name=u'FK__pritems_5', onupdate="CASCADE", ondelete="CASCADE"),
    
    )
sa.Index(u'_clients_rid25', _pritems.c._clients_rid, _pritems.c.archive, _pritems.c.offer_id, _pritems.c.prdate, unique=True)
sa.Index(u'_categories_rid25', _pritems.c._categories_rid, unique=False)
sa.Index(u'_wares_rid25', _pritems.c._wares_rid, unique=False)
sa.Index(u'_availabletypes_rid25', _pritems.c._availabletypes_rid, unique=False)



_pritemsimgs =  sa.Table('_pritemsimgs', meta.metadata,
                      sa.Column(u'rid', sa.types.Integer(),  autoincrement=True, primary_key=True, nullable=False),
                      sa.Column(u'_pritems_rid', sa.types.Integer(), primary_key=False, nullable=False),
                      sa.Column(u'name', sa.types.String(length=45), primary_key=False),
                      sa.Column(u'type', sa.types.String(length=45), primary_key=False),
                      sa.Column(u'size', sa.types.String(length=45), primary_key=False),
                      sa.Column(u'image', sa.Binary(length=None), primary_key=False, nullable=False),
                      sa.Column(u'archive', sa.types.Boolean(), primary_key=False, nullable=False),
                      sa.Column(u'descr', sa.types.Text(length=None), primary_key=False),
                      sa.Column(u'createdt', sa.types.TIMESTAMP(timezone=False), primary_key=False, nullable=False),
                      sa.ForeignKeyConstraint([u'_pritems_rid'], [u'_pritems.rid'], name=u'FK__pritemsimgs1', onupdate="CASCADE", ondelete="CASCADE"),
    
    )
sa.Index(u'FK__pritemsimgs26', _pritemsimgs.c._pritems_rid, unique=False)



_prloadsorganizer =  sa.Table('_prloadsorganizer', meta.metadata,
                           sa.Column(u'rid', sa.types.Integer(),  autoincrement=True, primary_key=True, nullable=False),
                           sa.Column(u'_clients_rid', sa.types.Integer(), primary_key=False, nullable=False),
                           sa.Column(u'load_time', sa.types.DateTime(timezone=False), primary_key=False, nullable=False),
                           sa.Column(u'next_load', sa.types.DateTime(timezone=False), primary_key=False, nullable=False),
                           sa.Column(u'wares_quan', sa.types.Integer(), primary_key=False, nullable=False),
                           sa.Column(u'error_status', sa.types.Boolean(), primary_key=False, nullable=False),
                           sa.Column(u'archive', sa.types.Boolean(), primary_key=False, nullable=False),
                           sa.Column(u'descr', sa.types.Text(length=None), primary_key=False),
                           sa.Column(u'createdt', sa.types.TIMESTAMP(timezone=False), primary_key=False, nullable=False),
                           sa.ForeignKeyConstraint([u'_clients_rid'], [u'_clients.rid'], name=u'FK__prloadsorganizer_1', onupdate="CASCADE", ondelete="CASCADE"),
    
    )
sa.Index(u'_clients_rid27', _prloadsorganizer.c._clients_rid, unique=False)



_relatedcats =  sa.Table('_relatedcats', meta.metadata,
                      sa.Column(u'rid', sa.types.Integer(),  autoincrement=True, primary_key=True, nullable=False),
                      sa.Column(u'_categories_rid', sa.types.Integer(), primary_key=False, nullable=False),
                      sa.Column(u'related_categories_rid', sa.types.Integer(), primary_key=False, nullable=False),
                      sa.Column(u'archive', sa.types.Boolean(), primary_key=False, nullable=False),
                      sa.Column(u'createdt', sa.types.TIMESTAMP(timezone=False), primary_key=False, nullable=False),
                      sa.ForeignKeyConstraint([u'_categories_rid'], [u'_categories.rid'], name=u'FK__relatedcats_1', onupdate="CASCADE", ondelete="CASCADE"),
    )
sa.Index(u'_secondary30', _relatedcats.c._categories_rid, _relatedcats.c.related_categories_rid, unique=True)

_tmpprices =  sa.Table('_tmpprices', meta.metadata,
                    sa.Column(u'rid', sa.types.Integer(),  autoincrement=True, primary_key=True, nullable=False),
                    sa.Column(u'_tmppritems_rid', sa.types.Integer(), primary_key=False, nullable=False),
                    sa.Column(u'_currency_rid', sa.types.Integer(), primary_key=False, nullable=False),
                    sa.Column(u'price', sa.types.Float(precision=None, asdecimal=False), primary_key=False),
                    sa.Column(u'archive', sa.types.Boolean(), primary_key=False, nullable=False),
                    sa.Column(u'descr', sa.types.Text(length=None), primary_key=False),
                    sa.Column(u'createdt', sa.types.TIMESTAMP(timezone=False), primary_key=False, nullable=False),
                    sa.ForeignKeyConstraint([u'_tmppritems_rid'], [u'_tmppritems.rid'], name=u'FK__tmpprices1', onupdate="CASCADE", ondelete="CASCADE"),
                    sa.ForeignKeyConstraint([u'_currency_rid'], [u'_currency.rid'], name=u'FK__tmpprices2', onupdate="CASCADE", ondelete="CASCADE"),
    )
sa.Index(u'_currency_rid31', _tmpprices.c._currency_rid, unique=False)

_tmppricesstorage =  sa.Table('_tmppricesstorage', meta.metadata,
                           sa.Column(u'rid', sa.types.Integer(),  autoincrement=True, primary_key=True, nullable=False),
                           sa.Column(u'_clients_rid', sa.types.Integer(), primary_key=False, nullable=False),
                           sa.Column(u'price_date', sa.types.DateTime(timezone=False), primary_key=False, nullable=False),
                           sa.Column(u'clname', sa.types.String(length=255), primary_key=False),
                           sa.Column(u'clcompany', sa.types.String(length=255), primary_key=False),
                           sa.Column(u'clurl', sa.types.String(length=255), primary_key=False),
                           sa.Column(u'archive', sa.types.Boolean(), primary_key=False, nullable=False),
                           sa.Column(u'createdt', sa.types.TIMESTAMP(timezone=False), primary_key=False, nullable=False),
                           sa.ForeignKeyConstraint([u'_clients_rid'], [u'_clients.rid'], name=u'FK__tmppricesstorage1', onupdate="CASCADE", ondelete="CASCADE"),
    )
sa.Index(u'_clients_rid32', _tmppricesstorage.c._clients_rid, unique=True)



_tmppritems =  sa.Table('_tmppritems', meta.metadata,
                     sa.Column(u'rid', sa.types.Integer(),  autoincrement=True, primary_key=True, nullable=False),
                     sa.Column(u'_tmppricesstorage_rid', sa.types.Integer(), primary_key=False, nullable=False),
                     sa.Column(u'_clcategories_rid', sa.types.Integer(), primary_key=False, nullable=False),
                     sa.Column(u'_availabletypes_rid', sa.types.Integer(), primary_key=False, nullable=False),
                     sa.Column(u'offer_id', sa.types.String(length=45), primary_key=False, nullable=False),
                     sa.Column(u'offer_type', sa.types.String(length=45), primary_key=False),
                     sa.Column(u'offer_bid', sa.types.Integer(), primary_key=False),
                     sa.Column(u'offer_cbid', sa.types.Integer(), primary_key=False),
                     sa.Column(u'archive', sa.types.Boolean(), primary_key=False, nullable=False),
                     sa.Column(u'descr', sa.types.Text(length=None), primary_key=False),
                     sa.Column(u'createdt', sa.types.TIMESTAMP(timezone=False), primary_key=False, nullable=False),
                     sa.ForeignKeyConstraint([u'_tmppricesstorage_rid'], [u'_tmppricesstorage.rid'], name=u'FK__tmppritems3', onupdate="CASCADE", ondelete="CASCADE"),
                     sa.ForeignKeyConstraint([u'_availabletypes_rid'], [u'_availabletypes.rid'], name=u'FK__tmppritems_5', onupdate="CASCADE", ondelete="CASCADE"),
                     sa.ForeignKeyConstraint([u'_clcategories_rid'], [u'_clcategories.rid'], name=u'FK__tmppritems_2', onupdate="CASCADE", ondelete="CASCADE"),
    )
sa.Index(u'offer_id33', _tmppritems.c._tmppricesstorage_rid, _tmppritems.c.offer_id, unique=True)
sa.Index(u'_categories_rid33', _tmppritems.c._clcategories_rid, unique=False)
sa.Index(u'_availabletypes_rid33', _tmppritems.c._availabletypes_rid, unique=False)



_tmppritemsattrs =  sa.Table('_tmppritemsattrs', meta.metadata,
                          sa.Column(u'rid', sa.types.Integer(),  autoincrement=True, primary_key=True, nullable=False),
                          sa.Column(u'_tmppritems_rid', sa.types.Integer(), primary_key=False, nullable=False),
                          sa.Column(u'attr_name', sa.types.String(length=255), primary_key=False, nullable=False),
                          sa.Column(u'attr_value', sa.types.String(length=255), primary_key=False, nullable=False),
                          sa.Column(u'archive', sa.types.Boolean(), primary_key=False, nullable=False),
                          sa.Column(u'descr', sa.types.Text(length=None), primary_key=False),
                          sa.Column(u'createdt', sa.types.TIMESTAMP(timezone=False), primary_key=False, nullable=False),
                          sa.ForeignKeyConstraint([u'_tmppritems_rid'], [u'_tmppritems.rid'], name=u'FK__tmppritemsattrs', onupdate="CASCADE", ondelete="CASCADE"),
    )
sa.Index(u'FK__tmppritemsattrs34', _tmppritemsattrs.c._tmppritems_rid, unique=False)



_tmppritemscources =  sa.Table('_tmppritemscources', meta.metadata,
                            sa.Column(u'rid', sa.types.Integer(),  autoincrement=True, primary_key=True, nullable=False),
                            sa.Column(u'_tmppricesstorage_rid', sa.types.Integer(), primary_key=False, nullable=False),
                            sa.Column(u'_currency_rid', sa.types.Integer(), primary_key=False, nullable=False),
                            sa.Column(u'cource', sa.types.Float(precision=None, asdecimal=False), primary_key=False, nullable=False),
                            sa.Column(u'archive', sa.types.Boolean(), primary_key=False, nullable=False),
                            sa.Column(u'createdt', sa.types.TIMESTAMP(timezone=False), primary_key=False, nullable=False),
                            sa.ForeignKeyConstraint([u'_tmppricesstorage_rid'], [u'_tmppricesstorage.rid'], name=u'FK__tmppritemscources1', onupdate="CASCADE", ondelete="CASCADE"),
                            sa.ForeignKeyConstraint([u'_currency_rid'], [u'_currency.rid'], name=u'FK__tmppritemscources2', onupdate="CASCADE", ondelete="CASCADE"),
    
    )
sa.Index(u'FK__tmppritemscources35', _tmppritemscources.c._currency_rid, unique=False)
sa.Index(u'FK__tmppritemscources135', _tmppritemscources.c._tmppricesstorage_rid, unique=False)



_tmppritemsimgs =  sa.Table('_tmppritemsimgs', meta.metadata,
                         sa.Column(u'rid', sa.types.Integer(),  autoincrement=True, primary_key=True, nullable=False),
                         sa.Column(u'_tmppritems_rid', sa.types.Integer(), primary_key=False, nullable=False),
                         sa.Column(u'name', sa.types.String(length=45), primary_key=False),
                         sa.Column(u'type', sa.types.String(length=45), primary_key=False),
                         sa.Column(u'size', sa.types.String(length=45), primary_key=False),
                         sa.Column(u'image', sa.Binary(length=None), primary_key=False, nullable=False),
                         sa.Column(u'archive', sa.types.Boolean(), primary_key=False, nullable=False),
                         sa.Column(u'createdt', sa.types.TIMESTAMP(timezone=False), primary_key=False, nullable=False),
                         sa.ForeignKeyConstraint([u'_tmppritems_rid'], [u'_tmppritems.rid'], name=u'FK__tmppritemsimgs1', onupdate="CASCADE", ondelete="CASCADE"),
    )
sa.Index(u'FK__tmppritemsimgs36', _tmppritemsimgs.c._tmppritems_rid, unique=False)


_tmppritemspars =  sa.Table('_tmppritemspars', meta.metadata,
                         sa.Column(u'rid', sa.types.Integer(),  autoincrement=True, primary_key=True, nullable=False),
                         sa.Column(u'_tmppritems_rid', sa.types.Integer(), primary_key=False, nullable=False),
                         sa.Column(u'_pars_rid', sa.types.Integer(), primary_key=False, nullable=False),
                         sa.Column(u'value', sa.types.Text(length=None), primary_key=False),
                         sa.Column(u'archive', sa.types.Boolean(), primary_key=False, nullable=False),
                         sa.Column(u'createdt', sa.types.TIMESTAMP(timezone=False), primary_key=False, nullable=False),
                         sa.ForeignKeyConstraint([u'_pars_rid'], [u'_pars.rid'], name=u'FK__tmppritemspars', onupdate="CASCADE", ondelete="CASCADE"),
                         sa.ForeignKeyConstraint([u'_tmppritems_rid'], [u'_tmppritems.rid'], name=u'FK__tmppritemspars1', onupdate="CASCADE", ondelete="CASCADE"),
    
    )
sa.Index(u'_secondary37', _tmppritemspars.c._tmppritems_rid, _tmppritemspars.c._pars_rid, unique=True)
sa.Index(u'_catpars_rid37', _tmppritemspars.c._pars_rid, unique=False)



_ucallbacks =  sa.Table('_ucallbacks', meta.metadata,
                     sa.Column(u'rid', sa.types.Integer(),  autoincrement=True, primary_key=True, nullable=False),
                     sa.Column(u'content', sa.types.String(length=512), primary_key=False, nullable=False),
                     sa.Column(u'archive', sa.types.Boolean(), primary_key=False, nullable=False),
                     sa.Column(u'createdt', sa.types.TIMESTAMP(timezone=False), primary_key=False, nullable=False),
                     sa.Column(u'status', sa.types.String(length=255), primary_key=False, nullable=False),
                     sa.Column(u'cemail', sa.types.String(length=255), primary_key=False, nullable=False),
    )


_users =  sa.Table('_users', meta.metadata,
                sa.Column(u'rid', sa.types.Integer(),  autoincrement=True, primary_key=True, nullable=False),
                sa.Column(u'_clients_rid', sa.types.Integer(), primary_key=False, nullable=False),
                sa.Column(u'displayname', sa.types.String(length=45), primary_key=False, nullable=False),
                sa.Column(u'login', sa.types.String(length=45), primary_key=False, nullable=False),
                sa.Column(u'passwd', sa.types.String(length=255), primary_key=False, nullable=False),
                sa.Column(u'email', sa.types.String(length=45), primary_key=False, nullable=False),
                sa.Column(u'archive', sa.types.Boolean(), primary_key=False, nullable=False),
                sa.Column(u'descr', sa.types.Text(length=None), primary_key=False),
                sa.Column(u'createdt', sa.types.TIMESTAMP(timezone=False), primary_key=False, nullable=False),
                sa.ForeignKeyConstraint([u'_clients_rid'], [u'_clients.rid'], name=u'FK__users_1', onupdate="CASCADE", ondelete="CASCADE"),
    
    )
sa.Index(u'_secondary39', _users.c.login, unique=True)
sa.Index(u'_clients_rid39', _users.c._clients_rid, unique=False)



_wares =  sa.Table('_wares', meta.metadata,
                sa.Column(u'rid', sa.types.Integer(),  autoincrement=True, primary_key=True, nullable=False),
                sa.Column(u'_categories_rid', sa.types.Integer(), primary_key=False, nullable=False),
                sa.Column(u'ware_name', sa.types.String(length=255), primary_key=False, nullable=False),
                sa.Column(u'ware_alias', sa.types.String(length=255), primary_key=False, nullable=False),
                sa.Column(u'popularity', sa.types.Integer(), primary_key=False),
                sa.Column(u'archive', sa.types.Boolean(), primary_key=False, nullable=False),
                sa.Column(u'createdt', sa.types.TIMESTAMP(timezone=False), primary_key=False, nullable=False),
                sa.ForeignKeyConstraint([u'_categories_rid'], [u'_categories.rid'], name=u'FK__wares_2', onupdate="CASCADE", ondelete="CASCADE"),
    )
sa.Index(u'_categories_rid40', _wares.c._categories_rid, unique=False)



_waresimages =  sa.Table('_waresimages', meta.metadata,
                      sa.Column(u'rid', sa.types.Integer(),  autoincrement=True, primary_key=True, nullable=False),
                      sa.Column(u'_wares_rid', sa.types.Integer(), primary_key=False, nullable=False),
                      sa.Column(u'image', sa.Binary(length=None), primary_key=False, nullable=False),
                      sa.Column(u'archive', sa.types.Boolean(), primary_key=False, nullable=False),
                      sa.Column(u'createdt', sa.types.TIMESTAMP(timezone=False), primary_key=False, nullable=False),
                      sa.Column(u'name', sa.types.String(length=45), primary_key=False),
                      sa.Column(u'type', sa.types.String(length=45), primary_key=False),
                      sa.Column(u'size', sa.types.String(length=45), primary_key=False),
                      sa.ForeignKeyConstraint([u'_wares_rid'], [u'_wares.rid'], name=u'FK__waresimages_1', onupdate="CASCADE", ondelete="CASCADE"),
    
    )
sa.Index(u'_wares_rid41', _waresimages.c._wares_rid, unique=False)



_waresmarks =  sa.Table('_waresmarks', meta.metadata,
                     sa.Column(u'rid', sa.types.Integer(),  autoincrement=True, primary_key=True, nullable=False),
                     sa.Column(u'_wares_rid', sa.types.Integer(), primary_key=False, nullable=False),
                     sa.Column(u'mark', sa.types.Integer(), primary_key=False, nullable=False),
                     sa.Column(u'ip', sa.types.String(length=15), primary_key=False, nullable=False),
                     sa.Column(u'archive', sa.types.Boolean(), primary_key=False, nullable=False),
                     sa.Column(u'descr', sa.types.Text(length=None), primary_key=False),
                     sa.Column(u'createdt', sa.types.TIMESTAMP(timezone=False), primary_key=False, nullable=False),
                     sa.ForeignKeyConstraint([u'_wares_rid'], [u'_wares.rid'], name=u'FK__waresmarks_1', onupdate="CASCADE", ondelete="CASCADE"),
    
    )
sa.Index(u'_wares_rid42', _waresmarks.c._wares_rid, unique=False)



_warespars =  sa.Table('_warespars', meta.metadata,
                    sa.Column(u'rid', sa.types.Integer(),  autoincrement=True, primary_key=True, nullable=False),
                    sa.Column(u'_wares_rid', sa.types.Integer(), primary_key=False, nullable=False),
                    sa.Column(u'_pars_rid', sa.types.Integer(), primary_key=False, nullable=False),
                    sa.Column(u'value', sa.types.Text(length=None), primary_key=False),
                    sa.Column(u'archive', sa.types.Boolean(), primary_key=False, nullable=False),
                    sa.Column(u'descr', sa.types.Text(length=None), primary_key=False),
                    sa.Column(u'createdt', sa.types.TIMESTAMP(timezone=False), primary_key=False, nullable=False),
                    sa.ForeignKeyConstraint([u'_wares_rid'], [u'_wares.rid'], name=u'FK__warespars_1', onupdate="CASCADE", ondelete="CASCADE"),
                    sa.ForeignKeyConstraint([u'_pars_rid'], [u'_pars.rid'], name=u'FK__warespars_2', onupdate="CASCADE", ondelete="CASCADE"),
    
    )
sa.Index(u'_secondary43', _warespars.c._wares_rid, _warespars.c._pars_rid, unique=True)
sa.Index(u'_catpars_rid43', _warespars.c._pars_rid, unique=False)



_waresrewievs =  sa.Table('_waresrewievs', meta.metadata,
                       sa.Column(u'rid', sa.types.Integer(),  autoincrement=True, primary_key=True, nullable=False),
                       sa.Column(u'_wares_rid', sa.types.Integer(), primary_key=False, nullable=False),
                       sa.Column(u'review', sa.types.Text(length=None), primary_key=False, nullable=False),
                       sa.Column(u'datereview', sa.types.DateTime(timezone=False), primary_key=False, nullable=False),
                       sa.Column(u'archive', sa.types.Boolean(), primary_key=False, nullable=False),
                       sa.Column(u'createdt', sa.types.TIMESTAMP(timezone=False), primary_key=False, nullable=False),
                       sa.Column(u'review_title', sa.types.String(length=255), primary_key=False, nullable=False),
                       sa.ForeignKeyConstraint([u'_wares_rid'], [u'_wares.rid'], name=u'FK__waresrewievs', onupdate="CASCADE", ondelete="CASCADE"),
    
    )
sa.Index(u'_secondary44', _waresrewievs.c._wares_rid, _waresrewievs.c.review_title, unique=True)



_waresuopinions =  sa.Table('_waresuopinions', meta.metadata,
                         sa.Column(u'rid', sa.types.Integer(),  autoincrement=True, primary_key=True, nullable=False),
                         sa.Column(u'_wares_rid', sa.types.Integer(), primary_key=False, nullable=False),
                         sa.Column(u'opinion', sa.types.Text(length=None), primary_key=False, nullable=False),
                         sa.Column(u'_members_rid', sa.types.Integer(), primary_key=False, nullable=False),
                         sa.Column(u'archive', sa.types.Boolean(), primary_key=False, nullable=False),
                         sa.Column(u'createdt', sa.types.TIMESTAMP(timezone=False), primary_key=False, nullable=False),
                         sa.Column(u'mark', sa.types.Integer(), primary_key=False, nullable=False),
                         sa.ForeignKeyConstraint([u'_wares_rid'], [u'_wares.rid'], name=u'FK__waresuopinions', onupdate="CASCADE", ondelete="CASCADE"),
                         sa.ForeignKeyConstraint([u'_members_rid'], [u'_members.rid'], name=u'FK__waresuopinions1', onupdate="CASCADE", ondelete="CASCADE"),
    
    )
sa.Index(u'_wares_rid45', _waresuopinions.c._wares_rid, unique=False)
sa.Index(u'FK__waresuopinions_45', _waresuopinions.c._members_rid, unique=False)



class Availabletypes(object): pass
class Categories(object): pass
class Catparents(object): pass
class Categoriesimages(object): pass
class Cities(object): pass
class Clcategories(object): pass
class Clients(object): pass
class Cluopinions(object): pass
class Countries(object): pass
class Currcources(object): pass
class Currency(object): pass
class Findqueries(object): pass
class Guides(object): pass
class Guidesimages(object): pass
class Links(object): pass
class Linkstocategories(object): pass
class Members(object): pass
class News(object): pass
class Newscategories(object): pass
class Officialcources(object): pass
class Pars(object): pass
class Parsvalues(object): pass
class Popularcategories(object): pass
class Popularwares(object): pass
class Prices(object): pass
class Pritems(object): pass
class Pritemsimgs(object): pass
class Prloadsorganizes(object): pass
class Regions(object): pass
class Relatedcats(object): pass
class Tmpprices(object): pass
class Tmppricesstorage(object): pass
class Tmppritems(object): pass
class Tmppritemsattrs(object): pass
class Tmppritemscources(object): pass
class Tmppritemsimgs(object): pass
class Tmppritemspars(object): pass
class Ucallbacks(object): pass
class Users(object): pass
class Wares(object): pass
class Waresimages(object): pass
class Waresmarks(object): pass
class Warespars(object): pass
class Waresrewievs(object): pass
class Waresopinions(object): pass
class Options(object): pass
class Sessions(object): pass


orm.mapper(Availabletypes, _availabletypes)
orm.mapper(Categories, _categories)
orm.mapper(Catparents, _catparents)
orm.mapper(Categoriesimages, _categoriesimages)
orm.mapper(Cities, _cities)
orm.mapper(Clcategories, _clcategories)
orm.mapper(Clients, _clients)
orm.mapper(Cluopinions, _cluopinions)
orm.mapper(Currency, _currency)
orm.mapper(Countries, _countries)
orm.mapper(Currcources, _currcources)
orm.mapper(Findqueries, _findqueries)
orm.mapper(Guides, _guides)
orm.mapper(Guidesimages, _guidesimages)
orm.mapper(Links, _links)
orm.mapper(Linkstocategories, _linkstocategories)
orm.mapper(Members, _members)
orm.mapper(News, _news)
orm.mapper(Newscategories, _newscategories)
orm.mapper(Officialcources, _officialcources)
orm.mapper(Pars, _pars)
orm.mapper(Parsvalues, _parsvalues)
orm.mapper(Popularcategories, _popularcategories)
orm.mapper(Popularwares, _popularwares)
orm.mapper(Prices, _prices)
orm.mapper(Pritems, _pritems)
orm.mapper(Pritemsimgs, _pritemsimgs)
orm.mapper(Prloadsorganizes, _prloadsorganizer)
orm.mapper(Regions, _regions)
orm.mapper(Relatedcats, _relatedcats)
orm.mapper(Tmpprices, _tmpprices)
orm.mapper(Tmppricesstorage, _tmppricesstorage)
orm.mapper(Tmppritems, _tmppritems)
orm.mapper(Tmppritemsattrs, _tmppritemsattrs)
orm.mapper(Tmppritemscources, _tmppritemscources)
orm.mapper(Tmppritemsimgs, _tmppritemsimgs)
orm.mapper(Tmppritemspars,_tmppritemspars)
orm.mapper(Ucallbacks, _ucallbacks)
orm.mapper(Users, _users)
orm.mapper(Wares, _wares)
orm.mapper(Waresimages, _waresimages)
orm.mapper(Waresmarks, _waresmarks)
orm.mapper(Warespars, _warespars)
orm.mapper(Waresrewievs, _waresrewievs)
orm.mapper(Waresopinions, _waresuopinions)
orm.mapper(Options, _options)
orm.mapper(Sessions, _sessions)

