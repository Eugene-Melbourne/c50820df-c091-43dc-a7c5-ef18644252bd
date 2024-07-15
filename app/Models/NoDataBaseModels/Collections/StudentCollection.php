<?php

declare(strict_types=1);

namespace App\Models\NoDataBaseModels\Collections;

use App\Models\NoDataBaseModels\Student;
use Illuminate\Support\Collection;
use function app;
use function buildPath;
use function json_decode;
use function myFileGetContents;
use function storage_path;

class StudentCollection
{

    /**
     * @var Collection<int, Student>
     */
    private Collection $data;


    public static function makeCollection(): self
    {
        return app(self::class);
    }


    public function make(): self
    {
        $fileName = buildPath(storage_path(), 'json', 'students.json');

        /** @var array<int,\stdClass> $records */
        $records = json_decode(
            json: myFileGetContents($fileName),
            associative: false,
            flags: JSON_THROW_ON_ERROR,
        );

        $this->data = new Collection();

        foreach ($records as $studentData) {
            $this->data->add(new Student($studentData));
        }

        return $this;
    }


    /**
     * @return Collection<int, Student>
     */
    public function getCollection(): Collection
    {
        return $this->data;
    }
}
