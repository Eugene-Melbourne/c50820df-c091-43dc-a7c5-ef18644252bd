@if (!is_null($completed_at))
{{ $student_name }} recently completed {{ $assessment_name }} assessment on {{ $completed_at }}
He got {{ $correct_answers_count }} questions right out of {{ $total_questions_count }}. Feedback for wrong answers given below

Question: What is the 'median' of the following group of numbers 5, 21, 7, 18, 9?
Your answer: A with value 7
Right answer: B with value 9
Hint: You must first arrange the numbers in ascending order. The median is the middle term, which in this case is 9
@else
{{ $student_name }} recently completed nothing
@endif
