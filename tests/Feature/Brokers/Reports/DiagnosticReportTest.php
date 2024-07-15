<?php

declare(strict_types=1);

namespace Tests\Feature\Brokers\Reports;

use App\Brokers\Reports\Drivers\DiagnosticReport;
use App\Models\NoDataBaseModels\Factories\StudentFactory;
use Tests\TestCase;

class DiagnosticReportTest extends TestCase
{


    public function test_generate_report()
    {
        $studentId = 'student1';
        $student   = StudentFactory::makeFactory()->findStudent($studentId);

        $text = (new DiagnosticReport())->process($student)->getOutput();

        $expected = <<<EXPECTED
Tony Stark recently completed Numeracy assessment on 16th December 2021 10:46 AM
He got 15 questions right out of 16. Details by strand given below:

Numeracy and Algebra: 5 out of 5 correct
Measurement and Geometry: 7 out of 7 correct
Statistics and Probability: 3 out of 4 correct
EXPECTED;

        $this->assertSame($expected, $text);
    }
}
