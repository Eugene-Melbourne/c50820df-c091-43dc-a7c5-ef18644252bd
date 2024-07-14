<?php

declare(strict_types=1);

namespace App\Models\NoDataBaseModels;

use stdClass;

class Answer
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


    public function getLabel(): string
    {
        return $this->data->label;
    }


    public function getValue(): string
    {
        return $this->data->value;
    }
}
