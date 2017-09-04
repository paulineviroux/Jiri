@extends( 'layouts.header' )

@section( 'title', 'Dashboard' )

@section( 'content' )
<section  class="content-wrapper">
    <div class="container-fluid">
        
        @if(Auth::user()->is_admin)
        <div class="card mb-3">
            <div class="card-header">
                <i class="fa fa-area-chart"></i>
                <strong>{{ $event->course_name }}</strong> - {{ $event->academic_year }} - session n° {{ $event->exam_session }}
            </div>
            <div class="card-body">
                <div class="table-responsive table__container">
                    <table class="table table-striped table-bordered table-hover table-condensed">
                        <thead>
                            <tr>
                            <th></th>
                                @foreach( $event->users as $jury )
                                <th class="text-center" colspan="{{ $event->projects->count() }}">
                                    {{ $jury->name }}
                                </th>
                                @endforeach
                            </tr>
                            <tr>
                                <th></th>
                                @for ( $i=0; $i < $event->users->count(); $i++)
                                    @foreach ( $event->projects as $project )
                                        <th>
                                            {{ $project -> name }}
                                        </th>
                                    @endforeach
                                @endfor
                            </tr>
                        </thead>
                        <tbody>
                            @foreach( $event->students as $student )
                            <tr>
                                <th>
                                    {{ $student->name }}
                                </th>
                                @foreach( $event->users as $jury )
                                    @if( $event->meetings->where( "user_id", $jury->id )->where( "student_id", $student->id )->count() )
                                        @foreach( $event->meetings->where( "user_id", $jury->id)->where( "student_id", $student->id)->first()->scores as $score )
                                        <td class="text-center">
                                            {{ $score->score }}
                                        </td>
                                        @endforeach
                                    @else
                                        <td></td>
                                    @endif
                                @endforeach
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div> 
        @endif

        @include('users.timetable')

    </div>
</section>
@endsection
