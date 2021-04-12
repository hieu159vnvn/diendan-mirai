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

class GroupController extends Controller
{
    public function addMember($id){
        $group = Group::find($id);
        $users= User::where('id','!=',Auth::user()->id)->get();
        $roles = DB::table('role_user')->where('role_id',2)->get();
        $member = DB::table("user_group")->where("user_group.group",$id)
        ->pluck('user_group.user','user_group.user')->all();
        return view('admin.template.group.addmember',[
            'group'=>$group,
            'users'=>$users,
            'roles'=>$roles,
            'member'=>$member,
        ]);
    }
    public function postMember(Request $request){
        if($request->thanhvien==null){
            DB::table("user_group")->where("group",$request->idgroup)->delete();
        }
        else{
            DB::table("user_group")->where("group",$request->idgroup)->delete();
            foreach($request->thanhvien as $thanhvien){
                $item = new UserGr;
                $item->group = $request->idgroup;
                $item->user = $thanhvien;
                $item->save();
            }
        }
        return redirect('group/'.$request->idgroup)->with('addsuccess','Đã thêm thành công!');
    }
}
