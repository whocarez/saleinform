import urllib
for i in range(0, 51):
    if i<10:
	urllib.urlretrieve('http://images.us.ciao.com/ius/images/bars/usefulness/bar_0%d.gif'%i, 'bar_0%d.gif'%i)
    else:
	urllib.urlretrieve('http://images.us.ciao.com/ius/images/bars/usefulness/bar_%d.gif'%i, 'bar_%d.gif'%i)