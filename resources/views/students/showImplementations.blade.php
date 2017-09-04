@extends( 'layouts.header' )

@section( 'title', 'Ajouter des projets' )

@section( 'content' )
<section class="content-wrapper">
    <div class="container-fluid">    

    <h1>Projets de {{ $student->name }}</h1>
        <div class="table-responsive table__container">
            <table class="table table-striped table-bordered table-hover table-condensed">
                
                <thead>
                    <th>Projet</th>
                    <th>URL</th>
                    <th>Repository</th>
                    <th>Evaluer</th>
                </thead>

                <tbody>
                    @foreach($implementations as $implementation)
                        <tr>
                            <td>{{ $implementation->project->name }}</td>
                            
                            @if( $implementation->url_repo )
                                <td><a href="{{ $implementation->url_project }}">{{ $implementation->url_project }}</a></td>
                            @else
                                <td>-</td>
                            @endif

                            @if( $implementation->url_repo )
                                <td><a href="{{ $implementation->url_repo }}">{{ $implementation->url_repo }}</a></td>
                            @else
                                <td>-</td>
                            @endif

                            <td><a href="{{ route('implementations.evaluate', $implementation) }}">Evaluer <i></i></a></td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
</section>

@endsection