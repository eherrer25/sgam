<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function listUsers(Request $request)
    {
        try{

            $data = User::orderBy('id','ASC')->paginate(5);

        }catch (\Exception $e){
            report($e);
            abort(500);
        }

        return view('users.list',compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }


    public function newUser()
    {
        try{

            $roles = Role::all();

        }catch (\Exception $e){
            report($e);
            abort(500);
        }

        return view('users.new',compact('roles'));
    }

    public function createUser(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed',
            'roles' => 'required'
        ]);

        try{

            $input = $request->all();
            $input['password'] = Hash::make($input['password']);

            $user = User::create($input);
            $user->assignRole($request->input('roles'));

        }catch (\Exception $e){
            report($e);
            abort(500);
        }

        return redirect()->route('users-list')
            ->with('success','Usuario creado.');
    }

    public function editUser($id)
    {
        try{
            $user = User::find($id);
            $roles = Role::pluck('name','name')->all();
        }catch (\Exception $e){
            report($e);
            abort(500);
        }

        return view('users.edit',compact('user','roles'));
    }

    public function updateUser(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'same:confirm-password',
            'roles' => 'required'
        ]);

        try{
            $input = $request->all();
            if(!empty($input['password'])){
                $input['password'] = Hash::make($input['password']);
            }else{
                $input = array_except($input,array('password'));
            }

            $user = User::find($id);
            $user->update($input);

            $user->roles()->sync($request->input('roles'));

        }catch (\Exception $e){
            report($e);
            abort(500);
        }

        return redirect()->route('users-list')
            ->with('success','Usuario modificado.');
    }

    public function deleteUser($id)
    {
        User::find($id)->delete();

        return redirect()->route('users-list')
            ->with('success','Usuario eliminado.');
    }
}
