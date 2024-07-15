<?php

declare(strict_types=1);

namespace App\Brokers\Reports\Drivers;

use App\Brokers\Reports\AbstractReportProcessor;
use App\Models\NoDataBaseModels\Collections\QuestionCollection;
use App\Models\NoDataBaseModels\Student;
use App\Models\NoDataBaseModels\StudentAssessment;
use App\Models\NoDataBaseModels\StudentResponse;
use Carbon\Carbon;
use Override;

class DiagnosticReport extends AbstractReportProcessor
{


    #[Override]
    protected function getViewName(): string
    {
        return 'report_templates.diagnostic';
    }


    #[Override]
    protected function getReportData(Student $student): array
    {
        /** @var ?StudentAssessment $mostRecentStudentAssessment */
        $mostRecentStudentAssessment = $student
            ->getStudentAssessments()
            ->filter(fn(StudentAssessment $assessment): bool => !is_null($assessment->getCompletedAt()))
            ->sortByDesc(fn(StudentAssessment $assessment): ?Carbon => $assessment->getCompletedAt())
            ->first();

        $records = [];
        if (!is_null($mostRecentStudentAssessment)) {
            $strands = $mostRecentStudentAssessment
                ->getStudentResponses()
                ->groupBy(fn(StudentResponse $studentResponse) => $studentResponse->getQuestion()->getStrand());

            foreach ($strands as $strand => $collection) {
                $correctCount = $collection
                    ->filter(fn(StudentResponse $studentResponse): bool => $studentResponse->isCorrectAnswer())
                    ->count();
                $record       = (object) [
                        'strand_label'  => $strand,
                        'correct_count' => $correctCount,
                        'total_count'   => $collection->count(),
                ];
                $records[]    = $record;
            }
        }

        return [
            'student_name'          => $student->getFullName(),
            'completed_at'          => $mostRecentStudentAssessment?->getCompletedAt()?->format('jS F Y h:i A'),
            'assessment_name'       => $mostRecentStudentAssessment?->getAssessment()?->getName(),
            'total_questions_count' => QuestionCollection::makeCollection()->getCollection()->count(),
            'correct_answers_count' => $mostRecentStudentAssessment?->getCorrectAnswersCount(),
            'records'               => $records,
        ];
    }
}
