<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Payment</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/ae360af17e.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
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
                        <h4>Edit Payment</h4>
                    </div>
                    <div class="card border-0 form-card">
                        <div class="card-header">
                            <h5 class="card-title">Register New Student</h5>
                        </div>
                        <div class="card-body">

                            <form method="POST" action="{{ route('students_payment.update', $payment->PaymentID) }}" enctype="multipart/form-data" class="row g-3">
                                @csrf
                                @method('PUT')
                                <div class="col-md-4">
                                    <label class="form-label" for="RegistrationID">Student</label>
                                    <select class="form-control" name="RegistrationID" required>
                                        <option value="{{ $payment->RegistrationID }}">
                                            {{ $payment->student->FirstName }} {{ $payment->student->LastName }}
                                        </option>
                                        @foreach ($students as $student)
                                            <option value="{{ $student->RegistrationID }}">
                                                {{ $student->FirstName }} {{ $student->LastName }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">Method of Payment</label>
                                    <select name="Payment_Method" class="form-control" required>
                                        <option value="Cash" {{ $payment->Method == 'Cash' ? 'selected' : '' }}>Cash</option>
                                        <option value="Gcash" {{ $payment->Method == 'Gcash' ? 'selected' : '' }}>Gcash</option>
                                    </select>
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">Amount</label>
                                    <input type="text" name="Amount" class="form-control" value="{{ $payment->Amount }}" required>
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">Reference Number</label>
                                    <input type="text" name="Reference_Number" class="form-control" value="{{ $payment->Reference_Number }}" required>
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">Payment Receipt</label>
                                    @if($payment->receipt)
                                        <a href="{{ asset('storage/' . $payment->receipt) }}" target="_blank">View File</a>
                                    @else
                                        <p>No file uploaded</p>
                                    @endif
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">Upload New receipt</label>
                                    <input type="file" name="receipt" class="form-control" accept=".pdf,.jpg,.png,.jpeg">
                                </div>

                                <div class="col-12">
                                    <button type="submit" class="btn btn-outline-success" >
                                        Update Payment
                                      </button>
                                </div>
                            </form>
                            
                            <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header bg-success text-white">
                                            <h5 class="modal-title" id="successModalLabel">Payment Updated</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body text-center">
                                            <i class="fas fa-check-circle text-success fa-3x mb-3"></i>
                                            <p>payment has been successfully updated</p>
                                        </div>
                                        <div class="modal-footer">
                                            <a href="{{ route('students_payment.Payment_list') }}" class="btn btn-outline-success">Go to Payment List</a>
                                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
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
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Check if success message exists
            @if(session('success1'))
                var successModal = new bootstrap.Modal(document.getElementById('successModal'));
                successModal.show();
            @endif
        });
    </script>
</body>

</html>