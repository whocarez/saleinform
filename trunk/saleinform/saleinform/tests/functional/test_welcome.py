from saleinform.tests import *

class TestWelcomeController(TestController):

    def test_index(self):
        response = self.app.get(url(controller='welcome', action='index'))
        # Test response...
