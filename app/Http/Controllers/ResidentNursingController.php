<?php

namespace App\Http\Controllers;

use App\Models\UserResidentNursing;
use Illuminate\Http\Request;

class ResidentNursingController extends Controller
{
    public function showNursings()
    {
        try {

            $nursings = UserResidentNursing::orderBy('created_at')->get();

            return view('residentnursings.index',compact('nursings'));

        }catch (\Exception $e){
            report($e);
            abort(500);
        }
    }
}
