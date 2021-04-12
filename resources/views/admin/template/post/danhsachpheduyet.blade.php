@extends('admin.master')
@section('title','Phê duyệt bài viết')
@section('PageContent')
<div class="row border-bottom bd-lightGray mt-4">
    <div class="col-md-4 text-center text-left-md">
        <h3 class="content_title m-0">Phê duyệt bài viết</h3>
    </div>
</div>
<section class="tables_wrapper">
    <aside class="tables_components">
        <div class="row">
            <div class="col-12">
                <div class="bg-white p-4">
                    <div class="custom_table-wrapper">
                        <div class="custom_table-top d-flex flex-wrap flex-nowrap-lg flex-align-center flex-justify-center flex-justify-start-lg mb-2">
                            <div class="custom_table-search w-100 w-auto-lg mb-2 mb-0-lg"></div>
                            <div class="custom_table-rows mx-2"></div>
                        </div>
                        <table class="table table-border cell-border" id="table1" data-role="table" data-search-wrapper=".custom_table-search" data-rows-wrapper=".custom_table-rows" data-info-wrapper=".custom_table-info" data-pagination-wrapper=".custom_table-pagination" data-pagination-short-mode="true" data-horizontal-scroll="true" data-check="fakse" data-check-style="2" data-rownum="true">
                            <thead>
                                <tr>
                                    {{-- <th>Nhóm</th> --}}
                                    <th>Tiêu đề</th>
                                    <th>Người đăng</th>
                                    <th>Ngày đăng</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($post as $item)
                                <tr>
                                        {{-- <td>
                                            @foreach ($group as $gr)
                                                @if ($gr->id == $item->id_group)
                                                    {{$gr->tennhom}}
                                                @endif
                                            @endforeach
                                        </td> --}}
                                        <td>{{$item->ten}}</td>
                                        <td>
                                            @foreach ($user as $us)
                                                @if ($us->id == $item->nguoitao)
                                                    {{$us->name}}
                                                @endif
                                            @endforeach
                                        </td>
                                        <td>{{date("H:i:s d-m-Y",strtotime($item->created_at))}}</td>
                                        <td>
                                            <div  style="text-align: center;color:white;">
                                                <a href="/pheduyet/{{$item->id}}" class="mt-1 button cycle square warning" data-role="hint"
                                                    data-hint-text="Xem"><span class="mif-eye"></span></a>
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
        timer: 5000
        })
    }
</script>
@endsection
