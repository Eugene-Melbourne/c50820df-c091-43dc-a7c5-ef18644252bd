<?php

declare(strict_types=1);

namespace App\Models\NoDataBaseModels;

use stdClass;

class Student
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


    public function getFullName(): string
    {
        return $this->data->firstName . ' ' . $this->data->lastName;
    }


    public function getYearLevel(): int
    {
        return $this->data->yearLevel;
    }
}
