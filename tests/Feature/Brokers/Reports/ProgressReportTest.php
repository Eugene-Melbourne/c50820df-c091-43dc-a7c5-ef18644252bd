<?php

declare(strict_types=1);

namespace Tests\Feature\Brokers\Reports;

use App\Brokers\Reports\Drivers\ProgressReport;
use App\Models\NoDataBaseModels\Factories\StudentFactory;
use Tests\TestCase;

class ProgressReportTest extends TestCase
{


    public function test_generate_report()
    {
        $studentId = 'student1';
        $student   = StudentFactory::makeFactory()->findStudent($studentId);

        $text = (new ProgressReport())->process($student)->getOutput();

        $expected = <<<EXPECTED
Tony Stark has completed Numeracy assessment 3 times in total. Date and raw score given below:

Date: 14th December 2019, Raw Score: 6 out of 16
Date: 14th December 2020, Raw Score: 10 out of 16
Date: 14th December 2021, Raw Score: 15 out of 16

Tony Stark got 9 more correct in the recent completed assessment than the oldest
EXPECTED;

        $this->assertSame($expected, $text);
    }
}
