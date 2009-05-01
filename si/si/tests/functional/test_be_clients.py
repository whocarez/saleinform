from si.tests import *

class TestClientsController(TestController):

    def test_index(self):
        response = self.app.get(url(controller='be\clients', action='index'))
        # Test response...
