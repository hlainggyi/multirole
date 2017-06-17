<?php

namespace learn88\multirole\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Input as input;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Role;
use Auth;
// use App\Http\Controllers\Controller;

trait AssignRoles
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     public function store(Request $request)
     {
         $this->validator($request->all())->validate();
         $role = $this->create($request->all());
         return  back();
     }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validator($request->all())->validate();
        $role = $this->edit($request->find($id));
        return  back();
    }



    public function UserAssignRoles(Request $request)
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
