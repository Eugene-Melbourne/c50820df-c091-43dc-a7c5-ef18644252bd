<?php

declare(strict_types=1);

namespace App\Models\NoDataBaseModels\Factories;

use App\Models\NoDataBaseModels\StudentAssessment;
use function app;
use function buildPath;
use function json_decode;
use function myFileGetContents;
use function storage_path;

class StudentAssessmentFactory
{


    public static function makeFactory(): self
    {
        return app(self::class);
    }


    public function findStudentAssessment(string $id): ?StudentAssessment
    {
        $fileName = buildPath(storage_path(), 'json', 'student-responses.json');

        /** @var array<int,\stdClass> $studentAssessments */
        $studentAssessments = json_decode(
            json: myFileGetContents($fileName),
            associative: false,
            flags: JSON_THROW_ON_ERROR,
        );

        foreach ($studentAssessments as $studentAssessmentData) {
            $studentAssessment = new StudentAssessment($studentAssessmentData);
            if ($id === $studentAssessment->getId()) {
                return $studentAssessment;
            }
        }

        return null;
    }
}
