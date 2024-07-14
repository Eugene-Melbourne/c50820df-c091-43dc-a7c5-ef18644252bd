<?php

declare(strict_types=1);

namespace App\Brokers\Reports\Drivers;

use App\Brokers\Reports\AbstractReportProcessor;
use App\Models\NoDataBaseModels\Factories\StudentAssessmentFactory;
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
        $studentAssessments = StudentAssessmentFactory::makeFactory()->findStudentAssessmentsByStudent($student);
        /** @var ?StudentAssessment $mostRecent */
        $mostRecent         = null;
        /** @var StudentAssessment $studentAssessment */
        foreach ($studentAssessments as $studentAssessment) {
            if (!is_null($studentAssessment->getCompletedAt())) {
                if (is_null($mostRecent)) {
                    $mostRecent = $studentAssessment;
                }
                // @phpstan-ignore-next-line
                if ($studentAssessment->getCompletedAt()->isAfter($mostRecent->getCompletedAt())) {
                    $mostRecent = $studentAssessment;
                }
            }
        }

        $mostRecent = null;

        return [
            'student_name' => $student->getFullName(),
            'completed_at' => $mostRecent?->getCompletedAt()?->format('jS F Y h:i A'),
        ];
    }
}
