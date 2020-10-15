@extends('layouts.app')

@section('css')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">

@endsection

@section('content')

  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="/admin">後台</a></li>
      <li class="breadcrumb-item active" aria-current="page"><a href="/admin/news">最新消息管理</a> </li>
      <li class="breadcrumb-item active" aria-current="page">新增</li>
    </ol>
  </nav>

  <form method="POST" action="/admin/news/store" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="title">標題<small class="text-danger">（限制至多20字）</small></label>
        <input type="text" class="form-control" id="title" aria-describedby="emailHelp" name="title" required>
    </div>
    <div class="form-group">
        <label for="sub_title">副標題</label>
        <input type="text" class="form-control" id="sub_title" aria-describedby="title" name="sub_title" required>
      </div>
      <div class="form-group">
        <label for="image_url">上傳主要照片<small class="text-danger">（建議圖片寬高為4:3）</small></label>
        <input type="file" class="form-control-file" id="image_url" name="image_url" required>
      </div>
      <div class="form-group">
        <label for="content">內容</label>
        <textarea class="form-control" id="content" rows="3" name="content" required></textarea>
      </div>
    <button type="submit" class="btn btn-primary">新增</button>
</form>
</div>


@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <script src="/js/summernote/lang_zh_TW.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/lang/summernote-zh-TW.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#content').summernote({
                height: 150,
                lang: 'zh-TW',
                callbacks: {
                    onImageUpload: function(files) {
                        for(let i=0; i < files.length; i++) {
                            $.upload(files[i]);
                        }
                    },
                    onMediaDelete : function(target) {
                        $.delete(target[0].getAttribute("src"));
                    }
                },
            });


            $.upload = function (file) {
                let out = new FormData();
                out.append('file', file, file.name);

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    method: 'POST',
                    url: '/admin/ajax_upload_img',
                    contentType: false,
                    cache: false,
                    processData: false,
                    data: out,
                    success: function (img) {
                        $('#description').summernote('insertImage', img);
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        console.error(textStatus + " " + errorThrown);
                    }
                });
            };

            $.delete = function (file_link) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    method: 'POST',
                    url: '/admin/ajax_delete_img',
                    data: {file_link:file_link},
                    success: function (img) {
                        console.log("delete:",img);
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        console.error(textStatus + " " + errorThrown);
                    }
                });
            }
       });
    </script>



@endsection
