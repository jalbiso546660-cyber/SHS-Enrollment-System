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
                        <h4>Edit Registration</h4>
                    </div>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() aAs $error)
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
                            <form method="POST" action="{{ route('students_registration.update', $registration->RegistrationID) }}" enctype="multipart/form-data" class="row g-3">
                                @csrf
                                @method('PUT')
                                
                                <div class="col-md-4">
                                    <label class="form-label">First Name</label>
                                    <input type="text" name="FirstName" value="{{ $registration->FirstName }}" class="form-control" required>
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">Middle Name</label>
                                    <input type="text" name="MiddleName" value="{{ $registration->MiddleName }}" class="form-control">
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">Last Name</label>
                                    <input type="text" name="LastName" value="{{ $registration->LastName }}" class="form-control" required>
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">Date of Birth</label>
                                    <input type="date" name="DOB" value="{{ $registration->DOB }}" class="form-control" required>
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">Gender</label>
                                    <select name="Gender" class="form-control" required>
                                        <option value="Male" {{ $registration->Gender == 'Male' ? 'selected' : '' }}>Male</option>
                                        <option value="Female" {{ $registration->Gender == 'Female' ? 'selected' : '' }}>Female</option>
                                        <option value="Other" {{ $registration->Gender == 'Other' ? 'selected' : '' }}>Other</option>
                                    </select>
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">Address</label>
                                    <input name="Address" class="form-control" required>{{ $registration->Address }}</input>
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">Contact Number</label>
                                    <input type="text" name="ContactNo" value="{{ $registration->ContactNo }}" class="form-control" required>
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">Email</label>
                                    <input type="email" name="Email" value="{{ $registration->Email }}" class="form-control" required>
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">Grade Level</label>
                                    <select name="GradeLevel" class="form-control" required>
                                        <option value="Grade 11" {{ $registration->GradeLevel == 'Grade 11' ? 'selected' : '' }}>Grade 11</option>
                                        <option value="Grade 12" {{ $registration->GradeLevel == 'Grade 12' ? 'selected' : '' }}>Grade 12</option>
                                    </select>
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">Current Form 138</label>
                                    @if($registration->Form138)
                                        <a href="{{ asset('storage/' . $registration->Form138) }}" target="_blank">View File</a>
                                    @else
                                        <p>No file uploaded</p>
                                    @endif
                                </div>
                                
                                <div class="col-md-4">
                                    <label class="form-label">Upload New Form 138</label>
                                    <input type="file" name="Form138" class="form-control" accept=".pdf,.jpg,.png,.jpeg">
                                </div>
                                

                                <div class="col-md-4">
                                    <label class="form-label">Strand</label>
                                    <select name="Strand" class="form-control" required>
                                        <option value="STEM" {{ $registration->Strand == 'STEM' ? 'selected' : '' }}>STEM</option>
                                        <option value="ABM" {{ $registration->Strand == 'ABM' ? 'selected' : '' }}>ABM</option>
                                        <option value="HUMSS" {{ $registration->Strand == 'HUMSS' ? 'selected' : '' }}>HUMSS</option>
                                    </select>
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">Father's Full Name</label>
                                    <input type="text" name="FatherFullName" value="{{ $registration->FatherFullName }}" class="form-control" required>
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">Mother's Full Name</label>
                                    <input type="text" name="MotherFullName" value="{{ $registration->MotherFullName }}" class="form-control" required>
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">Father's Contact Number</label>
                                    <input type="text" name="FatherContactNo" value="{{ $registration->FatherContactNo }}" class="form-control" required>
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">Mother's Contact Number</label>
                                    <input type="text" name="MotherContactNo" value="{{ $registration->MotherContactNo }}" class="form-control" required>
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">Status</label>
                                    <select name="current_status" class="form-control" required>
                                        <option value="Pending" {{ $registration->current_status == 'Pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="Approved" {{ $registration->current_status == 'Approved' ? 'selected' : '' }}>Approved</option>
                                        <option value="Rejected" {{ $registration->current_status == 'Rejected' ? 'selected' : '' }}>Rejected</option>
                                    </select>
                                </div>

                               
                                <div class="col-md-4">
                                    <label class="form-label">Application Date</label>
                                    <input type="text" class="form-control" value="{{ $registration->application_date }}" readonly>
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">Status Changed Date</label>
                                    <input type="text" class="form-control" value="{{ $registration->approved_date ?? $registration->rejected_date }}" readonly>
                                </div>

                                <div class="col-12">
                                    <button type="submit" class="btn btn-outline-success">Update Registration</button>
                                    <a href="{{ route('students_registration.index') }}" class="btn btn-outline-secondary">Cancel</a>
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