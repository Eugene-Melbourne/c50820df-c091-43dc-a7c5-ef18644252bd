<?php

declare(strict_types=1);

namespace App\Models\NoDataBaseModels\Factories;

use App\Models\NoDataBaseModels\Collections\QuestionCollection;
use App\Models\NoDataBaseModels\Question;
use function app;

class QuestionFactory
{


    public static function makeFactory(): self
    {
        return app(self::class);
    }


    public function findQuestion(string $id): ?Question
    {
        return QuestionCollection::makeCollection()
                ->getCollection()
                ->filter(function (Question $question) use ($id): bool {
                    return $question->getId() === $id;
                })
                ->first();
    }
}
