@extends('cms.layouts.web')
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Quản trị</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Cms</a></li>
                    <li class="breadcrumb-item active">List order</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
    <div class="row mb-2">
        <div class="col-sm-6">
        </div><!-- /.col -->
        <div class="col-sm-6">
            <!-- <a href="#"><button type="button" class="btn btn-primary float-sm-right"><i class="fas fa-plus-circle"></i> Thêm</button></a> -->
        </div><!-- /.col -->
    </div><!-- /.row -->
    <div class="row">
        <div class="container-fluid">
            <table class="table table-hover">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">Khách hàng</th>
                        <th scope="col">Ảnh</th>
                        <th scope="col">Sản phẩm</th>
                        <th scope="col">Giá</th>
                        <th scope="col">Số lượng</th>
                        <th scope="col">Tổng</th>
                        <th scope="col">Thời gian</th>
                        <th scope="col">#</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $key => $value)
                    <tr>
                    <td>
                        <p>Tên: {{$value->name}}</p>
                        <p>SĐT: {{$value->phone}}</p>
                        <p>Địa chỉ: {{$value->street}}</p>
                        <p>Ghi chú: {{$value->note}}</p>
                    </td>
                        <td><a href="#"><img style="width: 128px; height: 128px;" src="{{asset('files/')}}/{{$value->product->images[0] ?? ''}}" alt="Product"></a></td>
                        <td>
                            <p>{{$value->product->name ?? ''}}</p>
                            <p>Màu: {{$value->orderProduct->color ?? ''}}</p>
                            <p>size: {{$value->orderProduct->size ?? ''}}</p>
                        
                        </td>
                        <td>{{$value->orderProduct->promotion_price ?? 0}}</td>
                        <td>{{$value->orderProduct->quantity ?? 1}}</td>
                        <td>₫{{$value->total_order}}</td>
                        <td>{{$value->created_at}}</td>
                        <td></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
</section>
<!-- /.content -->
@push('scripts')
<script>
    $('#JsListBill').addClass('active');
</script>
@endpush
@endsection