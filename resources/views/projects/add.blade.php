@extends( 'layouts.header' )

@section( 'title', 'Ajouter des projets' )

@section( 'content' )
<section  class="content-wrapper">
    <div class="container-fluid">
    <h1>Ajouter des projets</h1>
    <div>
        {!! Form::open(["route" => ["projects.add", $event], "method" => "PUT"]) !!}
            <div class="form-group">
                {!! Form::label("name", "Titre du projet") !!}
                {!! Form::text("name", null, [ 'class' => 'form-control form-control-feedback']) !!}
            </div>
            <div class="form-group">
                {!! Form::label("description", "Description") !!}
                {!! Form::textarea("description", null, [ 'class' => 'form-control form-control-feedback']) !!}
            </div>
            <div class="form-group">
                {!! Form::label("weight", "Pondération") !!}
                {!! Form::number("weight", null, [ 'step' => 0.1, 'min' => 0, 'max' => 10, 'class' => 'form-control form-control-feedback']) !!}
            </div>

            <div class="form-group">
                    {!! Form::label("continue_adding", "Continuer l'ajout des projets ") !!}
                    {!! Form::checkbox("continue_adding", "continue_adding", true) !!}
            </div>

            {!! Form::submit("Enregistrer", ['class' => 'btn btn-default btn-info']) !!}

        {!! Form::close() !!}
    </div>
    </div>
</section>
@endsection
