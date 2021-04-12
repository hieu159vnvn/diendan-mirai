@extends('admin.master')
@section('title', 'Danh sách người dùng')
@section('PageContent')
<div class="row border-bottom bd-lightGray mt-4">
    <div class="col-md-4 text-center text-left-md">
        <h3 class="content_title m-0">Danh sách người dùng</h3>
    </div>
    <div class="col-md-8 d-flex flex-justify-center flex-justify-end-md">
        <ul class="breadcrumbs bg-transparent m-0">
            <li class="page-item"><a class="page-link" href="/"><span class="mdi mdi-home"></span></a></li>
            <li class="page-item"><a class="page-link" href="#">Danh sách người dùng</a></li>
        </ul>
    </div>
</div>
<section class="tables_wrapper">
    <aside class="tables_components">
        <div class="row">
            <div class="col-12">
                <div class="bg-white p-4">
                    <div class="custom_table-wrapper">
                        <a style="float:right;" href="/signup" class="image-button primary"><span class="mif-plus icon"></span><span class="caption">Thêm</span></a>
                        <div class="custom_table-top d-flex flex-wrap flex-nowrap-lg flex-align-center flex-justify-center flex-justify-start-lg mb-2">
                            <div class="custom_table-search w-100 w-auto-lg mb-2 mb-0-lg"></div>
                            <div class="custom_table-rows mx-2"></div>
                        </div>
                        <table class="table table-border cell-border"  data-table-search-title="Tìm kiếm" data-table-rows-count-title="Hiển thị" id="table1" data-role="table" data-search-wrapper=".custom_table-search" data-rows-wrapper=".custom_table-rows" data-info-wrapper=".custom_table-info" data-pagination-wrapper=".custom_table-pagination" data-pagination-short-mode="true" data-horizontal-scroll="true" data-check="fakse" data-check-style="2" data-rownum="true">
                            <thead>
                                <tr>
                                    <th>Tên người dùng</th>
                                    <th>Email</th>
                                    <th>Vai trò</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $item)
                                    <tr>
                                        <td>{{$item->name}}</td>
                                        <td>{{$item->email}}</td>
                                        <td>
                                            @foreach($item->roles as $role)
                                                {{ $role->name }}
                                            @endforeach
                                        </td>
                                        <td >
                                            <div style="text-align: center;color:white;width:77px">
                                                <a href="/editnguoidung/{{$item->id}}" class="mt-1 button cycle square primary"><span class="mif-wrench"></span></a>
                                                <a id="{{$item->id}}" class="mt-1 button cycle square alert btn-delete"><span class="mif-cross"></span></a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="custom_table-bottom d-flex flex-wrap flex-nowrap-lg flex-align-center flex-justify-center flex-justify-start-lg mb-2">
                            <div class="custom_table-info w-100 w-auto-lg mb-2 mb-0-lg"></div>
                            <div class="custom_table-pagination ml-auto-lg"></div>
                            <div class="content"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </aside>
</section>
@endsection
@section('JsLibraries')
<script>
    var msg = '{{Session::get('addsuccess')}}';
    var exist = '{{Session::has('addsuccess')}}';
    if(exist){
        Swal.fire({
        position: 'top-end',
        icon: 'success',
        title: msg,
        showConfirmButton: false,
        timer: 1500
        })
    }
</script>
<script>
    $(function() {
        $(".btn-delete").on('click',function(e){
            var id = $(this).attr('id');
            Swal.fire({
            title: 'Bạn có chắc chắn?',
            text: "Xóa sẽ không phục hồi lại được!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes!'
            }).then((result) => {
                location.reload(true);
                if (result.value) {
                    if(id!=1){
                        $.get("/deletenguoidung/"+id);
                        Swal.fire(
                        'Đã xóa!',
                        'Your file has been deleted.',
                        'success'
                        )
                    }
                    else{
                        Swal.fire(
                        'Không được xóa admin',
                        'Can not delete admin',
                        'warning'
                        )
                    }
                }
                else{
                    Swal.fire(  
                    'Đã hủy!',
                    'Can not delete',
                    'error'
                    )
                }
            })
        });
    });
</script>
@endsection