<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Registration</title>
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
                        <h4>Edit Student</h4>
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
                            <h5 class="card-title">Update Student Information</h5>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('students.update', $students->StudentID) }}" enctype="multipart/form-data" class="row g-3">
                                @csrf
                                @method('PUT')
                                
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Student Name</label>
                                    <input type="text" name="RegistrationID" value="{{ $students->registration->RegistrationID }} {{ $students->registration->FirstName }} {{ $students->registration->LastName }}" class="form-control" required>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Date of Birth</label>
                                    <input type="text" name="DOB" value="{{ $students->DOB }}" class="form-control">
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Gender</label>
                                    <select name="Gender" class="form-control" required>
                                        <option value="Male" {{ $students->Gender == 'Male' ? 'selected' : '' }}>Male</option>
                                        <option value="Female" {{ $students->Gender == 'Female' ? 'selected' : '' }}>Female</option>
                                        <option value="Other" {{ $students->Gender == 'Other' ? 'selected' : '' }}>Other</option>
                                    </select>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Address</label>
                                    <input type="text" name="Address" value="{{ $students->Address }}" class="form-control" required>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Contact Number</label>
                                    <input type="text" name="ContactNo" value="{{ $students->ContactNo }}" class="form-control" required>
                                </div>
                                
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Email</label>
                                    <input type="Email" class="form-control" value="{{ $students->Email }}" name="description" required>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Strand</label>
                                    <select name="StrandID" class="form-control" required>
                                        @foreach($strands as $strand)
                                            <option value="{{ $strand->StrandID }}" {{ $students->StrandID == $strand->StrandID ? 'selected' : '' }}>
                                                {{ $strand->Strand_Name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Grade Level</label>
                                    <select name="GradeLevel" class="form-control" required>
                                        <option value="STEM" {{ $students->GradeLevel == 'Grade 11' ? 'selected' : '' }}>Grade 11</option>
                                        <option value="ABM" {{ $students->GradeLevel == 'Grade 12' ? 'selected' : '' }}>Grade 12</option>
                                    </select>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Section</label>
                                    <input type="text" class="form-control" value="{{ $students->Section->Section_Name }}" name="SectionID" required>
                                </div>

                                <div class="col-12 mt-3">
                                    <button type="submit" class="btn btn-outline-success">Update Subject</button>
                                    <a href="{{ route('students.index') }}" class="btn btn-outline-secondary">Cancel</a>
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