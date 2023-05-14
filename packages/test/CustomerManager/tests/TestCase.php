<?php

namespace Test\CustomerManager\Tests;



use Test\BaceManager\Providers\BaseManagerServiceProvider;
use Test\CustomerManager\Providers\CustomerManagerServiceProvider;
use Tests\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{

    protected function setUp(): void
    {
        parent::setUp();
        
        $this->artisan('migrate:fresh');
    }

    protected function getPackageProviders($app)
    {
        return [
            BaseManagerServiceProvider::class,
            CustomerManagerServiceProvider::class,
        ];
    }

    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('database.default', 'testbench');
        $app['config']->set('database.connections.testbench', [
            'driver'   => 'sqlite',
            'database' => ':memory:',
            'prefix'   => '',
        ]);
    }
}