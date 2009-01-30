#-*-coding: utf-8 -*-
"""Setup the saleinform application"""
import logging, csv
from saleinform.config.environment import load_environment
from saleinform.model import si

log = logging.getLogger(__name__)


def setup_app(command, conf, vars):
    """Place any commands to setup saleinform here"""
    load_environment(conf.global_conf, conf.local_conf)
    # Load the models
    si.meta.metadata.bind = si.meta.engine
    # Create the tables if they aren't there already
    si.meta.metadata.drop_all()
    si.meta.metadata.create_all(checkfirst=True)
    # развертываем базу
    print "Data Loading..."
    for row in setup_reader('_categories.csv'): si._categories.insert().execute(row)
    for row in setup_reader('_catparents.csv'): si._catparents.insert().execute(row)
    for row in setup_reader('_currency.csv'): si._currency.insert().execute(row)
    for row in setup_reader('_cltypes.csv'): si._cltypes.insert().execute(row)
    for row in setup_reader('_countries.csv'): si._countries.insert().execute(row)
    for row in setup_reader('_regions.csv'): si._regions.insert().execute(row)
    for row in setup_reader('_cities.csv'): si._cities.insert().execute(row)
    for row in setup_reader('_clients.csv'): si._clients.insert().execute(row)
    
def setup_reader(csvFile, encoding="UTF-8"):
    reader = csv.DictReader(open('./saleinform/public/setup/%s'%csvFile), delimiter=';', quotechar='"')
    reader.reader = ([col.decode(encoding) for col in row] for row in reader.reader)
    return reader


class progressBar:
    def __init__(self, minValue = 0, maxValue = 10, totalWidth=12):
        self.progBar = "[]"   # This holds the progress bar string
        self.min = minValue
        self.max = maxValue
        self.span = maxValue - minValue
        self.width = totalWidth
        self.amount = 0       # When amount == max, we are 100% done 
        self.updateAmount(0)  # Build progress bar string

    def updateAmount(self, newAmount = 0):
        if newAmount < self.min: newAmount = self.min
        if newAmount > self.max: newAmount = self.max
        self.amount = newAmount

        # Figure out the new percent done, round to an integer
        diffFromMin = float(self.amount - self.min)
        percentDone = (diffFromMin / float(self.span)) * 100.0
        percentDone = round(percentDone)
        percentDone = int(percentDone)

        # Figure out how many hash bars the percentage should be
        allFull = self.width - 2
        numHashes = (percentDone / 100.0) * allFull
        numHashes = int(round(numHashes))

        # build a progress bar with hashes and spaces
        self.progBar = "[" + '#'*numHashes + ' '*(allFull-numHashes) + "]"

        # figure out where to put the percentage, roughly centered
        percentPlace = (len(self.progBar) / 2) - len(str(percentDone)) 
        percentString = str(percentDone) + "%"

        # slice the percentage into the bar
        self.progBar = self.progBar[0:percentPlace] + percentString + self.progBar[percentPlace+len(percentString):]

    def __str__(self):
        return str(self.progBar)
     