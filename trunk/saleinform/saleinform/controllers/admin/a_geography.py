#-*-coding: utf-8 -*-
import logging

from pylons import request, response, session, tmpl_context as c
from pylons.controllers.util import abort, redirect_to

from saleinform.lib.base import BaseController, render
from saleinform.model import si

log = logging.getLogger(__name__)

class AGeographyController(BaseController):

    def index(self):
        return render('/admin/layouts/geography.mako')
