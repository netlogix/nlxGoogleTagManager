sdGoogleTagManager
==================

This plugin implements GoogleTagManager functionality to a shopware shop

TODOs
-----

- Check functionality of plugin
- Check design of plugin
- Add tests

Running Tests
-------------

### phpunit - functional

    Not working at the moment because phpunit is functional testing and there is no running shopware installation.

    $ vendor/bin/phpunit
    
### phpunit - unit

    $ vendor/bin/phpunit -c phpunit_unit.xml.dist
    
### phpspec

phpspec should be run with the minimum supported version of PHP7.1

    $ vendor/bin/phpspec-standalone.php7.1.phar

Tracking Cookie
---------------

This Plugin will not tracking anything without a Cookie named 'cookieStrategy'.
The Cookie 'cookieStrategy' needs a value greater equqals 1 to enable tracking.

License
-------

Please see [License File](LICENSE) for more information.
