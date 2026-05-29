<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Section List</title>
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
                            <h6 class="card-title">Section List</h6>
                            <nav class="navbar bg-body-light">
                                <div class="container-fluid">
                                    <form role="search" method="GET" action="{{ route('sections.index') }}">
                                        <input class="form-control me-2" type="search" name="search" 
                                               placeholder="Search by Section Name" 
                                               style="display: inline-block; width: 45%;"
                                               value="{{ request('search') }}">
                                        <button class="btn btn-outline-success" type="submit">
                                            <i class="fa-solid fa-magnifying-glass"></i> Search
                                        </button>
                                        <a href="{{ route('sections.create') }}" class="btn btn-info ms-2">
                                            <i class="fa-solid fa-plus"></i> Add Section
                                        </a>
                                    </form>
                                </div>
                            </nav>
                            @if(isset($sections) && count($sections) == 0)
                                    <div class="alert alert-danger m-2" style="width: 170px">
                                        No results found.
                                    </div>
                                @endif
                        </div>
                        
                        <div class="card-body">
                            @if(session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif
                            
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Section ID</th>
                                            <th>Section Name</th>
                                            <th>Description</th>
                                            <th>Strand</th>
                                            <th>Grade Level</th>
                                            <th>Student Count</th> <!-- Add this -->
                                            <th>Student Roster</th> <!-- Add this column in your table header -->
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($sections as $section)
                                            <tr>
                                                <td>{{ $section->SectionID }}</td>
                                                <td>{{ $section->Section_Name }}</td>
                                                <td>{{ $section->description }}</td>
                                                <td>{{ $section->strand->Strand_Name ?? 'N/A' }}</td>
                                                <td>{{ $section->Grade_Level }}</td>
                                                <td>{{ $section->students_count }}</td> <!-- Show count here -->
                                                <td>
                                                    <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#rosterModal{{ $section->SectionID }}">
                                                        View Roster ({{ $section->students_count }}/40)
                                                    </button>
                                                    <!-- Modal -->
                                                    <div class="modal fade" id="rosterModal{{ $section->SectionID }}" tabindex="-1" aria-labelledby="rosterModalLabel{{ $section->SectionID }}" aria-hidden="true">
                                                        <div class="modal-dialog modal-lg">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="rosterModalLabel{{ $section->SectionID }}">
                                                                        Students in {{ $section->Section_Name }} (max 40)
                                                                    </h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    @if($section->students->count() > 0)
                                                                        <div class="table-responsive">
                                                                            <table class="table">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th>#</th>
                                                                                        <th>Student Name</th>
                                                                                        <th>Grade Level</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                    @foreach($section->students as $count => $student)
                                                                                        <tr>
                                                                                            <td>{{ $count + 1 }}</td>
                                                                                            <td>
                                                                                                {{ $student->registration->FirstName ?? '' }}
                                                                                                {{ $student->registration->MiddleName ?? '' }}
                                                                                                {{ $student->registration->LastName ?? '' }}
                                                                                            </td>
                                                                                            <td>{{ $student->GradeLevel }}</td>
                                                                                                
                                                                                        </tr>
                                                                                    @endforeach
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    @else
                                                                        <p class="text-center">No students enrolled in this section.</p>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <a href="{{ route('sections.edit', $section->SectionID) }}" 
                                                       class="btn btn-outline-primary btn-sm">
                                                        <i class="fa-solid fa-pen"></i> Edit
                                                    </a>
                                                    <form action="{{ route('sections.destroy', $section->SectionID) }}" 
                                                        method="POST" 
                                                        style="display:inline">
                                                      @csrf
                                                      @method('DELETE')
                                                      <button type="button" class="btn btn-outline-danger btn-sm" 
                                                              onclick="showDeleteConfirmation({{ $section->SectionID }})">
                                                              <i class="fa-regular fa-trash-can"></i> Delete
                                                      </button>
                                                      
                                                      <div class="toast position-fixed top-0 start-50 translate-middle-x" 
                                                           style="z-index: 1000;" 
                                                           id="deleteToast{{ $section->SectionID }}" 
                                                           role="alert" 
                                                           aria-live="assertive" 
                                                           aria-atomic="true">
                                                          <div class="toast-body">
                                                              Are you sure you want to delete this Section?
                                                              <div class="mt-2 pt-2 border-top">
                                                                  <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                                                  <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="toast">Cancel</button>
                                                              </div>
                                                          </div>
                                                      </div>
                                                      
                                                      <script>
                                                          function showDeleteConfirmation(id) {
                                                              const toast = new bootstrap.Toast(document.getElementById('deleteToast' + id));
                                                              toast.show();
                                                          }
                                                      </script>
                                                      
                                                  </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div> <!-- end of table-responsive -->
                        </div>
                    </div>
                </div>
            </main>

            <div class="d-flex justify-content-center mt-4">
                {{ $sections->appends(['search' => request('search')])->links() }}
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
