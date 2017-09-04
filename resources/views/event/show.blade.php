@extends( 'layouts.header' )

@section( 'title', 'Evènements' )

@section( 'content' )
<section class="content-wrapper">
    <div class="container-fluid">
        <div>
            <h1>Événements de {{ $user->name }}</h1>
            @foreach($events as $event)  
            <div class="col-lg-8">
                <div class="card mb-3">
                    <div class="card-header">
                        <i class="fa fa-bar-chart"> </i>
                        {{ Html::link(route('admin.dashboard', $event), $event->course_name) }}
                    </div>
                    <div class="card-body">
                    <div class="row">
                        <div class="col-sm-8 my-auto">
                            <p>{{ $event->academic_year }}</p>
                            <p>Session n° {{ $event->exam_session }}</p>
                        </div>
                    </div>
                  </div>
                </div>
            </div>
            @endforeach
        
        </div>
    </div>
</section>

@endsection