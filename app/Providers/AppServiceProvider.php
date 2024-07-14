<?php

namespace App\Providers;

use App\Models\NoDataBaseModels\Collections\StudentAssessmentCollection;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{


    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(StudentAssessmentCollection::class,
            function (): StudentAssessmentCollection {
                return (new StudentAssessmentCollection())->make();
            });
    }


    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
