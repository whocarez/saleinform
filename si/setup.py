try:
    from setuptools import setup, find_packages
except ImportError:
    from ez_setup import use_setuptools
    use_setuptools()
    from setuptools import setup, find_packages

setup(
    name='si',
    version='0.1',
    description='',
    author='',
    author_email='',
    #url='',
    install_requires=[
        "Pylons>=0.9.6",
        "SQLAlchemy>=0.4",
        "Genshi>=0.4",
    ],
    setup_requires=["PasteScript==dev,>=1.6.3dev-r7326"],
    packages=find_packages(exclude=['ez_setup']),
    include_package_data=True,
    test_suite='nose.collector',
    package_data={'si': ['i18n/*/LC_MESSAGES/*.mo']},
    #message_extractors = {'si': [
    #        ('**.py', 'python', None),
    #        ('public/**', 'ignore', None)]},
    zip_safe=False,
    paster_plugins=['PasteScript', 'Pylons'],
    entry_points="""
    [paste.app_factory]
    main = si.config.middleware:make_app

    [paste.app_install]
    main = pylons.util:PylonsInstaller
    """,
)
