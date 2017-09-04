@extends( 'layouts.header' )

@section( 'title', 'Ajouter un étudiant' )

@section( 'content' )
    <section class="content-wrapper">
        <div class="container-fluid">
            <h1>Ajouter des étudiants à l'événement  {{ $event->course_name }}</h1>
            <div>

                {!! Form::open(["route" => ["admin.addingStudents", $event], "method" => "PUT"]) !!}
                    <div class="form-group">
                        {!! Form::label("name", "Nom") !!}
                        {!! Form::text("name", null, [ 'class' => 'form-control form-control-feedback']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label("email", "Adresse email") !!}
                        {!! Form::text("email", null, [ 'class' => 'form-control form-control-feedback']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label("continue_adding", "Ajouter un nouvel étudiant ?") !!}
                        {!! Form::checkbox("continue_adding", "continue_adding", true) !!}
                    </div>
                    {!! Form::submit("Enregistrer", ['class' => 'btn btn-default btn-info']) !!}

                {!! Form::close() !!}
            </div>
        </div>
    </section>
@endsection
