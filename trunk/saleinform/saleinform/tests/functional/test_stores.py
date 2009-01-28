from saleinform.tests import *

class TestStoresController(TestController):

    def test_index(self):
        response = self.app.get(url(controller='stores', action='index'))
        # Test response...
