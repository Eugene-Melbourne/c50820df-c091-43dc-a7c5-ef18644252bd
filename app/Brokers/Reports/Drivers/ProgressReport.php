<?php

declare(strict_types=1);

namespace App\Brokers\Reports\Drivers;

use App\Brokers\Reports\AbstractReportProcessor;
use App\Models\NoDataBaseModels\Factories\AssessmentFactory;
use App\Models\NoDataBaseModels\Student;
use App\Models\NoDataBaseModels\StudentAssessment;
use Illuminate\Support\Collection;
use Override;
use stdClass;

class ProgressReport extends AbstractReportProcessor
{


    #[Override]
    protected function getViewName(): string
    {
        return 'report_templates.progress';
    }


    #[Override]
    protected function getReportData(Student $student): array
    {
        $assessments = $student
            ->getStudentAssessments()
            ->filter(fn(StudentAssessment $assessment): bool => !is_null($assessment->getCompletedAt()))
            ->groupBy(fn(StudentAssessment $assessment) => $assessment->getAssessment()->getId())
            ->map(
            function (Collection $studentAssessments, string $assessmentId): stdClass {

                $records = $studentAssessments
                    ->map(
                        function (StudentAssessment $assessment): stdClass {
                            return (object) [
                                'assigned_at'                  => $assessment->getAssignedAt()->format('jS F Y'),
                                'correct_answers_count'         => $assessment->getCorrectAnswersCount(),
                                'total_student_responses_count' => $assessment->getStudentResponses()->count(),
                            ];
                        })
                    ->toArray();

                return (object) [
                    'name'    => AssessmentFactory::makeFactory()->findAssessment($assessmentId)?->getName(),
                    'count'   => $studentAssessments->count(),
                    'records' => $records,
                ];
            });

        return [
            'student_name' => $student->getFullName(),
            'assessments'  => $assessments,
        ];
    }
}
