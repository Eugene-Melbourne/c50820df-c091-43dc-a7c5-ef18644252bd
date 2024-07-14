<?php

declare(strict_types=1);

namespace App\Models\NoDataBaseModels\Factories;

use App\Models\NoDataBaseModels\Assessment;
use function app;
use function buildPath;
use function json_decode;
use function myFileGetContents;
use function storage_path;

class AssessmentFactory
{


    public static function makeFactory(): self
    {
        return app(self::class);
    }


    public function findAssessment(string $id): ?Assessment
    {

        $fileName = buildPath(storage_path(), 'json', 'assessments.json');

        /** @var array<int,\stdClass> $assessments */
        $assessments = json_decode(
            json: myFileGetContents($fileName),
            associative: false,
            flags: JSON_THROW_ON_ERROR,
        );

        foreach ($assessments as $assessmentData) {
            $assessment = new Assessment($assessmentData);
            if ($id === $assessment->getId()) {
                return $assessment;
            }
        }

        return null;
    }
}
