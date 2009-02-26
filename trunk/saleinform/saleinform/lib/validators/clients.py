#-*-coding: utf-8 -*-
import formencode
from saleinform.model import si
from sqlalchemy.sql import and_, or_, func
from pylons import request
from cgi import FieldStorage as FS

#formencode.api.set_stdtranslation(domain="FormEncode", languages=["ru"])
class LogoValidation(formencode.validators.FancyValidator):
    def _to_python(self, value, state):
        print "***************",value.type
        if not isinstance(value, FS):
            raise formencode.validators.Invalid(u'Системная ошибка загрузки файлов', value, state)
        elif len(value.file.read()) > 102400: # не более 100 килобайт
            raise formencode.validators.Invalid(u'Размер логотипа не должен превышать 100К', value, state)
        elif value.type not in ['image/png', 'image/jpg', 'image/gif', 'image/jpeg']: 
            raise formencode.validators.Invalid(u'Поддерживаются только .jpg, .png и .gif файлы', value, state)
        value.file.seek(0)
        return value

class ClientsForm(formencode.Schema):
    allow_extra_fields = True
    filter_extra_fields = True
    logo = LogoValidation()
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

class CategoriesValidation(formencode.Schema):
    def _to_python(self, value, state):
        if len(value) > 3: # не более 3 категорий
            raise formencode.validators.Invalid(u'Выберите не более 3-х категорий', value, state)
        value.file.seek(0)
        return value
    
        
class OptionsForm(formencode.Schema):
    allow_extra_fields = True
    filter_extra_fields = True
    #_categories_rid = formencode.All(formencode.validators.Set(not_emplty=True, use_set=True))
        

