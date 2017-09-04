<?php

namespace Jiri\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Jiri\User;
use Jiri\Event;
use Jiri\Student;


class AdminController extends Controller
{
    // Créer un evenement
    public function createEvent(){ // a verifier (admin et event controller??)
        $users = User::where('is_admin', 1)->get();
        return view('admin.createEvent')->with([
            'users' => $users ]);
    }

    public function createdEvent(Request $request, Event $event){
        
        $event = new Event();

        $event->owner()->associate(Auth::user()->id);
        $event->fill($request->all());
    
        // Validate before submit

        $event->save();

    
        // Event::insert([
        //     "course_name" => $request->get('course_name'),
        //     "academic_year" => $request->get('academic_year'),
        //     "exam_session" => $request->get('exam_session'),
        //     "user_id" => $request->get('user_id'),
        //     // 'created_at' => \Carbon\Carbon::now(),
        //     // 'updated_at' => \Carbon\Carbon::now()
        // ]);

        return redirect()->route('admin.addJury', ['event' => $event]);
    }

    //Afficher les evenemnts
    public function showEvent(Event $event, Request $request) {
        $apiRequest = Request::create(
            '/api/events/'.$event->id,   // url
            'GET'
        );
        $request->replace($apiRequest->input());
        $event = Route::dispatch($apiRequest)->getOriginalContent();
        return view()->with([
            'event' => $event,
            'users' => User::where('is_admin', 1)->get()
        ]);
    }

    //Modifier un evenement
    public function updatedEvent(Request $request, Event $event){
        $event->fill($request->all());
        $event->save();
        return redirect()->route('event.show');
    }

    //Supprimer un evenement
    public function deleteEvent(Event $event){
        $event->delete();
        //return redirect()->route(''); ??
    }

    // Etablir un horaire
    public function createTimetable(){
        return view('admin.timetable');
    }

    public function createdTimetable(){
    }

    // Ajouter des jury
    public function addJury(Event $event){
        return view('admin.addJury')->with([
            'event' => $event,
            'users' => User::all()
        ]);
    }

    public function addingJury( Request $request, Event $event ){
        
        $user = User::where('email', $request->get('email'))->limit(1);
        
        if ( $user->count() == 0 ){
            // Vérification des données
            // if Validate .... ->
            // Cree le user dans la BD
            $user = User::create($request->only(['name', 'email', 'password', 'company' ]));             
        } else {
            $user = $user->get();
        }


        if($request->continue_adding != null){
            return redirect()->route('admin.addJury', $event);
        } 

        return redirect()->route('admin.addStudents', $event);
    }

    public function deleteJury( Event $event, User $jury ){
        $event->users()->detach($user);
        $event->save();
        return redirect()->route('admin.addJury');
    }

    // Ajouter des étudiants
    public function addStudents(Event $event){
        return view('admin.addStudents')->with([
            'event' => $event,
            'students' => Student::all()
        ]);
    }

    public function addingStudents( Request $request, Event $event ){
        
        $student = Student::where('email', $request->get('email'))->limit(1);
        
        if ( $student->count() == 0 ){
            // Vérification des données
            // if Validate .... ->
            // Cree le user dans la BD
            $student = Student::create($request->only(['name', 'email', 'password', 'company' ]));             
        } else {
            $student = $student->get();
        }


        if($request->continue_adding != null){
            return redirect()->route('admin.addStudents', $event);
        } 

        return redirect()->route('projects.add', $event);

    }

    // Supprimer un étudiant
    public function deleteStudent( Request $request, Event $event ){
        $event->students()->detach($student); //delete ou detach ? 
        $event->save();
        return redirect()->route('admin.addStudents');
    }

    // Prévoir une méthode pour lier des projets a des etudiants
}
