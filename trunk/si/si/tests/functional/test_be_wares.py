from si.tests import *

class TestWaresController(TestController):

    def test_index(self):
        response = self.app.get(url(controller='be\wares', action='index'))
        # Test response...
