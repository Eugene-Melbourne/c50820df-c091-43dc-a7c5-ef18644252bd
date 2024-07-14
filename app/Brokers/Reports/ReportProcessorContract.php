<?php

declare(strict_types=1);

namespace App\Brokers\Reports;

interface ReportProcessorContract
{


    public function process(string $studentId): self;


    public function getOutput(): string;
}
