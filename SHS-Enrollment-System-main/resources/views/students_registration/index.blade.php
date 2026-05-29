<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Registration List</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css?v=2">
    <script src="https://kit.fontawesome.com/ae360af17e.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="icon" type="image/png" href="{{ asset('images/Um logo.png') }}">
</head>

<body>
    <div class="wrapper">
        <!-- Sidebar  -->
            @include('layouts.sidebar')
        <!-- Sidebar  -->

        <div class="main">
            <!-- Navbar -->
            @include('layouts.navbar')
            <!-- Navbar -->

            <main class="content px-3 py-2">
                <div class="container-fluid">
                    <div class="mb-3">
                        <h4>Admin Dashboard</h4>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-6 d-flex">
                            <div class="card flex-fill border-0 illustration">
                                <div class="card-body p-0 d-flex flex-fill">
                                    <div class="row g-0 w-100">
                                        <div class="col-6">
                                            <div class="p-3 m-1">
                                                <h4>Welcome Back, Admin</h4>
                                                <p class="mb-0">Admin Dashboard</p>
                                            </div>
                                        </div>
                                        <div class="col-6 align-self-end text-end">
                                            <img src="image/customer-support.jpg" class="img-fluid illustration-img"
                                                alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 d-flex">
                            @include('layouts.dash')
                        </div>
                    </div>
                    <!-- Table Element -->
                    <div class="card border-0">
                        <div class="card-header">
                            <h5 class="card-title">
                                Student Registration List
                            </h5>
                        <h6 class="card-subtitle text-muted">
                            <nav class="navbar bg-body-light">
                                <div class="container-fluid">
                                    <form role="search" method="GET" action="{{ route('students_registration.index') }}">
                                        <input class="form-control me-2" type="search" name="search" 
                                               placeholder="Search by Registration ID" aria-label="Search" 
                                               style="display: inline-block; width: 45%;"
                                               value="{{ request('search') }}">
                                        <button class="btn btn-outline-success" type="submit"><i class="fa-solid fa-magnifying-glass"></i> Search</button>
                                        <a href="{{ route('students_registration.create') }}" 
                                           class="btn btn-info ms-2" ><i class="fa-solid fa-plus"></i> Register</a>
                                    </form>
                                </div>
                            </nav>
                            @if(isset($registrations) && count($registrations) == 0)
                                <div class="alert alert-danger m-2" style="width: 170px">
                                    No results found.
                                </div>
                            @endif
                        </h6>
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Student Full Name</th>
                                        <th>Strand</th>
                                        <th>Grade Level</th>
                                        <th>Details</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($registrations as $registration)
                                        <tr>
                                            <td>{{ $registration->RegistrationID }}</td>
                                            <td>{{ $registration->FirstName }} {{$registration->MiddleName }} {{ $registration->LastName }}</td>
                                            <td>{{ $registration->Strand }}</td>
                                            <td>{{ $registration->GradeLevel }}</td>
                                            <td>
                                                <button type="button" class="btn btn-info btn-sm" style="color:black"
                                                        data-bs-toggle="modal" data-bs-target="#detailsModal{{ $registration->RegistrationID }}">
                                                    <i class="fa-solid fa-eye"></i> View Details
                                                </button>
                                            </td>
                                            <td>
                                                <a href="{{ route('students_registration.edit', $registration->RegistrationID) }}" 
                                                   class="btn btn-outline-primary btn-sm">
                                                    <i class="fa-solid fa-edit"></i> Edit
                                                </a>
                                                
                                                <button type="button" class="btn btn-outline-danger btn-sm" 
                                                        onclick="showDeleteConfirmation({{ $registration->RegistrationID }})">
                                                    <i class="fa-regular fa-trash-can"></i> Delete
                                                </button>
                                            </td>
                                        </tr>

                                        <!-- Details Modal -->
                                        <div class="modal fade" id="detailsModal{{ $registration->RegistrationID }}" tabindex="-1" 
                                             aria-labelledby="detailsModalLabel{{ $registration->RegistrationID }}" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="detailsModalLabel{{ $registration->RegistrationID }}">
                                                            Student Details - {{ $registration->FirstName }} {{ $registration->LastName }}
                                                        </h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <h6>Personal Information</h6>
                                                                <p><strong>Date of Birth:</strong> {{ $registration->DOB }}</p>
                                                                <p><strong>Gender:</strong> {{ $registration->Gender }}</p>
                                                                <p><strong>Address:</strong> {{ $registration->Address }}</p>
                                                                <p><strong>Contact No:</strong> {{ $registration->ContactNo }}</p>
                                                                <p><strong>Email:</strong> {{ $registration->Email }}</p>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <h6>Parent Information</h6>
                                                                <p><strong>Father's Name:</strong> {{ $registration->FatherFullName }}</p>
                                                                <p><strong>Father's Contact:</strong> {{ $registration->FatherContactNo }}</p>
                                                                <p><strong>Mother's Name:</strong> {{ $registration->MotherFullName }}</p>
                                                                <p><strong>Mother's Contact:</strong> {{ $registration->MotherContactNo }}</p>
                                                            </div>
                                                        </div>
                                                        <div class="row mt-3">
                                                            <div class="col-md-6">
                                                                <h6>Academic Information</h6>
                                                                <p><strong>Strand:</strong> {{ $registration->Strand }}</p>
                                                                <p><strong>Grade Level:</strong> {{ $registration->GradeLevel }}</p>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <h6>Application Status</h6>
                                                                <p><strong>Status:</strong> {{ $registration->current_status }}</p>
                                                                <p><strong>Application Date:</strong> {{ $registration->application_date }}</p>
                                                                <p><strong>Approved Date:</strong> {{ $registration->approved_date }}</p>
                                                                <p><strong>Rejected Date:</strong> {{ $registration->rejected_date }}</p>
                                                            </div>
                                                        </div>
                                                        @if($registration->Form138)
                                                            <div class="row mt-3">
                                                                <div class="col-12">
                                                                    <h6>Form 138</h6>
                                                                    <img src="{{ asset('storage/' . $registration->Form138) }}" 
                                                                         class="img-fluid" alt="Form 138">
                                                                </div>
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        @if($registration->current_status !== 'Approved')
                                                            <form action="{{ route('students_registration.update', $registration->RegistrationID) }}" 
                                                                  method="POST" class="d-inline">
                                                                @csrf
                                                                @method('PUT')
                                                                <input type="hidden" name="current_status" value="Approved">
                                                                <button type="submit" class="btn btn-success">
                                                                    <i class="fa-solid fa-check"></i> Approve
                                                                </button>
                                                            </form>
                                                            
                                                            <form action="{{ route('students_registration.update', $registration->RegistrationID) }}" 
                                                                  method="POST" class="d-inline">
                                                                @csrf
                                                                @method('PUT')
                                                                <input type="hidden" name="current_status" value="Rejected">
                                                                <button type="submit" class="btn btn-danger">
                                                                    <i class="fa-solid fa-xmark"></i> Reject
                                                                </button>
                                                            </form>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>
            
            <div class="d-flex justify-content-center mt-4">
                 {{ $registrations->appends(['search' => request('search')])->links() }}
            </div>

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
