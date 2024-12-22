@extends('layouts.app')

@section('content')
@if (Auth::check())
    <div class="container mt-5">
        <h2>Chào Mừng, {{ Auth::user()->name }}!</h2>
        <!-- Hiển thị sản phẩm -->
        <h3 class="mt-5">Danh sách Sản phẩm</h3>
        <div class="row">
            @foreach ($products as $product)
                <div class="col-md-4">
                    <div class="card mb-3">
                        <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text">{{ $product->description }}</p>
                            <p class="card-text"><strong>{{ number_format($product->price, 0, ',', '.') }} VND</strong></p>

                            <!-- Thêm vào giỏ hàng -->
                            <form action="{{ route('cart.add', $product->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-primary">Thêm vào giỏ hàng</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Hiển thị giỏ hàng -->
        <div class="mt-5">
            <h4>Giỏ hàng của bạn</h4>
            <ul class="list-group">
                @foreach ($cartItems as $item)
                    <li class="list-group-item">
                        {{ $item->product->name }} - Số lượng: {{ $item->quantity }} - Giá:
                        {{ number_format($item->product->price, 0, ',', '.') }} VND
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@else
    <!-- Nếu người dùng chưa đăng nhập, chỉ hiển thị thông báo đơn giản -->
    <div class="container mt-5">
        <h2>Chào mừng bạn đến với trang của chúng tôi!</h2>
        <p>Vui lòng đăng nhập để truy cập các tính năng.</p>
    </div>
@endif
@endsection