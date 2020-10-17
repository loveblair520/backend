@extends('layouts.app')

@section('css')

@endsection

@section('content')

  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="/admin">後台</a></li>
      <li class="breadcrumb-item active" aria-current="page"><a href="/admin/product_types">商品類別管理</a> </li>
      <li class="breadcrumb-item active" aria-current="page">編輯</li>
    </ol>
  </nav>

  <form method="POST" action="/admin/product_types/{{$product_type->id}}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="type_name">商品類別名稱<small class="text-danger"></small></label>
        <input type="text" id="type_name" class="form-control" name="type_name" required value="{{$product_type->type_name}}">
    </div>
    <div class="form-group">
        <label for="sort">排序</label>
        <input type="number" min="0" step="1" class="form-control" id="sort" name="sort" value="{{$product_type->sort}}" required>
    </div>
    <button type="submit" class="btn btn-primary">編輯</button>
</form>
</div>


@endsection

@section('js')

@endsection
