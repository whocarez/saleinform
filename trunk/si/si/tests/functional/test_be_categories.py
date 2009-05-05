from si.tests import *

class TestCategoriesController(TestController):

    def test_index(self):
        response = self.app.get(url(controller='be/categories', action='index'))
        # Test response...
