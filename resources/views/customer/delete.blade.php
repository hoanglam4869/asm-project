<!-- resources/views/auth/delete.blade.php -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xóa Tài Khoản</title>
</head>

<body>
    <h2>Xóa Tài Khoản</h2>

    <form action="{{ url('delete-user') }}" method="POST">
        @csrf
        @method('DELETE')

        <button type="submit" style="background-color: red; color: white;">Xóa Tài Khoản</button>
    </form>
</body>

</html>