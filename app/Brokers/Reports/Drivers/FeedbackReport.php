<?php

declare(strict_types=1);

namespace App\Brokers\Reports\Drivers;

use App\Brokers\Reports\AbstractReportProcessor;
use App\Models\NoDataBaseModels\Collections\QuestionCollection;
use App\Models\NoDataBaseModels\Student;
use App\Models\NoDataBaseModels\StudentAssessment;
use App\Models\NoDataBaseModels\StudentResponse;
use Carbon\Carbon;
use Override;

class FeedbackReport extends AbstractReportProcessor
{


    #[Override]
    protected function getViewName(): string
    {
        return 'report_templates.feedback';
    }


    #[Override]
    protected function getReportData(Student $student): array
    {
        /** @var ?StudentAssessment $mostRecentStudentAssessment */
        $mostRecentStudentAssessment = $student
            ->getStudentAssessments()
            ->filter(fn(StudentAssessment $assessment): bool => !is_null($assessment->getCompletedAt()))
            ->sortByDesc(fn(StudentAssessment $assessment): ?Carbon => $assessment->getCompletedAt())
            ->first();

        $incorrectQuestions = $mostRecentStudentAssessment
                ?->getIncorrectStudentResponses()
                ?->map(
                    function (StudentResponse $studentResponse): array {
                        return [
                        'question_text'        => $studentResponse->getQuestion()->getQuestionText(),
                        'hint_text'            => $studentResponse->getQuestion()->getHint(),
                        'student_answer_label' => $studentResponse->getStudentAnswer()->getLabel(),
                        'student_answer_value' => $studentResponse->getStudentAnswer()->getValue(),
                        'correct_answer_label' => $studentResponse->getQuestion()->getCorrectAnswer()->getLabel(),
                        'correct_answer_value' => $studentResponse->getQuestion()->getCorrectAnswer()->getValue(),
                        ];
                    })
                ?->toArray() ?? [];

        return [
            'student_name'          => $student->getFullName(),
            'completed_at'          => $mostRecentStudentAssessment?->getCompletedAt()?->format('jS F Y h:i A'),
            'assessment_name'       => $mostRecentStudentAssessment?->getAssessment()?->getName(),
            'total_questions_count' => QuestionCollection::makeCollection()->getCollection()->count(),
            'correct_answers_count' => $mostRecentStudentAssessment?->getCorrectAnswersCount(),
            'incorrect_questions'   => $incorrectQuestions,
        ];
    }
}
