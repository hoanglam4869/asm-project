<!-- resources/views/customer/edit.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh sửa thông tin khách hàng</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Chỉnh sửa thông tin</h2>

        <!-- Hiển thị thông báo nếu có -->
        @if(session('message'))
            <div class="alert alert-success">{{ session('message') }}</div>
        @endif

        <!-- Form chỉnh sửa thông tin khách hàng -->
        <form action="{{ url('customer/edit') }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="fName" class="form-label">Họ</label>
                <input type="text" class="form-control" id="fName" name="fName" value="{{ old('fName', $customer->fName) }}" required>
            </div>

            <div class="mb-3">
                <label for="lName" class="form-label">Tên</label>
                <input type="text" class="form-control" id="lName" name="lName" value="{{ old('lName', $customer->lName) }}" required>
            </div>

            <div class="mb-3">
                <label for="phone" class="form-label">Số điện thoại</label>
                <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone', $customer->phone) }}" required>
            </div>

            <div class="mb-3">
                <label for="address" class="form-label">Địa chỉ</label>
                <input type="text" class="form-control" id="address" name="address" value="{{ old('address', $customer->address) }}" required>
            </div>

            <button type="submit" class="btn btn-primary">Cập nhật</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
