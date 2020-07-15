# yii2-ip2location

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Quality Score][ico-code-quality]][link-code-quality]
[![Total Downloads][ico-downloads]][link-downloads]

An extension that allows you to obtain the visitor's location information from any IP address. Uses IP2Location Database.
Implemented automatic database update.

## Install

Package is available on [Packagist](https://packagist.org/packages/slavkluev/yii2-ip2location),
you can install it using [Composer](http://getcomposer.org).

``` bash
composer require slavkluev/yii2-ip2location
```

## Usage

Add `ip2location` component to your configuration file.

``` php
'components' => [
    'ip2location' => [
      'class' => \slavkluev\Ip2Location\Ip2Location::class,
      'downloadToken' => 'secret',
    ],
],
```

Get information on custom IP address:

``` php
print_r(Yii::$app->ip2location->ip('127.0.0.1'));
```

Get information on user IP address:

``` php
print_r(Yii::$app->ip2location->ip());
```

You can use the free database: [IP2Location LITE BIN Data](https://lite.ip2location.com)

## Update

To update the database, use the command:

``` bash
$ yii ip2location/update
```

## Testing

``` bash
$ composer test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) and [CODE_OF_CONDUCT](CODE_OF_CONDUCT.md) for details.

## Security

If you discover any security related issues, please email slavkluev@yandex.ru instead of using the issue tracker.

## Credits

- [Viacheslav Kliuev][link-author]
- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/slavkluev/yii2-ip2location.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/slavkluev/yii2-ip2location/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/slavkluev/yii2-ip2location.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/slavkluev/yii2-ip2location.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/slavkluev/yii2-ip2location.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/slavkluev/yii2-ip2location
[link-travis]: https://travis-ci.org/slavkluev/yii2-ip2location
[link-scrutinizer]: https://scrutinizer-ci.com/g/slavkluev/yii2-ip2location/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/slavkluev/yii2-ip2location
[link-downloads]: https://packagist.org/packages/slavkluev/yii2-ip2location
[link-author]: https://github.com/slavkluev
[link-contributors]: ../../contributors
