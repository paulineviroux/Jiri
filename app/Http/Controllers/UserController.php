<?php

namespace Jiri\Http\Controllers;

use Illuminate\Http\Request;
use Jiri\User;
use Jiri\Meeting;

class UserController extends Controller
{
    // Afficher users
    public function show(User $user){
        return view('users.show', [ "user" => $user ]); //organisation des vues .
    }

    // Editer les users
    public function edit(User $user){
        return view('users.edit', [ "user" => $user]);
    }

    public function update(Request $request, User $user){
        dd($request->get("name"));
    }

    // Afficher l'horaire des users
    public function showTimetable(Meeting $meeting){
        return view('users.timetable', ["meeting" => $meeting]);    
    }

    // Evaluation globale d'un etudiant par un user
    public function globalEvaluation(){ //Nom méthode a revoir
        return view('users.globalEvaluation');
    }

}
