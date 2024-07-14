<?php

declare(strict_types=1);

namespace Tests\Feature\Console\Commands;

use App\Brokers\Reports\Drivers\DiagnosticReport;
use App\Brokers\Reports\ReportProcessorFactory;
use App\Models\NoDataBaseModels\ReportType;
use App\Models\NoDataBaseModels\Student;
use Mockery;
use Tests\TestCase;
use function app;

class GenerateReportTest extends TestCase
{


    public function test_generate_report_command__no_student()
    {
        // Mock user input
        $this->artisan('report:generate')
            ->expectsQuestion('Please enter the Student ID', '12345')
            ->expectsOutput('Student ID: 12345 is not valid')
            ->assertExitCode(1);
    }


    public function test_generate_report_command__success()
    {
        // Mock Processor
        $processor = Mockery::mock(DiagnosticReport::class);
        $processor
            ->shouldReceive('process')->times(1)
            ->with(Mockery::on(function (Student $argument): bool {
                    return $argument->getId() === 'student2';
                }))
            ->andReturnSelf()
            ->shouldReceive('getOutput')->once()->with()->andReturn('XXX');
        app()->instance(DiagnosticReport::class, $processor);

        // Mock Factory
        $factory = Mockery::mock(ReportProcessorFactory::class);
        $factory
            ->shouldReceive('makeDriver')
            ->times(1)
            ->with(Mockery::on(function (ReportType $argument): bool {
                    return $argument->getKey() === ReportType::KEY_DIAGNOSTIC;
                }))
            ->andReturn($processor);
        app()->instance(ReportProcessorFactory::class, $factory);

        // Mock user input
        $this->artisan('report:generate')
            ->expectsQuestion('Please enter the Student ID', 'student2')
            ->expectsQuestion('Report to generate (1 for Diagnostic, 2 for Progress, 3 for Feedback)', 'diagnostic')
            ->expectsOutput('Generating Diagnostic report for Student ID: student2')
            ->expectsOutput('XXX')
            ->assertExitCode(0);
    }
}
