<?php

declare(strict_types=1);

namespace App\Brokers\Reports\Drivers;

use App\Brokers\Reports\AbstractReportProcessor;
use App\Models\NoDataBaseModels\Student;
use App\Models\NoDataBaseModels\StudentAssessment;
use Override;

class FeedbackReport extends AbstractReportProcessor
{


    #[Override]
    protected function getViewName(): string
    {
        return 'report_templates.feedback';
    }


    #[Override]
    protected function getReportData(Student $student): array
    {
        /** @var ?StudentAssessment $mostRecent */
        $mostRecent = $student
            ->getStudentAssessments()
            ->filter(fn($assessment) => !is_null($assessment->getCompletedAt()))
            ->sortByDesc(fn($assessment) => $assessment->getCompletedAt())
            ->first();

        return [
            'student_name' => $student->getFullName(),
            'completed_at' => $mostRecent?->getCompletedAt()?->format('jS F Y h:i A'),
        ];
    }
}
