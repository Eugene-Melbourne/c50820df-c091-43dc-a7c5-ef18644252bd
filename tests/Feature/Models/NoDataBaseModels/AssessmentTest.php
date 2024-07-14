<?php

declare(strict_types=1);

namespace Tests\Feature\Models\NoDataBaseModels;

use App\Models\NoDataBaseModels\Factories\AssessmentFactory;
use Tests\TestCase;

class AssessmentTest extends TestCase
{


    public function test_assessment_factory_make_assessment(): void
    {
        $id       = 'assessment1';
        $factory  = new AssessmentFactory();
        $assessment = $factory->findAssessment($id);

        $this->assertSame($id, $assessment->getId());
        $this->assertSame('Numeracy', $assessment->getName());
    }


    public function test_assessment_factory_make_no_assessment(): void
    {
        $id       = 'assessmentXXX';
        $factory  = new AssessmentFactory();
        $assessment = $factory->findAssessment($id);

        $this->assertNull($assessment);
    }
}
