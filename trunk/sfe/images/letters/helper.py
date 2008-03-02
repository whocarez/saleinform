import os
listDir = os.listdir('./')
for line in listDir:
	if not line == 'helper.py':
		charN = line.split('.')
		newFileName = str(ord(charN[0]))+'.gif'			
		os.rename(line, newFileName)	
