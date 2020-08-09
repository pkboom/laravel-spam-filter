<?php

namespace Tests;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Response;
use Spatie\Honeypot\EncryptedTime;
use Illuminate\Support\Facades\Route;

class SpamTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        Route::post('/', function () {
            if (Request::isSpam()) {
                return Response::json([], 400);
            }
        });
    }

    /** @test */
    public function it_is_a_spam_without_honeypot()
    {
        $this->post('/')
            ->assertStatus(400);
    }

    /** @test */
    public function it_is_a_spam_if_honeypost_has_any_value()
    {
        $this->post('/', [
            'matsu_honeypot' => 'some value',
        ])->assertStatus(400);
    }

    /** @test */
    public function it_is_a_spam_if_time_value_is_invalid()
    {
        $this->post('/', [
            'matsu_honeypot' => null,
            'encrypted_time' => 'invalid time',
        ])->assertStatus(400);
    }

    /** @test */
    public function it_is_a_spam_if_creating_a_reservation_takes_a_very_short_time()
    {
        $this->post('/', [
            'matsu_honeypot' => null,
            'encrypted_time' => EncryptedTime::create(now()->addSecond())->__toString(),
        ])->assertStatus(400);
    }
}
