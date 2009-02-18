#-*-coding: utf-8 -*-
import formencode
from saleinform.model import si
from sqlalchemy.sql import and_, or_, func
from pylons import request


#formencode.api.set_stdtranslation(domain="FormEncode", languages=["ru"])

class CurrencyForm(formencode.Schema):
    allow_extra_fields = True
    filter_extra_fields = True
    code = formencode.All(formencode.validators.String(not_empty=True, strip=True), formencode.validators.MinLength(3), formencode.validators.MaxLength(3))
    name = formencode.All(formencode.validators.String(not_empty=True, strip=True), formencode.validators.MinLength(2))
    endword = formencode.All(formencode.validators.String(not_empty=True, strip=True))
    
        
        

