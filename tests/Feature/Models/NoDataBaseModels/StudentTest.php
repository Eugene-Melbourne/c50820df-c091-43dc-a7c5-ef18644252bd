<?php

declare(strict_types=1);

namespace Tests\Feature\Models\NoDataBaseModels;

use App\Models\NoDataBaseModels\Factories\StudentFactory;
use Tests\TestCase;

class StudentTest extends TestCase
{


    public function test_student_factory_make_student(): void
    {
        $studentId = 'student1';
        $factory   = new StudentFactory();
        $student   = $factory->makeStudent($studentId);

        $this->assertSame($studentId, $student->getId());
        $this->assertSame('Tony Stark', $student->getFullName());
        $this->assertSame(6, $student->getYearLevel());
    }


    public function test_student_factory_make_no_student(): void
    {
        $studentId = 'studentXXX';
        $factory   = new StudentFactory();
        $student   = $factory->makeStudent($studentId);

        $this->assertNull($student);
    }
}
