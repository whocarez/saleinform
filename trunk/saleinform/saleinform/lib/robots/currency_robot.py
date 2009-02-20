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
            if self.currency['code'] in self.CL:
                self.currenciesList.append(self.currency)
            self.currency = {}

    def characters (self, ch):
        if self.insideChar3: self.currency['code'] = ch
        if self.insideSize: self.currency['size'] = ch
        if self.insideRate: self.currency['rate'] = ch
        if self.insideChange: self.currency['change'] = ch
        if self.insideDate: self.currency['date'] = ch
        
def UA():
    URL = 'http://bank-ua.com/export/currrate.xml'
    try:
        parser = make_parser()   
        curHandler = UACurrency()
        parser.setContentHandler(curHandler)
        parser.parse(urllib2.urlopen(URL))
    except:
        return False
    
    # засовываем данные в базу
    countryRow = si.meta.Session.query(si.Countries).filter(si.Countries.code==u'UA').first()
    countryCurrency = si.meta.Session.query(si.Currency).filter(si.Currency.rid==countryRow._currency_rid).first()
    curHandler.currenciesList.append({'code':countryCurrency.code, 'size':1, 'rate':1, 'change':0, 'date':u''})
    si.meta.Session.query(si.Officialcources).filter(si.Officialcources._countries_rid==countryRow.rid).delete()
    for currency in curHandler.currenciesList:
        currencyRow = si.meta.Session.query(si.Currency).filter(si.Currency.code==currency['code']).first()
        if not currencyRow: continue
        officialCource = si.Officialcources()
        officialCource._currency_rid=currencyRow.rid
        officialCource._countries_rid=countryRow.rid
        officialCource.cource=round(float(currency['rate'])/float(currency['size']), 4)
        si.meta.Session.add(officialCource)
        si.meta.Session.commit()
    return True
        
         
    
         
            