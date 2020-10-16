@extends('layouts/nav_footer')

@section('content')

<section class="news_info" style="margin-top: 100px">
    <div class="container">
        <h2 class="info_title">{{$product->name}}</h2>
        <div class="row">
            <div class="col-12 my-3 my-md-0 col-md-6">
                <div class="image_box h-100">
                    <a href="" data-lightbox="image-1" data-title="My caption">
                        <img width="100%" src="{{$product->product_image}}" alt="">
                    </a>
                </div>
            </div>
            <div class="col-12 my-3 my-md-0 col-md-6">
                <div class="info_content">
                <h3>價錢:${{$product->price}}</h3>
                {{$product->info}}
                </div>

            </div>
        </div>
    </div>
</section>
@endsection

@section('css')
<link rel="stylesheet" href="./css/news_info.css">
@endsection

@section('js')
{{-- lightbox --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>
@endsection
