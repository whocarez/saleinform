#-*-coding: utf-8 -*-
"""
Управление регионами и городами
"""
import logging

from pylons import request, response, session, tmpl_context as c
from pylons.controllers.util import abort, redirect_to
from saleinform.lib.modules.countries import CountriesList
from saleinform.lib.modules.regions import RegionsList, CitiesList
from pylons.decorators import validate
from saleinform.lib.validators import regions as v_regions

from saleinform.lib.base import BaseController, render

log = logging.getLogger(__name__)

class ARegionsController(BaseController):
    a_operation_status = None

    def index(self):
        """Рисуем дерево
        """
        c.a_countries = CountriesList().getList()
        c.a_operation_status = self.a_operation_status
        c.a_template_name = 'regions_tree.mako' 
        #self.cources()
        return render('/admin/layouts/regions.mako')

    @validate(schema=v_regions.RegionForm(), form="regions_processing")
    def regions_processing(self, rid=None):
        """Создание или редактирование регионов"""
        if rid: 
            c.a_region = RegionsList().getRegion(rid)
            c.a_template_name = 'region_edit.mako'
        else:
            c.a_template_name = 'region_add.mako'
        c.a_country = CountriesList().getCountry(request.GET.get('_countries_rid', None))
        if request.POST.get('action', None):
            self.a_operation_status = True
            if rid:
                """Редактирование"""
                if not RegionsList().processingRegions(rid): 
                    self.a_operation_status = False
            else:
                """Создание новой записи"""
                newRid = RegionsList().processingRegions()
                if not newRid: 
                    self.a_operation_status = False
                else:
                    redirect_to('rp/'+str(newRid))
        c.a_operation_status = self.a_operation_status
        return render('/admin/layouts/regions.mako')

    @validate(schema=v_regions.CityForm(), form="cities_processing")
    def cities_processing(self, rid=None):
        """Создание или редактирование записи"""
        if rid: 
            c.a_city = CitiesList().getCity(rid)
            c.a_template_name = 'city_edit.mako'
        else:
            c.a_template_name = 'city_add.mako'            
        c.a_region = RegionsList().getRegion(request.GET.get('_regions_rid', None))
        try:   
            c.a_country = CountriesList().getCountry(c.a_region._countries_rid)
        except: 
            pass         
        if request.POST.get('action', None):
            self.a_operation_status = True
            if rid:
                """Редактирование"""
                if not CitiesList().processingCities(rid): 
                    self.a_operation_status = False
            else:
                """Создание новой записи"""
                newRid = CitiesList().processingCities() 
                if not newRid: 
                    self.a_operation_status = False
                else:
                    redirect_to('rc/'+str(newRid))
        c.a_operation_status = self.a_operation_status
        return render('/admin/layouts/regions.mako')

    def rr(self, rid=None):
        """Удаление регионов"""
        RegionsList().removeRegion(rid)
        redirect_to('/admin/regions')

    def rc(self, rid=None):
        """Удаление городов"""
        CitiesList().removeCity(rid)
        redirect_to('/admin/regions')
        
    def get(self):
        country = request.GET.get('country', None)
        region = request.GET.get('region', None)
        if country:
            return self._getRegions(country)
        if region:
            return self._getCities(region)
        
    def _getRegions(self, countryRid):
        """Возвращаем регионы страны"""
        c.a_countryRid = countryRid
        c.a_regions = RegionsList().getList(countryRid)
        return render('/admin/modules/regions/regions_sublist.mako') 
            
    def _getCities(self, regionRid):
        """Возвращаем регионы страны"""
        c.a_cities = CitiesList().getList(regionRid)
        return render('/admin/modules/regions/cities_sublist.mako') 
            