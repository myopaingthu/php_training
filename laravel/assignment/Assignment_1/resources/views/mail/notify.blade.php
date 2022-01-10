@component('mail::message')
# Student Registered!

Student registration with your current email has been successfully completed in our student system.

@component('mail::button', ['url' => 'http://localhost:8000/students'])
More Info
@endcomponent

Thanks,<br>
Assginment 5
@endcomponent