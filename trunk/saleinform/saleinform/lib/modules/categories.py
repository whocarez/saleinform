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
        categories = si.meta.Session.query(si.Categories.rid, si.Categories.name, si.Categories.slug, si.Categories.meta_title, \
                                           expression.select([si.Catparents._parent_rid], si.Catparents._categories_rid == si.Categories.rid).order_by(si.Catparents.level.desc()).limit(1).label('_parent_rid')).\
                                           filter(~si.Categories.archive).order_by(si.Categories.name, si.Categories.rid).all()
        c.a_categories_tree = CategoriesTree(categories)
        #print_map(c.a_categories_tree.Root)
        return 
        
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
    

class Node:
    def __init__(self, n, s):
        self.rid = n
        self.category = s
        self.children = []

class CategoriesTree:
    
    def __init__(self, categories):
        self.treeMap = {}
        self.Root = Node(None, "Root")
        self.treeMap[self.Root.rid] = self.Root
        
        for element in categories:
            nodeId = element.rid
            parentId = element._parent_rid
            
            if not nodeId in self.treeMap:
                self.treeMap[nodeId] = Node(nodeId, element)
            else:
                self.treeMap[nodeId].rid = nodeId
                self.treeMap[nodeId].category = element

            if not parentId in self.treeMap:
                self.treeMap[parentId] = Node(None, '')
            self.treeMap[parentId].children.append(self.treeMap[nodeId])     

        
def print_map(node, lvl=0):
    for n in node.children:
        print '    ' * lvl + n.category.name
        if len(n.children) > 0:
            print_map(n, lvl+1)

