<?php

declare(strict_types=1);

namespace App\Models\NoDataBaseModels;

use App\Models\NoDataBaseModels\Factories\StudentFactory;
use Carbon\Carbon;
use InvalidArgumentException;
use stdClass;

class StudentAssessment
{

    private const DATETIME_FORMAT = 'd/m/Y H:i:s';


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


    public function getAssignedAt(): ?Carbon
    {
        $datetime = $this->data->assigned ?? null;
        if (is_null($datetime)) {
            return null;
        }
        return Carbon::createFromFormat(self::DATETIME_FORMAT, $datetime, 'UTC');
    }


    public function getStartedAt(): ?Carbon
    {
        $datetime = $this->data->started ?? null;
        if (is_null($datetime)) {
            return null;
        }
        return Carbon::createFromFormat(self::DATETIME_FORMAT, $datetime, 'UTC');
    }


    public function getCompletedAt(): ?Carbon
    {
        $datetime = $this->data->completed ?? null;
        if (is_null($datetime)) {
            return null;
        }
        return Carbon::createFromFormat(self::DATETIME_FORMAT, $datetime, 'UTC');
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
