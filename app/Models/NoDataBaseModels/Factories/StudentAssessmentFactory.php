<?php

declare(strict_types=1);

namespace App\Models\NoDataBaseModels\Factories;

use App\Models\NoDataBaseModels\Collections\StudentAssessmentCollection;
use App\Models\NoDataBaseModels\Student;
use App\Models\NoDataBaseModels\StudentAssessment;
use Illuminate\Support\Collection;
use function app;

class StudentAssessmentFactory
{


    public static function makeFactory(): self
    {
        return app(self::class);
    }


    public function findStudentAssessment(string $id): ?StudentAssessment
    {
        return StudentAssessmentCollection::makeCollection()
                ->getCollection()
                ->filter(function (StudentAssessment $studentAssessment) use ($id): bool {
                    return $studentAssessment->getId() === $id;
                })
                ->first();
    }


    /**
     * @return Collection <int, StudentAssessment>
     */
    public function findStudentAssessmentsByStudent(Student $student): Collection
    {
        return StudentAssessmentCollection::makeCollection()
                ->getCollection()
                ->filter(function (StudentAssessment $studentAssessment) use ($student): bool {
                    return $student->getId() === $studentAssessment->getStudent()->getId();
                });
    }
}
