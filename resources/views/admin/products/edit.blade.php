@extends('layouts.app')

@section('css')

@endsection

@section('content')

  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="/admin">後台</a></li>
      <li class="breadcrumb-item active"><a href="/admin/news">商品管理</a> </li>
      <li class="breadcrumb-item active" aria-current="page">編輯</li>
    </ol>
  </nav>

<form method="POST" action="/admin/products/update/{{$products->id}}" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="title">標題<small class="text-danger">（限制至多20字）</small></label>
    <input type="text" class="form-control" id="title" aria-describedby="emailHelp" name="title" value="{{$products->name}}" required>
    </div>
    <div class="form-group">
        <label for="sub_title">副標題</label>
        <input type="text" class="form-control" id="sub_title" aria-describedby="title" name="sub_title" value="{{$news->sub_title}}" required>
      </div>
      <div class="form-group">
        <label for="image_url">現有主要照片<small class="text-danger">（建議圖片寬高為4:3）</small></label>
      <img class="img-fluid" width="200" src="{{$products->product_image}}" alt="">
        <label for="image_url">修改主要照片<small class="text-danger">（建議圖片寬高為4:3）</small></label>
        <input type="file" class="form-control-file" id="image_url" name="image_url" >
      </div>
      <div class="form-group">
        <label for="content">內容</label>
        <textarea class="form-control" id="content" rows="3" name="content" value="{{$products->info}}" required></textarea>
      </div>
    <button type="submit" class="btn btn-primary">編輯</button>
</form>
</div>


@endsection

@section('js')

@endsection
