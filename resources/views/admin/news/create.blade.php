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
    <script>
        $(document).ready(function() {
        $('#content').summernote({
        lang: 'zh-TW',
            toolbar: [
        // [groupName, [list of button]]
        ['style', ['bold', 'italic', 'underline', 'clear']],
        ['font', ['strikethrough', 'superscript', 'subscript']],
        ['insert', ['link', 'picture', 'video']],
        ['fontsize', ['fontsize']],
        ['color', ['color']],
        ['para', ['ul', 'ol', 'paragraph']],
        ['height', ['height']]
            ],
        popover: {
            image: [
                ['image', ['resizeFull', 'resizeHalf', 'resizeQuarter', 'resizeNone']],
                ['float', ['floatLeft', 'floatRight', 'floatNone']],
                ['remove', ['removeMedia']]
            ],
            link: [
                ['link', ['linkDialogShow', 'unlink']]
            ],
            table: [
                ['add', ['addRowDown', 'addRowUp', 'addColLeft', 'addColRight']],
                ['delete', ['deleteRow', 'deleteCol', 'deleteTable']],
            ],
            air: [
                ['color', ['color']],
                ['font', ['bold', 'underline', 'clear']],
                ['para', ['ul', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture']]
            ]
        },

        callbacks: {
            onImageUpload: function(files) {
                $.ajax({
                    type:'post',
                    url:'/ajax_img_upload',
                    data:{
                        img_file:files
                    },
                    success:function(result){
                        // upload image to server and create imgNode...
                        $summernote.summernote('insertNode', result);
                    }
                })

            }
  }

        });;
    });

    </script>
@endsection
