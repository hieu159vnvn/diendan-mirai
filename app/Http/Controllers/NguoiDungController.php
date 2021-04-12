<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\User;
use Hash;
use Auth;
use App\Role;

class NguoiDungController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function index(){
        $users= User::all();
        return view('admin.template.nguoidung.index',['users' => $users]);
    }
    public function getSignup(){
        $roles = Role::all();
        return view('admin.template.nguoidung.addnguoidung',[  'roles'=> $roles]);
    }
    public function postSignup(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|unique:users,email',
        ]);
        $user = User::create([
            'name'=> $request->name,
            'email'=> $request->email,
            'password'=> bcrypt($request->password),
        ]);
        $user->attachRole($request->roles);
        return redirect('danhsachnguoidung')->with('addsuccess','Thêm người dùng thành công');
    }
    public function delete($id){
        $user= User::find($id);
        if($user->id==1){
            return redirect('danhsachnguoidung')->with('addsuccess','Không được xóa admin');
        }
        else{
            $user->delete();
        }
    }
    public function getEdit($id){
        $user= User::find($id);
        $roles = Role::all();
        $select=$user->roles;
        return view('admin.template.nguoidung.edit',['user' => $user,'roles'=> $roles,'select'=> $select]);
    }
    public function postEdit($id,Request $request){
        $user= User::find($id);
        $user->name= $request->name;
        $user->email= $request->email;
        if(!empty($request->password)){
            $user->password=bcrypt($request->password);
        }
        else{
            $password = User::find($id);
            $passwordold = $password->password;
            $user->password = $passwordold;
        }
        $user->update();
        DB::table('role_user')->where('user_id',$id)->delete();
        $user->attachRole($request->roles);
        return redirect('danhsachnguoidung')->with('addsuccess','Sửa người dùng thành công!');
    }
}
