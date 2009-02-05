#-*- coding: utf-8 -*-
"""
Популярность, фактическое к-во просмотров
категорий - ['p_c'] 
магазинов - ['p_s']
предложений - ['p_p']
"""
from saleinform.model import si
class SetPopularity:
    
    def __init__(self, objRid = None):
        self.objRid = objRid

    def populate(self, objType = 'C'):
        """
        C- categories, S- stores, P- products
        """
        if self.objRid:
            if objType == 'S': self.storePopulate()
            elif objType == 'P': self.productPopulate()
            elif objType == 'C': self.categoryPopulate()
    
    def categoryPopulate(self):
        if not session.has_key('p_c'): 
            session['p_c'] = []
        
        if session['p_c'].count(self.objRid)==0:
                session['p_c'].append(self.objRid)
                session.save()
                category = si.meta.Session.query(si.Categories.popularity).one()
                category.popularity += 1
                si.meta.Session.commit()
            

    def productPopulate(self):
        if not session.has_key('p_p'): 
            session['p_p'] = []
        
        if session['p_p'].count(self.objRid)==0:
                session['p_p'].append(self.objRid)
                session.save()
        
    def storePopulate(self):
        if not session.has_key('p_s'): 
            session['p_s'] = []
        
        if session['p_s'].count(self.objRid)==0:
                session['p_s'].append(self.objRid)
                session.save()
                store = si.meta.Session.query(si.Stores.popularity).one()
                store.popularity += 1
                si.meta.Session.commit()
                
                   
                   
