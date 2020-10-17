@extends('layouts.app')

@section('css')
 <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css
 ">
@endsection

@section('content')

  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="/admin">後台</a></li>
      <li class="breadcrumb-item active" aria-current="page">商品類別管理</li>
    </ol>
  </nav>

  <a href="/admin/product_types/create" class="btn btn-success mb-3">新增商品類別</a>

  <table id="example" class="table table-striped table-bordered" style="width:100%">
    <thead>
        <tr>
            <th>類別名稱</th>
            <th>排序</th>
            <th width="80">功能</th>
        </tr>
    </thead>
    <tbody>

        @foreach ($product_types as $product_type)
            <tr>
                    <th>{{$product_type->type_name}}</th>
                    <th>{{$product_type->sort}}</th>
                    <th>
                    <a href="/admin/product_types/{{$product_type->id}}/edit" class="btn btn-sm btn-info">編輯</a>
                    <button class="btn btn-danger btn-sm btn-delete" data-ptid="{{$product_type->id}}">刪除</button>
                    <form id="delete-form-{{$product_type->id}}" action="/admin/product_types/{{$product_type->id}}" method="POST" style="display: none;">
                        @csrf
                        @method('DELETE')
                    </form>
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

        <script>
            $(document).ready(function() {
            $('#example').DataTable();
            $("#example").on("click" , ".btn-delete",function(){
                var product_type_id = this.dataset.ptid;

                Swal.fire({
                title: '你確定要刪除嗎？',
                text: "刪除不可以反悔哦！！！！",
                icon: '警告！！！',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes,  it!'
                }).then((result) => {
                if (result.isConfirmed) {
                    $('#delete-form-' + product_type_id).submit();
                }
                })

            });
        } );
        </script>
@endsection
