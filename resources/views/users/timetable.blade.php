
        <div>
            <div class="card mb-3">
                    <div class="card-header">
                        <h1>Horaire de l'événement</h1>
                    </div>
                    <div class="card-body">
                    <div class="row">
                        <div class="col-sm-8 my-auto">
                            <ul>
                                @forelse($meetings as $meeting)   

                                <li>{{ $meeting->start_time }} - {{ $meeting->end_time }} : <a href="{{ route('students.showImplementations', $meeting->student) }}">{{ $meeting->student->name }}</a></li>
                                
                                @empty
                                    <p>Vous n'avez aucun meeting prévu pour cet événement</p>
                                @endforelse      
                            </ul>
                        </div>
                    </div>
                  </div>
                </div>
            </div>
    
<!-- A renommer dashboard ? -->