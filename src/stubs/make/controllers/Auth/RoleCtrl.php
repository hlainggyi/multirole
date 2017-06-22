<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use learn88\multirole\Http\Controllers\AssignRoles;
use App\Role;
use Validator;

class RoleCtrl extends Controller
{
    use AssignRoles;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::where('active', 0)->get();
        return view('auth.role', compact('roles'));
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'description' => 'required',
        ]);
    }

      /**
       * Create a new user instance after a valid registration.
       *
       * @param  array  $data
       * @return Role
       */
      protected function create(array $data)
      {
          return Role::create([
              'name' => $data['name'],
              'description' => $data['description'],
          ]);
      }

      /**
       * Show a Role
       *
       * @param  array  $role
       * @return Show
       */
      public function Show($id)
      {
        $role = Role::find($id);

        return view('auth.role-show', compact('role'));
      }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = Role::find($id);
        $role->active=1;
        $role->save();

        return back();

    }
}
