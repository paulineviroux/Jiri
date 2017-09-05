<?php

namespace Jiri\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


use Jiri\User;
use Jiri\Event;
use Jiri\Meeting;

class DashboardController extends Controller{

    public function dashboardAdmin(Request $request, Event $event) {
        
        $request->session()->put('event', $event);
        //$request->session->put('event.name', $event->name);

        if(Auth::user()->is_admin){

            $apiRequest = Request::create(
                '/api/events/'. $event->id .'/students',   // url
                'GET',                      // method
                ['embed' => 'performances'] // paramètres supplémentaires
            );

            $request->replace($apiRequest->input());
            $event = Route::dispatch($apiRequest)->getOriginalContent();
        
        } 

        $meetings = Auth::user()
                        ->meetings()->where('event_id', $event->id)
                        ->with('student')->get();

        //return view("users.timetable", compact('meetings'));
        return view("admin.dashboard", compact('event', 'meetings'));
    }

}

