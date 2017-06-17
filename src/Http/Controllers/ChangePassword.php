<?php

namespace learn88\multirole\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input as input;
use App\User;
use Auth;
use Session;

trait ChangePassword
{
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
}
