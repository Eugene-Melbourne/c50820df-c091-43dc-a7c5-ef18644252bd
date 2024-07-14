<?php

declare(strict_types=1);

namespace App\Brokers\Reports;

use App\Models\NoDataBaseModels\Student;

interface ReportProcessorContract
{


    public function process(Student $student): self;


    public function getOutput(): string;
}
