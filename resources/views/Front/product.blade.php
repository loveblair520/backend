@extends('layouts/nav_footer')

@section('content')
<section class="news">
    <div class="container">
        <h2 class="news_title">商品清單</h2>
        <div class="row news_lists">

            @foreach ($product_types as $product_type)
            <div class="mb-3">
                <h1>{{$product_type->type_name}}</h1>
                <div class="row">
                    @foreach ($product_type->products as $product)
                    <div class="col-md-4">
                        <div class="news_list">
                        <h3>{{$product->name}}</h3>
                            <h4>價錢{{$product->price}}</h4>
                            <img width="100%" src="{{$product->product_image}}" alt="圖片建議尺寸: 1000 x 567">
                            <p class="news_content">{{$product->info}}</p>
                            <a class="btn btn-success" href="/product/{{$product->id}}" role="button">點擊查看更多 &raquo;</a>
                        </div>
                    </div>
                @endforeach
                </div>

                {{-- {{$product_type->products}} --}}
            </div>
            @endforeach

             {{-- @foreach ($product_type as $news)
                <div class="col-md-4">
                    <div class="news_list">
                    <h3>{{$news->title}}</h3>
                        <h4>{{$news->sub_title}}</h4>
                        <img width="100%" src="{{$news->image_url}}" alt="圖片建議尺寸: 1000 x 567">
                        <p class="news_content">{{$news->content}}</p>
                        <a class="btn btn-success" href="/news_info/{{$news->id}}" role="button">點擊查看更多 &raquo;</a>
                    </div>
                </div>
            @endforeach --}}
        </div>
    </div>
</section>
@endsection


@section('css')
<link rel="stylesheet" href="./css/news.css">
@endsection
