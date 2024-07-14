<?php

declare(strict_types=1);

namespace Tests\Feature\Models\NoDataBaseModels;

use App\Models\NoDataBaseModels\Factories\StudentAssessmentFactory;
use Tests\TestCase;

class StudentAssessmentTest extends TestCase
{


    public function test_student_assessment_factory_make_student_assessment(): void
    {
        $id                = 'studentReponse1';
        $factory           = new StudentAssessmentFactory();
        $studentAssessment = $factory->findStudentAssessment($id);

        $this->assertSame($id, $studentAssessment->getId());
        $this->assertSame('student1', $studentAssessment->getStudent()->getId());
        $this->assertSame(3, $studentAssessment->getStudentYearLevel());

        $studentResponse = $studentAssessment->getStudentResponses()[0];
        $question        = $studentResponse->getQuestion();
        $this->assertSame('numeracy1', $question->getId());
        $answer          = $studentResponse->getStudentAnswer();
        $this->assertSame('option3', $answer->getId());
    }


    public function test_student_assessment_factory_make_no_student_assessment(): void
    {
        $id                = 'studentReponseXXX';
        $factory           = new StudentAssessmentFactory();
        $studentAssessment = $factory->findStudentAssessment($id);

        $this->assertNull($studentAssessment);
    }
}
