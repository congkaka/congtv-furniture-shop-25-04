@extends('layouts.web')
@section('content')
@section('css')
@endsection
<!-- <<<<<<<<<<<<<<<<<<<< Breadcumb Area Start <<<<<<<<<<<<<<<<<<<< -->
<div class="breadcumb_area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <ol class="breadcrumb d-flex align-items-center">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item ">List</li>
                    <li class="breadcrumb-item active">Order</li>
                </ol>
                <!-- btn -->
                <a href="/" class="backToHome d-block"><i class="fa fa-angle-double-left"></i> Quay lại trang chủ</a>
            </div>
        </div>
    </div>
</div>
<!-- <<<<<<<<<<<<<<<<<<<< Breadcumb Area End <<<<<<<<<<<<<<<<<<<< -->
<!-- ****** Cart Area Start ****** -->
<div class="cart_area section_padding_20 clearfix">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="cart-table clearfix">
                    <table class="table table-responsive">
                        <thead>
                            <tr>
                                <th>Sản phẩm</th>
                                <th>Giá</th>
                                <th>Số lượng</th>
                                <th>Tổng</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $value)
                            <tr>
                                <td class="cart_product_img d-flex align-items-center">
                                    <a href="#"><img src="{{asset('files/')}}/{{$value->product->images[0] ?? ''}}" alt="Product"></a>
                                    <h6>{{$value->product->name ?? ''}}</h6>
                                </td>
                                <td class="price"><span>{{$value->orderProduct->promotion_price ?? 0}}</span></td>
                                <td class="qty">
                                    <div class="quantity">
                                        <span class="qty-minus" onclick="var effect = document.getElementById('qty'); var qty = effect.value; if( !isNaN( qty ) &amp;&amp; qty &gt; 1 ) effect.value--;return false;"><i class="fa fa-minus" aria-hidden="true"></i></span>
                                        <input type="number" class="qty-text" id="qty" step="1" min="1" max="99" name="quantity" value="{{$value->orderProduct->quantity ?? 1}}">
                                        <span class="qty-plus" onclick="var effect = document.getElementById('qty'); var qty = effect.value; if( !isNaN( qty )) effect.value++;return false;"><i class="fa fa-plus" aria-hidden="true"></i></span>
                                    </div>
                                </td>
                                <td class="total_price"><span>₫{{$value->total_order}}</span></td>
                                <td class="total_price" style="text-align: center;">
                                    {!! Form::open(['route' => ['product.delete', $value->id], 'method' => 'delete']) !!}
                                    {!! Form::button('<i class="fa fa-trash-o" style="color:red"></i>', ['type' => 'submit', 'class' => 'btn btn-xs']) !!}
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="cart-footer d-flex mt-30">
                    <div class="back-to-shop w-50">
                        <a href="/">Tiếp tục mua sắm</a>
                    </div>
                    <div class="update-checkout w-50 text-right">
                        <a href="#">clear cart</a>
                        <a href="#">Update cart</a>
                    </div>
                </div>

            </div>
        </div>
        {!! Form::open(['route' => 'web.product.store']) !!}
        <div class="row">
            <div class="col-12 col-md-6 col-lg-8">
                <div class="coupon-code-area mt-70">
                    <div class="cart-page-heading">
                        <h5>Thông tin nhận hàng</h5>
                    </div>
                        <div class="row">
                            <div class="col-12 mb-3">
                                <label for="company">Họ Tên</label>
                                <input type="text" class="form-control" id="name" name="name" value="" required>
                            </div>
                            <div class="col-12 mb-3">
                                <label for="street_address">Địa chỉ <span>*</span></label>
                                <input type="text" class="form-control mb-3" id="street_address" name="street_address" value="" required>
                            </div>
                            <div class="col-12 mb-3">
                                <label for="phone_number">Số điện thoại<span>*</span></label>
                                <input type="number" class="form-control" id="phone_number" name="phone_number" min="0" value="" required>
                            </div>
                            <div class="col-12 mb-4">
                                <label for="email_address">Địa chỉ Email<span>*</span></label>
                                <input type="email" class="form-control" id="email_address" name="email_address" value="" required>
                            </div>
                            <div class="col-12 mb-4">
                                <label for="note">Yêu cầu của bạn<span></span></label>
                                <textarea class="form-control" id="note" name="note" rows="3"></textarea>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-12 col-lg-4">
                <div class="cart-total-area mt-70">
                    <div class="cart-page-heading">
                        <h5>Cart total</h5>
                        <p>Final info</p>
                    </div>

                    <ul class="cart-total-chart">
                        
                        <li><span>Subtotal</span> <span>₫{{number_format($data->average('total_order') * $data->count())}}</span></li>
                        <li><span>Shipping</span> <span>Free</span></li>
                        <li><span><strong>Total</strong></span> <span><strong>₫{{number_format($data->average('total_order') * $data->count())}}</strong></span></li>
                    </ul>
                    <button type="submit" class="btn karl-checkout-btn">Đặt hàng</button>
                </div>
            </div>
        </div>
        {{ Form::close() }}
    </div>
</div>
<!-- ****** Cart Area End ****** -->
@push('scripts')
@endpush
@endsection