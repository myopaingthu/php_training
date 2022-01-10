@component('mail::message')
# Student List

@component('mail::table')
| Name | Email | Major |
| ------------- |:-------------:| --------:|
@foreach ($students as $student)
| {{$student->name}} | {{$student->email}} | {{$student->major}} |
@endforeach
@endcomponent

@component('mail::button', ['url' => 'http://localhost:8000/students'])
See More Students
@endcomponent

Thanks,<br>
Assginment 5
@endcomponent