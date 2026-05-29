<aside id="sidebar" class="js-sidebar">
    <div class="h-100">
        <div class="sidebar-logo">
            <img src="{{ asset('images/UM_name.png') }}" alt="UM" style="width: 200px; height: auto;">
        </div>
        <ul class="sidebar-nav">
            <li class="sidebar-header">
                Admin Elements
            </li>
            <li class="sidebar-item">
                <a href="{{ route('dashboard') }}" class="sidebar-link">
                    <i class="fa-solid fa-list pe-2"></i>
                    Dashboard
                </a>
            </li>
            <li class="sidebar-item">
                <a href="{{ route('students_payment.Payment_list') }}" class="sidebar-link">
                    <i class="fa-solid fa-cash-register"></i> 
                    Payment List
                </a>
            </li>            
        </ul>
    </div>
</aside>