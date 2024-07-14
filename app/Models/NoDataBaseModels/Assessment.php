<?php

declare(strict_types=1);

namespace App\Models\NoDataBaseModels;

use stdClass;

class Assessment
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


    public function getName(): string
    {
        return $this->data->name;
    }
}
