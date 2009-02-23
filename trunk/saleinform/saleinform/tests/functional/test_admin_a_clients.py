from saleinform.tests import *

class TestAClientsController(TestController):

    def test_index(self):
        response = self.app.get(url(controller='admin/a_clients', action='index'))
        # Test response...
