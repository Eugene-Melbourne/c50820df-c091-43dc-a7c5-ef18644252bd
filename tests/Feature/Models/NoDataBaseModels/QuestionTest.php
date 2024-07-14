<?php

declare(strict_types=1);

namespace Tests\Feature\Models\NoDataBaseModels;

use App\Models\NoDataBaseModels\Factories\QuestionFactory;
use Tests\TestCase;

class QuestionTest extends TestCase
{


    public function test_question_factory_make_question(): void
    {
        $id       = 'numeracy16';
        $factory  = new QuestionFactory();
        $question = $factory->makeQuestion($id);

        $this->assertSame($id, $question->getId());
        $expected      = "What is the 'median' of the following group of numbers 5, 21, 7, 18, 9?";
        $this->assertSame($expected, $question->getQuestionText());
        $expected      = "You must first arrange the numbers in ascending order. The median is the middle term, which in this case is 9";
        $this->assertSame($expected, $question->getHint());
        $correctAnswer = $question->getCorrectAnswer();
        $this->assertSame('option2', $correctAnswer->getId());
        $this->assertSame('B', $correctAnswer->getLabel());
        $this->assertSame('9', $correctAnswer->getValue());
    }


    public function test_question_factory_make_no_question(): void
    {
        $id       = 'numeracyXXX';
        $factory  = new QuestionFactory();
        $question = $factory->makeQuestion($id);

        $this->assertNull($question);
    }
}
