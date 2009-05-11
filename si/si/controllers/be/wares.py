import logging

from pylons import request, response, session, tmpl_context as c
from pylons.controllers.util import abort, redirect_to

from si.lib.base import BaseController, render
from si.model import meta, sidb 
from webhelpers import paginate

log = logging.getLogger(__name__)

class WaresController(BaseController):

    def index(self):
        c.wares_quan = meta.Session.query(sidb.Ware).count()
        c.sorts = [('name', sidb.Ware.name)]
        c.sort_col = request.GET.get("sort_field", 'name')
        sort_field = dict(c.sorts).get(c.sort_col)
        c.sort_rule = request.GET.get("sort_rule", 'asc')
        sort_field = (c.sort_rule == 'desc' and  sort_field.desc() or sort_field.asc())
        for key, value in request.POST.iteritems():
            if key in ['s_name']: session[key] = value  
        session.save()
        c.s_name = session.has_key('s_name') and session.get('s_name') or u''
        
        wares_list = meta.Session.query(sidb.Ware, sidb.Category.name.label('category_name')).join((sidb.Category, sidb.Category.rid==sidb.Ware._categories_rid)).order_by(sort_field)
        if c.s_name: wares_list = wares_list.filter(sidb.Ware.name.like('%'+c.s_name+'%'))
        page = paginate.Page(wares_list, items_per_page=15, page=request.GET.get("page", 1), sort_col=c.sort_col, sort_rule=c.sort_rule)
        c.pager = page.pager()
        c.wares_list = page.items
        c.subtempl = 'wares_list'
        return render('be/layouts/wares.html')
    
    def _processingWares(self, rid=None):
        try:
            if rid:
                ware = meta.Session.query(sidb.Ware).filter(sidb.Ware.rid==rid).first()
            else: 
                ware = sidb.Ware()
            ware.name = request.POST.get('name', None)
            ware._categories_rid = request.POST.get('_categories_rid', None)
            ware.popularity = request.POST.get('popularity', 0)
            meta.Session.add(ware)
            meta.Session.commit()
            return ware.rid
        except:
            meta.Session.rollback()
            return False
    
    def add(self):
        c.oper_status = None
        if request.POST.get('save', None):
            new_ware = self._processingWares() 
            if new_ware:
                redirect_to('/be/wares/edit/%s'%new_ware)
            else:
                c.oper_status = False
        c.subtempl = 'wares_add'
        return render('be/layouts/wares.html')
        
