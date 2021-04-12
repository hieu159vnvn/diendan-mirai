@extends('admin.master')
@section('title', __($group->tennhom))
@section('PageContent')
<div class="row border-bottom bd-lightGray mt-4">
    <div class="col-md-4 text-center text-left-md">
        <h3 class="content_title m-0">{{$group->tennhom}}</h3>
    </div>

    @if (Auth::user()->id == $group->nguoiquanly || Auth::user()->id == 1)
        <div class="col-md-8 d-flex flex-justify-center flex-justify-end-md">
            <a href="/addthanhvien/{{$group->id}}" class="image-button success mr-5"><span class="mif-users icon"></span><span class="caption">Thêm thành viên</span></a>
            <a href="/pheduyet/group/{{$group->id}}" class="image-button warning"> <span class="badge">{{$duyetpost}}</span><span class="mif-books icon"></span><span class="caption">Duyệt bài viết</span></a>
        </div>
    @endif
</div>
<section class="tables_wrapper">
    <aside class="tables_components">
        <div class="row">
            <div class="col-12">
                <div class="bg-white p-4">
                    <div class="custom_table-wrapper">
                        @if ($checkguess->role_id != 3)
                            <a style="float:right;" href="/addpost/{{$group->id}}" class="image-button primary"><span class="mif-plus icon"></span><span class="caption">Thêm bài viết</span></a>
                        @endif
                        <div class="custom_table-top d-flex flex-wrap flex-nowrap-lg flex-align-center flex-justify-center flex-justify-start-lg mb-2">
                            <div class="custom_table-search w-100 w-auto-lg mb-2 mb-0-lg"></div>
                            <div class="custom_table-rows mx-2"></div>
                        </div>
                        <table class="table table-border cell-border" id="table1" data-role="table" data-search-wrapper=".custom_table-search" data-rows-wrapper=".custom_table-rows" data-info-wrapper=".custom_table-info" data-pagination-wrapper=".custom_table-pagination" data-pagination-short-mode="true" data-horizontal-scroll="true" data-check="fakse" data-check-style="2" data-rownum="true">
                            <thead>
                                <tr>
                                    <th>Tiêu đề</th>
                                    <th>Người đăng</th>
                                    <th>Ngày đăng</th>
                                    @if (Auth::user()->id == $group->nguoiquanly || Auth::user()->id == 1)
                                    <th>Thao tác</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($post as $item)
                                    <tr>
                                        <td><a class="fg-blue" href="/post/{{$item->id}}">{{$item->ten}}</a></td>
                                        <td>
                                            @foreach ($user as $us)
                                                @if ($us->id == $item->nguoitao)
                                                    {{$us->name}}
                                                @endif
                                            @endforeach
                                        </td>
                                        <td>{{date("H:i:s d-m-Y",strtotime($item->created_at))}}</td>
                                        @if (Auth::user()->id == $group->nguoiquanly || Auth::user()->id == 1)
                                        <td>
                                            <div  style="text-align: center;color:white;">
                                                <a id="{{$item->id}}" class="mt-1 button cycle square alert btn-delete" data-role="hint"
                                                    data-hint-text="Xóa bài"><span class="mif-bin"></span></a>
                                            </div>
                                        </td>
                                        @endif
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
        timer: 5000
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
                window.location.reload(true);
                if (result.value) {
                    $.get("/post/delete/"+id);
                    Swal.fire(
                    'Đã xóa!',
                    'Your file has been deleted.',
                    'success'
                    )
                }
                else{
                    Swal.fire(
                    'Không xóa được!',
                    'Your file has been deleted.',
                    'warning'
                    )
                }
            })
        });
    });
</script>
@endsection
