@if (!is_null($completed_at))
{!! $student_name !!} recently completed {!! $assessment_name !!} assessment on {!! $completed_at !!}
He got {!! $correct_answers_count !!} questions right out of {!! $total_questions_count !!}. Details by strand given below:

@foreach($records as $record)
{!! $record->strand_label !!}: {!! $record->correct_count !!} out of {!! $record->total_count !!} correct
@endforeach
@else
{!! $student_name !!} recently completed nothing
@endif