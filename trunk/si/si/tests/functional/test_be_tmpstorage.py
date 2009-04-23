from si.tests import *

class TestTmpstorageController(TestController):

    def test_index(self):
        response = self.app.get(url(controller='be\tmpstorage', action='index'))
        # Test response...
