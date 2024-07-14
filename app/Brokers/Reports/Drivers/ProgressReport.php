<?php

declare(strict_types=1);

namespace App\Brokers\Reports\Drivers;

use App\Brokers\Reports\AbstractReportProcessor;
use App\Models\NoDataBaseModels\Student;
use Override;

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
        return [
            'student_name' => $student->getFullName(),
        ];
    }
}
