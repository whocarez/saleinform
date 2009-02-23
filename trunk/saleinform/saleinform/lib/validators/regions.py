#-*-coding: utf-8 -*-
import formencode
from saleinform.model import si
from sqlalchemy.sql import and_, or_, func
from pylons import request

#formencode.api.set_stdtranslation(domain="FormEncode", languages=["ru"])

class RegionForm(formencode.Schema):
    allow_extra_fields = True
    filter_extra_fields = True
    name = formencode.All(formencode.validators.String(not_empty=True, strip=True), formencode.validators.MinLength(2))    
    
class CityForm(formencode.Schema):
    allow_extra_fields = True
    filter_extra_fields = True
    name = formencode.All(formencode.validators.String(not_empty=True, strip=True), formencode.validators.MinLength(2))    
        
        

