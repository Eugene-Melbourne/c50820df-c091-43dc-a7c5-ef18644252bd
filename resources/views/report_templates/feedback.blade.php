@if (!is_null($completed_at))
{{ $student_name }} recently completed {{ $assessment_name }} assessment on {{ $completed_at }}
He got {{ $correct_answers_count }} questions right out of {{ $total_questions_count }}. Feedback for wrong answers given below
@foreach($incorrect_questions as $incorrect_question)

@include('report_templates._question', $incorrect_question)
@endforeach
@else
{{ $student_name }} recently completed nothing
@endif
