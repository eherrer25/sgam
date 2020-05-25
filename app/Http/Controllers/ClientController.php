<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Commune;
use Illuminate\Http\Request;

class ClientController extends Controller
{


    public function listClients(Request $request)
    {
        try{

            $data = Client::orderBy('id','ASC')->get();

        }catch (\Exception $e){
            report($e);
            abort(500);
        }

        return view('clients.list',compact('data'));
    }


    public function newClient()
    {
        try{

            $communes = Commune::all();

        }catch (\Exception $e){
            report($e);
            abort(500);
        }

        return view('clients.new',compact('communes'));
    }

    public function createClient(Request $request)
    {
        $messages = [
            'name.required' => 'El nombre es requerido',
            'last_name.required' => 'El apellido es requerido',
            'run.required' => 'El run es requerido',
            'phone.max' => 'El teléfono debe tener 10 digitos',
            'mobile.max' => 'El celular debe tener 10 digitos',
            'email.email' => 'El email es invalido',
            'address.required' => 'La dirección es requerida',
            'commune_id.required' => 'La comuna es requerida',
        ];

        $this->validate($request, [
            'name' => 'required',
            'last_name' => 'required',
            'run' => 'required',
            'phone' => 'max:10|nullable',
            'mobile' => 'max:10|nullable',
            'email' => 'email|nullable',
            'address' => 'required',
            'commune_id' => 'required',
        ],$messages);

        try{
            $input = $request->all();
//            $input = $request->except('_token');

            $client = Client::create($input);

        }catch (\Exception $e){
            report($e);
            abort(500);
        }

        return redirect()->route('clients-list')
            ->with('success','Cliente creado con éxito.');
    }

    public function editClient($id)
    {
        try{

            $client = Client::find($id);
            $communes = Commune::all();

        }catch (\Exception $e){
            report($e);
            abort(500);
        }

        return view('clients.edit',compact('client','communes'));
    }

    public function updateClient(Request $request, $id)
    {
        $messages = [
            'name.required' => 'El nombre es requerido',
            'last_name.required' => 'El apellido es requerido',
            'run.required' => 'El run es requerido',
            'phone.max' => 'El teléfono debe tener 10 digitos',
            'mobile.max' => 'El celular debe tener 10 digitos',
            'email.email' => 'El email es invalido',
            'address.required' => 'La dirección es requerida',
            'commune_id.required' => 'La comuna es requerida',
        ];

        $this->validate($request, [
            'name' => 'required',
            'last_name' => 'required',
            'run' => 'required',
            'phone' => 'max:10|nullable',
            'mobile' => 'max:10|nullable',
            'email' => 'email|nullable',
            'address' => 'required',
            'commune_id' => 'required',
        ],$messages);

        try{
            $input = $request->all();

            $client = Client::find($id);
            $client->update($input);

        }catch (\Exception $e){
            report($e);
            abort(500);
        }

        return redirect()->route('clients-list')
            ->with('success','Cliente modificado con éxito.');
    }

    public function deleteClient($id)
    {
        Client::find($id)->delete();

        return redirect()->route('clients-list')
            ->with('success','Cliente eliminado con éxito.');
    }
}
