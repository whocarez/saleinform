"""Setup the saleinform application"""
import logging
from saleinform.config.environment import load_environment
from saleinform.model import si

log = logging.getLogger(__name__)


def setup_app(command, conf, vars):
    """Place any commands to setup saleinform here"""
    load_environment(conf.global_conf, conf.local_conf)
    # Load the models
    si.meta.metadata.bind = si.meta.engine
    # Create the tables if they aren't there already
    si.meta.metadata.drop_all()
    si.meta.metadata.create_all(checkfirst=True)
    
