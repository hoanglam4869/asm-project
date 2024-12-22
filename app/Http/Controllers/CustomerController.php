<?php

// app/Http/Controllers/CustomerController.php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    // Lấy thông tin khách hàng
    public function getCustomerInfo()
    {
        // Lấy thông tin khách hàng của người dùng đã đăng nhập
        $customer = auth()->user()->customer;

        // Trả về view chỉnh sửa thông tin và truyền thông tin khách hàng
        return view('customer.edit', compact('customer'));
    }

    // Cập nhật thông tin khách hàng
    public function updateCustomerInfo(Request $request)
    {
        // Xác thực dữ liệu
        $validated = $request->validate([
            'fName' => 'required|string|max:255',
            'lName' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'address' => 'required|string|max:255',
        ]);

        // Cập nhật thông tin khách hàng
        $customer = auth()->user()->customer;
        $customer->update($validated);

        // Sau khi cập nhật thành công, chuyển hướng về trang chào mừng
        return redirect()->route('welcome')->with('message', 'Thông tin đã được cập nhật!');
    }
}
