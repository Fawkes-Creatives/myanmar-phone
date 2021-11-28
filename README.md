<h1 align="center">Laravel Myanmar Phone</h1>

[![Latest Version on Packagist](https://img.shields.io/packagist/v/fawkescreatives/myanmar-phone.svg)](https://packagist.org/packages/fawkescreatives/myanmar-phone)
[![Laravel 8.x](https://img.shields.io/badge/Laravel-8.x-red.svg)](http://laravel.com)
[![Total Downloads](https://poser.pugx.org/fawkescreatives/myanmar-phone/downloads)](https://packagist.org/packages/fawkescreatives/myanmar-phone)
[![License](https://img.shields.io/github/license/mashape/apistatus.svg)](https://packagist.org/packages/fawkescreatives/myanmar-phone)

Myanmar phone number များနှင့်ပတ်သက်ပြီး format လုပ်ခြင်းနှင့် check လုပ်နိုင်ရန်ရည်ရွယ်ပြီးတည်ဆောက်သည်။

## Table of Contents

<p>

- [Installation](#installation)
- [Configuration](#configuration)
- [Usage](#usage)
    - [Functions](#functions)
</p>

## Installation

Composer ကိုသုံးပြီး Install လုပ်ပါ။

```bash
composer require fawkescreatives/myanmar-phone
```

Laravel Package Auto-Discovery မလုပ်လျှင် `config/app.php` file ထဲမှ `providers` ထဲမှာ ဒီလိုသွားထည့်ပါ။

```php
/*
 * Package Service Providers...
 */

MyanmarPhone\MyanmarPhoneServiceProvider::class,
```

## Configuration
```bash
php artisan vendor:publish --provider="MyanmarPhone\MyanmarPhoneServiceProvider"
```

``config/myanmar_phone.php`` တွင် default format standard ကိုသတ်မှတ်နိုင်သည်။

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
        
    return MyanPhone::make($phone);
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
