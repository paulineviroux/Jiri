@extends( 'layouts.header' )

@section( 'title', 'Créer un événement' )

@section( 'content' )
    <section class="content-wrapper">
        <div class="container-fluid">
            <h1>Créer un nouvel événement</h1>
            <div>

                {!! Form::open(["route" => ["admin.createdEvent", ], "method" => "PUT"]) !!}
                    <div class="form-group">
                        {!! Form::label("course_name", "Nom") !!}
                        {!! Form::text("course_name", null, [ 'class' => 'form-control form-control-feedback']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label("academic_year","Année académique") !!}
                        {!! Form::text("academic_year", null, [ 'class' => 'form-control form-control-feedback']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label("exam_session","Session d'examen") !!}
                        {!! Form::text("exam_session", null, [ 'class' => 'form-control form-control-feedback']) !!}
                    </div>

                    {!! Form::submit('Enregistrer', ['class' => 'btn btn-default btn-info']) !!}

                {!! Form::close() !!}
            </div>
        </div>
    </section>
@endsection
