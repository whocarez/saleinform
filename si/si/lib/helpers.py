"""Helper functions

Consists of functions to typically be used within templates, but also
available to Controllers. This module is available to both as 'h'.
"""
# Import helpers as desired, or define your own, ie:
# from webhelpers.html.tags import checkbox, password
from webhelpers.pylonslib import Flash as _Flash
from pylons import config
flash = _Flash()
import Image, os, StringIO

def img_thumb(storage_path, img_rid, content, size):
    sizeStr = str(size[0])+'x'+str(size[1])
    imName = str(img_rid)+'_'+sizeStr+'.jpg'
    if not os.path.isfile(os.path.join(config['pylons.paths']['static_files'], storage_path, imName)):
        logoImage = Image.open(StringIO.StringIO(content))
        if logoImage.mode != "RGB": logoImage = logoImage.convert("RGB")
        logoImage.thumbnail(size, Image.ANTIALIAS)
        logoImage.save(os.path.join(config['pylons.paths']['static_files'], storage_path, imName), "JPEG")
    return os.path.join('/', storage_path, imName)

    
