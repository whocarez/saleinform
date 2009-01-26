#-*-coding: utf-8 -*-
from saleinform.lib.base import render
class Navigator:
    def renderMainTopNavigator(self):
        return render('/modules/navigator/maintopnav.mako')

    def renderFooterNavigator(self):
        return render('/modules/navigator/footernav.mako')
