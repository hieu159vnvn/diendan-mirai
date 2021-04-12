@extends('admin.master')
@section('title', 'Welcome')
@section('PageContent')
<div class="row bd-lightGray mt-4">
    @permission('add-group')
        <div class="d-flex flex-justify-center flex-justify-end-md">
            <a href="/taonhom" class="image-button success "><span class="mif-plus icon"></span><span class="caption">Tạo nhóm mới</span></a>
        </div>
    @endpermission
    <section class="dashboard_wrapper">
        <aside class="dashboard_general">
            <div class="row">
                @php
                    $group = DB::table('group')->where('stt',1)->get();
                @endphp
                @foreach ($group as $item)
                    @php
                        $member = DB::table("user_group")->where("user_group.group",$item->id)
                            ->pluck('user_group.user','user_group.user')->all();
                        $countpost = DB::table("posts")->where([['id_group',$item->id],['stt',1]])->count();
                        $checkguess = DB::table("role_user")->where("user_id",Auth::user()->id)->first();
                    @endphp
                    @if (Auth::user()->id == $item->nguoiquanly || Auth::user()->id == 1 || $checkguess->role_id == 3 || in_array(Auth::user()->id, $member))
                        <div class="col-xl-3 col-lg-4 col-md-full wrap_more-info-box">
                            <div class="more-info-box fg-white">
                                <div class="content">
                                    <p style="word-break: break-all;" class="text-bold mb-0">{{str_limit($item->tennhom,150)}}</p>
                                </div>
                                <div class="icon">
                                    <span class="mif-barcode"></span>
                                </div>
                                <a class="more" href="/group/{{$item->id}}"></p> Có {{$countpost}} bài viết <span class="mif-arrow-right ml-3"></span></a>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </aside>
    </section>
</div>
@endsection
