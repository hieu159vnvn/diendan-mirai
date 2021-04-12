<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\User;
use Auth;
use App\Models\Group;
use App\Models\UserGr;
use App\Role;
use App\Models\Post;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function index(Request $request)
    {
        return view('admin.welcome');
    }
    public function getAddGroup(){
        $users= User::all();
        $roles = DB::table('role_user')->where('role_id',2)->get();
        return view('admin.template.create-group.add',[
            'users'=>$users,
            'roles'=>$roles,
        ]);
    }
    public function getPostGroup(Request $request){
        $group= Group::where('stt',1)->get();
        foreach($group as $gr){
            if($request->tennhom == $gr->tennhom){
                return redirect('taonhom')->with('addsuccess', 'Tên nhóm đã tồn tại!');
            }
        }
        $item = new Group;
        $item->tennhom = $request->tennhom;
        $item->nguoiquanly = $request->nguoiquanly;
        $item->created_at = date("Y-m-d H:i:s");
        $item->save();
        return redirect('taonhom')->with('addsuccess', 'Đã thêm "' . $request->tennhom . '" thành công!');
    }
    public function getGroup($id){
        $group= Group::find($id);
        $checkmember = UserGr::where([['user', Auth::user()->id],['group', $id]])->first();
        $checkgroup = Group::where([['id',$id],['nguoiquanly', Auth::user()->id ]])->first();
        $checkguess = DB::table("role_user")->where('user_id',Auth::user()->id)->first();
        $post = Post::where([['id_group',$id],['stt',1]])->orderBy('id','desc')->get();
        $duyetpost = Post::where([['id_group',$id],['stt',2]])->count();
        $user = User::all();
        if(Auth::user()->id == 1 || $checkguess->role_id == 3 || $checkmember || $checkgroup){
            return view('admin.template.group.index',[
                'group'=>$group,
                'post'=>$post,
                'user'=>$user,
                'checkguess'=>$checkguess,
                'duyetpost'=>$duyetpost,
            ]);
        }
        else{
            return view('admin.template.group.error');
        }

    }
}
