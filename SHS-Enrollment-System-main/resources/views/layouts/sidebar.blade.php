<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<aside id="sidebar" class="js-sidebar">
    <div class="h-100 d-flex flex-column">
        <div class="sidebar-logo">
            <img src="{{ asset('images/UM_name.png') }}" alt="UM" style="width: 200px; height: auto;">
        </div>
        <ul class="sidebar-nav flex-grow-1">
            <li class="sidebar-header">
                University of Mindanao SHS
            </li>
            @if(auth()->user() && auth()->user()->role === 'Admin')
                <li class="sidebar-item">
                    <a href="{{ route('dashboard') }}" class="sidebar-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <i class="fa-solid fa-list pe-2"></i>
                        Dashboard
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="{{ route('students_registration.index') }}" class="sidebar-link {{ request()->routeIs('students_registration.index') ? 'active' : '' }}">
                        <i class="fa-solid fa-users pe-2"></i>  
                        Student Registration List
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="{{ route('students_payment.Payment_list') }}" class="sidebar-link {{ request()->routeIs('students_payment.Payment_list') ? 'active' : '' }}">
                        <i class="fa-solid fa-cash-register"></i> 
                        Payment List
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="{{ route('students.index') }}" class="sidebar-link {{ request()->routeIs('students.index') ? 'active' : '' }}">
                        <i class="fa-solid fa-users pe-2"></i> 
                        Student List
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="{{ route('room.index') }}" class="sidebar-link {{ request()->routeIs('room.index') ? 'active' : '' }}">
                        <i class="fa-solid fa-users pe-2"></i> 
                        Room List
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="{{ route('strand.index') }}" class="sidebar-link {{ request()->routeIs('strand.index') ? 'active' : '' }}">
                        <i class="fa-solid fa-list"></i>
                        Strand List
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="{{ route('schedule.index') }}" class="sidebar-link {{ request()->routeIs('schedule.index') ? 'active' : '' }}">
                        <i class="bi bi-calendar-check"></i>
                        Schedule List
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="{{ route('teachers.index') }}" class="sidebar-link {{ request()->routeIs('teachers.index') ? 'active' : '' }}">
                        <i class="fa-solid fa-chalkboard-user"></i>
                        Teachers List
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="{{ route('sections.index') }}" class="sidebar-link {{ request()->routeIs('sections.index') ? 'active' : '' }}">
                        <i class="fa-solid fa-chalkboard-user"></i>
                        Section List
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="{{ route('subjects.index') }}" class="sidebar-link {{ request()->routeIs('subjects.index') ? 'active' : '' }}">
                        <i class="fa-solid fa-chalkboard-user"></i>
                        Subject List
                    </a>
                </li>
            @elseif(auth()->user() && auth()->user()->role === 'Operator')
                <li class="sidebar-item">
                    <a href="{{ route('dashboard') }}" class="sidebar-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <i class="fa-solid fa-list pe-2"></i>
                        Dashboard
                    </a>
                </li>
            <li class="sidebar-item">
                <a href="{{ route('students.index') }}" class="sidebar-link {{ request()->routeIs('students.index') ? 'active' : '' }}">
                    <i class="fa-solid fa-users pe-2"></i> 
                    Student List
                </a>
            </li>
            <li class="sidebar-item">
                <a href="{{ route('room.index') }}" class="sidebar-link {{ request()->routeIs('room.index') ? 'active' : '' }}">
                    <i class="fa-solid fa-users pe-2"></i> 
                    Room List
                </a>
            </li>
            <li class="sidebar-item">
                <a href="{{ route('strand.index') }}" class="sidebar-link {{ request()->routeIs('strand.index') ? 'active' : '' }}">
                    <i class="fa-solid fa-list"></i>
                    Strand List
                </a>
            </li>
            <li class="sidebar-item">
                <a href="{{ route('schedule.index') }}" class="sidebar-link {{ request()->routeIs('schedule.index') ? 'active' : '' }}">
                    <i class="bi bi-calendar-check"></i>
                    Schedule List
                </a>
            </li>
            <li class="sidebar-item">
                <a href="{{ route('teachers.index') }}" class="sidebar-link {{ request()->routeIs('teachers.index') ? 'active' : '' }}">
                    <i class="fa-solid fa-chalkboard-user"></i>
                    Teachers List
                </a>
            </li>
            <li class="sidebar-item">
                <a href="{{ route('sections.index') }}" class="sidebar-link {{ request()->routeIs('sections.index') ? 'active' : '' }}">
                    <i class="fa-solid fa-chalkboard-user"></i>
                    Section List
                </a>
            </li>
            <li class="sidebar-item">
                <a href="{{ route('subjects.index') }}" class="sidebar-link {{ request()->routeIs('subjects.index') ? 'active' : '' }}">
                    <i class="fa-solid fa-chalkboard-user"></i>
                    Subject List
                </a>
            </li> 
            @elseif(auth()->user() && auth()->user()->role === 'Registrar')
                <li class="sidebar-item">
                    <a href="{{ route('dashboard') }}" class="sidebar-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <i class="fa-solid fa-list pe-2"></i>
                        Dashboard
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="{{ route('students_registration.index') }}" class="sidebar-link {{ request()->routeIs('students_registration.index') ? 'active' : '' }}">
                        <i class="fa-solid fa-users pe-2"></i>  
                        Student Registration List
                    </a>
                </li>
            @elseif(auth()->user() && auth()->user()->role === 'Cashier')
                <li class="sidebar-item">
                    <a href="{{ route('dashboard') }}" class="sidebar-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <i class="fa-solid fa-list pe-2"></i>
                        Dashboard
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="{{ route('students_payment.Payment_list') }}" class="sidebar-link {{ request()->routeIs('students_payment.Payment_list') ? 'active' : '' }}">
                        <i class="fa-solid fa-cash-register"></i> 
                        Payment List
                    </a>
                </li>
            @endif
        </ul>

        <!-- User Profile Section at Bottom -->
        <div class="sidebar-bottom border-top py-2">
            <div class="dropdown">
                <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle px-3" data-bs-toggle="dropdown">
                    <img src="{{ asset('images/Um logo.png') }}" class="rounded-circle me-2" width="32" height="32" alt="Profile">
                    <span class="text-white">{{ Auth::user()->name }}</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-dark">
                    <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Profile</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a href="{{ route('logout') }}" class="dropdown-item" 
                               onclick="event.preventDefault(); this.closest('form').submit();">
                                Logout
                            </a>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</aside>