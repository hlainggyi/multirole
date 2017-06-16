<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Input as input;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Role;
use Auth;
use App\Http\Controllers\Controller;

class UserCtrl extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function help()
    {
      return view('auth.help');
    }

    public function index()
    {
        // $admin = Role::all();
        // $roles = Role::all();
        $users = User::where('active', 0)->get();

        return view('auth.index', compact('users'));
    }


    public function show($id)
    {
        $user = User::find($id);

        $roles = Role::where('active', 0)->get();

        return view('auth.show')->with('user', $user)->with('roles', $roles);
    }

    public function delete($id)
    {
        $user = User::find($id);
        $user->active=1;
        $user->save();
        return redirect('users/list');
    }

    public function profile()
    {
      return view('auth.profile', array('user' => Auth::user()) );
    }

    public function changepass()
    {
      $User = User::find(Auth::user()->id);

      if (Hash::check(Input::get('passwordold'), $User['password']) && Input::get('password') == Input::get('password_confirmation')) {

        $User->password = bcrypt(Input::get('password'));
        $User->save();
        return back()->with('success', 'Password Changed');
      }else {
        return back()->with('error', 'Password NOT Changed!!');
      }
    }

    public function update_avatar(Request $request)
    {
      // dd ('OK');
      if ($request->hasFile('avatar')) {
        // get file name
        $avatar = $request->file('avatar')->getClientOriginalName();
        // move image to Server
        $destination = base_path() . '/public/uploads/user_images';
        $request->file('avatar')->move($destination, $avatar);

        $user = Auth::user();
        $user->avatar = $avatar;
        $user->save();
      }
      return view('auth.profile', array('user' => Auth::user()) );
    }

    public function role_list()
    {
      return view('auth.roles');
    }


    public function AdminAssignRoles(Request $request)
    {
      $roles = Role::all();
      $user = User::where('email', $request['email'])->first();
      $user->roles()->detach();
      foreach ($roles as $role) {
        if ($request[$role['name']]) {
          $user->roles()->attach(Role::where('name', $role['name'])->first());
        }
      }
      return back();
    }

}
