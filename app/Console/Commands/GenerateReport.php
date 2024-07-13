<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Brokers\Reports\ReportType;
use Illuminate\Console\Command;

class GenerateReport extends Command
{

    /**
     * The name and signature of the console command
     * @var string
     */
    protected $signature   = 'report:generate';
    /**
     * The console command description.
     */
    protected $description = 'Generate a report for a student';


    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        // Step 1: Ask for Student ID
        /** @var string $studentId */
        $studentId = $this->ask('Please enter the Student ID');

        // Step 2: Ask for Report Type
        /** @var array<string, string> $options */
        $options = [
            '1' => ReportType::KEY_DIAGNOSTIC,
            '2' => ReportType::KEY_PROGRESS,
            '3' => ReportType::KEY_FEEDBACK,
        ];

        $legend = self::generateLegend($options);

        /** @var string $reportTypeKey */
        $reportTypeKey = $this->choice(
            "Report to generate ({$legend})",
            $options,
            '1'
        );

        // todo: Add report generation logic here
        $reportType = new ReportType($reportTypeKey);

        // Output
        $this->info("Generating {$reportType->getLabel()} report for Student ID: {$studentId}");

        return 0;
    }


    /**
     * @param array<string, string> $options
     */
    private static function generateLegend(array $options): string
    {
        $labels = [];
        foreach ($options as $key => $reportTypeKey) {
            $reportType = new ReportType($reportTypeKey);
            $labels[]   = $key . ' for ' . $reportType->getLabel();
        }
        $label = implode(', ', $labels);
        unset($labels);

        return $label;
    }
}
