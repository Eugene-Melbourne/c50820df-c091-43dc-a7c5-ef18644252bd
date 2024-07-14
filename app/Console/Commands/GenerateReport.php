<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Models\NoDataBaseModels\Factories\StudentFactory;
use App\Models\NoDataBaseModels\ReportType;
use App\Models\NoDataBaseModels\Student;
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
     * Return 1 to indicate an error
     * Return 0 to indicate success
     */
    public function handle(): int
    {
        // Step 1: Ask for Student ID
        /** @var string $studentId */
        $studentId = $this->ask('Please enter the Student ID');

        /** @var ?Student $student */
        $student = StudentFactory::makeFactory()->findStudent($studentId);

        if (is_null($student)) {
            $this->info("Student ID: {$studentId} is not valid");

            return 1;
        }

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

        $reportType = new ReportType($reportTypeKey);

        $this->info("Generating {$reportType->getLabel()} report for Student ID: {$student->getId()}");

        $output = $reportType->getDriver()->process($student)->getOutput();

        $this->info($output);

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
