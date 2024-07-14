<?php

declare(strict_types=1);

namespace App\Models\NoDataBaseModels\Factories;

use App\Models\NoDataBaseModels\Student;
use function app;
use function buildPath;
use function json_decode;
use function myFileGetContents;
use function storage_path;

class StudentFactory
{


    public static function makeFactory(): self
    {
        return app(self::class);
    }


    public function findStudent(string $studentId): ?Student
    {
        $fileName = buildPath(storage_path(), 'json', 'students.json');

        /** @var array<int,\stdClass> $students */
        $students = json_decode(
            json: myFileGetContents($fileName),
            associative: false,
            flags: JSON_THROW_ON_ERROR,
        );

        foreach ($students as $studentData) {
            $student = new Student($studentData);
            if ($studentId === $student->getId()) {
                return $student;
            }
        }

        return null;
    }
}
