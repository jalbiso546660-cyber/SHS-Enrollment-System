<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Schedule</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/ae360af17e.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="icon" type="image/png" href="{{ asset('images/Um logo.png') }}">
</head>

<body>
    <div class="wrapper">
        @include('layouts.sidebar')

        <div class="main">
            @include('layouts.navbar')

            <main class="content px-3 py-2">
                <div class="container-fluid">
                    <div class="mb-3">
                        <h4>Edit Schedule</h4>
                    </div>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="card border-0 form-card">
                        <div class="card-header">
                            <h5 class="card-title">Update Schedule Information</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('schedule.update', $schedule->ScheduleID) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Room</label>
                                        <select name="RoomID" class="form-control" required>
                                            @foreach($rooms as $room)
                                                <option value="{{ $room->RoomID }}" 
                                                    {{ $schedule->RoomID == $room->RoomID ? 'selected' : '' }}>
                                                    {{ $room->Room_Number }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Teacher</label>
                                        <select name="TeacherID" class="form-control" required>
                                            @foreach($teachers as $teacher)
                                                <option value="{{ $teacher->TeacherID }}" 
                                                    {{ $schedule->TeacherID == $teacher->TeacherID ? 'selected' : '' }}>
                                                    {{ $teacher->FirstName }} {{ $teacher->LastName }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Subject</label>
                                        <select name="SubjectID" class="form-control" required>
                                            @foreach($subjects as $subject)
                                                <option value="{{ $subject->SubjectID }}" 
                                                    {{ $schedule->SubjectID == $subject->SubjectID ? 'selected' : '' }}>
                                                    {{ $subject->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Day</label>
                                        <select name="Day" class="form-control" required>
                                            @foreach(['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'] as $day)
                                                <option value="{{ $day }}" {{ $schedule->Day == $day ? 'selected' : '' }}>
                                                    {{ $day }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Start Time</label>
                                        <input type="time" name="Start_Time" class="form-control" value="{{ date('H:i', strtotime($schedule->Start_Time)) }}" required>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">End Time</label>
                                        <input type="time" name="End_Time" class="form-control" value="{{ date('H:i', strtotime($schedule->End_Time)) }}" required>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Section</label>
                                        <select name="SectionID" class="form-control" required>
                                            @foreach($sections as $section)
                                                <option value="{{ $section->SectionID }}" 
                                                    {{ $schedule->SectionID == $section->SectionID ? 'selected' : '' }}>
                                                    {{ $section->Section_Name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-12 mt-3">
                                        <button type="submit" class="btn btn-outline-success">Update Schedule</button>
                                        <a href="{{ route('schedule.index') }}" class="btn btn-outline-secondary">Cancel</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </main>

            <a href="#" class="theme-toggle">
                <i class="fa-regular fa-moon"></i>
                <i class="fa-regular fa-sun"></i>
            </a>
            
            <!-- Footer -->
            @include('layouts.footer')
            <!-- Footer -->
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/script.js') }}"></script>
</body>

</html>