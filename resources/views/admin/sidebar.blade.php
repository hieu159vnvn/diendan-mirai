<section class="sidebar_wrapper navview-pane bg-blue fg-white z-5">
    <div class="sidebar_header d-flex flex-align-center">
        <button class="pull-button bg-blue-hover"><span class="mdi mdi-menu fg-white"></span></button>
        <div class="sidebar_header-title text-bold enlarge-1 ml-4">Diễn đàn MiraiHuman</div>
    </div>
    <div class="sidebar_block suggest-box mt-4">
        <div class="data-box"><img class="avatar ml-4" src="https://via.placeholder.com/48">
            <div class="ml-4 avatar-title flex-column"><a class="d-block no-decor fg-white" href="#"><span class="text-medium">{{Auth::user()->name}}</span></a>
                <p class="m-0"><span class="fg-green mr-2">●</span><span class="text-small">online</span></p>
            </div>
        </div><img class="avatar holder" src="https://via.placeholder.com/36">
    </div>

    <div class="sidebar_nav-title text-medium my-2 px-3 enlarge-3">Danh sách nhóm</div>
    <ul class="navview-menu bg-blue bg-blue-hover">
        @permission('add-group')
        <li><a href="/taonhom"><span class="icon"><span class="mif-plus"></span></span><span class="caption">Tạo nhóm mới</span></a></li>
        @endpermission
        @php
            $group = DB::table('group')->where('stt',1)->get();
        @endphp
        @foreach ($group as $item)
            @php
                  $member = DB::table("user_group")->where("user_group.group",$item->id)
                    ->pluck('user_group.user','user_group.user')->all();
            @endphp
            @if (Auth::user()->id == $item->nguoiquanly || Auth::user()->id == 1 || in_array(Auth::user()->id, $member))
                <li><a href="/group/{{$item->id}}"><span class="icon"><span class="mif-chat"></span></span><span class="caption">{{$item->tennhom}}</span></a></li>
            @endif
        @endforeach
    </ul>
    <div class="data-box w-100 text-center reduce-2 p-2 border-top bd-grayMouse" style="position: absolute; bottom: 0">
        <div>© 2021 <a class="no-decor fg-white" href="#">MiraHuman Co., LTD</a></div>
    </div>
</section>
