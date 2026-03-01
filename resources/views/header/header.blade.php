<nav class="navbar navbar-expand-lg border-bottom custom-navbar">
    <div class="container-fluid" style="background-color: black;">
        <a class="navbar-brand d-flex align-items-center" href="#">
            <div class="bg-warning rounded-circle p-2 me-2"> 
                <i class="fas fa-bars text-white"></i>
            </div>
            <span>Project Task Tracker</span>
        </a>
        
        <div class="collapse navbar-collapse">
            
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <!-- <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-user"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                        <li><a class="dropdown-item" href="#">Profile</a></li>
                        <li><a class="dropdown-item" href="#">Settings</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="#">Logout</a></li>
                    </ul>
                </li> -->
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="fas fa-bell"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" onclick="event.preventDefault(); confirmLogout();">
                        <i class="fas fa-sign-out-alt" style="color: #dc3545;"></i>
                    </a>

                    <!-- Hidden form to submit the logout request -->
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>

            </ul>
        </div>
    </div>
</nav>
