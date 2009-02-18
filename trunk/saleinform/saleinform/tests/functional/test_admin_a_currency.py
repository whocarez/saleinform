from saleinform.tests import *

class TestACurrencyController(TestController):

    def test_index(self):
        response = self.app.get(url(controller='admin/a_currency', action='index'))
        # Test response...
