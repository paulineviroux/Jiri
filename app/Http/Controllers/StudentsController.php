<?php

namespace Jiri\Http\Controllers;

use Illuminate\Http\Request;

use Jiri\Student;

class StudentsController extends Controller
{
    

    public function showImplementations(Request $request, Student $student){

        $implementations = $student->implementations()
                                    ->with('project')
                                    ->get();

        return view('students.showImplementations', compact('student', 'implementations'));
    }
}
