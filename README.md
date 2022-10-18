# Livewire Throttling

[![Latest Version on Packagist](https://img.shields.io/packagist/v/f1uder/livewire-throttling.svg?style=flat-square)](https://packagist.org/packages/f1uder/laravel-notification)
[![Total Downloads](https://img.shields.io/packagist/dt/f1uder/livewire-throttling.svg?style=flat-square)](https://packagist.org/packages/f1uder/laravel-notification)


## Installation

You can install the package via composer:

```bash
composer require f1uder/livewire-throttling
```

## Usage Livewire component

```php
<?php

namespace App\Http\Livewire\Test;

use Livewire\Component;
use Nrox\LivewireThrottling\ThrottlingTrait;

class TestComponent extends Component
{
    use ThrottlingTrait; // use Trait
    
   /**
    * Thrown out ValidationException
    * name: throttle
    */
    public function test()
    {
        $this->rateLimit('10'); // Limit 10 requests per minute
    }
    
    public function testCallback()
    {
        $this->rateLimit('10', function ($sec) {
            abort(429);
        });
    }
}
```

### Clear Rate Limit
```php
$this->clearRateLimit();
```

### Lang message error (support: en)
Add Russian lang

`lang/ru.json`
```php
"Too many requests, try again in :sec seconds.": "Слишком много запросов, повторите попытку через :sec сек."
```

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
