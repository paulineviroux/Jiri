<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

// Route::get('/', function () {
//     return view('home');
// });

Route::get('/', function () {
    return view('auth.login');
});

Route::get('resetPassword', function() {
    return view('auth.passwords.reset');
});


// Test : affichage + modification d'un user

// Route::get('/users/{user}', [
//     'as' => 'users.show',
//     'uses' => 'UserController@show'
// ]);

// Route::get('users/{user}/edit', [
//     'as' => 'users.edit',
//     'uses' => 'UserController@edit'
// ]);

// Route::put('users/{user}', [
//     'as' => 'users.update',
//     'uses' => 'UserController@update'
// ]);


// Dashboard 

Route::get('/dashboard/{event}', [  
    'as' => 'admin.dashboard',
    'uses' => 'DashboardController@dashboardAdmin'
]);


// Affichage des evenements 
Route::get('events/show', [ // Route
    'as' => 'event.show',
    'uses' => 'EventController@show'
]);


// Modifier un événement

Route::get('events/{event}/edit', [ 
    'as' => 'event.showSingle',
    'uses' => 'AdminController@showEvent'
])->middleware('can:admin');



// Ordre de passage / horaire d'un jury

Route::get('users/{user}/meetings', [ 
    'as' => 'users.timetable',
    'uses' => 'UserController@showTimetable'
]);



// Ajouter un membre du jury (only admin)

Route::get('/events/{event}/users/add', [ // Route & add ? 
    'as' => 'admin.addJury',
    'uses' => 'AdminController@addJury'
])->middleware('can:admin');

Route::put('/events/{event}/users/added', [  //Route
    'as' => 'admin.addingJury',
    'uses' => 'AdminController@addingJury'
]);



// Ajouter des étudiants (only admin)

Route::get('/events/{event}/students/add', [   // Route
    'as' => 'admin.addStudents',
    'uses' => 'AdminController@addStudents'
])->middleware('can:admin');

Route::put('/events/{event}/students/added', [    // Route
    'as' => 'admin.addingStudents',
    'uses' => 'AdminController@addingStudents'
]);



// Créer un nouvel évènement

Route::get('/events/add', [ 
    'as' => 'admin.createEvent',
    'uses' => 'AdminController@createEvent'
])->middleware('can:admin');

Route::put('/events', [ //Changer la route ?
    'as' => 'admin.createdEvent',
    'uses' => 'AdminController@createdEvent'
]);




// Créer un horaire pour les jury/élèves

Route::get('/meetings/create/{event}', [     
    'as' => 'meetings.create',
    'uses' => 'MeetingsController@create'
])->middleware('can:admin');

Route::put('/meetings/create/{event}', [   
    'as' => 'meetings.create',
    'uses' => 'MeetingsController@add'
]);

// Implementations

Route::get('implementations/{event}', [
    'as' => 'implementations.selectStudent',
    'uses' => 'ImplementationsController@selectStudent'
])->middleware('can:admin');

Route::put('/implementations/fill/{event}', [     
    'as' => 'implementations.fill',
    'uses' => 'ImplementationsController@fill'
])->middleware('can:admin');

Route::put('/implementations/create/{event}/{student}', [   
    'as' => 'implementations.create',
    'uses' => 'ImplementationsController@add'
]);

Route::get('/implementations/evaluate/{implementation}', [
    'as' => 'implementations.evaluate',
    'uses' => 'ImplementationsController@getEvaluate'
]);

Route::put('/implementations/evaluate/{implementation}', [
    'as' => 'implementations.evaluate',
    'uses' => 'ImplementationsController@putEvaluate'
]);


// Gestion des projets des étudiants (jury)

Route::get('/student/{student}/implementations', [
    'as' => 'students.showImplementations',
    'uses' => 'StudentsController@showImplementations'
]);


// Ajouter des projets (admin)

Route::get('/events/{event}/projects/add', [ 
    'as' => 'projects.add',
    'uses' => 'ProjectController@add'
])->middleware('can:admin');

Route::put('/events/{event}/projects/add', [
    'as' => 'projects.add',
    'uses' => 'ProjectController@added'
]);




Route::get('/home', 'HomeController@index')->name('home');

