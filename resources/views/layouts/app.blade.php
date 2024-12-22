<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel Project</title>
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ url('/') }}">Home</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <!-- Home -->
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/') }}">Home</a>
                    </li>
                    <!-- Dashboard (hiển thị nếu người dùng đã đăng nhập) -->
                    @if(Auth::check())
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('dashboard') }}">Dashboard</a>
                        </li>
                        <!-- About Us -->
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('about') }}">About Us</a>
                        </li>
                        <!-- Admin quản lý danh mục -->
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.category.index') }}">Admin</a>
                        </li>
                        <!-- Hello User -->
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('auth/welcome') }}">Hello, {{ Auth::user()->name }}</a>
                        </li>
                        <!-- Logout -->
                        <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-danger">Đăng xuất</button>
            </form>
                    @else
                        <!-- Login (hiển thị nếu người dùng chưa đăng nhập) -->
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('login') }}">Login</a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    <!-- Nội dung trang -->
    <div class="container mt-5">
        @yield('content')
    </div>

    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
