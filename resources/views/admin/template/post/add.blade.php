@extends('admin.master')
@section('title', 'Thêm bài viết')
@section('PageContent')
<div class="row border-bottom bd-lightGray mt-4">
    <div class="col-md-4 text-center text-left-md">
        <h3 class="content_title m-0">Thêm bài viết</h3>
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
                <form class="ui form" action="" method="post" name="form_1" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="row flex-align-end">
                        <div class="form-group col-sm-12 mt-0">
                            <h6>Tiêu đề</h6>
                            <input type="text" data-role="input" name="ten" value="{{ old('ten') }}" required>
                        </div>
                        <div class="form-group col-sm-12 mt-0">
                            <h6>Nội dung</h6>
                            <textarea name="noidung" class="textarea-400"></textarea>
						</div>
                        <div class="form-group col-sm-12 mt-0">
                            <h6>Đính kèm</h6>
                            <input type="file" data-role="file" data-prepend="Chọn file từ máy tính (tải nhiều tệp vui lòng nén lại):" name="dinhkem"  accept=".xlsx, .xls, .csv, image/*, .doc, .docx, .zip, .rar, .7zip">
                        </div>
                        <div class="form-group col-sm-12 mt-0">
                            <a href="/group/{{$idgroup}}" class="mt-1 image-button"><span class="mif-backward icon"></span><span class="caption">Quay lai</span></a>
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
    <base href="{{asset('')}}">
    <script src="tinymce/tinymce.min.js"></script>
    <script src="tinymce/config_Tinymce.js"></script>
    <link rel="stylesheet" href="fancybox/jquery.fancybox.css">
    <script src="fancybox/vhn_customs/preview-img.js"></script>
    <link  href="fancybox/vhn_customs/preview-img.css">
    <script src="fancybox/jquery.fancybox.pack.js"></script>
    <script src="fancybox/vhn_customs/config_Fancybox.js"></script>
@endsection
