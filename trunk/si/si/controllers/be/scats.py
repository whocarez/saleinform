import logging

from pylons import request, response, session, tmpl_context as c
from pylons.controllers.util import abort, redirect_to
from si.model import meta, sidb
from sqlalchemy import and_
from sqlalchemy.sql import expression
from si.lib.base import BaseController, render

log = logging.getLogger(__name__)

class ScatsController(BaseController):

    def index(self):
        srid = request.GET.get('srid', 0)
        c.selected_category = meta.Session.query(sidb.Category).filter(sidb.Category.rid==srid).first()
        selected_parent = (c.selected_category and c.selected_category._categories_rid or 0)
        if c.selected_category: 
            selected_parent = c.selected_category._categories_rid
        else:   
            selected_parent = 0
        c.categories_list = meta.Session.query(sidb.Category).filter(sidb.Category._categories_rid==selected_parent).all()
        c.parents = meta.Session.query(sidb.Catparent).filter(sidb.Catparent._categories_rid==selected_parent).\
                                        order_by(sidb.Catparent.level).\
                                        join((sidb.Category, sidb.Catparent._parent_rid==sidb.Catparent._categories_rid)).all()
        clause = ~sidb.Category.rid.in_(expression.select([sidb.Category._categories_rid]).group_by(sidb.Category._categories_rid))
        leafs = meta.Session.query(sidb.Category.rid).filter(and_(sidb.Category._categories_rid==selected_parent, clause)).all()
        c.leafs = [l.rid for l in leafs ]
        c.subtempl = 'scategories_list'
        return render('be/layouts/scategories.html')
