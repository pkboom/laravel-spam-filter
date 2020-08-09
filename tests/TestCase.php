<?php

namespace Tests;

use Orchestra\Testbench\TestCase as Orchestra;
use Pkboom\SpamFilter\SpamFilterServiceProvider;

abstract class TestCase extends Orchestra
{
    public function setUp(): void
    {
        parent::setUp();

        $this->swap('encrypter', new FakeEncrypter());
    }

    protected function getPackageProviders($app)
    {
        return [
            SpamFilterServiceProvider::class,
        ];
    }
}
