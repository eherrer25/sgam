<?php

namespace App\Http\Controllers;

use App\Models\Record;
use App\Models\Resident;
use Illuminate\Http\Request;

class RecordController extends Controller
{
    public function recordResident($id)
    {
        try {
            $resident = Resident::find($id);

            if(!$resident){
                abort(404);
            }

            $record = $resident->record;

        }catch (\Exception $e){
            report($e);
            abort(500);
        }

        return view('residents.record',compact('record','resident'));
    }

    public function saveRecord(Request $request)
    {
        $messages = [
            'name.required' => 'El nombre es requerido',
            'observations.required' => 'Las observaciones son requeridas',
            'resident_id.required' => 'El residente es requerido',
        ];

        $this->validate($request, [
            'name' => 'required',
            'observations' => 'required',
            'resident_id' => 'required',
        ],$messages);

        try {

            $resident = Resident::find($request->resident_id);

            if(!$resident){
                abort(404);
            }

            $record = new Record();
            $record->name = $request->name;
            $record->observations = $request->observations;
            $record->resident_id = $resident->id;
            $record->save();

            return redirect()->route('resident-record', $resident->id)
                ->with('success','Ficha creada con éxito.');

        }catch (\Exception $e){
            report($e);
            abort(500);
        }
    }
}
