<?php

namespace App\Providers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;
use App\Providers\TelescopeServiceProvider as VendorTelescopeServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        if ($this->app->environment('local') && class_exists(VendorTelescopeServiceProvider::class)) {
            $this->app->register(VendorTelescopeServiceProvider::class);
            $this->app->register(TelescopeServiceProvider::class);
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->configModels();
        $this->configDatabase();

        URL::forceHttps();
    }

    private function configModels(): void
    {
        Model::shouldBeStrict();
        Model::preventLazyLoading();
        Model::preventAccessingMissingAttributes();
        Model::preventSilentlyDiscardingAttributes();
    }

    private function configDatabase(): void
    {
        DB::prohibitDestructiveCommands($this->app->isProduction());
    }
}
