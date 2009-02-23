#-*-coding: utf-8 -*-
import formencode
from saleinform.model import si
from sqlalchemy.sql import and_, or_, func
from pylons import request

#formencode.api.set_stdtranslation(domain="FormEncode", languages=["ru"])

class ClientsForm(formencode.Schema):
    allow_extra_fields = True
    filter_extra_fields = True
    name = formencode.All(formencode.validators.String(not_empty=True, strip=True), formencode.validators.MinLength(2))
    _cities_rid = formencode.All(formencode.validators.Int(not_empty=True, strip=True))
    address = formencode.All(formencode.validators.String(not_empty=True, strip=True), formencode.validators.MinLength(2), formencode.validators.MaxLength(255))    
    phones = formencode.All(formencode.validators.IPhoneNumberValidator(not_empty=True, strip=True))
    actual_days = formencode.All(formencode.validators.Int(strip=True))
    price_email = formencode.All(formencode.validators.Email(strip=True))
    price_url = formencode.All(formencode.validators.URL(strip=True))
    contact_phones = formencode.All(formencode.validators.IPhoneNumberValidator(not_empty=True, strip=True))
    contact_email = formencode.All(formencode.validators.Email(not_empty=True, strip=True))
    contact_person = formencode.All(formencode.validators.String(not_empty=True, strip=True), formencode.validators.MaxLength(32))
    
        
        

