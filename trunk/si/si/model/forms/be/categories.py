#-*-coding: utf-8 -*-
import formencode
from si.model import sidb
from sqlalchemy.sql import and_, or_, func

formencode.api.set_stdtranslation(domain="FormEncode", languages=["ru"])

class CategoriesForm(formencode.Schema):
    allow_extra_fields = True
    filter_extra_fields = True
    name = formencode.All(formencode.validators.String(not_empty=True, strip=True), formencode.validators.MinLength(2))
    _categories_rid = formencode.All(formencode.validators.Int(not_empty=True, strip=True))
    meta_title = formencode.All(formencode.validators.String(strip=True), formencode.validators.MaxLength(256))
    meta_keywords = formencode.All(formencode.validators.String(strip=True), formencode.validators.MaxLength(256))
    meta_description = formencode.All(formencode.validators.String(strip=True), formencode.validators.MaxLength(256))
    descr = formencode.All(formencode.validators.String(not_empty=True, strip=True), formencode.validators.MinLength(5), formencode.validators.MaxLength(1024))
    
        
        

