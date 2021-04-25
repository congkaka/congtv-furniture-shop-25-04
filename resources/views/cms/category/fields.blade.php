<div class="card-body">
    <div class="form-group">
        <label for="name">Tên danh mục</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="" value="{{$categorys->name}}" required>
    </div>
    <div class="form-group">
        <label for="description">Mô tả</label>
        <textarea id="description" name="description" class="form-control" rows="4" cols="50">{{$categorys->description}}</textarea>
    </div>
    <div class="form-check">
        <input type="checkbox" class="form-check-input" id="staus" name="status" @if($categorys->status ?? 1 == 1) checked @endif>
        <label class="form-check-label" for="staus">Hoạt động</label>
    </div>
</div>
<!-- /.card-body -->

<div class="card-footer">
    <button type="submit" class="btn btn-primary">Submit</button>
</div>