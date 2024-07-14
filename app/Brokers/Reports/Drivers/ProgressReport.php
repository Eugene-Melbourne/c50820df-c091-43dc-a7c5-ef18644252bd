<?php

declare(strict_types=1);

namespace App\Brokers\Reports\Drivers;

use App\Brokers\Reports\AbstractReportProcessor;
use Override;

class ProgressReport extends AbstractReportProcessor
{


    #[Override]
    protected function getViewName(): string
    {
        return 'report_templates.progress';
    }


    #[Override]
    protected function getReportData(string $studentId): array
    {
        return [
            'student_name' => 'Tony Stark',
        ];
    }
}
