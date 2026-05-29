<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student List</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css?v=2">
    <script src="https://kit.fontawesome.com/ae360af17e.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="icon" type="image/png" href="{{ asset('images/Um logo.png') }}">
</head>

<body>
    <div class="wrapper">
        <!-- Sidebar -->
        @include('layouts.sidebar')
        <!-- Sidebar -->
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
                                Student List
                            </h5>
                            <h6 class="card-subtitle text-muted">
                                <nav class="navbar bg-body-light">
                                    <div class="container-fluid">
                                        <form role="search" method="GET" action="{{ route('students.index') }}">
                                            <input class="form-control me-2" type="search" name="search" 
                                                   placeholder="Search by Student ID" aria-label="Search" 
                                                   style="display: inline-block; width: 45%;"
                                                   value="{{ request('search') }}">
                                            <button class="btn btn-outline-success" type="submit"><i class="fa-solid fa-magnifying-glass"></i> Search</button>
                                            <a href="{{ route('students.create') }}" 
                                           class="btn btn-info ms-2"><i class="fa-solid fa-user-plus"></i> Add Student</a>
                                        </form>
                                    </div>
                                </nav>
                                @if(isset($students) && count($students) == 0)
                                    <div class="alert alert-danger m-2" style="width: 170px">
                                        No results found.
                                    </div>
                                @endif
                            </h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Student ID</th>
                                            <th>Student Name</th>
                                            <th>Contact No</th>
                                            <th>Grade Level</th>
                                            <th>Strand</th>
                                            <th>Section</th>
                                            <th>Details</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($students as $student)
                                            <tr>
                                                <td>{{ $student->StudentID }}</td>
                                                <td>
                                                    {{ $student->registration->FirstName }} 
                                                    {{ $student->registration->MiddleName }} 
                                                    {{ $student->registration->LastName }}
                                                </td>
                                                <td>{{ $student->ContactNo }}</td>
                                                <td>{{ $student->GradeLevel }}</td>
                                                <td>{{ $student->strand->Strand_Name }}</td>
                                                <td>{{ $student->section->Section_Name }}</td>
                                                <td>
                                                    <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" 
                                                            data-bs-target="#detailsModal{{ $student->StudentID }}">
                                                        <i class="fa-solid fa-eye"></i> View Details
                                                    </button>
                                                </td>
                                                <td>
                                                    <a href="{{ route('students.edit', $student->StudentID) }}" 
                                                       class="btn btn-outline-primary btn-sm">
                                                        <i class="fa-solid fa-edit"></i> Edit
                                                    </a>
                                                    
                                                    <button type="button" class="btn btn-outline-danger btn-sm" 
                                                            onclick="showDeleteConfirmation({{ $student->StudentID }})">
                                                        <i class="fa-regular fa-trash-can"></i> Delete
                                                    </button>
                                                </td>
                                            </tr>

                                            <!-- Details Modal -->
                                            <div class="modal fade" id="detailsModal{{ $student->StudentID }}" tabindex="-1" 
                                                 aria-labelledby="detailsModalLabel{{ $student->StudentID }}" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="detailsModalLabel{{ $student->StudentID }}">
                                                                Student Details - {{ $student->registration->FirstName }} {{ $student->registration->LastName }}
                                                            </h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <h6>Personal Information</h6>
                                                                    <p><strong>Student ID:</strong> {{ $student->StudentID }}</p>
                                                                    <p><strong>Full Name:</strong> {{ $student->registration->FirstName }} 
                                                                        {{ $student->registration->MiddleName }} 
                                                                        {{ $student->registration->LastName }}</p>
                                                                    <p><strong>Date of Birth:</strong> {{ $student->DOB }}</p>
                                                                    <p><strong>Gender:</strong> {{ $student->Gender }}</p>
                                                                    <p><strong>Address:</strong> {{ $student->Address }}</p>
                                                                    <p><strong>Contact No:</strong> {{ $student->ContactNo }}</p>
                                                                    <p><strong>Email:</strong> {{ $student->Email }}</p>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <h6>Academic Information</h6>
                                                                    <p><strong>Grade Level:</strong> {{ $student->GradeLevel }}</p>
                                                                    <p><strong>Strand:</strong> {{ $student->strand->Strand_Name }}</p>
                                                                    <p><strong>Section:</strong> {{ $student->section->Section_Name }}</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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
                </div>
            </main>

            <div class="d-flex justify-content-center mt-4">
                {{ $students->appends(['search' => request('search')])->links() }}
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
