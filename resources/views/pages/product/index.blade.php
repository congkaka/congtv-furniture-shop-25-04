@extends('layouts.web')
@section('content')
@section('css')
<style>
    .price {
        padding: 16px;
        background: #fafafa;
    }
    .btn-color-active,.btn-size-active {
        background: #ff084e;
        color: white !important;
    }
</style>
@endsection
<!-- <<<<<<<<<<<<<<<<<<<< Breadcumb Area Start <<<<<<<<<<<<<<<<<<<< -->
<div class="breadcumb_area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <ol class="breadcrumb d-flex align-items-center">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item active">Product</li>
                </ol>
                <!-- btn -->
                <a href="/" class="backToHome d-block"><i class="fa fa-angle-double-left"></i> Quay lại trang chủ</a>
            </div>
        </div>
    </div>
</div>
<!-- <<<<<<<<<<<<<<<<<<<< Breadcumb Area End <<<<<<<<<<<<<<<<<<<< -->

<!-- <<<<<<<<<<<<<<<<<<<< Single Product Details Area Start >>>>>>>>>>>>>>>>>>>>>>>>> -->
<section class="single_product_details_area section_padding_0_100">
    <div class="container">
        <div class="row">

            <div class="col-12 col-md-6">
                <div class="single_product_thumb">
                    <div id="product_details_slider" class="carousel slide" data-ride="carousel">
                        @if(!empty($products))
                        <ol class="carousel-indicators">
                            @foreach($products->images as $key =>$imageValue)
                            <li class="{{ ($key == 0) ? 'active' : '' }}" data-target="#product_details_slider" data-slide-to="{{$key}}" style="background-image: url(files/{!!$imageValue!!});">
                            </li>
                            @endforeach

                            @if(!empty($products->color['file']))
                            @php $i = count($products->images) @endphp
                            @foreach($products->color['file'] as $keyfcl =>$colorFile)
                            <li data-target="#product_details_slider" data-slide-to="{{$i}}" style="background-image: url(files/{!!$colorFile!!});">
                            </li>
                            @php $i++ @endphp
                            @endforeach
                            @endif

                        </ol>

                        <div class="carousel-inner">
                            @foreach($products->images as $key =>$imageValue)
                            <div class="carousel-item {{ ($key == 0) ? 'active' : '' }}">
                                <a class="gallery_img" href="{{asset('files')}}/{{$imageValue}}">
                                    <img class="d-block w-100" src="{{asset('files')}}/{{$imageValue}}" alt="First slide">
                                </a>
                            </div>
                            @endforeach
                            @if(!empty($products->color['file']))
                            @foreach($products->color['file'] as $keyfcl =>$colorFile)
                            <div class="carousel-item }}">
                                <a class="gallery_img" href="{{asset('files')}}/{{$colorFile}}">
                                    <img class="d-block w-100" src="{{asset('files')}}/{{$colorFile}}">
                                </a>
                            </div>
                            @endforeach
                            @endif

                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-6">
                <div class="single_product_desc">

                    <h4 class="title"><a href="#">Phòng khách</a></h4>
                    <div class=" _21hHOx" style="display:flex">
                        <div class="_119xyB" style="margin-right: 15px;padding-right: 15px;border-right: 1px solid #bfafaf;">Chưa có đánh giá</div>
                        <div class=" _210dTF">
                            <div class="aca9MM"><b>0</b> Đã bán</div>
                        </div>
                    </div>
                    <h4 class="price">
                        <p style="font-size: 1.875rem;font-weight: 500;color: #ee4d2d;">{{(!empty($products->price) ? '₫' : '')}}<span id="jsprice">{{$products->price}}</span> - {{(!empty($products->promotion_price) ? '₫' : '')}}<span id="jspromotion">{{$products->promotion_price}}</span></p>
                    </h4>

                    <p class="available">Trạng thái: <span class="text-muted">Còn hàng</span></p>

                    <div class="single_product_ratings mb-15">
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star-o" aria-hidden="true"></i>
                    </div>

                    <div class="widget size mb-30">
                        <h6 class="widget-title">Màu sắc</h6>
                        <div class="widget-desc">
                            <ul>
                                @if(!empty($products->color['file']))
                                    @php $i = count($products->images) @endphp
                                    @foreach($products->color['name'] as $keyfcl =>$colorFile)
                                        @if(!empty($colorFile))
                                        <li data-target="#product_details_slider" data-slide-to="{{$i}}"><a class="btn-color" data-price="{{$products->color['price'][$keyfcl]}}">{{$colorFile}}</a></li>
                                        @php $i++ @endphp
                                        @endif
                                    @endforeach
                                @endif
                            </ul>
                        </div>
                    </div>
                    <div class="widget size mb-30">
                        <h6 class="widget-title">Size</h6>
                        <div class="widget-desc">
                            <ul>
                                @foreach($products->size['name'] as $keysz =>$size)
                                @if(!empty($size))
                                <li><a class="btn-size" data-price="{{$products->size['price'][$keysz]}}" data-promotion-price="{{$products->size['promotionPrice'][$keysz]}}">{{$size}}</a></li>
                                @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    <!-- Add to Cart Form -->
                    <!-- <form  method="post"> -->
                    <div class="cart clearfix mb-30 d-flex">
                        <div class="quantity">
                            <span class="qty-minus" onclick="var effect = document.getElementById('qty'); var qty = effect.value; if( !isNaN( qty ) &amp;&amp; qty &gt; 1 ) effect.value--;return false;"><i class="fa fa-minus" aria-hidden="true"></i></span>
                            <input onchange="check()" type="number" class="qty-text" id="qty" step="1" min="1" max="12" name="quantity" value="1">
                            <span class="qty-plus" onclick="var effect = document.getElementById('qty'); var qty = effect.value; if( !isNaN( qty )) effect.value++;return false;"><i class="fa fa-plus" aria-hidden="true"></i></span>
                        </div>
                        <button type="button" name="addtocart" id="addtocart" value="5" class="btn cart-submit d-block">Thêm vào rỏ hàng</button>
                    </div>
                    <p id="product-exist">{{$products->exist}} sản phẩm có sẵn </p>
                    <p id="product-exist-warning" style="color:red"></p>
                    <input hidden id="productExist" name="productExist" value="{{$products->exist}}" type="text">
                    <input hidden id="productId" name="productId" value="{{$products->id}}" type="text">
                    <input hidden id="price" name="price" value="{{$products->price}}" type="text">
                    <input hidden id="promotionPrice" name="promotionPrice" value="{{$products->promotion_price}}" type="text">
                    <input hidden  name="txtColor" id="txtColor" value="" type="text">
                    <input hidden  name="txtSize" id="txtSize" value="" type="text">
                    <input hidden  name="variant" id="variant" value="" type="text">
                    <!-- </form> -->
                    <!-- </form> -->
                    <div id="accordion" role="tablist">
                        <div class="card">
                            <div class="card-header" role="tab" id="headingOne">
                                <h6 class="mb-0">
                                    <a data-toggle="collapse" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">Mô tả sản phẩm</a>
                                </h6>
                            </div>

                            <div id="collapseOne" class="collapse show" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion">
                                <div class="card-body">
                                    {!! $products->description !!}
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header" role="tab" id="headingTwo">
                                <h6 class="mb-0">
                                    <a class="collapsed" data-toggle="collapse" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">Đánh giá </a>
                                </h6>
                            </div>
                            <div id="collapseTwo" class="collapse" role="tabpanel" aria-labelledby="headingTwo" data-parent="#accordion">
                                <div class="card-body">

                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header" role="tab" id="headingThree">
                                <h6 class="mb-0">
                                    <a class="collapsed" data-toggle="collapse" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">Vận chuyển &amp; Trả lại</a>
                                </h6>
                            </div>
                            <div id="collapseThree" class="collapse" role="tabpanel" aria-labelledby="headingThree" data-parent="#accordion">
                                <div class="card-body">

                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
<!-- <<<<<<<<<<<<<<<<<<<< Single Product Details Area End >>>>>>>>>>>>>>>>>>>>>>>>> -->

<!-- ****** Quick View Modal Area Start ****** -->
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
                                <!-- Add to Cart Form -->
                                <form class="cart" method="post">
                                    <div class="quantity">
                                        <span class="qty-minus" onclick="var effect = document.getElementById('qty'); var qty = effect.value; if( !isNaN( qty ) &amp;&amp; qty &gt; 1 ) effect.value--;return false;"><i class="fa fa-minus" aria-hidden="true"></i></span>

                                        <input type="number" class="qty-text" id="qty2" step="1" min="1" max="12" name="quantity" value="1">

                                        <span class="qty-plus" onclick="var effect = document.getElementById('qty'); var qty = effect.value; if( !isNaN( qty )) effect.value++;return false;"><i class="fa fa-plus" aria-hidden="true"></i></span>
                                    </div>
                                    <button type="submit" name="addtocart" value="5" class="cart-submit">Add to cart</button>
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

<section class="you_may_like_area clearfix">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section_heading text-center">
                    <h2>Sản phẩm tương tự</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="you_make_like_slider owl-carousel">
                    @foreach($productEquivalents as $productEquivalent)
                    <!-- Single gallery Item -->
                    <div class="single_gallery_item">
                        <!-- Product Image -->
                        <div class="product-img">
                            <img src="{{asset('files')}}/{{$productEquivalent->images[0]}}" alt="">
                            <div class="product-quicview">
                                <a href="#" data-toggle="modal" data-target="#quickview"><i class="ti-plus"></i></a>
                            </div>
                        </div>
                        <!-- Product Description -->
                        <div class="product-description">
                            <h4 class="product-price">{{number_format($productEquivalent->promotion_price)}}₫</h4>
                            <p>{{$productEquivalent->name}}</p>
                            <!-- Add to Cart -->
                            <a href="#" class="add-to-cart-btn">Mua ngay</a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
@push('scripts')
<script type="text/javascript">
    $('.btn-color').click(function () {
        $('.btn-color').removeClass('btn-color-active');
        $(this).addClass('btn-color-active');
        $('#variant').val($(this).data('price'));
    });
    $('.btn-size').click(function () {
        $('.btn-size').removeClass('btn-size-active');
        $(this).addClass('btn-size-active');
        //price with size
        var variant = $('#variant').val();
        if (variant != '') {
            var price = $(this).data('price');
            var promotionPrice = $(this).data('promotion-price');
            if(price != '') {
                $('#jsprice').text(Number(price) + Number(variant));
            }
            if(promotionPrice != '') {
                $('#jspromotion').text(Number(promotionPrice) + Number(variant));
            }
        }        

    });
    function check() {
        var id = $('#qty').val();
        var exist = $('#productExist').val();
        if (id > exist) {
            $('#product-exist-warning').text('Quá số lượng đặt hàng');
            $('#qty').val(0);
        }
    };
    $('#addtocart').click( function() {
        var url = "{{route('product.order')}}";
        var quantity = $('#qty').val();
        if(quantity <= 0) {
            alert('Số lượng sản phẩm lớn hơn 0');
            return false;
        }
        var color = $('.btn-color-active').text();
        var size = $('.btn-size-active').text();
        if(color == '' || size == '') {
            alert('Vui lòng chọn phân loại hàng');
            return false;
        }
        var productId = $('#productId').val();
        var data = {
            '_token': '{{ csrf_token() }}',
            'id': 1,
            'color': color,
            'size': size,
            'quantity': quantity,
            'productId': productId,
            'price': $('#jsprice').text(),
            'promotionPrice': $('#jspromotion').text(),
        }
        // console.log(data); return;
        $.ajax({
                type: 'POST',
                url: url,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: data,
                dataType : 'json',
                success: function(data) {
                    if (data.status == 1) {
                        alert(data.message); 
                        window.location.replace(data.url);
                    }else{
                        alert(data.message); return false;
                    }
                }
        });
    });
</script>
@endpush
@endsection

