<?php

declare(strict_types=1);

namespace App\Models\NoDataBaseModels;

use App\Models\NoDataBaseModels\Factories\AssessmentFactory;
use App\Models\NoDataBaseModels\Factories\StudentFactory;
use Carbon\Carbon;
use Illuminate\Support\Collection;
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


    public function getAssignedAt(): Carbon
    {
        $datetime = $this->data->assigned ?? null;
        if (is_null($datetime)) {
            throw new InvalidArgumentException('Assigned date is missing for StudentResponse - ' . $this->getId());
        }
        $result = Carbon::createFromFormat(self::DATETIME_FORMAT, $datetime, 'UTC');
        if (is_null($result)) {
            throw new InvalidArgumentException('Assigned date is empty for StudentResponse - ' . $this->getId());
        }

        return $result;
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
     * @return Collection<int, StudentResponse>
     */
    public function getStudentResponses(): Collection
    {
        $result               = new Collection();
        $studentResponsesData = $this->data->responses;
        foreach ($studentResponsesData as $studentResponseData) {
            $result->add(new StudentResponse($studentResponseData));
        }

        return $result;
    }


    public function getAssessment(): Assessment
    {
        $assessment = AssessmentFactory::makeFactory()
            ->findAssessment($this->data->assessmentId);

        if (is_null($assessment)) {
            throw new InvalidArgumentException('Assessment is missing for StudentResponse - ' . $this->getId());
        }

        return $assessment;
    }


    public function getCorrectAnswersCount(): int
    {
        return $this
                ->getStudentResponses()
                ->filter(fn(StudentResponse $studentResponse): bool => $studentResponse->isCorrectAnswer())
                ->count();
    }


    /**
     * @return Collection<int, StudentResponse>
     */
    public function getIncorrectStudentResponses(): Collection
    {
        return $this
                ->getStudentResponses()
                ->filter(fn(StudentResponse $studentResponse): bool => !$studentResponse->isCorrectAnswer());
    }
}
