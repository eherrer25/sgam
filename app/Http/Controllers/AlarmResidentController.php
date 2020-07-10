<?php

namespace App\Http\Controllers;

use App\Models\AlarmResident;
use App\Models\Resident;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Notifications\AlarmNotification;
use Illuminate\Support\Facades\Date;

class AlarmResidentController extends Controller
{
    public function showAlarms(Request $request)
    {
        try {

            if($request->date == null){
                $alarms = AlarmResident::whereDate('created_at', Carbon::today()->toDateString());
            }else{
                $alarms = AlarmResident::whereDate('created_at','=', $request->date);
            }

            if($request->reminder != null){
                $alarms->where('id',$request->reminder)->first();
            }


            if(Auth::user()->hasRole('tens')){
                $alarms = $alarms->where('user_id',Auth::user()->id);
            }

            $alarms = $alarms->orderBy('created_at')->get();

            return view('alarms.list',compact('alarms'));

        }catch (\Exception $e){
            report($e);
            abort(500);
        }
    }

    public function newAlarm()
    {
        try {

            $users = User::where('status',1)->get();
            $residents = Resident::get();

            return view('alarms.new',compact('users','residents'));

        }catch (\Exception $e){
            report($e);
            abort(500);
        }
    }

    public function saveAlarm(Request $request)
    {
        try {

            $user =  Auth::user();

            $new = new AlarmResident();
            $new->user_id = $user->id;
            $new->resident_id = $request->resident_id;
            $new->start = $request->start;
            $new->name = $request->name;
            $new->description = $request->description;
            $new->save();

            $when = Carbon::parse($request->start)->timezone('America/Santiago');
//            dd($when);
//            $when = Carbon::createFromFormat('Y-m-d H:i:s',$when , 'UTC')->setTimezone('America/Santiago');

            $user->notify((new AlarmNotification($new))->delay($when));

        }catch (\Exception $e){
            report($e);
            abort(500);
        }

        return redirect()->route('show-alarms')->with('success','Alarma generada con éxito.');
    }

    public function deleteAlarm($id)
    {
        AlarmResident::find($id)->delete();

        return redirect()->route('show-alarms')
            ->with('success','Alarma eliminada con éxito.');
    }
}
