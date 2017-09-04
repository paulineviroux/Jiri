<?php

namespace Jiri\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

use Jiri\Meeting;
use Jiri\Event;
use Jiri\Student;
use Jiri\User;

class MeetingsController extends Controller
{
    
    public function create(Event $event){

        $students = Student::all();
        $jury = User::where('is_admin', 0)->get();
        $owner = $event->owner()->get();

        return view('meetings.create')
                    ->with(compact('event', 'jury', 'students'));
    }

    public function add(Request $request, Event $event){

        $meeting = new Meeting();
        
        $meeting->event()->associate($event->id);
        $meeting->user()->associate($request->user_id);
        $meeting->student()->associate($request->student_id);

        $date_value = $request->date;
        $time_value = $request->time;

        $start_time = Carbon::createFromFormat('Y-m-d H:i', $date_value.' '.$time_value);
        $meeting->start_time = $start_time;

        // ! Verifications
        if($meeting->save()){

            if($request->continue_adding != null){
                return redirect()->route('meetings.create', $event);
            } 

            return redirect()->route('implementations.create');
        }
        
        // Si le save n'a pas fonctionné
        return redirect()->route('');
    }

}
