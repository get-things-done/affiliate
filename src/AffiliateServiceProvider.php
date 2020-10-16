<?php

namespace GetThingsDone\Affiliate;

use Illuminate\Support\ServiceProvider;
use GetThingsDone\Affiliate\Commands\AffiliateCommand;

class AffiliateServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/affiliate.php' => config_path('affiliate.php'),
            ], 'config');

            $this->publishes([
                __DIR__ . '/../resources/views' => base_path('resources/views/vendor/affiliate'),
            ], 'views');

            $migrationFileName = 'create_affiliate_table.php';
            if (! $this->migrationFileExists($migrationFileName)) {
                $this->publishes([
                    __DIR__ . "/../database/migrations/{$migrationFileName}.stub" => database_path('migrations/' . date('Y_m_d_His', time()) . '_' . $migrationFileName),
                ], 'migrations');
            }

            $this->commands([
                AffiliateCommand::class,
            ]);
        }

        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'affiliate');
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/affiliate.php', 'affiliate');
    }

    public static function migrationFileExists(string $migrationFileName): bool
    {
        $len = strlen($migrationFileName);
        foreach (glob(database_path("migrations/*.php")) as $filename) {
            if ((substr($filename, -$len) === $migrationFileName)) {
                return true;
            }
        }

        return false;
    }
}
