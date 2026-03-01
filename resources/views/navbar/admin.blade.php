<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard PRO</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="{{ asset('css/adminApp.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/create-users.css') }}">
    <link rel="stylesheet" href="{{ asset('css/userList.css') }}">
    <script src="{{ asset('js/config_js.js') }}"></script>
</head>
<body>
    <header>
        @include('header.header')
    </header>
    <div class="layout">
        <!-- Sidebar -->
        <nav class="bg-warning sidebar">
    <div class="sidebar-sticky">
        <div class="text-center my-3">
            <h6 class="mt-2">High authority NavBar</h6>
        </div>
        <ul class="nav flex-column" id="list-container">
            <!-- Users CRUD with dropdown -->
            <li class="nav-item">
                <a class="nav-link text-white" href="#" data-bs-toggle="collapse" data-bs-target="#usersMenu">
                    <i class="fas fa-user"></i> Users CRUD
                </a>
                <div id="usersMenu" class="collapse">
                    <ul class="nav flex-column ms-3">
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{route('users.index')}}">
                                <i class="fas fa-list"></i> List Users
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{route('users.create')}}">
                                <i class="fas fa-user-plus"></i> Create User
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <!-- partnership CRUD with dropdown -->
            <li class="nav-item">
                <a class="nav-link text-white" href="#" data-bs-toggle="collapse" data-bs-target="#driversMenu">
                    <i class="fas fa-id-badge"></i> Partnership
                </a>
                <div id="driversMenu" class="collapse">
                    <ul class="nav flex-column ms-3">
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{route('admin.home')}}">
                                <i class="fas fa-list"></i> List Partnership
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{route('admin.home')}}">
                                <i class="fas fa-user-plus"></i> Create Partnership
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <!-- Persontal Task CRUD with dropdown -->
            <li class="nav-item">
                <a class="nav-link text-white" href="#" data-bs-toggle="collapse" data-bs-target="#carsMenu">
                    <i class="fas fa-car"></i> Personal Task
                </a>
                <div id="carsMenu" class="collapse">
                    <ul class="nav flex-column ms-3">
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{route('admin.pTask')}}">
                                <i class="fas fa-list"></i> My Personal Task
                            </a>
                        </li>
                        <!-- <li class="nav-item">
                            <a class="nav-link text-white" href="{{route('admin.home')}}">
                                <i class="fas fa-car"></i> Create Personal Task
                            </a>
                        </li> -->
                    </ul>
                </div>
            </li>
            <!-- Project CRUD with dropdown -->
            <li class="nav-item">
                <a class="nav-link text-white" href="#" data-bs-toggle="collapse" data-bs-target="#transactionsMenu">
                    <i class="fas fa-exchange-alt"></i> Project
                </a>
                <div id="transactionsMenu" class="collapse">
                    <ul class="nav flex-column ms-3">
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{route('admin.home')}}">
                                <i class="fas fa-list"></i> List Project
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{route('admin.home')}}">
                                <i class="fas fa-plus"></i> Create Project
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <!-- Worker assignment CRUD with dropdown -->
            <li class="nav-item">
                <a class="nav-link text-white" href="#" data-bs-toggle="collapse" data-bs-target="#transactionsMenu">
                    <i class="fas fa-exchange-alt"></i> Assign Worker
                </a>
                <div id="transactionsMenu" class="collapse">
                    <ul class="nav flex-column ms-3">
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{route('admin.home')}}">
                                <i class="fas fa-list"></i> List Assigned Worker
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{route('admin.home')}}">
                                <i class="fas fa-plus"></i> Assign Worker
                            </a>
                        </li>
                    </ul>
                </div>
            </li>   
            <!-- Check Point CRUD with dropdown -->
            <li class="nav-item">
                <a class="nav-link text-white" href="#" data-bs-toggle="collapse" data-bs-target="#transactionsMenu">
                    <i class="fas fa-exchange-alt"></i> Checkpoint Project
                </a>
                <div id="transactionsMenu" class="collapse">
                    <ul class="nav flex-column ms-3">
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{route('admin.home')}}">
                                <i class="fas fa-list"></i> List Checkpoint
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{route('admin.home')}}">
                                <i class="fas fa-plus"></i> Create Checkpoint
                            </a>
                        </li>
                    </ul>
                </div>
            </li>       
        </ul>
    </div>
</nav>


        <!-- Main content -->
        <div class="content">
            @yield('content')
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        function confirmLogout() {
            if (confirm('Are you sure you want to log out?')) {
                document.getElementById('logout-form').submit();
            }
        }
    </script>
</body>
</html>
