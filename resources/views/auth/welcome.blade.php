<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chào Mừng</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <!-- Tiêu đề và thông tin người dùng -->
        <h2 class="text-center">Chào Mừng, {{ auth()->user()->name }}!</h2>
        <p class="text-center">Email: {{ auth()->user()->email }}</p>
        
        <div class="text-center mt-4">
            <h4>Thông tin của bạn:</h4>
            <ul class="list-group">
                <li class="list-group-item"><strong>Họ Tên:</strong> {{ auth()->user()->customer->fName }} {{ auth()->user()->customer->lName }}</li>
                <li class="list-group-item"><strong>Số điện thoại:</strong> {{ auth()->user()->customer->phone }}</li>
                <li class="list-group-item"><strong>Địa chỉ:</strong> {{ auth()->user()->customer->address }}</li>
            </ul>
        </div>

        <!-- Các liên kết -->
        <div class="text-center mt-4">
            <a href="{{ url('customer/edit') }}" class="btn btn-warning">Chỉnh sửa thông tin khách hàng</a>
        </div>

        <div class="text-center mt-3">
            <!-- Thay thế liên kết bằng form -->
            <form action="{{ route('delete.user') }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa tài khoản không?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Xóa tài khoản</button>
            </form>
        </div>

        <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-danger">Đăng xuất</button>
            </form>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
