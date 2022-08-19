# Livewire Throttling

[![Latest Version on Packagist](https://img.shields.io/packagist/v/f1uder/livewire-throttling.svg?style=flat-square)](https://packagist.org/packages/f1uder/laravel-notification)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/f1uder/livewire-throttling/Fix%20PHP%20code%20style%20issues?label=code%20style)](https://github.com/f1uder/laravel-notification/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
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
    
    public function test()
    {
        $this->rateLimit('10'); // Limit 10 requests per minute
    }
    
    public function testCallback()
    {
        $this->rateLimit('10', function () {
            abort(429);
        });
    }
}
```

### Clear Rate Limit
```php
$this->clearRateLimit();
```

### Custom message error
```php
$this->templateMessage = 'Слишком много запросов, повторите попытку через :sec: сек.';
```


## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
