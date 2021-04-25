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
                    <li class="breadcrumb-item active">List sản phẩm</li>
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
            <a href="{{ route('category.create') }}"><button type="button" class="btn btn-primary float-sm-right"><i class="fas fa-plus-circle"></i> Thêm</button></a>
        </div><!-- /.col -->
    </div><!-- /.row -->
    <div class="row">
        <div class="container-fluid">
            <table class="table">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">name</th>
                        <th scope="col">Description</th>
                        <th scope="col">Trạng thái</th>
                        <th scope="col">#</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $key => $value)
                    <tr>
                        <th scope="row">{{$value->id}}</th>
                        <td>{{$value->name}}</td>
                        <td>{{$value->description}}</td>
                        <td>{{($value->status == 1) ? 'Hoạt động' : 'Không hoạt động'}}</td>
                        <td>
                            {!! Form::open(['route' => ['category.destroy', $value->id], 'method' => 'delete']) !!}
                            <a href="{{route('category.edit', $value->id)}}"><i class="fa fa-edit btn btn-xs"></i></a>
                            {!! Form::button('<i class="fa fa-trash-alt" style="color:red"></i>', ['type' => 'submit', 'class' => 'btn btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                            {!! Form::close() !!}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
</section>
<!-- /.content -->
@push('scripts')
<script>
    $('#JsCategory').addClass('active');
</script>
@endpush
@endsection