<style>
    .product-color {
        box-shadow: 0 0 1px rgb(0 0 0 / 13%), 0 1px 3px rgb(0 0 0 / 20%);
        padding: 30px;
    }
</style>
<div class="card-body">
    <div class="form-group">
        <label for="name">Tên sản phẩm</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="" value="{{$product->name}}" required>
    </div>
    <!-- <div class="form-group">
        <label class="form-label" for="product_images">Avatar</label>
        <input type="file" class="form-control" name="product_images[]" />
    </div> -->
    <div class="form-group">
        <label for="description">Loại sản phẩm</label>
        <select class="form-select form-control" aria-label="Default select example" name="category_id" required>
            @foreach($categorys as $value)
            <option value="{{$value->id}}" @if($product->category_id == $value->id) selected @endif >{{$value->name}}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label class="form-label" for="price">Giá</label>
        <input type="number" class="form-control" id="price" name="price" max="1000000000000" min="1" value="{{$product->price}}" required />
    </div>
    <div class="form-group">
        <label class="form-label" for="promotion_price">Giá khuyến mại</label>
        <input type="number" class="form-control" id="promotion_price" name="promotion_price" max="1000000000000" min="1" value="{{$product->promotion_price}}" required />
    </div>
    <div class="form-group">
        <label class="form-label" for="exist">Số lượng</label>
        <input type="number" class="form-control" id="exist" name="exist" max="1000000000000" min="1" value="{{$product->exist}}" required />
    </div>
    <div class="form-group">
        <label class="form-label" for="prodcut_color">Màu</label>
        <div class="product-color">
            @foreach($product->color['name'] ?? [0,1,2,3] as $key => $productColors)
            <div class="row">
                <div class="col-4">Màu {{$key}}: <input type="text" class="form-control" name="prodcut_color[name][]" value="{{(!empty($product->color['name'])) ? $productColors : ''}}"></div>
                <div class="col-7">Ảnh: <input type="file" class="form-control" name="prodcut_color[file][]" value="{{$product->color['file'][$key] ?? ''}}" /></div>
                @if(!empty($product->color['file'][$key]))
                <div class="col-1" >Avatar: <img class="form-control" style="width: 60px;height: 45px;" src="{{asset('files/')}}/{{$product->color['file'][$key]}}" alt=""></div>
                @endif
            </div>
            @endforeach
        </div>
    </div>
    <div class="form-group">
        <label class="form-label" for="product_size">size</label>
        <div class="product-color">
            <div class="row">
            @foreach($product->size ?? [0,1,2,3,4,5] as $key => $size)
                <div class="col-4">size {{$key}}: <input type="text" name="product_size[]" class="form-control" value="{{(!empty($product->size)) ? $size  : ''}}"></div>
            @endforeach
            </div>
        </div>
    </div>
    <div class="form-group">
        <label class="form-label" for="customFile">Ảnh mô tả</label>
        <div class="product-color">
            <div class="row">
            @foreach($listFramImages as $key => $images)
            @if(!empty($product))
            <div class="col-3"><input type="file" class="form-control" name="product_images[]" value="{{$product->images[$key] ?? ''}}" /></div>
            @if(!empty($product->images[$key]))
                <div class="col-1" ><img class="" style="width: 60px;height: 35px;" src="{{asset('files/')}}/{{$product->images[$key]}}" alt=""></div>
            @else
                <div class="col-1" ></div>
            @endif

            @else
            <div class="col-3"><input type="file" class="form-control" name="product_images[]" value="" /></div>
             @endif
            @endforeach
            </div>
        </div>
    </div>
    <div class="form-group">
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-outline card-info">
                        <div class="card-header">
                            <h3 class="card-title">
                                Nhập mô tả sản phẩm
                            </h3>
                            <!-- tools box -->
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool btn-sm" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                    <i class="fas fa-minus"></i></button>
                                <button type="button" class="btn btn-tool btn-sm" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                                    <i class="fas fa-times"></i></button>
                            </div>
                            <!-- /. tools -->
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body pad">
                            <div class="mb-3">
                                <textarea class="textarea" id="description" name="description" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{!! $product->description !!}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.col-->
            </div>
            <!-- ./row -->
        </section>
    </div>
    <div class="form-check">
        <input type="checkbox" class="form-check-input" id="staus" name="status" @if($product->status ?? 1 == 1) checked @endif>
        <label class="form-check-label" for="staus">Hoạt động</label>
    </div>
</div>
<!-- /.card-body -->

<div class="card-footer">
    <button type="submit" class="btn btn-primary">Submit</button>
</div>