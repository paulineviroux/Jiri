@extends( 'layouts.header' )
@section( 'title', 'Encodage de l\'horaire' )

@section('content')
<section class="content-wrapper">
    <div class="container-fluid">
        <h1>Organiser la session de {{ $event->course_name }} - {{ $event->academic_year }} - session n° {{ $event->exam_session }}</h1>

        {!! Form::open(["route" => ["meetings.create", $event], "method" => "PUT"]) !!} 
            <div class="form-group">
                {!! Form::label("user_id", "Jury") !!}
                {!! Form::select("user_id", $jury->pluck('name', 'id'), null, [ 'class' => 'form-control form-control-feedback']) !!}
            </div>
            <div class="form-group">
                {!! Form::label("student_id", "Étudiant") !!}
                {!! Form::select("student_id", $students->pluck('name', 'id'), null, [ 'class' => 'form-control form-control-feedback']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('date', "Heure de la rencontre") !!}
                {!! Form::date('date', Carbon\Carbon::now()->format('Y-m-d'), [ 'class' => 'form-control form-control-feedback']) !!}
                {!! Form::time('time', Carbon\Carbon::now('Europe/Brussels')->format('H:i'), [ 'class' => 'form-control form-control-feedback']) !!}
            </div>

            <div class="form-group">
                {!! Form::label("continue_adding", "Ajouter un nouveau jury ?") !!}
                {!! Form::checkbox("continue_adding",   "continue_adding", true) !!}
            </div>


            {!! Form::submit("Enregistrer", ['class' => 'btn btn-default btn-info']) !!}

        {!! Form::close() !!}
    </div>
</section>

@endsection