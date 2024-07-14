<?php

declare(strict_types=1);

namespace App\Brokers\Reports;

use Override;
use function view;

abstract class AbstractReportProcessor implements ReportProcessorContract
{

    protected string $output;


    abstract protected function getViewName(): string;


    /**
     * @return array<string, mixed>
     */
    abstract protected function getReportData(string $studentId): array;


    #[Override]
    public function getOutput(): string
    {
        return $this->output;
    }


    #[Override]
    public function process(string $studentId): ReportProcessorContract
    {

        $this->output = view(
            view: $this->getViewName(),
            data: $this->getReportData($studentId),
            )
            ->render();

        return $this;
    }
}
