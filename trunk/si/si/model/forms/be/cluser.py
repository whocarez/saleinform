#-*-coding: utf-8 -*-
import formencode
from si.model import meta, sidb
from sqlalchemy.sql import and_, or_, func
from pylons import request

formencode.api.set_stdtranslation(domain="FormEncode", languages=["ru"])
class LoginValidation(formencode.validators.FancyValidator):
    def _to_python(self, value, state):
        login = meta.Session.query(sidb.User).filter(sidb.User.login == value).filter(sidb.User._clients_rid != request.POST.get('clrid')).all()
        if len(login):
            raise formencode.validators.Invalid(u'Уже существует такой логин. Выберите другой.', value, state)
        return value

class CluserForm(formencode.Schema):
    allow_extra_fields = True
    filter_extra_fields = True
    login = LoginValidation(not_empty=True, strip=True)
    passwd = formencode.All(formencode.validators.String(not_empty=True, strip=True), formencode.validators.MinLength(6))
    
        
        

