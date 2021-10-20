<?php

namespace Tjmugova\LaravelFlash\Tests;

use Tjmugova\LaravelFlash\FlashNotifier;
use Tjmugova\LaravelFlash\LaravelFlashServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

abstract class TestCase extends Orchestra
{

    protected $session;

    protected $flash;

    /**
     * Setup the test environment.
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->session = \Mockery::spy('Laracasts\Flash\SessionStore');

        $this->flash = new FlashNotifier($this->session);
    }

    /**
     * Get package providers.
     *
     * @param \Illuminate\Foundation\Application $app
     *
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [LaravelFlashServiceProvider::class];
    }

    /** @test */
    public function view_has_message_using_short_helper()
    {
        flash('Saved');

        $this->assertStringContainsString('Saved', view('flash::message')->render());
    }

    protected function assertSessionIsFlashed($times = 1)
    {
        $this->session
            ->shouldHaveReceived('flash')
            ->with('flash_notification', $this->flash->messages)
            ->times($times);
    }

    public function notificationTypes(): array
    {
        return [
            ['success'],
            ['error'],
            ['warning'],
            ['stored'],
            ['updated'],
            ['deleted'],
            ['queued'],
        ];
    }
}