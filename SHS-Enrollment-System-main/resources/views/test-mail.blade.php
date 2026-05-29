<!DOCTYPE html>
<html>
<head>
    <title>Registration Approved</title>
</head>
<body>
    <h2>Hello Mr/Ms.{{ $registration->LastName }},</h2>
    
    <p>Your registration has been approved. Welcome to University of Mindanao!</p>
    
    <p>Registration Details:</p>
    <ul>
        <li><Strong>Registration ID:</Strong> {{ $registration->RegistrationID }}</li>
        <li><Strong>Name:</Strong> {{ $registration->FirstName }} {{ $registration->LastName }}</li>
        <li><Strong>Strand:</Strong> {{ $registration->Strand }}</li>
        <li><Strong>Grade Level:</Strong> {{ $registration->GradeLevel }}</li>
    </ul>

    <p>Please keep this email for your records.</p>
    <p>You can now proceed to payment.</p>
    <button><a href={{route('students_payment.create')}}>Payment</a></button>

    <p>Best regards,<br>University of Mindanao Admissions</p>
</body>
</html>