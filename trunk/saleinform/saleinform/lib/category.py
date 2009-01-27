#-*- coding: utf-8 -*-
"""
Mazvv 22-01-2009
Category 
"""
from pylons import request, response, session, tmpl_context as c
from saleinform.lib.base import render
from pylons.i18n import get_lang, set_lang
from saleinform.model import si
from sqlalchemy.sql import func
from sqlalchemy.sql import expression

class Category:
    
    def __init__(self):
        self.mainListLimit = 15

    def renderCategoriesMain(self):
        """получить первые N самых популярных категорий"""
        subquery = si.meta.Session.query(si.Categories.popularity, si.Catparents._parent_rid).\
                        join((si.Catparents, si.Catparents._categories_rid==si.Categories.rid)).subquery()
        clause = ~si.Categories.rid.in_(expression.select([si.Catparents._categories_rid]))
        c.categories = si.meta.Session.query(si.Categories.rid, si.Categories.name, si.Categories.slug, (func.sum(si.Categories.popularity)+func.sum(subquery.c.popularity)).label('popularity')).\
                        filter(subquery.c._parent_rid == si.Categories.rid).\
                        filter(clause).\
                        group_by(si.Categories.rid, si.Categories.name, si.Categories.slug).order_by('popularity desc').\
                        limit(self.mainListLimit).\
                        all()
        """Получить подкатегории второго уровня"""
        c.subcategories = si.meta.Session.query(si.Categories.name, si.Categories.slug, si.Catparents._parent_rid).\
                            join((si.Catparents, si.Catparents._categories_rid==si.Categories.rid)).\
                            filter(si.Catparents.num == 2).\
                            group_by(si.Categories.rid, si.Categories.name, si.Categories.slug, si.Catparents._parent_rid).\
                            order_by(si.Categories.name).\
                            all() 
        return render('/modules/categories/main.mako')

    