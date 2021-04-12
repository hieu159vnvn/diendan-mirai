@extends('admin.master')
@section('title', 'Phê duyệt bài viết')
@section('PageContent')
<div class="row border-bottom bd-lightGray mt-4">
    <div class="col-md-4 text-center text-left-md">
        <h3 class="content_title m-0">Phê duyệt bài viết</h3>
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
                <form class="ui form" action="" method="post" name="form_1">
                    {{ csrf_field() }}
                    <div class="row flex-align-end">
                        <div class="form-group col-sm-12 mt-0">
                            <h6>Tiêu đề</h6>
                            <p>{{$post->ten}}</p>
                        </div>
                        <div class="form-group col-sm-12 mt-0">
                            <h6>Nội dung</h6>
                            <p>{!!$post->noidung!!}</p>
						</div>
                        <a href={{ asset('public/'.$post->dinhkem)}} download class="ml-2 mt-1 image-button warning"><span class="mif-books icon"></span><span class="caption">Tải file đính kèm</span></span></a>
                         <div class="form-group col-sm-12 mt-0">
                            <a href="/pheduyet/group/{{$post->id_group}}" class="mt-1 image-button"><span class="mif-backward icon"></span><span class="caption">Quay lai</span></a>
                            <button class="mt-1 image-button primary"><span class="mif-checkmark icon"></span><span class="caption">Duyệt bài</span></button>
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

@endsection
