<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Registration</title>
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
                        <h4>Student Registration</h4>
                    </div>
                    <div class="card border-0 form-card">
                        <div class="card-header">
                            <h5 class="card-title">Register New Student</h5>
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
                            
                            <form method="POST" action="{{ route('students_registration.store') }}" enctype="multipart/form-data" class="row g-3">
                                @csrf
                                
                                <div class="col-md-4">
                                    <label class="form-label">First Name</label>
                                    <input type="text" name="FirstName" class="form-control" required>
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">Middle Name</label>
                                    <input type="text" name="MiddleName" class="form-control" required>
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">Last Name</label>
                                    <input type="text" name="LastName" class="form-control" required>
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">Date of Birth</label>
                                    <input type="date" name="DOB" class="form-control" required>
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">Gender</label>
                                    <select name="Gender" class="form-control" required>
                                        <option value="">Select Gender</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                        <option value="Other">Other</option>
                                    </select>
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">Address</label>
                                    <input type="Address" name="Address" class="form-control" required>
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">Student Contact No</label>
                                    <input type="text" name="ContactNo" class="form-control" required>
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">Email</label>
                                    <input type="email" name="Email" class="form-control" required>
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">Grade Level</label>
                                    <select name="GradeLevel" class="form-control" required>
                                        <option value="">Select Grade</option>
                                        <option value="Grade 11">Grade 11</option>
                                        <option value="Grade 12">Grade 12</option>
                                    </select>
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">Form 138</label>
                                    <input type="file" class="form-control" name="Form138">
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">Strand</label>
                                    <select name="Strand" class="form-control" required>
                                        <option value="">Select Strand</option>
                                        <option value="STEM">STEM</option>
                                        <option value="ABM">ABM</option>
                                        <option value="HUMSS">HUMSS</option>
                                    </select>
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">Father Full Name</label>
                                    <input type="text" name="FatherFullName" class="form-control" required>
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">Mother Full Name</label>
                                    <input type="text" name="MotherFullName" class="form-control" required>
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">Father Contact No</label>
                                    <input type="text" name="FatherContactNo" class="form-control" required>
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">Mother Contact No</label>
                                    <input type="text" name="MotherContactNo" class="form-control" required>
                                </div>

                                <div class="col-12">
                                    <button type="submit" class="btn btn-outline-success">Submit Registration</button>
                                    <a href="{{ route('students_registration.index') }}" class="btn btn-outline-secondary">Cancel</a>
                                </div>
                            </form>

                            <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header bg-success text-white">
                                            <h5 class="modal-title" id="successModalLabel">Student Added</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body text-center">
                                            <i class="fas fa-check-circle text-success fa-3x mb-3"></i>
                                            <p>Student has been successfully added</p>
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