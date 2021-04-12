@extends('admin.master')
@section('title', __('Thêm thành viên '.$group->tennhom))
@section('PageContent')
<div class="row border-bottom bd-lightGray mt-4">
    <div class="col-md-4 text-center text-left-md">
        <h3 class="content_title m-0">Thêm thành viên {{$group->tennhom}}</h3>
    </div>
</div>
<section class="forms_wrapper">
    <aside class="forms_extended">
        <div class="row">
            <div class="col-12">
                <div class="bg-white p-4">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{$group->id}}" class="ui form" action="" method="post" name="form_1">
                    {{ csrf_field() }}
                    <div class="row flex-align-end">
                        <div class="form-group col-sm-12 mt-0">
                            <h6>Chọn thành viên</h6>
                            <input name="idgroup" type="hidden" value="{{$group->id}}">
                            <select name="thanhvien[]" multiple data-role="select" data-duration="0">
                                @foreach ($roles as $role)
                                    @foreach ($users as $item)
                                        @if($role->user_id == $item->id){
                                            <option value="{{$item->id}}" @if(in_array($item->id, $member)) selected @endif>{{$item->name}}</option>
                                        }
                                        @endif
                                    @endforeach
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-sm-12 mt-0">
                            <button class="mt-1 image-button primary"><span class="mif-checkmark icon"></span><span class="caption">Lưu</span></button>
                        </div>
                    </div>
                </form>
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
@endsection
