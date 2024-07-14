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


function buildPath(string ...$segments): string
{
    return join(DIRECTORY_SEPARATOR, $segments);
}


function myFileGetContents(string $fileName): string
{
    $content = file_get_contents($fileName);

    if ($content === false) {
        $message = '';
        $error   = error_get_last();
        if (!is_null($error)) {
            $message = json_encode(value: $error, flags: JSON_THROW_ON_ERROR);
        }
        throw new InvalidArgumentException($message);
    }

    return $content;
}

