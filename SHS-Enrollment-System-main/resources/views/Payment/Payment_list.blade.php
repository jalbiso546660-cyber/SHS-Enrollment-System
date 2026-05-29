<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment List</title>
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
                               Payment List
                            </h5>
                        <h6 class="card-subtitle text-muted">
                            <nav class="navbar bg-body-light">
                                <div class="container-fluid">
                                    <form role="search" method="GET" action="{{ route('students_payment.Payment_list') }}">
                                        <input class="form-control me-2" type="search" name="search" 
                                               placeholder="Search by Payment ID" aria-label="Search" 
                                               style="display: inline-block; width: 45%;"
                                               value="{{ request('search') }}">
                                        <button class="btn btn-outline-success" type="submit"><i class="fa-solid fa-magnifying-glass"></i> Search</button>
                                        <a href="{{ route('cashier_payment.create') }}" 
                                           class="btn btn-info ms-2"><i class="fa-solid fa-money-bill"></i></i> Payment</a>
                                    </form>
                                </div>
                            </nav>
                            @if(isset($payments) && count($payments) == 0)
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
                                        <th>Student Name</th>
                                        <th>Method</th>
                                        <th>Amount</th>
                                        <th>Reference #</th>
                                        <th>Payment Date</th>
                                        <th>Status</th>
                                        <th>Receipt</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($payments as $payment)
                                        <tr>
                                            <td>{{ $payment->PaymentID }}</td>
                                            <td>{{ $payment->student->FirstName ?? 'N/A' }} {{ $payment->student->LastName ?? '' }}</td>
                                            <td>{{ $payment->Payment_Method }}</td>
                                            <td>₱{{ number_format($payment->Amount, 2) }}</td>
                                            <td>{{ $payment->Reference_Number }}</td>
                                            <td>{{ $payment->Payment_Date }}</td>
                                            <td>{{ $payment->Status }}</td>
                                            <td>
                                                @if($payment->receipt)
                                                    <button type="button" 
                                                            class="btn btn-info btn-sm" style="color:black;"
                                                            data-bs-toggle="modal" 
                                                            data-bs-target="#form138Modal{{ $payment->PaymentID }}">
                                                        <i class="fa-solid fa-eye"></i> View Receipt
                                                    </button>

                                                    <!-- Modal -->
                                                    <div class="modal fade" 
                                                         id="form138Modal{{ $payment->PaymentID }}" 
                                                         tabindex="-1" 
                                                         aria-labelledby="form138ModalLabel{{ $payment->PaymentID }}" 
                                                         aria-hidden="true">
                                                        <div class="modal-dialog modal-lg">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="form138ModalLabel{{ $payment->PaymentID }}">
                                                                        receipt - {{ $payment->FirstName }} {{ $payment->LastName }}
                                                                    </h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body text-center">
                                                                    <img src="{{ asset('storage/' . $payment->receipt) }}" 
                                                                         class="img-fluid" 
                                                                         alt="receipt"
                                                                         style="max-height: 80vh;">
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                    
                                                                    
                                                                    <form action="{{ route('students_payment.update', $payment->PaymentID) }}" 
                                                                          method="POST"
                                                                          class="d-inline">
                                                                        @csrf
                                                                        @method('PUT')
                                                                        <input type="hidden" name="Status" value="Completed">
                                                                        <button type="submit" 
                                                                                class="btn btn-success" 
                                                                                {{ $payment->Status === 'Completed' || $payment->Status === 'Rejected' ? 'disabled' : '' }}>
                                                                            <i class="fa-solid fa-check"></i> Approve
                                                                        </button>
                                                                    </form>

                                                                    
                                                                    <form action="{{ route('students_payment.update', $payment->PaymentID) }}" 
                                                                          method="POST"
                                                                          class="d-inline">
                                                                        @csrf
                                                                        @method('PUT')
                                                                        <input type="hidden" name="Status" value="Rejected">
                                                                        <button type="submit" 
                                                                                class="btn btn-danger"
                                                                                {{ $payment->Status === 'Completed' || $payment->Status === 'Rejected' ? 'disabled' : '' }}>
                                                                            <i class="fa-solid fa-xmark"></i> Reject
                                                                        </button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @else
                                                    <span class="text-muted">No file uploaded</span>
                                                @endif
                                            </td>

                                            <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header bg-success text-white">
                                                            <h5 class="modal-title" id="successModalLabel">Payment Successful</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body text-center">
                                                            <i class="fas fa-check-circle text-success fa-3x mb-3"></i>
                                                            <p>Payment has been successfully approved</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <td>
                                                <a href="{{ route('students_payment.edit', $payment->PaymentID) }}" 
                                                  class="btn btn-outline-primary btn-sm">
                                                    <i class="fa-solid fa-edit"></i> Edit
                                                </a>
                                                
                                                <form action="{{ route('students_payment.destroy', $payment->PaymentID) }}" 
                                                      method="POST" 
                                                      style="display:inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-outline-danger btn-sm" 
                                                            onclick="showDeleteConfirmation({{ $payment->PaymentID }})">
                                                            <i class="fa-regular fa-trash-can"></i> Delete
                                                    </button>
                                                    
                                                    <div class="toast position-fixed top-0 start-50 translate-middle-x" 
                                                         style="z-index: 1000;" 
                                                         id="deleteToast{{ $payment->PaymentID }}" 
                                                         role="alert" 
                                                         aria-live="assertive" 
                                                         aria-atomic="true">
                                                        <div class="toast-body">
                                                            Are you sure you want to delete this payment?
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
                                                
                                                <div class="modal fade" id="successDeleteModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header bg-success text-white">
                                                                <h5 class="modal-title" id="successModalLabel">Payment Successful</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body text-center">
                                                                <i class="fas fa-check-circle text-success fa-3x mb-3"></i>
                                                                <p>Payment has been successfully Deleted</p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>

            <div class="d-flex justify-content-center mt-4">
                {{ $payments->appends(['search' => request('search')])->links() }}
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Check if success message exists
            @if(session('success_destroy'))
                var successModal = new bootstrap.Modal(document.getElementById('successDeleteModal'));
                successModal.show();
            @endif
        });
    </script>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Check if success message exists
            @if(session('success'))
                var successModal = new bootstrap.Modal(document.getElementById('successModal'));
                successModal.show();
            @endif
        });
    </script>
</body>

</html>
