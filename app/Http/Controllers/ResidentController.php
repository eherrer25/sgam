<?php

namespace App\Http\Controllers;

use App\Models\Bed;
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

            dd($data);

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
            $beds = Bed::where('status',1)->get();

        }catch (\Exception $e){
            report($e);
            abort(500);
        }

        return view('residents.new',compact('clients','civils','beds'));
    }

    public function createResident(Request $request)
    {
        $messages = [
            'name.required' => 'El nombre es requerido',
            'last_name.required' => 'El apellido es requerido',
            'run.required' => 'El run es requerido',
            'run.cl_rut' => 'Rut no valido Ej:15330467-k',
            'run.unique' => 'Rut ingresado ya existe',
            'gender.required' => 'El genero es requerido',
            'birth_of_date.required' => 'La fecha de nacimiento es requerido',
            'client_id.required' => 'El cliente es requerido',
            'civil_id.required' => 'El estado civil es requerido',
            'bed_id.required' => 'La cama es requerida',
        ];

        $this->validate($request, [
            'name' => 'required',
            'last_name' => 'required',
            'run' => 'required|cl_rut|unique:residents',
            'phone' => 'max:10|nullable',
            'mobile' => 'max:10|nullable',
            'birth_of_date' => 'required',
            'studies' => 'nullable',
            'profession' => 'nullable',
            'client_id' => 'required',
            'civil_id' => 'required',
            'bed_id' => 'required',
        ],$messages);

        try{

            $resident = new Resident();
            $resident->run = $request->run;
            $resident->name = $request->name;
            $resident->last_name = $request->last_name;
            $resident->gender = $request->gender;
            $resident->birth_of_date = $request->birth_of_date;
            $resident->studies = $request->studies;
            $resident->profession = $request->profession;
            $resident->client_id = $request->client_id;
            $resident->civil_id = $request->civil_id;
            $resident->bed_id = $request->bed_id;
            $resident->save();

            $bed = Bed::find($request->bed_id);
            $bed->status = 0;
            $bed->save();

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
            $beds = Bed::where('status',1)->get();

        }catch (\Exception $e){
            report($e);
            abort(500);
        }

        return view('residents.edit',compact('resident','clients','civils','beds'));
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
            'bed_id.required' => 'La cama es requerida',
        ];

        $this->validate($request, [
            'name' => 'required',
            'last_name' => 'required',
            'run' => 'required|cl_rut',
            'phone' => 'max:10|nullable',
            'mobile' => 'max:10|nullable',
            'studies' => 'nullable',
            'profession' => 'nullable',
            'birth_of_date' => 'required',
            'client_id' => 'required',
            'civil_id' => 'required',
            'bed_id' => 'required',
        ],$messages);

        try{

            $resident = Resident::find($id);

            if($resident->bed_id != $request->bed_id){
                $bed1 = Bed::find($resident->bed_id);
                $bed1->status = 1;
                $bed1->save();

                $bed2 = Bed::find($request->bed_id);
                $bed2->status = 0;
                $bed2->save();
            }

            $resident->run = $request->run;
            $resident->name = $request->name;
            $resident->last_name = $request->last_name;
            $resident->gender = $request->gender;
            $resident->birth_of_date = $request->birth_of_date;
            $resident->studies = $request->studies;
            $resident->profession = $request->profession;
            $resident->client_id = $request->client_id;
            $resident->civil_id = $request->civil_id;
            $resident->bed_id = $request->bed_id;
            $resident->save();

        }catch (\Exception $e){
            report($e);
            abort(500);
        }

        return redirect()->route('residents-list')
            ->with('success','Residente modificado con éxito.');
    }

    public function deleteResident($id)
    {
        $resident = Resident::find($id);

        $bed = $resident->room;
        $bed->status = 1;
        $bed->save();

        $resident->delete();

        return redirect()->route('residents-list')
            ->with('success','Residente eliminado con éxito.');
    }
}
