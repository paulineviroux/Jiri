@extends( 'layouts.header' )

@section( 'title', 'Ajouter un jury' )

@section( 'content' )
    <section class="content-wrapper">
    <div class="container-fluid">
        {{-- <nav>
            <h2 class="hidden">Navigation principale</h2>
            <ul>
                <li><a href="{{ route("admin.dashboard") }}">Dashboard</a></li>
                <li><a href=""></a></li>
            </ul>
        </nav> --}}
        <h1>Ajouter des membres du jury à l'événement {{ $event->course_name }}</h1>
        <div>

            {!! Form::open(["route" => ["admin.addingJury", $event], "method" => "PUT"]) !!}
                <div class="form-group">
                    {!! Form::label("name", "Nom") !!}
                    {!! Form::text("name", null, [ 'class' => 'form-control form-control-feedback', 'required']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label("email", "Email") !!}
                    {!! Form::text("email", null, [ 'class' => 'form-control form-control-feedback']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label("company", "Societé") !!}
                    {!! Form::text("company", null, [ 'class' => 'form-control form-control-feedback']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label("password", "Mot de passe") !!}
                    {!! Form::password("password", [ 'class' => 'form-control form-control-feedback']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label("continue_adding", "Continuer l'ajout de membres du jury ") !!}
                    {!! Form::checkbox("continue_adding", "continue_adding", true) !!}
                </div>

                {!! Form::submit("Enregistrer", ['class' => 'btn btn-default btn-info']) !!}

            {!! Form::close() !!}
        </div>  
    </div>  
    </section>
    
@endsection
