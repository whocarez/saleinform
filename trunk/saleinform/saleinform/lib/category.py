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
        """
        получить первые N корневых категорий по популярности
        select _categories.name, _categories.popularity+
        (select sum(c2.popularity)
        from _catparents c1
        left join _categories c2 on c1._categories_rid = c2.rid
        where c1._parent_rid = _categories.rid
        ) AS popularity
        from _categories
        where _categories.rid not in (select _categories_rid from _catparents)
        order by popularity desc
        nulls last        
        """
        subquery = si.meta.Session.query(si.Categories.popularity, si.Catparents._parent_rid).\
                        join((si.Catparents, si.Catparents._categories_rid==si.Categories.rid)).subquery()
        clause = ~si.Categories.rid.in_(expression.select([si.Catparents._categories_rid]))
        c.categories = si.meta.Session.query(si.Categories.name, si.Categories.slug, (func.sum(si.Categories.popularity)+func.sum(subquery.c.popularity)).label('popularity')).\
                        filter(subquery.c._parent_rid == si.Categories.rid).\
                        filter(clause).\
                        group_by(si.Categories.rid, si.Categories.name, si.Categories.slug).order_by('popularity desc').\
                        limit(self.mainListLimit).\
                        all()
        return render('/modules/categories/main.mako')
    