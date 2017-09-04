@extends( 'layouts.header' )
@section( 'title', 'Evaluer le projet d\'un étudiant' )

@section('content')
<section  class="content-wrapper">
    <div class="container-fluid">
    <h1>Évaluation du projet {{ $project->name }} de {{ $student->name }}</h1>

        {!! Form::open(["route" => ["implementations.evaluate", $implementation], "method" => "PUT"]) !!}
            <div class="form-group">
                {!! Form::label("score", "Score") !!}

                @if($score)
                    {!! Form::number("score", $score->score, [ 'step' => 0.1, 'min' => 0, 'max' => 20, 'class' => 'form-control form-control-feedback' ]) !!}
                @else
                    {!! Form::number("score", null, [ 'step' => 0.1, 'min' => 0, 'max' => 20, 'class' => 'form-control form-control-feedback' ]) !!}
                @endif
            </div>
            <div class="form-group">
                {!! Form::label("comment", "Commentaire") !!}

                @if($score)
                    {!! Form::textarea("comment", $score->comment, [ 'class' => 'form-control form-control-feedback']) !!}
                @else
                    {!! Form::textarea("comment", null, ['class' => 'form-control form-control-feedback']) !!}
                @endif
            </div>
            {!! Form::submit("Enregistrer", ['class' => 'btn btn-default btn-info']) !!}

        {!! Form::close() !!}
    </div>
</section>
@endsection    