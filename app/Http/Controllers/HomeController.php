<?php

namespace App\Http\Controllers;

use App\Models\Resident;
use App\Models\UserResidentNursing;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        try {
            $residents = Resident::get()->count();
            $nursings = UserResidentNursing::whereDate('created_at', Carbon::today()->toDateString())->orderBy('created_at');

            if(Auth::user()->hasRole('cam')){
                $nursings = $nursings->where('user_id',Auth::user()->id);
            }

            $nursings = $nursings->get();
        }catch (\Exception $e){
            report($e);
            abort(500);
        }

        return view('home', compact('residents','nursings'));
    }
}
