# Filter spams

[![Latest Stable Version](https://poser.pugx.org/pkboom/laravel-spam-filter/v/stable)](https://packagist.org/packages/pkboom/laravel-spam-filter)
[![Build Status](https://travis-ci.com/pkboom/laravel-spam-filter.svg?branch=master)](https://travis-ci.com/pkboom/laravel-spam-filter)

Using a honeypot, you can easily filter spams. This package uses [spatie/laravel-honeypot](https://github.com/spatie/laravel-honeypot) under the hood.

## Installation

You can install the package via composer:

```bash
composer require pkboom/laravel-spam-filter
```

## Usage

Place this in your form.

```html
<form>
    <input name="honeypot" type="text" value="" class="hidden" />
    <input
        name="encrypted_time"
        type="text"
        value="{{ \Spatie\Honeypot\EncryptedTime::create(now()->addSecond()) }}"
        class="hidden"
    />
    ...
</form>
```

Filter spams

```php
use Illuminate\Support\Facades\Request;

if (Request::isSpam()) {
    return response('', 400);
}
```

### Testing

```bash
composer test
```

## License

The MIT License (MIT). Please see [MIT license](http://opensource.org/licenses/MIT) for more information.
