<h1 align="center">Laravel Myanmar Phone</h1>

[![Latest Version on Packagist](https://img.shields.io/packagist/v/fawkescreatives/myanmar-phone.svg)](https://packagist.org/packages/fawkescreatives/myanmar-phone)
[![Laravel 8.x](https://img.shields.io/badge/Laravel-8.x-red.svg)](https://laravel.com/docs/8.x)
[![Laravel 9.x](https://img.shields.io/badge/Laravel-9.x-red.svg)](https://laravel.com)
[![Total Downloads](https://poser.pugx.org/fawkescreatives/myanmar-phone/downloads)](https://packagist.org/packages/fawkescreatives/myanmar-phone)
[![License](https://img.shields.io/github/license/mashape/apistatus.svg)](https://packagist.org/packages/fawkescreatives/myanmar-phone)

It is designed to format and check Myanmar phone numbers.

## Table of Contents

<p>

- [Installation](#installation)
- [Configuration](#configuration)
- [Usage](#usage)
    - [Functions](#functions)
</p>

## Installation

You can install this package via composer using this command:

```bash
composer require fawkescreatives/myanmar-phone
```

The package will automatically register itself.

```php
/*
 * Package Service Providers...
 */

MyanmarPhone\MyanmarPhoneServiceProvider::class,
```

## Configuration

You can publish the config-file with:

```bash
php artisan vendor:publish --provider="MyanmarPhone\MyanmarPhoneServiceProvider"
```

You can define default format standard at ``config/myanmar_phone.php``

## Usage

- Option 1: Use Injection
```php
use MyanmarPhone\MyanmarPhone;

public function index(MyanmarPhone $service)
{
    $phone = '09251234567';

    return $service->make($phone)->getPhoneNumber();
}
```

- Option 2: Use Facade
```php
use MyanmarPhone\Facades\MyanPhone;

public function index()
{
    $phone = '09251234567';
        
    return MyanPhone::make($phone)->getPhoneNumber();
}
```

### Functions

eg..,
```php
MyanPhone::make($phone)->format(2); // look format number in config
```

- format($format)
- formatE164()
- formatInternational()
- formatRFC3966(string $separator = null)
- formatNational(string $separator = null)
- operator($number = null)
- telecom($number = null)
- isTelenor($number = null)
- isOoredoo($number = null)
- isMpt($number = null)
- isMyTel($number = null)
- isMec($number = null)
- getCountryCode()
- getStrPhoneNumber()
- getPhoneNumber($leadingZero = true)

## Testing

You can run the tests with:

```bash
composer test
```

### License

The MIT License (MIT). Please see [License File](https://github.com/Fawkes-Creatives/myanmar-phone/blob/main/LICENSE.md) for more information.
