<?php

declare(strict_types=1);

namespace Tests\Feature\Brokers\Reports;

use App\Brokers\Reports\Drivers\FeedbackReport;
use App\Models\NoDataBaseModels\Factories\StudentFactory;
use Tests\TestCase;

class FeedbackReportTest extends TestCase
{


    public function test_generate_report()
    {
        $studentId = 'student1';
        $student   = StudentFactory::makeFactory()->findStudent($studentId);

        $text = (new FeedbackReport())->process($student)->getOutput();

        $expected = <<<EXPECTED
Tony Stark recently completed Numeracy assessment on 16th December 2021 10:46 AM
He got 15 questions right out of 16. Feedback for wrong answers given below

Question: What is the 'median' of the following group of numbers 5, 21, 7, 18, 9?
Your answer: A with value 7
Right answer: B with value 9
Hint: You must first arrange the numbers in ascending order. The median is the middle term, which in this case is 9

EXPECTED;

        $this->assertSame($expected, $text);
    }
}
