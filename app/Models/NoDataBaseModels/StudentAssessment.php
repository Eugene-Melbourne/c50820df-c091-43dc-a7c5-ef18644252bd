<?php

declare(strict_types=1);

namespace App\Models\NoDataBaseModels;

use App\Models\NoDataBaseModels\Factories\StudentFactory;
use InvalidArgumentException;
use stdClass;

class StudentAssessment
{


    public function __construct(
        private stdClass $data,
    )
    {

    }


    public function getId(): string
    {
        return $this->data->id;
    }


    public function getStudent(): Student
    {
        $studentId = $this->data->student->id;
        $student   = StudentFactory::makeFactory()->findStudent($studentId);

        if (is_null($student)) {
            throw new InvalidArgumentException('Student is missing for StudentResponse - ' . $this->getId());
        }

        return $student;
    }


    public function getStudentYearLevel(): int
    {
        return $this->data->student->yearLevel;
    }


    /**
     * @return array<int, StudentResponse>
     */
    public function getStudentResponses(): array
    {
        $result               = [];
        $studentResponsesData = $this->data->responses;
        foreach ($studentResponsesData as $studentResponseData) {
            $result[] = new StudentResponse($studentResponseData);
        }

        return $result;
    }
}
