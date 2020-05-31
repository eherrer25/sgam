<?php

namespace App\Http\Controllers;

use App\Models\Nursing;
use App\Models\Resident;
use App\Models\UserResidentNursing;
use App\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function showNursings()
    {
        try {

            $users = User::where('status',1)->get();
            $residents = Resident::get();
            $nursings = Nursing::get();

            return view('nursings',compact('users','residents','nursings'));

        }catch (\Exception $e){
            report($e);
            abort(500);
        }
    }

    public function saveNursings(Request $request)
    {
        try {
            //estados = pendiente,en proceso, realizado

            $new = new UserResidentNursing();
            $new->user_id = $request->user_id;
            $new->resident_id = $request->resident_id;
            $new->nursing_id = $request->nursing_id;
            $new->start = strtotime($request->start);
            $new->stop = strtotime($request->stop);
            $new->status = 'pendiente';
            $new->save();

            return redirect()->route('show-nursings')->with('success','Cuidado asignado correctamente.');

        }catch (\Exception $e){
            report($e);
            abort(500);
        }
    }
}
