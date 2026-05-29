<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Schedule Registration</title>
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
                        <h4>Schedule Registration</h4>
                    </div>
                    <div class="card border-0 form-card">
                        <div class="card-header">
                            <h5 class="card-title">Register New Schedule</h5>
                        </div>
                        <div class="card-body">
                            @if($errors->any())
                                <div class="alert alert-danger">
                                    <ul class="mb-0">
                                        @foreach($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            
                            <form method="POST" action="{{ route('schedule.store') }}" enctype="multipart/form-data" class="row g-3">
                                @csrf
                                
                                <div class="col-md-4">
                                    <label class="form-label" for="RoomID">Room</label>
                                    <select class="form-control" name="RoomID" required>
                                        <option value="">Select a Room</option>
                                        @foreach ($rooms as $room)
                                            <option value="{{ $room->RoomID }}">
                                                {{ $room->Room_Name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label" for="TeacherID">Teacher</label>
                                    <select class="form-control" name="TeacherID" required>
                                        <option value="">Select a Teacher</option>
                                        @foreach ($teachers as $teacher)
                                            <option value="{{ $teacher->TeacherID }}">
                                                {{ $teacher->Teacher_Name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label" for="SubjectID">Subject</label>
                                    <select class="form-control" name="SubjectID" required>
                                        <option value="">Select a Subject</option>
                                        @foreach ($subjects as $subject)
                                            <option value="{{ $subject->SubjectID }}">
                                                {{ $subject->Subject_Name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label" for="SectionID">Section</label>
                                    <select class="form-control" name="SectionID" required>
                                        <option value="">Select a Section</option>
                                        @foreach ($sections as $section)
                                            <option value="{{ $section->SectionID }}">
                                                {{ $section->Section_Name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">Day</label>
                                    <select name="Day" class="form-control" required>
                                        <option value="">Select a Day</option>
                                        <option value="Monday">Monday</option>
                                        <option value="Tuesday">Tuesday</option>
                                        <option value="Wednesday">Wednesday</option>
                                        <option value="Thursday">Thursday</option>
                                        <option value="Friday">Friday</option>
                                    </select>
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">Start Time</label>
                                    <input type="time" name="Start_Time" class="form-control" required>
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">End Time</label>
                                    <input type="time" name="End_Time" class="form-control" required>
                                </div>

                                <div class="col-12">
                                    <button type="submit" class="btn btn-outline-success">Submit Registration</button>
                                    <a href="{{ route('sections.index') }}" class="btn btn-outline-secondary">Cancel</a>
                                </div>
                            </form>

                            <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header bg-success text-white">
                                            <h5 class="modal-title" id="successModalLabel">Schedule Added</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body text-center">
                                            <i class="fas fa-check-circle text-success fa-3x mb-3"></i>
                                            <p>Schedule has been successfully added</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Check if success message exists
            @if(session('success'))
                var successModal = new bootstrap.Modal(document.getElementById('successModal'));
                successModal.show();
            @endif
        });
    </script>
</body>

</html>