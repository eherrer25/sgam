<?php

namespace App\Http\Controllers;

use App\Events\NotificationsEvent;
use App\Models\Nursing;
use App\Models\Resident;
use App\Models\UserResidentNursing;
use App\Notifications\ReminderTask;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ResidentNursingController extends Controller
{

    public function showNursings(Request $request)
    {
        try {

            if($request->date == null){
                $nursings = UserResidentNursing::whereDate('created_at', Carbon::today()->toDateString());
            }else{
                $nursings = UserResidentNursing::whereDate('created_at','=', $request->date);
            }

            if($request->reminder != null){
                $nursings->where('id',$request->reminder)->first();
            }


            if(Auth::user()->hasRole('cam')){
                $nursings = $nursings->where('user_id',Auth::user()->id);
            }

            $nursings = $nursings->orderBy('created_at')->get();

            return view('residentnursings.list',compact('nursings'));

        }catch (\Exception $e){
            report($e);
            abort(500);
        }
    }

    public function newNursings()
    {
        try {

            $users = User::where('status',1)->get();
            $residents = Resident::get();
            $nursings = Nursing::get();

            return view('residentnursings.new',compact('users','residents','nursings'));

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
            $new->start = $request->start;
            $new->stop = $request->stop;
            $new->status = 'pendiente';
            $new->save();

            $user = User::find($request->user_id);
            $where = Carbon::parse($request->start)->format('Y-m-d H:i:s');

//            $user->notify((new ReminderTask($new))->delay($where));
            $user->notify((new ReminderTask($new)));
            event(new NotificationsEvent($new));

            return redirect()->route('show-nursings')->with('success','Cuidado asignado correctamente.');

        }catch (\Exception $e){
            report($e);
            abort(500);
        }
    }

    public function changeStatus(Request $request)
    {
        try {
            //estados = pendiente,en proceso, realizado
            $data = UserResidentNursing::find($request->id);

            if($request->status == 'pendiente'){
                $status = 'en proceso';
            }elseif($request->status == 'en proceso'){
                $status = 'realizado';
            }

            $data->status = $status;
            if($request->status == 'pendiente') {
                $data->start_unreal = Carbon::now()->format('H:i');
            }
            if($request->status == 'en proceso') {
                $data->stop_unreal = Carbon::now()->format('H:i');
            }
            $data->save();

            $message = 'El cuidado a comenzado a realizarse';

            if($data->status == 'realizado'){
                $message = 'El cuidado a sido completado';
            }

            return redirect()->route('show-nursings')->with('success',$message);

        }catch (\Exception $e){
            report($e);
            abort(500);
        }
    }

    public function deleteNursing($id)
    {
        UserResidentNursing::find($id)->delete();

        return redirect()->route('show-nursings')
            ->with('success','Cuidado de residente eliminado con éxito.');
    }
}
