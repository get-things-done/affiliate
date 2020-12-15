<?php

namespace GetThingsDone\Affiliate\Tests;

use GetThingsDone\Affiliate\AffiliateServiceProvider;
use Illuminate\Database\Eloquent\Factories\Factory;
use Orchestra\Testbench\TestCase as Orchestra;

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

        
        include_once __DIR__.'/../database/migrations/create_affiliate_table.php.stub';
        (new \CreateAffiliateTable())->up();
    }

    protected function getUserId($id)
    {
        $type = config('affiliate.user_type') ?? 'integer';

        return [
            'integer' => [
                1 => 1,
                2 => 2,
                3 => 3,
                4 => 4,
                5 => 5,
                6 => 6,
                7 => 7,
            ],
            'uuid' => [
                1 => '05e42425-e87c-4754-a5c0-f6d3581b5a2e',
                2 => 'd770e90f-48aa-4b78-84be-667a0b3066fb',
                3 => '86a70f7d-1982-4266-b0f1-18703d8bc679',
                4 => '7beffe70-3eba-419e-b0bb-6bb09577f6f9',
                5 => 'dc4ba5c6-668a-448d-82c0-76cd22691d43',
                6 => '6794219a-c882-48a3-8c2d-c5daae7608b0',
                7 => '7f30720d-77c3-4e6c-885f-14f3785cf29f',
            ],
        ][$type][$id];
    }
}
