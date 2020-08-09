<?php

namespace Pkboom\SpamFilter;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\ServiceProvider;
use Spatie\Honeypot\EncryptedTime;
use Throwable;

class SpamFilterServiceProvider extends ServiceProvider
{
    public function register()
    {
        Request::macro('isSpam', function () {
            try {
                $time = new EncryptedTime($this->encrypted_time);
            } catch (Throwable $e) {
                $time = null;
            }

            return $this->missing('honeypot') ||
                $this->filled('honeypot') ||
                is_null($time) ||
                $time->isFuture();
        });
    }
}
