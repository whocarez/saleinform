#-*-coding: utf-8 -*-
import formencode
from saleinform.model import si
from saleinform.lib import members
from sqlalchemy.sql import and_, or_, func
from pylons import request

formencode.api.set_stdtranslation(domain="FormEncode", languages=["ru"])
class checkUser(formencode.validators.FancyValidator):
    def _to_python(self, value, state):
        u = si.meta.Session.query(func.count(si.Members.rid).label('uquan')).filter(and_(si.Members.login==value, si.Members.password==request.params.get('password')))
        if not u[0].uquan:
            raise formencode.validators.Invalid(u'Неверный логин или пароль', value, state)
        return value
    
class LoginForm(formencode.Schema):
    allow_extra_fields = True
    filter_extra_fields = True
    login = formencode.All(formencode.validators.String(not_empty=True), checkUser())
    password = formencode.validators.String()
    

class SignupForm(formencode.Schema):
    allow_extra_fields = True
    filter_extra_fields = True
    login = formencode.All(formencode.validators.String(not_empty=True))
    email = formencode.All(formencode.validators.Email(not_empty=True))
    password = formencode.All(formencode.validators.String(not_empty=True), formencode.validators.MinLength(4))
    confirm_password = formencode.validators.String(not_empty=True)
    gender = formencode.validators.String(not_empty=True) 
    chained_validators = [formencode.validators.FieldsMatch('password', 'confirm_password')]
    