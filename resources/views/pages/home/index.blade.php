@extends('layouts.web')
@section('content')
@section('css')
@endsection
<!-- ****** Welcome Slides Area Start ****** -->
@include('layouts.slide')
<!-- ****** Welcome Slides Area End ****** -->

<!-- ****** Quick View Modal Area Start ****** -->
<?php setlocale(LC_MONETARY, 'en_US'); ?>
<div class="modal fade" id="quickview" tabindex="-1" role="dialog" aria-labelledby="quickview" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <button type="button" class="close btn" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>

            <div class="modal-body">
                <div class="quickview_body">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 col-lg-5">
                                <div class="quickview_pro_img">
                                    <img src="img/product-img/product-1.jpg" alt="">
                                </div>
                            </div>
                            <div class="col-12 col-lg-7">
                                <div class="quickview_pro_des">
                                    <h4 class="title">Boutique Silk Dress</h4>
                                    <div class="top_seller_product_rating mb-15">
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                    </div>
                                    <h5 class="price">$120.99 <span>$130</span></h5>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Mollitia expedita quibusdam aspernatur, sapiente consectetur accusantium perspiciatis praesentium eligendi, in fugiat?</p>
                                    <a href="#">View Full Product Details</a>
                                </div>
                                <!-- Mua ngay Form -->
                                <form class="cart" method="post">
                                    <div class="quantity">
                                        <span class="qty-minus" onclick="var effect = document.getElementById('qty'); var qty = effect.value; if( !isNaN( qty ) &amp;&amp; qty &gt; 1 ) effect.value--;return false;"><i class="fa fa-minus" aria-hidden="true"></i></span>

                                        <input type="number" class="qty-text" id="qty" step="1" min="1" max="12" name="quantity" value="1">

                                        <span class="qty-plus" onclick="var effect = document.getElementById('qty'); var qty = effect.value; if( !isNaN( qty )) effect.value++;return false;"><i class="fa fa-plus" aria-hidden="true"></i></span>
                                    </div>
                                    <button type="submit" name="addtocart" value="5" class="cart-submit">Mua ngay</button>
                                    <!-- Wishlist -->
                                    <div class="modal_pro_wishlist">
                                        <a href="wishlist.html" target="_blank"><i class="ti-heart"></i></a>
                                    </div>
                                    <!-- Compare -->
                                    <div class="modal_pro_compare">
                                        <a href="compare.html" target="_blank"><i class="ti-stats-up"></i></a>
                                    </div>
                                </form>

                                <div class="share_wf mt-30">
                                    <p>Share With Friend</p>
                                    <div class="_icon">
                                        <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                                        <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                                        <a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a>
                                        <a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ****** Quick View Modal Area End ****** -->

<!-- ****** New Arrivals Area Start ****** -->
<section class="new_arrivals_area section_padding_100_0 clearfix">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section_heading text-center">
                    <h2>Danh mục sản phẩm</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="karl-projects-menu mb-100">
        <div class="text-center portfolio-menu">
            <button class="btn active" data-filter="*">Tất cả</button>
            @foreach($categories as $category)
            <button class="btn" data-filter=".noithat{{$category->id}}">{{$category->name}}</button>
            @endforeach
            <!-- <button class="btn" data-filter=".phonglamviec">Phòng làm việc</button>
            <button class="btn" data-filter=".phongngu">Phòng ngủ</button>
            <button class="btn" data-filter=".phongtam">Phòng tắm</button>
            <button class="btn" data-filter=".phongbep">Phòng bếp</button> -->
        </div>
    </div>

    <div class="container">
        <div class="row karl-new-arrivals">

            <!-- Single gallery Item Start -->
            @foreach($products as $product)
            <div class="col-12 col-sm-6 col-md-3 single_gallery_item noithat{{$product->category_id}} wow fadeInUpBig" data-wow-delay="0.2s">
                <!-- Product Image -->
                <div class="product-img">
                    <img style="width: 250px;height: 230px;" src="{{asset('files')}}/{{$product->images[0] ?? ''}}" alt="">
                    <div class="product-quicview">
                        <a href="{{route('product.detail')}}" data-toggle="modal" data-target="#quickview"><i class="ti-plus"></i></a>
                    </div>
                </div>
                <!-- Product Description -->
                <div class="product-description">
                    <h4 class="product-price">{{number_format($product->promotion_price)}}₫</h4>
                    <p>{{$product->name}}</p>
                    <!-- Mua ngay -->
                    <a href="{{route('product.detail', ['item' => $product->id])}}" class="add-to-cart-btn">Mua ngay</a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
<!-- ****** New Arrivals Area End ****** -->
@push('scripts')
@endpush
@endsection