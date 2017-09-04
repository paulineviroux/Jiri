@extends( 'layouts.header' )
@section( 'title', 'Encodage des projets' )

@section('content')
<section class="content-wrapper">
    <div class="container-fluid">
    <h1>Encoder les projets des étudiants</h1>
    {!! Form::open(["route" => ["implementations.fill", $event], "method" => "PUT"]) !!} 
        <div class="form-group">
            {!! Form::label("student_id", "Étudiant") !!}
            {!! Form::select("student_id", $students->pluck('name', 'id'), null, [ 'class' => 'form-control form-control-feedback']) !!}
        </div>

        {!! Form::submit("Encoder les projets", ['class' => 'btn btn-default btn-info']) !!}

        {{-- <a href="{{ route("admin.dashboard", $event) }}">Dashboard</a> --}}

    {!! Form::close() !!}
    </div>
</section>

@endsection