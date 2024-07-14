<?php

declare(strict_types=1);

namespace App\Brokers\Reports;

use App\Models\NoDataBaseModels\ReportType;
use App\Brokers\Reports\Drivers\DiagnosticReport;
use App\Brokers\Reports\Drivers\FeedbackReport;
use App\Brokers\Reports\Drivers\ProgressReport;
use InvalidArgumentException;
use function app;

class ReportProcessorFactory
{


    /**
     * @throws InvalidArgumentException
     */
    public static function getDriver(string $key): string
    {
        return match ($key) {
            ReportType::KEY_DIAGNOSTIC => DiagnosticReport::class,
            ReportType::KEY_PROGRESS   => ProgressReport::class,
            ReportType::KEY_FEEDBACK   => FeedbackReport::class,
            default                    => (fn(): string => throw new InvalidArgumentException('Not expected key - ' . $key))(),
        };
    }


    public function makeDriver(ReportType $reportType): ReportProcessorContract
    {
        // @phpstan-ignore-next-line
        return app(self::getDriver($reportType->getKey()));
    }
}
