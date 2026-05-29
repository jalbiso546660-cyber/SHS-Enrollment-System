<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Room</title>
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
                            <form action="{{ route('room.update', $room->RoomID) }}" method="POST">
                                @csrf
                                @method('PUT')
                                
				                <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Room Number</label>
                                    <input type="text" name="Room_Number" class="form-control" value="{{ $room->Room_Number }}" required>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Building</label>
                                    <input type="text" name="Building" class="form-control" value="{{ $room->Building }}" required>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Floor</label>
                                    <input type="text" name="Floor" class="form-control" value="{{ $room->Floor }}" required>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Room Type</label>
                                    <input type="text" name="Room_Type" class="form-control" value="{{ $room->Room_Type }}" required>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Strand</label>
                                    <select name="StrandID" class="form-control" required>
                                        @foreach($strands as $strand)
                                            <option value="{{ $strand->StrandID }}" 
                                                {{ $room->StrandID == $strand->StrandID ? 'selected' : '' }}>
                                                {{ $strand->Strand_Name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Grade Level</label>
                                    <select name="Grade_Level" class="form-control" required>
                                        <option value="Grade 11" {{ $room->Grade_Level == 'Grade 11' ? 'selected' : '' }}>Grade 11</option>
                                        <option value="Grade 12" {{ $room->Grade_Level == 'Grade 12' ? 'selected' : '' }}>Grade 12</option>
                                    </select>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Capacity</label>
                                    <input type="number" name="Capacity" class="form-control" value="{{ $room->Capacity }}" required>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Status</label>
                                    <select name="is_available" class="form-control" required>
                                        <option value="1" {{ $room->is_available ? 'selected' : '' }}>Available</option>
                                        <option value="0" {{ !$room->is_available ? 'selected' : '' }}>In Use</option>
                                    </select>
                                </div>
				                <div class="col-12 mt-3">
                                <button type="submit" class="btn btn-outline-success">Update Room</button>
                                <a href="{{ route('room.index') }}" class="btn btn-outline-secondary">Cancel</a>
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