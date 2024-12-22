<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    // Hiển thị giỏ hàng
    public function index()
    {
        $cart = auth()->user()->cart; // Lấy giỏ hàng của người dùng

        // Nếu không có giỏ hàng thì trả về trang trống
        if (!$cart) {
            return view('cart.index', ['cartItems' => collect(), 'totalPrice' => 0]);
        }

        // Lấy các sản phẩm trong giỏ và tính tổng giá trị giỏ hàng
        $cartItems = $cart->cartItems;
        $totalPrice = $cartItems->sum(function ($item) {
            return $item->quantity * $item->product->price;
        });

        return view('cart.index', compact('cartItems', 'totalPrice'));
    }

    // Thêm sản phẩm vào giỏ hàng
    public function add(Product $product)
    {
        $cart = auth()->user()->cart;

        if (!$cart) {
            // Nếu người dùng chưa có giỏ hàng, tạo mới giỏ hàng
            $cart = Cart::create(['user_id' => auth()->id()]);
        }

        // Kiểm tra nếu sản phẩm đã có trong giỏ hàng chưa
        $cartItem = $cart->cartItems()->where('product_id', $product->id)->first();

        if ($cartItem) {
            // Nếu sản phẩm đã có trong giỏ hàng, chỉ cần cập nhật số lượng
            $cartItem->increment('quantity');
        } else {
            // Nếu sản phẩm chưa có trong giỏ hàng, thêm mới
            $cart->cartItems()->create([
                'product_id' => $product->id,
                'quantity' => 1,
            ]);
        }

        return redirect()->route('cart.index')->with('success', 'Sản phẩm đã được thêm vào giỏ hàng.');
    }

    // Xóa sản phẩm khỏi giỏ hàng
    public function remove(CartItem $cartItem)
    {
        // Xóa sản phẩm khỏi giỏ hàng
        $cartItem->delete();

        return redirect()->route('cart.index')->with('success', 'Sản phẩm đã được xóa khỏi giỏ hàng.');
    }

    // Tiến hành thanh toán (Chức năng thanh toán cơ bản, có thể mở rộng thêm)
    public function checkout(Request $request)
    {
        $cart = auth()->user()->cart;

        // Nếu không có giỏ hàng, redirect về trang giỏ hàng
        if (!$cart || $cart->cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Giỏ hàng của bạn đang trống.');
        }

        // Xử lý thanh toán tại đây (có thể tích hợp với các dịch vụ thanh toán bên ngoài)
        // Ví dụ: Cập nhật trạng thái đơn hàng, xóa giỏ hàng, v.v.

        // Thông báo thanh toán thành công
        return redirect()->route('cart.index')->with('success', 'Thanh toán thành công!');
    }

    public function updateQuantity(Request $request, CartItem $cartItem)
    {
        // Kiểm tra số lượng nhập vào
        $quantity = $request->input('quantity');

        // Nếu số lượng là hợp lệ (lớn hơn 0)
        if ($quantity > 0) {
            $cartItem->update([
                'quantity' => $quantity
            ]);
        } else {
            // Nếu số lượng không hợp lệ, có thể xóa sản phẩm khỏi giỏ
            $cartItem->delete();
        }

        return redirect()->route('cart.index')->with('success', 'Cập nhật giỏ hàng thành công!');
    }

}
