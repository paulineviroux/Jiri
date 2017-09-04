<?php

namespace Jiri\Http\Controllers;

use Illuminate\Http\Request;

use Jiri\Project;
use Jiri\Event;
use Jiri\Weight;

class ProjectController extends Controller
{
    // Ajouter des projets
    public function add(Event $event){
        return view('projects.add')->with([
            'event' => $event
        ]);
    }

    public function added(Request $request, Event $event){
                
        $project = Project::create($request->only(['name', 'description']));

        $weight = new Weight();
        $weight->weight = $request->get('weight');
        $weight->project()->associate($project);
        $weight->event()->associate($event);

        $weight->save();

        if($request->continue_adding != null){
            return redirect()->route('projects.add', $event);
        } 

        return redirect()->route('admin.addStudents', $event);
    }

    // Noter un projet
    public function note(){
        return view('projects.note');
    }

    public function noted(){
        
    }

    // Afficher des projets
    public function show(){
        return view('projects.show');
    }

}
