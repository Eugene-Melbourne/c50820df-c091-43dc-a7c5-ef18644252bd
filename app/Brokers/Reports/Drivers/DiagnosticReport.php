<?php

declare(strict_types=1);

namespace App\Brokers\Reports\Drivers;

use App\Brokers\Reports\AbstractReportProcessor;
use App\Models\NoDataBaseModels\Student;
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
        return [
            'student_name' => $student->getFullName(),
        ];
    }
}
