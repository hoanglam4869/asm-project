<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Cart; // Sử dụng model Cart để truy xuất giỏ hàng
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Lấy tất cả sản phẩm từ cơ sở dữ liệu
        $products = Product::all();

        // Lấy giỏ hàng của người dùng (nếu có)
        $user = auth()->user();
        $cartItems = $user ? ($user->cart ? $user->cart->cartItems : []) : [];

        // Truyền sản phẩm và giỏ hàng vào view welcome
        return view('welcome', compact('products', 'cartItems'));
    }
}
