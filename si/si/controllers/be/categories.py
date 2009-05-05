import logging

from pylons import request, response, session, tmpl_context as c
from pylons.controllers.util import abort, redirect_to

from si.lib.base import BaseController, render
from si.model import meta, sidb
from sqlalchemy import and_
from sqlalchemy.sql import expression
from pylons.decorators import validate
from si.model.forms.be import categories as v_categories 

log = logging.getLogger(__name__)

class CategoriesController(BaseController):

    def index(self):
        parent = request.GET.get('parent', 0)
        c.categories_list = meta.Session.query(sidb.Category).filter(sidb.Category._categories_rid==parent).order_by(sidb.Category.name).all()
        c.category_parents = meta.Session.query(sidb.Category).\
                                                join((sidb.Catparent, sidb.Category.rid==sidb.Catparent._parent_rid)).\
                                                filter(sidb.Catparent._categories_rid == parent).\
                                                order_by(sidb.Catparent.level).\
                                                all()
        c.currcat = meta.Session.query(sidb.Category).filter(sidb.Category.rid==parent).first()
        clause = ~sidb.Category.rid.in_(expression.select([sidb.Category._categories_rid]).group_by(sidb.Category._categories_rid))
        leafs = meta.Session.query(sidb.Category.rid).filter(and_(sidb.Category._categories_rid==parent, clause)).all()
        c.leafs = [l.rid for l in leafs ]
        c.subtempl = 'categories_list'
        return render('be/layouts/categories.html')

    @validate(schema=v_categories.CategoriesForm(), form="edit")
    def edit(self, rid=None):
        if not rid: redirect_to('/be/categories')
        c.currcat = meta.Session.query(sidb.Category).filter(sidb.Category.rid==rid).first()
        if not c.currcat: redirect_to('/be/categories')
        if request.POST.get('save', None):
            catrid = self._processingCategory(rid) 
            if catrid:
                c.oper_status = True
            else:
                c.oper_status = False
        
        c.subtempl = 'categories_edit'
        return render('be/layouts/categories.html')

    @validate(schema=v_categories.CategoriesForm(), form="add")
    def add(self, rid=0):
        c._categories_rid = rid
        c.currcat = meta.Session.query(sidb.Category).filter(sidb.Category.rid==rid).first()
        if request.POST.get('save', None):
            catrid = self._processingCategory(rid) 
            if catrid:
                c.oper_status = True
            else:
                c.oper_status = False
        
        c.subtempl = 'categories_add'
        return render('be/layouts/categories.html')
        
    def _processingCategory(self, rid=None):
        try:
            if rid:
                category = meta.Session.query(sidb.Category).filter(sidb.Category.rid==rid).first()
            else: 
                category = sidb.Category()
            category._categories_rid = request.POST.get('_categories_rid', None)
            category.name = request.POST.get('name', None)
            category.meta_title = request.POST.get('meta_title', None)
            category.meta_description = request.POST.get('meta_description', None)
            category.meta_keywords = request.POST.get('meta_keywords', None)
            category.to_main = request.POST.get('to_main', 0)
            category.isgrouped = request.POST.get('isgrouped', 0)
            category.iscompared = request.POST.get('iscompared', 0)
            category.archive = request.POST.get('archive', 0)
            category.descr = request.POST.get('descr', 0)
            category.popularity = request.POST.get('popularity', 0)
            meta.Session.add(category)
            meta.Session.commit()
            return category.rid
        except:
            meta.Session.rollback()
            return False
        