from saleinform.tests import *

class TestARegionsController(TestController):

    def test_index(self):
        response = self.app.get(url(controller='admin/a_regions', action='index'))
        # Test response...
