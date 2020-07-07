<?php

namespace App\Http\Controllers;

use App\Models\Office;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{

    public function notifications()
    {
        return auth()->user()->unreadNotifications()->limit(5)->get()->toArray();
    }

    public function showUser($id)
    {
        try {
            $user = User::findOrFail($id);

            return view('profile',compact('user'));

        }catch (\Exception $e){
            report($e);
            abort(500);
        }
    }

    public function updateProfile(Request $request)
    {
        try {

            $this->validate($request, [
                'name' => 'required',
                'last_name' => 'required',
            ]);

            $user = User::findOrFail($request->id);
            if($request->password != null){
                $user->password = Hash::make($request->password);
            }
            $user->name = $request->name;
            $user->last_name = $request->last_name;
            $user->save();

            return redirect()->back()->with('success','Perfil modificado con éxito');


        }catch (\Exception $e){
            report($e);
            abort(500);
        }
    }

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
            $offices = Office::get();

        }catch (\Exception $e){
            report($e);
            abort(500);
        }

        return view('users.new',compact('roles','offices'));
    }

    public function createUser(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'last_name' => 'required',
            'status' => '',
            'office_id' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed',
            'roles' => 'required'
        ]);

        try{

            $input = $request->all();
            $input['password'] = Hash::make($input['password']);
            $input['status'] = $request->status = 1;

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
            $roles = Role::all();
            $offices = Office::get();

        }catch (\Exception $e){
            report($e);
            abort(500);
        }

        return view('users.edit',compact('user','roles','offices'));
    }

    public function updateUser(Request $request, $id)
    {

        $this->validate($request, [
            'name' => 'required',
            'last_name' => 'required',
            'status' => '',
            'office_id' => 'required',
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

            $input['status'] = $request->status == false ? 0 : 1;

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
