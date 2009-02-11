#-*- coding: utf-8 -*-
"""
Mazvv 22-01-2009
Category 
"""
from pylons import request, response, session, tmpl_context as c
from saleinform.lib.base import render
from pylons.i18n import get_lang, set_lang
from saleinform.model import si
from sqlalchemy.sql import func, and_
from sqlalchemy.sql import expression


class CategoriesList(object):

    def __init__(self):
        self.mainListLimit = 15  
        self.topListLimit = 7 
    

    def getMainMenu(self):
        c.categories = self._getTopCategories()
        c.subcategories = self._getSecondLevelCategories()
        return

    def getTopMenu(self, slug = None):
        c.currentCategorySlug = slug
        c.categories = self._getTopCategories()[:self.topListLimit]
        return


    def getAlphabetCategories(self):
        c.a_categories = self._getTopLevelCategories()
        c.a_subcategories = self._getSecondLevelCategories(False)
        return
    
    def getCategoriesTree(self):
        pass
        
        
    def _getTopCategories(self):
        """получить первые N самых популярных категорий"""
        subquery = si.meta.Session.query(si.Categories.popularity, si.Catparents._parent_rid, si.Categories.meta_title).\
                        join((si.Catparents, si.Catparents._categories_rid==si.Categories.rid)).filter(~si.Categories.archive).subquery()
        clause = ~si.Categories.rid.in_(expression.select([si.Catparents._categories_rid]))
        categories = si.meta.Session.query(si.Categories.rid, si.Categories.name, si.Categories.slug, si.Categories.meta_title, (func.sum(si.Categories.popularity)+func.sum(subquery.c.popularity)).label('popularity')).\
                        filter(subquery.c._parent_rid == si.Categories.rid).\
                        filter(clause).\
                        group_by(si.Categories.rid, si.Categories.name, si.Categories.slug, si.Categories.slug, si.Categories.meta_title).order_by('popularity desc').\
                        limit(self.mainListLimit).\
                        all()
        return categories

    def _getSecondLevelCategories(self, random = True):
        """Получить произвольные категории второго уровня"""
        subquery = si.meta.Session.query(si.Catparents._parent_rid, si.Categories.name, si.Categories.slug, si.Categories.meta_title).\
                        join((si.Categories, si.Catparents._parent_rid==si.Categories.rid)).\
                        filter(and_(si.Catparents.level == 2, ~si.Categories.archive)).\
                        group_by(si.Catparents._parent_rid, si.Categories.name, si.Categories.slug, si.Categories.meta_title).\
                        subquery()
        subcategories = si.meta.Session.query(si.Catparents._categories_rid, subquery.c.slug, subquery.c.name, subquery.c.meta_title, si.Catparents._parent_rid).\
                            filter(subquery.c._parent_rid == si.Catparents._categories_rid).\
                            filter(si.Catparents.level == 1)
                            
        if random:
            subcategories.order_by(func.random())
        else: 
            subcategories.order_by(func.random()) 
        return subcategories.all()

    def _getTopLevelCategories(self):
        """Получить все категории первого уровня"""
        subquery = si.meta.Session.query(si.Categories.popularity, si.Catparents._parent_rid).\
                        join((si.Catparents, si.Catparents._categories_rid==si.Categories.rid)).filter(~si.Categories.archive).subquery()
        clause = ~si.Categories.rid.in_(expression.select([si.Catparents._categories_rid]))
        categories = si.meta.Session.query(si.Categories.rid, si.Categories.name, si.Categories.slug, si.Categories.meta_title).\
                        filter(subquery.c._parent_rid == si.Categories.rid).\
                        filter(clause).\
                        group_by(si.Categories.rid, si.Categories.name, si.Categories.slug, si.Categories.meta_title).order_by(si.Categories.name).\
                        all()
        return categories
    

# simple tree builder.
# (node, parent, title)
els = (
       (1, 0, 'a'),
       (2, 1, 'b'),
       (3, 1, 'c'),
       (4, 0, 'd'),
       (5, 4, 'e'),
       (6, 5, 'f'),
       (7, 4, 'g')
)

class CategoryNode:
    def __init__(self, n, c):
        self.rid = n
        self.category = c
        self.children = []

class CategoriesTree:
    treeMap = {}
    Root = CategoryNode(0, None)
    treeMap[Root.rid] = Root

    def __init__(self, categoriesList):
        self.categoriesList = categoriesList
    
    def buildTree(self):    
        for element in self.categoriesList:
            nodeRid = element.rid
            parentRid = element._parent_rid
        
            if not nodeRid in self.treeMap:
                self.treeMap[nodeRid] = CategoryNode(nodeRid, element)
            else:
                self.treeMap[nodeRid].rid = nodeRid
                self.treeMap[nodeRid].category = element

            if not parentRid in self.treeMap:
                self.treeMap[parentRid] = CategoryNode(0, None)
    
            self.treeMap[parentRid].children.append(self.treeMap[nodeRid])
            return     

node = CategoriesTree(els).buildTree().treeMap
def print_map(node, lvl=0):
    for n in node.children:
        print '    ' * lvl + n.category
        if len(n.children) > 0:
            print_map(n, lvl+1)
print_map(Root)

