#-*-coding: utf-8 -*-
import formencode
from si.model import sidb
from sqlalchemy.sql import and_, or_, func
from pylons import request
from cgi import FieldStorage as FS

formencode.api.set_stdtranslation(domain="FormEncode", languages=["ru"])
class LogoValidation(formencode.validators.FancyValidator):
    def _to_python(self, value, state):
        if not isinstance(value, FS):
            raise formencode.validators.Invalid(u'Системная ошибка загрузки файлов', value, state)
        elif len(value.file.read()) > 102400: # не более 100 килобайт
            raise formencode.validators.Invalid(u'Размер логотипа не должен превышать 100К', value, state)
        elif value.type not in ['image/png', 'image/jpg', 'image/gif', 'image/jpeg']: 
            raise formencode.validators.Invalid(u'Поддерживаются только .jpg, .png и .gif файлы', value, state)
        value.file.seek(0)
        return value

class ClientlogoForm(formencode.Schema):
    allow_extra_fields = True
    filter_extra_fields = True
    logo = LogoValidation(not_empty=True)
    
        
        

