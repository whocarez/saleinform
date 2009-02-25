#-*-coding: utf-8 -*-
import formencode
from saleinform.model import si
from sqlalchemy.sql import and_, or_, func
from pylons import request
import formencode.variabledecode as vd
from cgi import FieldStorage as FS

#formencode.api.set_stdtranslation(domain="FormEncode", languages=["ru"])
class FlagValidation(formencode.validators.FancyValidator):
    def _to_python(self, value, state):
        if not isinstance(value, FS):
            raise formencode.validators.Invalid(u'Системная ошибка загрузки файлов', value, state)
        elif len(value.file.read()) > 5120: # не более 5 килобайт
            raise formencode.validators.Invalid(u'Размер файла не должен превышать 5К', value, state)
        elif value.type not in ['image/png', 'image/jpg', 'image/jpeg', 'image/gif']: 
            raise formencode.validators.Invalid(u'Поддерживаются только .jpg, .png и .gif файлы', value, state)
        value.file.seek(0)
        return value


class CountryForm(formencode.Schema):
    allow_extra_fields = True
    filter_extra_fields = True
    code = formencode.All(formencode.validators.String(not_empty=True, strip=True), formencode.validators.MinLength(2), formencode.validators.MaxLength(2))
    name = formencode.All(formencode.validators.String(not_empty=True, strip=True), formencode.validators.MinLength(2))    
    image_name = FlagValidation()
    _currency_rid = formencode.validators.Int(not_empty=True)
    
        
        

