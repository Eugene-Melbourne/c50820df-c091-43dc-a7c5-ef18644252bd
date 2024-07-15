<?php

declare(strict_types=1);

namespace App\Models\NoDataBaseModels\Factories;

use App\Models\NoDataBaseModels\Collections\StudentCollection;
use App\Models\NoDataBaseModels\Student;
use function app;

class StudentFactory
{


    public static function makeFactory(): self
    {
        return app(self::class);
    }


    public function findStudent(string $id): ?Student
    {
        return StudentCollection::makeCollection()
                ->getCollection()
                ->filter(function (Student $student) use ($id): bool {
                    return $student->getId() === $id;
                })
                ->first();
    }
}
