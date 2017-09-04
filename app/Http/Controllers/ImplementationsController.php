<?php

namespace Jiri\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

use Jiri\Event;
use Jiri\Project;
use Jiri\Student;
use Jiri\Meeting;
use Jiri\Implementation;
use Jiri\Score;


class ImplementationsController extends Controller
{
    
    // Choisir l'étudiant pour l'event
    // GET
    public function selectStudent(Request $request, Event $event){

        // Récupere les étudiants appartenant dont
        // on souhaite encoder une implémentation

        $students = $event->students()->get();

        return view('implementations.selectStudent')
            ->with(compact('event', 'students'));
    }


    // Remplir l'implementations pour l'étudiant
    // GET
    public function fill(Request $request, Event $event){


        // Faire les vérfication, ...
        $student = Student::find($request->student_id);
        $implementations = $student->implementations()->where('event_id', $event->id)->get();
        $projects = Project::all();
        $project_implementations = [];

        foreach ($projects as $project) {
            
            $project_implementations[$project->id] = new \stdClass();
            $project_implementations[$project->id]->id = $project->id;
            $project_implementations[$project->id]->name = $project->name;
            $project_implementations[$project->id]->exists = false;
            $project_implementations[$project->id]->url_repo = null;
            $project_implementations[$project->id]->url_project = null;            

            // Est-ce queu il existe une implement... pour le project $project ?
            $project_imp = $implementations->where('project_id', $project->id);
            
            if(!$project_imp->isEmpty()){

                $project_imp = $project_imp->first();

                $project_implementations[$project->id]->url_repo = $project_imp->url_repo;
                $project_implementations[$project->id]->url_project = $project_imp->url_project;
                $project_implementations[$project->id]->exists = true;
            }

            // Oui -> on l'ajoute a un tableau magique avec les infos

        }

        return view('implementations.fill')
                    ->with(compact('event', 'student', 'project_implementations'));
    }

    // PUT
    public function add(Request $request, Event $event, Student $student){
        
        foreach ($request->project_id as $project_id) {
            
            $implementation = Implementation::where('event_id', $event->id)
                                ->where('student_id', $student->id)
                                ->where('project_id', $project_id)
                                ->first();

            if(array_key_exists($project_id, $request->selected)){

                $url_repo    = $request->url_repo[$project_id];
                $url_project = $request->url_project[$project_id];

                if( $implementation == null || $implementation->get()->isEmpty() ){
                    $implementation = new Implementation();
                    $implementation->event()->associate($event->id);
                    $implementation->student()->associate($student->id);
                    $implementation->project()->associate($project_id);
                } 

                $implementation->url_repo = $url_repo;
                $implementation->url_project = $url_project;

                $implementation->save();                

            // Si le project est déselectionné, on check 
            } else {

                if($implementation != null && $implementation->get()->isEmpty()){
                    $implementation->delete();
                }
            }
        }

        //return view('implementations.fill', $event, $student);

        return redirect()->route('implementations.selectStudent', $event);
    }

    public function getEvaluate(Request $request, Implementation $implementation){
        
        $user    = Auth::user();
        $project = $implementation->project()->get()->first();
        $student = $implementation->student()->get()->first();
        $event   = $implementation->event()->get()->first();
        
        $meeting = Meeting::where('user_id', $user->id)
                  ->where('event_id', $event->id)
                  ->where('student_id', $student->id)
                  ->get()->first();

        $score = Score::where('meeting_id', $meeting->id)
                      ->where('implementation_id', $implementation->id)
                      ->get()->first();

        return view('implementations.evaluate', compact('implementation', 'project', 'student', 'score'));
    }

    public function putEvaluate(Request $request, Implementation $implementation){

        $user    = Auth::user();
        $project = $implementation->project()->get()->first();
        $student = $implementation->student()->get()->first();
        $event   = $implementation->event()->get()->first();
        
        $meeting = Meeting::where('user_id', $user->id)
                  ->where('event_id', $event->id)
                  ->where('student_id', $student->id)
                  ->get()->first();

        $score = Score::updateOrCreate([
                'meeting_id' => $meeting->id,
                'implementation_id' => $implementation->id,
            ], ['score' => $request->get('score'), 'comment' => $request->get('comment')]);

        return redirect()->route('students.showImplementations', $student);
    }

}
