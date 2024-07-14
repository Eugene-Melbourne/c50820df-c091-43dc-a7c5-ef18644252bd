<?php

declare(strict_types=1);

namespace App\Models\NoDataBaseModels;

use App\Models\NoDataBaseModels\Factories\QuestionFactory;
use App\Models\NoDataBaseModels\Question;
use InvalidArgumentException;
use stdClass;

class StudentResponse
{


    public function __construct(
        private stdClass $data,
    )
    {

    }


    /**
     * @throws InvalidArgumentException
     */
    public function getQuestion(): Question
    {
        $question = QuestionFactory::makeFactory()
            ->findQuestion($this->data->questionId);

        if (is_null($question)) {
            throw new InvalidArgumentException('Question is missing for StudentResponse');
        }

        return $question;
    }


    public function getStudentAnswer(): Answer
    {
        return $this->getQuestion()->getAnswer($this->data->response);
    }
}
