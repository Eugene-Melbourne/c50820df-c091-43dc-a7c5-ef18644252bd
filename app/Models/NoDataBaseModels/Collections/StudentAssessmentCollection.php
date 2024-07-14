<?php

declare(strict_types=1);

namespace App\Models\NoDataBaseModels\Collections;

use App\Models\NoDataBaseModels\StudentAssessment;
use Illuminate\Support\Collection;
use function app;
use function buildPath;
use function json_decode;
use function myFileGetContents;
use function storage_path;

class StudentAssessmentCollection
{

    /**
     * @var Collection<int, StudentAssessment>
     */
    private Collection $data;


    public static function makeCollection(): self
    {
        return app(self::class);
    }


    public function make(): self
    {
        $fileName = buildPath(storage_path(), 'json', 'student-responses.json');

        /** @var array<int,\stdClass> $records */
        $records = json_decode(
            json: myFileGetContents($fileName),
            associative: false,
            flags: JSON_THROW_ON_ERROR,
        );

        $this->data = new Collection();

        foreach ($records as $record) {
            $this->data->add(new StudentAssessment($record));
        }

        return $this;
    }


    /**
     * @return Collection<int, StudentAssessment>
     */
    public function getCollection(): Collection
    {
        return $this->data;
    }
}
