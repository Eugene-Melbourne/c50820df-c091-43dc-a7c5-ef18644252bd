@forelse($assessments as $assessment)
{!! $student_name !!} has completed {!! $assessment->name !!} assessment {!! $assessment->count !!} times in total. Date and raw score given below:

@foreach($assessment->records as $record)
Date: {!! $record->assigned_at !!}, Raw Score: {!! $record->correct_answers_count !!} out of {!! $record->total_student_responses_count !!}
@endforeach

{!! $student_name !!} got 9 more correct in the recent completed assessment than the oldest
@empty
{!! $student_name !!} has completed no assessments
@endforelse