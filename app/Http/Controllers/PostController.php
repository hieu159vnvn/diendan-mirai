<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\User;
use Auth;
use App\Role;
use App\Models\Group;
use App\Models\UserGr;
use App\Models\Post;
use Mail;
use Illuminate\Http\Response;
class PostController extends Controller
{
    public function getAdd($idgroup){
        return view('admin.template.post.add',[
            'idgroup' => $idgroup
        ]);
    }
    public function postAdd(Request $request,$idgroup){
        $group = Group::find($idgroup);
        $name_group=str_slug($group->tennhom, '-');
        $name_post=str_slug($request->ten, '-');
        if ($request->dinhkem) {
                $dinhkem = $request->dinhkem;
                $dinhkem->move('uploads/'.$name_group.'/'.$name_post, preg_replace('/\s+/', '', ($dinhkem->getClientOriginalName())));
                $dinhkem = preg_replace('/\s+/', '', ($dinhkem->getClientOriginalName()));
        }
        $item = new Post;
        $item->ten = $request->ten;
        $item->noidung = $request->noidung;
        $item->dinhkem = 'uploads/'.$name_group.'/'.$name_post.'/'.$dinhkem;
        $item->id_group = $idgroup;
        $item->nguoitao = Auth::user()->id;
        $item->created_at = date("Y-m-d H:i:s");
        $item->save();

        //send mail
        $id_nguoiquanly = Group::find($idgroup);
        $mailquanly = User::find($id_nguoiquanly->nguoiquanly);
        if($mailquanly){
            $data = ['email'=>$mailquanly->email];
                $data = (object)$data;
                Mail::send('admin.template.post.mail', ['data' => $data], function ($m) use ($data) {
                    $m->from('cskh@thichtinhoc.com', 'Diễn đàn MiraiHuman');
                    $m->to($data->email);
                    $m->subject('Diễn đàn MiraiHuman');
                });
        }
        return redirect('/group/'.$idgroup)->with('addsuccess','Đã thêm thành công! Bài viết của bạn sẽ hiển thị sau khi được duyệt');
    }
    public function pheduyet($id){
        $post = Post::where([['id_group',$id],['stt',2]])->orderBy('id','desc')->get();
        $user = User::all();
        $group = Group::where('stt',1)->get();
        return view('admin.template.post.danhsachpheduyet',[
            'post'=>$post,
            'user'=>$user,
            'group'=>$group,
        ]);
    }
    public function getDuyet($id){
        $post = Post::find($id);
        return view('admin.template.post.pheduyet',[
            'post'=>$post,
        ]);
    }
    public function postDuyet($id){
        $post = Post::find($id);
        $post->stt=1;
        $post->save();
        return redirect('/pheduyet/group/'.$post->id_group)->with('addsuccess','Đã duyệt thành công!');

    }
    public function getPost($id){
        $post = Post::find($id);
        return view('admin.template.post.post',[
            'post'=>$post,
        ]);
    }
    public function delete($id){
        $post = Post::find($id);
        $post->stt = 0;
        $post -> save();
    }
}
