<?php

declare(strict_types=1);

namespace App\Models\NoDataBaseModels\Collections;

use App\Models\NoDataBaseModels\Assessment;
use Illuminate\Support\Collection;
use function app;
use function buildPath;
use function json_decode;
use function myFileGetContents;
use function storage_path;

class AssessmentCollection
{

    /**
     * @var Collection<int, Assessment>
     */
    private Collection $data;


    public static function makeCollection(): self
    {
        return app(self::class);
    }


    public function make(): self
    {
        $fileName = buildPath(storage_path(), 'json', 'assessments.json');

        /** @var array<int,\stdClass> $records */
        $records = json_decode(
            json: myFileGetContents($fileName),
            associative: false,
            flags: JSON_THROW_ON_ERROR,
        );

        $this->data = new Collection();

        foreach ($records as $assessmentData) {
            $this->data->add(new Assessment($assessmentData));
        }

        return $this;
    }


    /**
     * @return Collection<int, Assessment>
     */
    public function getCollection(): Collection
    {
        return $this->data;
    }
}
