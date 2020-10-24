# 

[![Latest Version on Packagist](https://img.shields.io/packagist/v/get-things-done/affiliate.svg?style=flat-square)](https://packagist.org/packages/get-things-done/affiliate)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/get-things-done/affiliate/run-tests?label=tests)](https://github.com/get-things-done/affiliate/actions?query=workflow%3Arun-tests+branch%3Amaster)
[![Total Downloads](https://img.shields.io/packagist/dt/get-things-done/affiliate.svg?style=flat-square)](https://packagist.org/packages/get-things-done/affiliate)


This is where your description should go. Limit it to a paragraph or two. Consider adding a small example.


## Installation

You can install the package via composer:

```bash
composer require get-things-done/affiliate
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --provider="GetThingsDone\Affiliate\AffiliateServiceProvider" --tag="migrations"
php artisan migrate
```

You can publish the config file with:
```bash
php artisan vendor:publish --provider="GetThingsDone\Affiliate\AffiliateServiceProvider" --tag="config"
```

This is the contents of the published config file:

```php
return [
];
```

## Usage

``` php
//Get invite url 
$inviteUrl = \GetThingsDone\Affiliate\Affiliate::getInviteUrl($user->id);

//Get user's referral
$referral = \GetThingsDone\Affiliate\Affiliate::getReferral($user->id);

//Get user's network
$network = \GetThingsDone\Affiliate\Affiliate::getNetwork($user->id);
$networkLevel1 = $network->getByLevel(1);
```

## Testing

``` bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Cao Minh Duc](https://github.com/CaoMinhDuc)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
