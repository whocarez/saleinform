from si.tests import *

class TestScatsController(TestController):

    def test_index(self):
        response = self.app.get(url(controller='scats', action='index'))
        # Test response...
