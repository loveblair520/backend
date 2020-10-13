@extends('layouts.app')

@section('css')
 <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css
 ">
@endsection

@section('content')

  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="/admin">後台</a></li>
      <li class="breadcrumb-item active" aria-current="page">最新消息管理</li>
    </ol>
  </nav>

  <a href="/admin/news/create" class="btn btn-success mb-3">新增最新消息</a>

  <table id="example" class="table table-striped table-bordered" style="width:100%">
    <thead>
        <tr>
            <th>標題</th>
            <th>圖片</th>
            <th>副標題</th>
            <th>上傳時間</th>
            <th width="150">功能</th>
        </tr>
    </thead>
    <tbody>

        @foreach ($news_list as $news)
            <tr>
                        <th>{{$news->title}}</th>
                        <th><img width="200" src="{{$news->image_url}}" alt=""></th>
                        <th>{{$news->sub_title}}</th>
                        <th>{{$news->created_at}}</th>
                        <th>
                            <a href="news/edit/{{$news->id}}" class="btn btn-sm btn-info">編輯</a>
                            <button class="btn btn-danger btn-sm btn-delete" data-newsid="{{$news->id}}">刪除</button>
                        </th>
                    </tr>
        @endforeach

    </tbody>

</table>

  {{-- {{$news_list}} --}}
@endsection

@section('js')
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>

        <script>
            $(document).ready(function() {
            $('#example').DataTable();
            $("#example").on("click" , ".btn-delete",function(){
                var news_id = this.dataset.newsid;
                var r = confirm("你確定要刪除嗎？");
                if (r == true) {
                    window.location.href = `/admin/news/destroy/${news_id}`;
                }
            });
        } );
        </script>
@endsection
