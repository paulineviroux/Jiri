@extends( 'layouts.header' )

@section( 'title', 'Appréciation globale' )

@section( 'content' )
    <h1>Appréciation globale</h1>
    <div>
        {!! Form::open(["route" => ["users.globalEvaluation", ], "method" => "PUT"]) !!}
            
            {!! Form::label("Cote") !!}
            {!! Form::text("Cote") !!}

            {!! Form::label("Commentaire") !!}
            {!! Form::textarea("Commentaire") !!}

            {!! Form::submit("Enregistrer", ['class' => 'btn btn-default btn-info']) !!}

        {!! Form::close() !!}
    </div>
@endsection
