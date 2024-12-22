@extends('layouts.app')

@section('content')
    @if (Auth::check())
        <section class="h-100 h-custom" style="background-color: #f8f9fa;">
            <div class="container py-5 h-100">
                <div class="row justify-content-center align-items-center h-100">
                    <div class="col-lg-8">
                        <div class="card shadow-sm">
                            <div class="card-body p-4">

                                <h5 class="mb-3">
                                    <a href="/" class="text-body"><i class="fas fa-arrow-left me-2"></i>Tiếp tục mua sắm</a>
                                </h5>
                                <hr>

                                @if ($cartItems->isEmpty())
                                    <p class="text-center">Giỏ hàng của bạn hiện tại không có sản phẩm nào.</p>
                                @else
                                    <div class="d-flex justify-content-between mb-4">
                                        <div>
                                            <p class="mb-1">Giỏ hàng của bạn</p>
                                            <p class="mb-0">{{ $cartItems->count() }} sản phẩm trong giỏ</p>
                                        </div>
                                    </div>

                                    @foreach ($cartItems as $item)
                                        <div class="card mb-3">
                                            <div class="row g-0">
                                                <div class="col-md-3">
                                                    <!-- Hình ảnh sản phẩm -->
                                                    <img src="{{ asset('storage/' . $item->product->image) }}" class="card-img-top" alt="{{ $item->product->name }}">
                                                </div>
                                                <div class="col-md-9">
                                                    <div class="card-body">
                                                        <h6 class="card-title">{{ $item->product->name }}</h6>
                                                        <p class="card-text text-muted">{{ $item->product->description }}</p>

                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <div class="d-flex align-items-center">
                                                                <form action="{{ route('cart.update', $item->id) }}" method="POST" class="d-inline-flex me-3">
                                                                    @csrf
                                                                    @method('PATCH')
                                                                    <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" class="form-control form-control-sm w-auto" style="max-width: 60px;">
                                                                    <button type="submit" class="btn btn-sm btn-warning ms-2">Cập nhật</button>
                                                                </form>

                                                                <form action="{{ route('cart.remove', $item->id) }}" method="POST" class="d-inline">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="btn btn-sm btn-danger">Xóa</button>
                                                                </form>
                                                            </div>

                                                            <div class="ms-3">
                                                                <p class="mb-0">{{ number_format($item->product->price * $item->quantity, 0, ',', '.') }} VND</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>

                            <div class="card-footer text-center py-4">
                                @if (!$cartItems->isEmpty())
                                    <h5 class="mb-2">Tổng cộng</h5>
                                    <h3 class="text-danger">{{ number_format($totalPrice, 0, ',', '.') }} VND</h3>
                                    <form action="{{ route('cart.checkout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-info btn-lg w-100">Tiến hành thanh toán <i class="fas fa-arrow-right ms-2"></i></button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @else
        <div class="container mt-5 text-center">
            <h2>Vui lòng đăng nhập để xem giỏ hàng của bạn.</h2>
            <p>Đăng nhập để tiếp tục mua sắm.</p>
        </div>
    @endif
@endsection
