<?php

declare(strict_types=1);

namespace App\Models\NoDataBaseModels\Factories;

use App\Models\NoDataBaseModels\Answer;
use function app;

class AnswerFactory
{


    public static function makeFactory(): self
    {
        return app(self::class);
    }


    /**
     * @param array<int, \stdClass> $answersData
     */
    public function findAnswer(string $id, array $answersData): ?Answer
    {
        foreach ($answersData as $answerData) {
            $answer = new Answer($answerData);
            if ($id === $answer->getId()) {
                return $answer;
            }
        }

        return null;
    }
}
