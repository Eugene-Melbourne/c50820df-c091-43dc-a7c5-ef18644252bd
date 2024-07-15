<?php

declare(strict_types=1);

namespace App\Models\NoDataBaseModels\Collections;

use App\Models\NoDataBaseModels\Question;
use Illuminate\Support\Collection;
use function app;
use function buildPath;
use function json_decode;
use function myFileGetContents;
use function storage_path;

class QuestionCollection
{

    /**
     * @var Collection<int, Question>
     */
    private Collection $data;


    public static function makeCollection(): self
    {
        return app(self::class);
    }


    public function make(): self
    {
        $fileName = buildPath(storage_path(), 'json', 'questions.json');

        /** @var array<int,\stdClass> $records */
        $records = json_decode(
            json: myFileGetContents($fileName),
            associative: false,
            flags: JSON_THROW_ON_ERROR,
        );

        $this->data = new Collection();

        foreach ($records as $questionData) {
            $this->data->add(new Question($questionData));
        }

        return $this;
    }


    /**
     * @return Collection<int, Question>
     */
    public function getCollection(): Collection
    {
        return $this->data;
    }
}
