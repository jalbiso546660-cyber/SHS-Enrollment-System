<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UMSHS Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/ae360af17e.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
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
                        <h4>Admin Dashboard</h4>
                    </div>
                    <div class="row">
                        <div class="container">
                            <div class="row justify-content-around">
                                <div class="col-md-4 mb-4">
                                    <div class="card normal-card h-100">
                                        <div class="card-img-container" style="height: 200px;">
                                            <img src="images/stem_logo.jpg" class="card-img-top" alt="STEM" style="width: 100%; height: 100%; object-fit: contain;">
                                        </div>
                                        <div class="card-body">
                                            <h5 class="card-title">Total STEM Students</h5>
                                            <p class="card-text">
                                                <span class="h3">{{ $stemCount }}</span>
                                                <br>
                                                <small class="text-muted">Currently Enrolled</small>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-4">
                                    <div class="card normal-card h-100">
                                        <div class="card-img-container" style="height: 200px;">
                                            <img src="images/abm_logo.jpg" class="card-img-top" alt="ABM" style="width: 100%; height: 100%; object-fit: contain;">
                                        </div>
                                        <div class="card-body">
                                            <h5 class="card-title">Total ABM Students</h5>
                                            <p class="card-text">
                                                <span class="h3">{{ $abmCount }}</span>
                                                <br>
                                                <small class="text-muted">Currently Enrolled</small>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-4">
                                    <div class="card normal-card h-100">
                                        <div class="card-img-container" style="height: 200px;">
                                            <img src="images/humss_logo.jpg" class="card-img-top" alt="HUMSS" style="width: 100%; height: 100%; object-fit: contain;">
                                        </div>
                                        <div class="card-body">
                                            <h5 class="card-title">Total HUMSS Students</h5>
                                            <p class="card-text">
                                                <span class="h3">{{ $humssCount }}</span>
                                                <br>
                                                <small class="text-muted">Currently Enrolled</small>
                                            </p>
                                        </div>
                                    </div>
                                </div>    
                            </div>
                        </div>
                    </div>

                    <!-- Table Element -->
                    <div class="card border-0">
                        <div class="card-header">
                            <h5 class="card-title">
                                Senior High School Enrollment System
                            </h5>
                            <h6 class="card-subtitle text-muted">
                                This system is for managing student enrollment in the Senior High School department(UMSHS).
                            </h6>
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Group Members</th>
                                        <th scope="col">First Name</th>
                                        <th scope="col">Last Name</th>
                                        <th scope="col">Task</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">1</th>
                                        <td>Patrick</td>
                                        <td>Albiso</td>
                                        <td>QA</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">2</th>
                                        <td>Jimmy</td>
                                        <td>Redundo</td>
                                        <td>Frontend</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">3</th>
                                        <td>Carl Lawrence</td>
                                        <td>Fernandez</td>
                                        <td>Frontend&Backend</td>
                                    </tr>
                                </tbody>
                            </table>
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
    <script src="js/script.js"></script>
</body>

</html>
