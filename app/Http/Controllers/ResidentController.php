<?php

namespace App\Http\Controllers;

use App\Models\CivilStatus;
use App\Models\Client;
use App\Models\Resident;
use App\Models\Room;
use Illuminate\Http\Request;

class ResidentController extends Controller
{
    public function listResidents(Request $request)
    {
        try{

            $data = Resident::orderBy('id','ASC')->get();

        }catch (\Exception $e){
            report($e);
            abort(500);
        }

        return view('residents.list',compact('data'));
    }


    public function newResident()
    {
        try{

            $clients = Client::get();
            $civils = CivilStatus::get();
            $rooms = Room::get();

        }catch (\Exception $e){
            report($e);
            abort(500);
        }

        return view('residents.new',compact('clients','civils','rooms'));
    }

    public function createResident(Request $request)
    {
        $messages = [
            'name.required' => 'El nombre es requerido',
            'last_name.required' => 'El apellido es requerido',
            'run.required' => 'El run es requerido',
            'run.cl_rut' => 'Rut no valido Ej:15330467-k',
            'gender.required' => 'El genero es requerido',
            'birth_of_date.required' => 'La fecha de nacimiento es requerido',
            'client_id.required' => 'El cliente es requerido',
            'civil_id.required' => 'El estado civil es requerido',
            'room_id.required' => 'El dormitorio es requerido',
        ];

        $this->validate($request, [
            'name' => 'required',
            'last_name' => 'required',
            'run' => 'required|cl_rut',
            'phone' => 'max:10|nullable',
            'mobile' => 'max:10|nullable',
            'studies' => 'nullable',
            'profession' => 'nullable',
            'client_id' => 'required',
            'civil_id' => 'required',
            'room_id' => 'required',
        ],$messages);

        try{
            $input = $request->all();

            $resident = Resident::create($input);

        }catch (\Exception $e){
            report($e);
            abort(500);
        }

        return redirect()->route('residents-list')
            ->with('success','Residente creado con éxito.');
    }

    public function editResident($id)
    {
        try{

            $resident = Resident::find($id);
            $clients = Client::get();
            $civils = CivilStatus::get();
            $rooms = Room::get();

        }catch (\Exception $e){
            report($e);
            abort(500);
        }

        return view('residents.edit',compact('resident','clients','civils','rooms'));
    }

    public function updateResident(Request $request, $id)
    {
        $messages = [
            'name.required' => 'El nombre es requerido',
            'last_name.required' => 'El apellido es requerido',
            'run.required' => 'El run es requerido',
            'run.cl_rut' => 'Rut no valido Ej:15330467-k',
            'gender.required' => 'El genero es requerido',
            'birth_of_date.required' => 'La fecha de nacimiento es requerido',
            'client_id.required' => 'El cliente es requerido',
            'civil_id.required' => 'El estado civil es requerido',
            'room_id.required' => 'El dormitorio es requerido',
        ];

        $this->validate($request, [
            'name' => 'required',
            'last_name' => 'required',
            'run' => 'required|cl_rut',
            'phone' => 'max:10|nullable',
            'mobile' => 'max:10|nullable',
            'studies' => 'nullable',
            'profession' => 'nullable',
            'client_id' => 'required',
            'civil_id' => 'required',
            'room_id' => 'required',
        ],$messages);

        try{
            $input = $request->all();

            $resident = Resident::find($id);
            $resident->update($input);

        }catch (\Exception $e){
            report($e);
            abort(500);
        }

        return redirect()->route('residents-list')
            ->with('success','Residente modificado con éxito.');
    }

    public function deleteResident($id)
    {
        Resident::find($id)->delete();

        return redirect()->route('residents-list')
            ->with('success','Residente eliminado con éxito.');
    }
}
