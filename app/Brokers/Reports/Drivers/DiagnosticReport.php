<?php

declare(strict_types=1);

namespace App\Brokers\Reports\Drivers;

use App\Brokers\Reports\AbstractReportProcessor;
use Override;

class DiagnosticReport extends AbstractReportProcessor
{


    #[Override]
    protected function getViewName(): string
    {
        return 'reports.diagnostic';
    }


    #[Override]
    protected function getReportData(string $studentId): array
    {
        return [
            'student_name' => 'Tony Stark',
        ];
    }
}
