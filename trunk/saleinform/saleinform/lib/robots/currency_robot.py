#-*-coding: utf-8 -*-
from pylons import config
from xml.sax import make_parser
from xml.sax.handler import ContentHandler
from pylons.i18n import get_lang, set_lang, _
import urllib2
from saleinform.model import si
from saleinform.lib.modules.currency import CurrencyList 

class UACurrency(ContentHandler):
    def __init__(self):
        self.insideChar3 = False
        self.insideSize = False
        self.insideRate = False
        self.insideChange = False
        self.insideDate = False
        self.currency = {} 
        self.currenciesList = []
        self.CL = [cc.code for cc in CurrencyList().getList()]

    def startElement(self, name, attrs):
        if name == 'char3': self.insideChar3 = True
        if name == 'size': self.insideSize = True
        if name == 'rate': self.insideRate = True
        if name == 'change': self.insideChange = True
        if name == 'date': self.insideDate = True
    
    def endElement(self, name):
        if name == 'char3': self.insideChar3 = False
        if name == 'size': self.insideSize = False
        if name == 'rate': self.insideRate = False
        if name == 'change': self.insideChange = False
        if name == 'date': self.insideDate = False
        if name == 'item':
            if self.currency['char3'] in self.CL:
                self.currenciesList.append(self.currency)
            self.currency = {}

    def characters (self, ch):
        if self.insideChar3: self.currency['code'] = ch
        if self.insideSize: self.currency['size'] = ch
        if self.insideRate: self.currency['rate'] = ch
        if self.insideChange: self.currency['change'] = ch
        if self.insideDate: self.currency['date'] = ch
        
def UAParse():
    URL = 'http://bank-ua.com/export/currrate.xml'
    try:
        parser = make_parser()   
        curHandler = UACurrency()
        parser.setContentHandler(curHandler)
        parser.parse(urllib2.urlopen(URL))
        print curHandler.currenciesList
    except:
        return u'Ошибка получения данных от НБУ'

    # засовываем данные в базу
    si.meta.Session.query(si.Officialcources).\
    join((si.Countries, si.Countries.rid == si.Officialcources._countries_rid)).\
    filter(si.Countries.code=='UA').delete()
    
    countryRow = si.meta.Session.query(si.Countries).filter(si.Countries.code=='UA').first()
    
    for currency in self.currenciesList:
        currencyRow = si.meta.Session.query(si.Currency).filter(si.Currency.code==currency['char3']).first()
        if not currencyRow: continue
        officialCource = si.Officialcources()
        officialCource._currency_rid=currencyRow.rid
        officialCource._countries_rid=countryRow.rid
        officialCource.cource=currency['rate']/currency['size']
        si.meta.Session.add(officialCource)
        
         
    
UAParse()    
    
         
            