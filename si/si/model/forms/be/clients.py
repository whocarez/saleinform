#-*-coding: utf-8 -*-
import formencode
from si.model import sidb
from sqlalchemy.sql import and_, or_, func
from pylons import request
from cgi import FieldStorage as FS

formencode.api.set_stdtranslation(domain="FormEncode", languages=["ru"])

class ClientsForm(formencode.Schema):
    allow_extra_fields = True
    filter_extra_fields = True
    name = formencode.All(formencode.validators.String(not_empty=True, strip=True), formencode.validators.MinLength(2))
    _cities_rid = formencode.All(formencode.validators.Int(not_empty=True, strip=True))
    zip = formencode.All(formencode.validators.String(not_empty=True, strip=True), formencode.validators.MinLength(2), formencode.validators.MaxLength(10), formencode.validators.PostalCode())
    street = formencode.All(formencode.validators.String(not_empty=True, strip=True), formencode.validators.MinLength(2), formencode.validators.MaxLength(64))
    build = formencode.All(formencode.validators.String(not_empty=True, strip=True), formencode.validators.MinLength(1), formencode.validators.MaxLength(32))    
    wphones = formencode.All(formencode.validators.IPhoneNumberValidator(not_empty=True, strip=True))
    delivery_info = formencode.All(formencode.validators.String(not_empty=True, strip=True), formencode.validators.MinLength(5), formencode.validators.MaxLength(128))
    worktime_info = formencode.All(formencode.validators.String(not_empty=True, strip=True), formencode.validators.MinLength(5), formencode.validators.MaxLength(128))
    descr = formencode.All(formencode.validators.String(not_empty=True, strip=True), formencode.validators.MinLength(5), formencode.validators.MaxLength(255))
    pr_url = formencode.All(formencode.validators.URL(strip=True))
    contact_phones = formencode.All(formencode.validators.IPhoneNumberValidator(not_empty=True, strip=True))
    contact_email = formencode.All(formencode.validators.Email(not_empty=True, strip=True))
    contact_person = formencode.All(formencode.validators.String(not_empty=True, strip=True), formencode.validators.MaxLength(32))
    
        
        

