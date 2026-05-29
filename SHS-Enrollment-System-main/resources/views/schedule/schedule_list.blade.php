<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Schedule List</title>
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
                            <h6 class="card-title">Schedule List</h6>
                            <nav class="navbar bg-body-light">
                                <div class="container-fluid">
                                    <form role="search" method="GET" action="{{ route('schedule.index') }}">
                                        <input class="form-control me-2" type="search" name="search" 
                                               placeholder="Search by Schedule Name" 
                                               style="display: inline-block; width: 45%;"
                                               value="{{ request('search') }}">
                                        <button class="btn btn-outline-success" type="submit">
                                            <i class="fa-solid fa-magnifying-glass"></i> Search
                                        </button>
                                        <a href="{{ route('schedule.create') }}" class="btn btn-info ms-2">
                                            <i class="fa-solid fa-plus"></i> Schedule
                                        </a>
                                    </form>
                                </div>
                            </nav>
                            @if(isset($schedules) && count($schedules) == 0)
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
                                            <th>Schedule ID</th>
                                            <th>Room</th>
                                            <th>Teacher</th>
                                            <th>Subject</th>
                                            <th>Section</th>
                                            <th>Day</th>
                                            <th>Time</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($schedules as $schedule)
                                            <tr>
                                                <td>{{ $schedule->ScheduleID }}</td>
                                                <td>{{ $schedule->room->Room_Number }}</td>
                                                <td>{{ $schedule->teacher->FirstName }} {{ $schedule->teacher->LastName }}</td>
                                                <td>{{ $schedule->subject->name }}</td>
                                                <td>{{ $schedule->section->Section_Name }}</td>
                                                <td>{{ $schedule->Day }}</td>
                                                <td>{{ date('h:i A', strtotime($schedule->Start_Time)) }} - 
                                                    {{ date('h:i A', strtotime($schedule->End_Time)) }}</td>
                                                <td>
                                                    <a href="{{ route('schedule.edit', $schedule->ScheduleID) }}" 
                                                       class="btn btn-outline-primary btn-sm">
                                                        <i class="fa-solid fa-pen"></i> Edit
                                                    </a>
                                                    <form action="{{ route('schedule.destroy', $schedule->ScheduleID) }}" 
                                                        method="POST" 
                                                        style="display:inline">
                                                      @csrf
                                                      @method('DELETE')
                                                      <button type="button" class="btn btn-outline-danger btn-sm" 
                                                              onclick="showDeleteConfirmation({{ $schedule->ScheduleID }})">
                                                              <i class="fa-regular fa-trash-can"></i> Delete
                                                      </button>
                                                      
                                                      <div class="toast position-fixed top-0 start-50 translate-middle-x" 
                                                           style="z-index: 1000;" 
                                                           id="deleteToast{{ $schedule->ScheduleID }}" 
                                                           role="alert" 
                                                           aria-live="assertive" 
                                                           aria-atomic="true">
                                                          <div class="toast-body">
                                                              Are you sure you want to delete this Schedule?
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
                            </div>
                        </div>
                    </div>
                </div>
            </main>

            <div class="d-flex justify-content-center mt-4">
                {{ $schedules->appends(['search' => request('search')])->links() }}
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
