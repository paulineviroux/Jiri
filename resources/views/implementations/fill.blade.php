@extends( 'layouts.header' )
@section( 'title', 'Encoder les projets d\'un étudiant' )

@section('content')
<section class="content-wrapper">
    <div class="container-fluid"> 

    {!! Form::open(["route" => ["implementations.create", $event, $student], "method" => "PUT"]) !!} 
        
        <h1>Encoder les projects de {{ $student->name }}</h1>
        <div class="table-responsive table__container">
            <table class="table table-striped table-bordered table-hover table-condensed">
                <thead>
                    <th>Implémenter ?</th>
                    <th>Nom du projet</th>
                    <th>URL</th>
                    <th>Repo</th>
                </thead>
                <tbody>   

            @foreach($project_implementations as $project)
                <tr>
                    <td class="text-center">{!! Form::checkbox('selected['. $project->id .']', $project->id, $project->exists, ['id' => 'selected_' . $project->id]) !!}</td>
                    <td>
                        {!! Form::label('selected_'. $project->id, $project->name) !!}
                        {!! Form::hidden('project_id['. $project->id .']', $project->id) !!}
                    </td>
                    <td>{!! Form::text('url_project['. $project->id .']', $project->url_project, ['placeholder' => 'http://url-to-website.com', 'class' => 'form-control form-control-feedback']) !!}</td>
                    <td>{!! Form::text('url_repo['. $project->id .']', $project->url_repo, ['placeholder' => 'http://url-to-website.com', 'class' => 'form-control form-control-feedback']) !!}</td>
                </tr>
            @endforeach
            
                </tbody>            

            </table>  
        </div>      

        {!! Form::submit("Encoder les projets", ['class' => 'btn btn-default btn-info']) !!}

    {!! Form::close() !!}
    </div>
</section>
@endsection