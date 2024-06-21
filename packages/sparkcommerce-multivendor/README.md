# This is my package sparkcommerce-multivendor

[![Latest Version on Packagist](https://img.shields.io/packagist/v/rahat1994/sparkcommerce-multivendor.svg?style=flat-square)](https://packagist.org/packages/rahat1994/sparkcommerce-multivendor)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/rahat1994/sparkcommerce-multivendor/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/rahat1994/sparkcommerce-multivendor/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/rahat1994/sparkcommerce-multivendor/fix-php-code-styling.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/rahat1994/sparkcommerce-multivendor/actions?query=workflow%3A"Fix+PHP+code+styling"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/rahat1994/sparkcommerce-multivendor.svg?style=flat-square)](https://packagist.org/packages/rahat1994/sparkcommerce-multivendor)



This is where your description should go. Limit it to a paragraph or two. Consider adding a small example.

## Installation

1. You can install the package via composer:

```bash
composer require rahat1994/sparkcommerce-multivendor
```

2. Add the Spatie\Permission\Traits\HasRoles trait to your User model(s):

```use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
 
class User extends Authenticatable
{
    use HasRoles;
 
    // ...
}
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --tag="sparkcommerce-multivendor-migrations"
php artisan migrate
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="sparkcommerce-multivendor-config"
```

Optionally, you can publish the views using

```bash
php artisan vendor:publish --tag="sparkcommerce-multivendor-views"
```

This is the contents of the published config file:

```php
return [
];
```

## Usage

```php
$sparkcommerceMultivendor = new Rahat1994\SparkcommerceMultivendor();
echo $sparkcommerceMultivendor->echoPhrase('Hello, Rahat1994!');
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Rahat Baksh](https://github.com/rahat1994)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
