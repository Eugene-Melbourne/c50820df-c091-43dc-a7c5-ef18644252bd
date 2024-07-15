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


    public function getStrand(): string
    {
        return $this->data->strand;
    }


    /**
     * @throws InvalidArgumentException
     */
    public function getCorrectAnswer(): Answer
    {
        return $this->getAnswer($this->data->config->key);
    }


    /**
     * @throws InvalidArgumentException
     */
    public function getAnswer(string $answerId): Answer
    {
        $answersData = $this->data->config->options;

        $answer = AnswerFactory::makeFactory()
            ->findAnswer($answerId, $answersData);

        if (is_null($answer)) {
            throw new InvalidArgumentException('Correct Answer is missing for Question - ' . $this->getId());
        }

        return $answer;
    }
}
