<?php

namespace App\Providers;

use App\Models\NoDataBaseModels\Collections\AssessmentCollection;
use App\Models\NoDataBaseModels\Collections\QuestionCollection;
use App\Models\NoDataBaseModels\Collections\StudentAssessmentCollection;
use App\Models\NoDataBaseModels\Collections\StudentCollection;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{


    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(AssessmentCollection::class,
            function (): AssessmentCollection {
                return (new AssessmentCollection())->make();
            });

        $this->app->singleton(QuestionCollection::class,
            function (): QuestionCollection {
                return (new QuestionCollection())->make();
            });

        $this->app->singleton(StudentAssessmentCollection::class,
            function (): StudentAssessmentCollection {
                return (new StudentAssessmentCollection())->make();
            });

        $this->app->singleton(StudentCollection::class,
            function (): StudentCollection {
                return (new StudentCollection())->make();
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
