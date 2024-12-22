<?php

// app/Http/Controllers/AuthController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Customer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    // Đăng ký người dùng
    public function register(Request $request)
    {
        // Xác thực dữ liệu đầu vào
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'fName' => 'required|string|max:255',
            'lName' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'address' => 'required|string|max:255',
        ]);

        // Tạo người dùng
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        // Tạo customer liên kết với user
        $customer = Customer::create([
            'fName' => $validated['fName'],
            'lName' => $validated['lName'],
            'phone' => $validated['phone'],
            'address' => $validated['address'],
            'user_id' => $user->id,
        ]);

        // Đăng nhập ngay sau khi đăng ký
        Auth::login($user);

        // Chuyển hướng tới trang chào mừng
        return redirect()->route('welcome');
    }

    // Đăng nhập người dùng
    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:8',
        ]);

        if (Auth::attempt($validated)) {
            // Chuyển hướng người dùng đến trang chào mừng
            return redirect()->route('welcome');
        }

        throw ValidationException::withMessages([
            'email' => ['Thông tin đăng nhập không chính xác'],
        ]);
    }

    // Đăng xuất người dùng
    public function logout()
    {
        Auth::logout();
        return redirect('login');
    }

    // Xóa người dùng
    public function deleteUser(Request $request)
{
    $user = auth()->user();

    // Kiểm tra nếu người dùng tồn tại
    if ($user) {
        $user->delete(); // Xóa tài khoản
        return redirect()->route('home')->with('success', 'Tài khoản đã được xóa thành công.');
    }

    return redirect()->route('welcome')->with('error', 'Không thể xóa tài khoản.');
}

}
