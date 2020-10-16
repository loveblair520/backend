@extends('layouts.app')

@section('css')

@endsection

@section('content')

  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="/admin">後台</a></li>
      <li class="breadcrumb-item active"><a href="/admin/products">商品管理</a> </li>
      <li class="breadcrumb-item active" aria-current="page">編輯</li>
    </ol>
  </nav>

<form method="POST" action="/admin/products/update/{{$products->id}}" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="name">商品名稱<small class="text-danger">（限制至多20字）</small></label>
    <input type="text" class="form-control" id="name" aria-describedby="emailHelp" name="name" value="{{$products->name}}" required>
    </div>
    <div class="form-group">
        <label for="price">價錢</label>
        <input type="number" class="form-control" id="price" aria-describedby="title" name="price" value="{{$products->price}}" required>
      </div>
      <div class="form-group">
        <label for="product_image">現有商品照片<small class="text-danger">（建議圖片寬高為4:3）</small></label>
      <img class="img-fluid" width="200" src="{{$products->product_image}}" alt="">
        <label for="product_image">修改商品照片<small class="text-danger">（建議圖片寬高為4:3）</small></label>
        <input type="file" class="form-control-file" id="product_image" name="product_image" >
      </div>
      <div class="form-group">
        <label for="info">介紹內容</label>
        <textarea class="form-control" id="info" rows="3" name="info" required>{{$products->info}}</textarea>
      </div>
    <button type="submit" class="btn btn-primary">編輯</button>
</form>
</div>


@endsection

@section('js')

@endsection
