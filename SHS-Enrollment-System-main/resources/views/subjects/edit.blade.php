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
                        <h4>Edit Subject</h4>
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
                            <h5 class="card-title">Update Subject Information</h5>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('subjects.update', $subject->SubjectID) }}" enctype="multipart/form-data" class="row g-3">
                                @csrf
                                @method('PUT')
                                
                                <div class="col-md-4">
                                    <label class="form-label">Strand</label>
                                    <select name="StrandID" class="form-control" required>
                                        @foreach($strands as $strand)
                                            <option value="{{ $strand->StrandID }}" {{ $subject->StrandID == $strand->StrandID ? 'selected' : '' }}>
                                                {{ $strand->Strand_Name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">Subject</label>
                                    <input type="text" name="name" value="{{ $subject->name }}" class="form-control">
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">Semester</label>
                                    <input type="text" name="Semester" value="{{ $subject->Semester }}" class="form-control" required>
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">School Year</label>
                                    <input type="text" name="School_Year" value="{{ $subject->School_Year }}" class="form-control" required>
                                </div>


                                <div class="col-md-4">
                                    <label class="form-label">Grade Level</label>
                                    <select name="Grade_Level" class="form-control" required>
                                        <option value="Grade 11" {{ $subject->Grade_Level == 'Grade 11' ? 'selected' : '' }}>Grade 11</option>
                                        <option value="Grade 12" {{ $subject->Grade_Level == 'Grade 12' ? 'selected' : '' }}>Grade 12</option>
                                    </select>
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">Description</label>
                                    <input type="text" class="form-control" value="{{ $subject->description }}" name="description" required>
                                </div>

                                <div class="col-12">
                                    <button type="submit" class="btn btn-outline-success">Update Subject</button>
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