<?php

declare(strict_types=1);

namespace App\Models\NoDataBaseModels\Factories;

use App\Models\NoDataBaseModels\Question;
use function app;
use function buildPath;
use function json_decode;
use function myFileGetContents;
use function storage_path;

class QuestionFactory
{


    public static function makeFactory(): self
    {
        return app(self::class);
    }


    public function makeQuestion(string $id): ?Question
    {
        $fileName = buildPath(storage_path(), 'json', 'questions.json');

        /** @var array<int,\stdClass> $questions */
        $questions = json_decode(
            json: myFileGetContents($fileName),
            associative: false,
            flags: JSON_THROW_ON_ERROR,
        );

        foreach ($questions as $questionData) {
            $question = new Question($questionData);
            if ($id === $question->getId()) {
                return $question;
            }
        }

        return null;
    }
}
