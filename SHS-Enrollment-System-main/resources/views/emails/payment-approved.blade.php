<!DOCTYPE html>
<html>
<head>
    <title>Payment Approved</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; }
        .content { padding: 20px; }
        .details { margin: 20px 0; }
        .footer { margin-top: 30px; }
        .subjects { margin: 20px 0; }
        .subjects table { width: 100%; border-collapse: collapse; }
        .subjects th, .subjects td { padding: 8px; border: 1px solid #ddd; }
        .subjects th { background-color: #f5f5f5; }
        .subjects table { 
            width: 100%; 
            border-collapse: collapse; 
            margin-bottom: 20px;
        }
        .subjects th, 
        .subjects td { 
            padding: 8px; 
            border: 1px solid #ddd; 
            text-align: left;
        }
        .subjects th { 
            background-color: #f5f5f5; 
            font-weight: bold;
        }
        .subjects tr:nth-child(even) { 
            background-color: #f9f9f9; 
        }
    </style>
</head>
<body>
    <div class="content">
        <h2>Hello {{ $registration->FirstName }},</h2>
        
        <p>Your payment has been approved! Here are your enrollment details:</p>
        
        <ul>
            <li><strong>Student Name:</strong> {{ $registration->FirstName }} {{ $registration->LastName }}</li>
            <li><strong>Section:</strong> {{ $section->Section_Name }}</li>
            <li><strong>Strand:</strong> {{ $strand->Strand_Name }}</li>
            <li><strong>Grade Level:</strong> {{ $registration->GradeLevel }}</li>
            <li><strong>Room Number:</strong> {{ $room->Room_Number }}</li>
            <li><strong>Building:</strong> {{ $room->Building }}</li>   
            <li><strong>Floor:</strong> {{ $room->Floor }}</li>
            <li><strong>Payment Reference:</strong> {{ $payment->Reference_Number }}</li>
            <li><strong>Amount Paid:</strong> ₱{{ number_format($payment->Amount, 2) }}</li>
        </ul>

        <div class="subjects">
            <h3>Your Subjects for {{ $registration->GradeLevel }}</h3>
            <table>
                <thead>
                    <tr>
                        <th>Subject Name</th>
                        <th>Description</th>
                        <th>Semester</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($subjects as $subject)
                    <tr>
                        <td>{{ $subject->name }}</td>
                        <td>{{ $subject->description }}</td>
                        <td>{{ $subject->Semester }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="subjects">
            <h3>Your Class Schedule for {{ $registration->GradeLevel }}</h3>
            <table>
                <thead>
                    <tr>
                        <th>Subject</th>
                        <th>Teacher</th>
                        <th>Day</th>
                        <th>Time</th>
                        <th>Room</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($subjects as $subject)
                        @foreach($subject->schedules as $schedule)
                            <tr>
                                <td>{{ $subject->name }}</td>
                                <td>{{ $schedule->teacher->FirstName }} {{ $schedule->teacher->LastName }}</td>
                                <td>{{ $schedule->Day }}</td>
                                <td>{{ date('h:i A', strtotime($schedule->Start_Time)) }} - 
                                    {{ date('h:i A', strtotime($schedule->End_Time)) }}</td>
                                <td>{{ $schedule->room->Room_Number }}</td>
                            </tr>
                        @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>

        <p>Welcome to University of Mindanao! Your enrollment is now complete.</p>
        <p>Please keep this email for your records.</p>

        <div class="footer">
            <p>Best regards,<br>University of Mindanao</p>
        </div>
    </div>
</body>
</html>