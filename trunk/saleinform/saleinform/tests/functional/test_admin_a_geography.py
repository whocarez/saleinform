from saleinform.tests import *

class TestAGeographyController(TestController):

    def test_index(self):
        response = self.app.get(url(controller='admin/a_geography', action='index'))
        # Test response...
