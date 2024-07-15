<?php

declare(strict_types=1);

namespace App\Models\NoDataBaseModels\Factories;

use App\Models\NoDataBaseModels\Assessment;
use App\Models\NoDataBaseModels\Collections\AssessmentCollection;
use function app;

class AssessmentFactory
{


    public static function makeFactory(): self
    {
        return app(self::class);
    }


    public function findAssessment(string $id): ?Assessment
    {
        return AssessmentCollection::makeCollection()
                ->getCollection()
                ->filter(function (Assessment $assessment) use ($id): bool {
                    return $assessment->getId() === $id;
                })
                ->first();
    }
}
