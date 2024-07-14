<?php

declare(strict_types=1);

namespace App\Models\NoDataBaseModels;

use App\Models\NoDataBaseModels\Factories\AnswerFactory;
use InvalidArgumentException;
use stdClass;

class Question
{


    public function __construct(
        private stdClass $data,
    )
    {

    }


    public function getId(): string
    {
        return $this->data->id;
    }


    public function getQuestionText(): string
    {
        return $this->data->stem;
    }


    public function getHint(): string
    {
        return $this->data->config->hint;
    }


    public function getCorrectAnswer(): Answer
    {
        $id          = $this->data->config->key;
        $answersData = $this->data->config->options;

        $answer = AnswerFactory::makeFactory()
            ->makeAnswer($id, $answersData);

        if (is_null($answer)) {
            throw new InvalidArgumentException('Correct Answer is missing for Question - ' . $this->getId());
        }

        return $answer;
    }
}
