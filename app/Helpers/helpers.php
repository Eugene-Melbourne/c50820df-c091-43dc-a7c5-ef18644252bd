<?php

declare(strict_types=1);


function myEnv(string $key, mixed $default = null): string|bool|null
{
    return env($key, $default); // @phpstan-ignore-line
}


function myEnvString(string $key, mixed $default = null): string
{
    return env($key, $default); // @phpstan-ignore-line
}

