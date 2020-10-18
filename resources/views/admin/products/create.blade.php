@extends('layouts.app')

@section('css')

@endsection

@section('content')

  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="/admin">後台</a></li>
      <li class="breadcrumb-item active" aria-current="page"><a href="/admin/products">商品管理</a> </li>
      <li class="breadcrumb-item active" aria-current="page">新增</li>
    </ol>
  </nav>

  <form method="POST" action="/admin/products/store" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="product_type_id">商品類別<small class="text-danger"></small></label>
        <select class="form-control" name="product_type_id" id="product_type_id">
            @foreach ($product_types as $product_type)
        <option value="{{$product_type->id}}">{{$product_type->type_name}}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="name">商品名稱<small class="text-danger">（限制至多20字）</small></label>
        <input type="text" class="form-control" id="name" aria-describedby="emailHelp" name="name" required>
    </div>
    <div class="form-group">
        <label for="price">價錢</label>
        <input type="number" class="form-control" id="price" aria-describedby="title" name="price" required>
      </div>
      <div class="form-group">
        <label for="product_image">上傳商品圖片<small class="text-danger">（建議圖片寬高為4:3）</small></label>
        <input type="file" class="form-control-file" id="product_image" name="product_image" required>
      </div>
      <div class="form-group">
        <label for="multi_images">內頁多張圖片上傳
            <small class="text-danger">（建議圖片寬高為4:3）</small>
        </label>
        <input type="file" class="form-control-file" id="multi_images" name="multi_images[]" multiple required>
      </div>
      <div class="form-group">
        <label for="info">介紹內容</label>
        <textarea class="form-control" id="info" rows="3" name="info" required></textarea>
      </div>
    <button type="submit" class="btn btn-primary">新增</button>
</form>
</div>


@endsection

@section('js')

@endsection
