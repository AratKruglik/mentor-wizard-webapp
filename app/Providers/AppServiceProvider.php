<?php

namespace App\Providers;

use App\Enums\RoleEnum;
use App\Models\User;
use App\Providers\TelescopeServiceProvider as VendorTelescopeServiceProvider;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;

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

        if ($this->app->isProduction()) {
            URL::forceHttps();
        }

        Gate::define('viewPulse', function (User $user) {
            return $user->hasAnyRole([RoleEnum::ADMIN, RoleEnum::SUPER_ADMIN]);
        });

        Vite::prefetch(concurrency: 3);
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
