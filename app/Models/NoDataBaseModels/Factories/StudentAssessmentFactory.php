<?php

declare(strict_types=1);

namespace App\Models\NoDataBaseModels\Factories;

use App\Models\NoDataBaseModels\Collections\StudentAssessmentCollection;
use App\Models\NoDataBaseModels\Student;
use App\Models\NoDataBaseModels\StudentAssessment;
use function app;

class StudentAssessmentFactory
{


    public static function makeFactory(): self
    {
        return app(self::class);
    }


    public function findStudentAssessment(string $id): ?StudentAssessment
    {
        $studentAssessments = StudentAssessmentCollection::makeCollection()->getCollection();

        foreach ($studentAssessments as $studentAssessment) {
            if ($id === $studentAssessment->getId()) {
                return $studentAssessment;
            }
        }

        return null;
    }


    /**
     * @return array <int, StudentAssessment>
     */
    public function findStudentAssessmentsByStudent(Student $student): array
    {
        $studentAssessments = StudentAssessmentCollection::makeCollection()->getCollection();

        $result = [];
        foreach ($studentAssessments as $studentAssessment) {
            if ($student->getId() === $studentAssessment->getStudent()->getId()) {
                $result[] = $studentAssessment;
            }
        }

        return $result;
    }
}
