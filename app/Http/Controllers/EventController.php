<?php

namespace Jiri\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use Jiri\User;

class EventController extends Controller{

    public function show(){
        
        $user = Auth::user();
        
        if($user->is_admin){
            
            $events = $user->events()->get();

        } else {
            
            $meetings = $user->meetings()
                            // Selection de event_id de manière unique
                            ->select('event_id')->distinct('event_id')
                            // On récupere les events dont l'id est dans la liste des event_id ci dessus
                            ->with('event')
                            ->get();

            $events = $meetings->pluck('event');            
        }

        //dd($events);

        return view("event.show", compact('user', 'events'));
    }
    
}