<?php

namespace App\Http\Controllers;

use App\Models\Nursing;
use Illuminate\Http\Request;

class NursingController extends Controller
{
    public function listNursings(Request $request)
    {
        try{

            $data = Nursing::orderBy('id','ASC')->get();

        }catch (\Exception $e){
            report($e);
            abort(500);
        }

        return view('nursings.list',compact('data'));
    }


    public function newNursing()
    {

        return view('nursings.new');
    }

    public function createNursing(Request $request)
    {
        $messages = [
            'name.required' => 'El nombre es requerido',
            'description.required' => 'La descripción es requerida',
        ];

        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
        ],$messages);

        try{
            $input = $request->all();

            $nursing = Nursing::create($input);

        }catch (\Exception $e){
            report($e);
            abort(500);
        }

        return redirect()->route('nursings-list')
            ->with('success','Cuidado creado con éxito.');
    }

    public function editNursing($id)
    {
        try{

            $nursing = Nursing::find($id);

        }catch (\Exception $e){
            report($e);
            abort(500);
        }

        return view('nursings.edit',compact('nursing'));
    }

    public function updateNursing(Request $request, $id)
    {
        $messages = [
            'name.required' => 'El nombre es requerido',
            'description.required' => 'La descripción es requerida',
        ];

        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
        ],$messages);

        try{
            $input = $request->all();

            $nursing = Nursing::find($id);
            $nursing->update($input);

        }catch (\Exception $e){
            report($e);
            abort(500);
        }

        return redirect()->route('nursings-list')
            ->with('success','Cuidado modificado con éxito.');
    }

    public function deleteNursing($id)
    {
        Nursing::find($id)->delete();

        return redirect()->route('nursings-list')
            ->with('success','Cuidado eliminado con éxito.');
    }
}
