#-*-coding: utf-8 -*-
import formencode
from saleinform.model import si
from saleinform.lib import members
from sqlalchemy.sql import and_, or_, func
from pylons import request

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
    
    