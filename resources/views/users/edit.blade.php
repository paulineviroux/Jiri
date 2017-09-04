@extends( 'layouts.header' )

@section( 'title', 'Modifier un étudiant' )

@section( 'content' )
    <h1>{{ $user->name }}</h1>
    {!! Form::open(["route" => ["users.update", $user], "method" => "PUT"]) !!}
        
        {!! Form::text("name", $user->name) !!}

        {!! Form::submit("Valider", ['class' => 'btn btn-default btn-info']) !!}

    {!! Form::close() !!}
@endsection