<?php

declare(strict_types=1);

namespace App\Brokers\Reports;

use InvalidArgumentException;
use function app;

class ReportType
{

    public const KEY_DIAGNOSTIC = 'diagnostic';
    public const KEY_PROGRESS   = 'progress';
    public const KEY_FEEDBACK   = 'feedback';


    public function __construct(
        private string $key,
    )
    {
        self::validateKey($key);
    }


    /**
     * @throws InvalidArgumentException
     */
    public static function validateKey(string $key): void
    {
        if (!in_array($key, self::availableKeyValues())) {
            throw new InvalidArgumentException('Not expected key - ' . $key);
        }
    }


    /**
     * @return array<int, string>
     */
    public static function availableKeyValues(): array
    {
        return [
            self::KEY_DIAGNOSTIC,
            self::KEY_PROGRESS,
            self::KEY_FEEDBACK,
        ];
    }


    /**
     * @throws InvalidArgumentException
     */
    public function getLabel(): string
    {
        return match ($this->key) {
            self::KEY_DIAGNOSTIC => 'Diagnostic',
            self::KEY_PROGRESS   => 'Progress',
            self::KEY_FEEDBACK   => 'Feedback',
            default              => (fn(): string => throw new InvalidArgumentException('Not expected key - ' . $this->key))(),
        };
    }


    public function getKey(): string
    {
        return $this->key;
    }


    public function getDriver(): ReportProcessorContract
    {
        return app(ReportProcessorFactory::class)->makeDriver($this);
    }
}
