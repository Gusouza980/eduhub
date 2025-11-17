<?php

namespace App\Providers;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->defineBlueprintMacros();
    }

    private function defineBlueprintMacros(): void
    {
        Blueprint::macro('addressFields', function (): Blueprint {
            /** @var Blueprint $this */
            $this->string('street', 100)->nullable();
            $this->string('number', 10)->nullable();
            $this->string('complement', 40)->nullable();
            $this->string('neighborhood', 60)->nullable();
            $this->string('city', 40)->nullable();
            $this->string('state', 2)->nullable();
            $this->string('zip_code', 8)->nullable();
            
            return $this;
        });

        Blueprint::macro('documentField', function (): Blueprint {
            /** @var Blueprint $this */
            $this->string('document', 14)->nullable();
            return $this;
        });

        Blueprint::macro('phoneField', function (): Blueprint {
            /** @var Blueprint $this */
            $this->string('phone', 15)->nullable();
            return $this;
        });
    }
}
