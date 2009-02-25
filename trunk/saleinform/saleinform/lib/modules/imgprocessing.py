#-*-coding: utf-8 -*-
# Image processing
from cgi import FieldStorage
from pylons import request, config
import os, shutil, uuid, Image


class Img:
    save_path = None
    field_name = None
    
    def __init__(self, save_path):
        self.save_path = save_path
        

    def save_img(self, field_name, prefix = None, suffix = 'jpg', size=None):
        """Сохраняем все файлы в jpg
        """
        f_name = self.unique_file(suffix=suffix)
        original_image = os.path.join(config['pylons.paths']['static_files'], self.save_path, 'original', f_name)
        try:
            im = Image.open(request.params.get(field_name).file)
            if im.mode!='RGB': im = im.convert('RGB')
            im.save(original_image)
            if size:
                t_image = os.path.join(self.save_path, 'x'.join([str(x) for x in size])+'_'+f_name)
                thumb_image = os.path.join(config['pylons.paths']['static_files'], t_image)
                im.resize(size, Image.ANTIALIAS).save(thumb_image, quality=75)
                return unicode('/'+t_image)
            return unicode('/'+os.path.join(self.save_path, 'original', f_name))
        except IOError:
            print u"cannot convert image"
        
    def unique_file(self, prefix=None, suffix=None):
        fn = []
        if prefix: fn.extend([prefix, '-'])
        fn.append(str(uuid.uuid4()))
        if suffix: fn.extend(['.', suffix.lstrip('.')])
        return ''.join(fn)
        
    
    