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

    // Afficher l'horaire des users
    public function showTimetable(Meeting $meeting){
        return view('users.timetable', ["meeting" => $meeting]);    
    }

    // Evaluation globale d'un etudiant par un user
    public function globalEvaluation(){ //Nom méthode a revoir
        return view('users.globalEvaluation');
    }

}
