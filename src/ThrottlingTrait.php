<?php

namespace Nrox\LivewireThrottling;

use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Str;
use Closure;

trait ThrottlingTrait
{
    /**
     * @var int
     */
    protected int $decaySeconds = 60;

    /**
     * @var string
     */
    protected string $templateMessage = 'Too many requests, try again in :sec: seconds';

    /**
     * @return string
     */
    protected function getThrottlingKey(): string
    {
        $fn = debug_backtrace()[1]['function'];
        $id = Auth::check() ? Auth::id() : Request::ip();

        return static::class.'|'.$fn.'|'.$id;
    }

    /**
     * @param int $maxAttempts
     * @param Closure|null $callback
     * @return void
     */
    protected function rateLimit(int $maxAttempts, Closure $callback = null)
    {
        $key = $this->getThrottlingKey();

        if (RateLimiter::tooManyAttempts($key, $maxAttempts)) {
            $secondsUntilAvailable = RateLimiter::availableIn($key);

            if ($callback) $callback();

            throw ValidationException::withMessages([
                'throttle' => [Str::replace(':sec:', $secondsUntilAvailable, $this->templateMessage)],
            ])->status(1021);
        }

        RateLimiter::hit($key, $this->decaySeconds);
    }

    /**
     * @return void
     */
    protected function clearRateLimit(): void
    {
        $key = $this->getThrottlingKey();
        RateLimiter::clear($key);
    }
}
