<?php

namespace GetThingsDone\Affiliate\Tests;

use Orchestra\Testbench\TestCase as Orchestra;
use GetThingsDone\Affiliate\AffiliateServiceProvider;
use Illuminate\Database\Eloquent\Factories\Factory;

class TestCase extends Orchestra
{
    public function setUp(): void
    {
        parent::setUp();

        Factory::guessFactoryNamesUsing(
            fn (string $modelName) => 'GetThingsDone\\Affiliate\\Database\\Factories\\'.class_basename($modelName).'Factory'
        );
    }

    protected function getPackageProviders($app)
    {
        return [
            AffiliateServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        $app['config']->set('database.default', 'sqlite');
        $app['config']->set('database.connections.sqlite', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ]);

        /*
        include_once __DIR__.'/../database/migrations/create_affiliate_table.php.stub';
        (new \CreatePackageTable())->up();
        */
    }
}