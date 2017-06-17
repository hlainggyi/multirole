<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use learn88\multirole\Http\Controllers\ChangePassword;
use App\User;
use App\Role;
use Auth;
use App\Http\Controllers\Controller;

class UserCtrl extends Controller
{
    use ChangePassword;

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
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


    public function update_avatar(Request $request)
    {
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


}
