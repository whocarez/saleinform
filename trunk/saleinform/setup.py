try:
    from setuptools import setup, find_packages
except ImportError:
    from ez_setup import use_setuptools
    use_setuptools()
    from setuptools import setup, find_packages

setup(
    name='saleinform',
    version='0.1',
    description='',
    author='',
    author_email='',
    #url='',
    install_requires=[
        "psycopg2",
        "Pylons>=0.9.7",
        "SQLAlchemy>=0.5",
        "FormAlchemy>=1.1",
        "Mako",
        "PIL",
    ],
    setup_requires=["PasteScript==dev,>=1.6.3dev-r7326"],
    packages=find_packages(exclude=['ez_setup']),
    include_package_data=True,
    test_suite='nose.collector',
    package_data={'saleinform': ['i18n/*/LC_MESSAGES/*.mo']},
    message_extractors = {'saleinform': [
            ('**.py', 'python', None),
            ('templates/**.mako', 'mako', None),
            ('public/**', 'ignore', None)]},
    zip_safe=False,
    paster_plugins=['PasteScript', 'Pylons'],
    entry_points="""
    [paste.app_factory]
    main = saleinform.config.middleware:make_app

    [paste.app_install]
    main = pylons.util:PylonsInstaller
    """,
)
