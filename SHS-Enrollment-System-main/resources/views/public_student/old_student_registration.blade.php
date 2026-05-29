<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Old Student Registration</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <div class="wrapper">
        <div class="main">
            @include('layouts.pub_navbar')

            <main class="content px-3 py-2">
                <div class="container-fluid">
                    <div class="mb-3">
                        <h4>Old Student Registration</h4>
                    </div>

                    <div class="card border-0">
                        <div class="card-header">
                            <h5 class="card-title">Enter Student ID</h5>
                        </div>
                        <div class="card-body">
                            @if(session('error'))
                                <div class="alert alert-danger">
                                    {{ session('error') }}
                                </div>
                            @endif

                            <form action="{{ route('search.student') }}" method="POST" class="mb-4">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <input type="text" name="student_id" class="form-control" placeholder="Enter Student ID" required>
                                    </div>
                                    <div class="col-md-2">
                                        <button type="submit" class="btn btn-primary">Search</button>
                                    </div>
                                </div>
                            </form>

                            @if(isset($student))
                                <form action="{{ route('old.student.register') }}" method="POST" class="row g-3">
                                    @csrf
                                    <input type="hidden" name="StudentID" value="{{ $student->StudentID }}">
                                    
                                    <div class="col-md-4">
                                        <label class="form-label">Name</label>
                                        <input type="text" class="form-control" value="{{ $student->registration->FirstName }} {{ $student->registration->LastName }}" readonly>
                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label">Current Strand</label>
                                        <input type="text" class="form-control" value="{{ $student->strand->Strand_Name }}" readonly>
                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label">Section</label>
                                        <input type="text" class="form-control" value="{{ $student->section->Section_Name }}" readonly>
                                    </div>

                                    

                                    <div class="col-md-4">
                                        <label class="form-label">Current Grade Level</label>
                                        <input type="text" class="form-control" value="{{ $student->GradeLevel }}" readonly>
                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label">New Grade Level</label>
                                        <input type="text" value="Grade 12" class="form-control" readonly>
                                        <input type="hidden" name="GradeLevel" value="Grade 12">
                                    </div>

                                    <div class="col-12">
                                        <button type="submit" class="btn btn-success">Submit Registration</button>
                                    </div>
                                </form>
                            @endif
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
</body>
</html>