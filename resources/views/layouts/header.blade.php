<?php
    if(!isset($event) && Session::has('event')){
        $event = Session::get('event');
    }
?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="author" content="Pauline Viroux">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" >
    {{ Html::style('css/main.css') }}
    
    <title>@yield("title") - Jiri</title>
</head>
<body class="fixed-nav sticky-footer" id="page-top">
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
        @if(isset($event)) 
        <a class="navbar-brand" href="{{ route("admin.dashboard", $event) }}">Jiri</a> <!--Route vers ??-->
        @endif
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <h2 class="hidden">Menu principal</h2>
            <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
            @if(isset($event))    
                <li class="nav-item active" data-toggle="tooltip" data-placement="right" title="Dashboard">
                    <a class="nav-link" href="{{ route("admin.dashboard", $event) }}">
                      <span class="nav-link-text">
                       <i class="fa fa-fw fa-dashboard"> </i>
                        Dashboard</span>
                    </a>
                </li>
            @endif
                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Evénement">
                    <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseEvent" data-parent="#exampleAccordion">
                      <i class="fa fa-fw fa-wrench"> </i>
                      <span class="nav-link-text">
                        Événement</span>
                    </a>
                    <ul class="sidenav-second-level collapse" id="collapseEvent">
                        @if(Auth::user()->is_admin)
                        <li>
                            <a href="{{ route("admin.createEvent") }}">Ajouter</a>
                        </li>
                        <li>
                            <a href="#">Modifier</a>
                        </li>
                        @endif
                        <li>
                            <a href="{{ route("event.show") }}">Liste</a>
                        </li>
                    </ul>
                </li>

                @if(Auth::user()->is_admin)
                @if(isset($event))
                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Jury">
                    <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseJury" data-parent="#exampleAccordion">
                      <i class="fa fa-fw fa-wrench"> </i>
                      <span class="nav-link-text">
                        Jury</span>
                    </a>
                    <ul class="sidenav-second-level collapse" id="collapseJury">
                    
                        <li>
                            <a href="{{ route("admin.addJury", $event) }}">Ajouter</a>
                        </li>
                    
                        <li>
                            <a href="#">Modifier</a>
                        </li>
                    </ul>
                </li>
                @endif
                @endif

                @if(Auth::user()->is_admin)
                @if(isset($event))
                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Etudiant">
                    <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseStudent" data-parent="#exampleAccordion">
                      <i class="fa fa-fw fa-wrench"> </i>
                      <span class="nav-link-text">
                        Étudiant</span>
                    </a>
                    <ul class="sidenav-second-level collapse" id="collapseStudent">
                        <li>
                            <a href="{{ route("admin.addStudents", $event) }}">Ajouter</a>
                        </li>
                        <li>
                            <a href="#">Modifier</a>
                        </li>
                        <li>
                            <a href="{{ route("implementations.selectStudent", $event) }}">Projets</a>
                        </li>
                    </ul>
                </li>
                @endif
                @endif

                @if(Auth::user()->is_admin)
                @if(isset($event))
                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Projet">
                    <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseProject" data-parent="#exampleAccordion">
                      <i class="fa fa-fw fa-wrench"> </i>
                      <span class="nav-link-text">
                        Projets</span>
                    </a>
                    <ul class="sidenav-second-level collapse" id="collapseProject">
                        <li>
                            <a href="{{ route("projects.add", $event) }}">Ajouter</a>
                        </li>
                        <li>
                            <a href="#">Modifier</a>
                        </li>
                    </ul>
                </li>
                @endif
                @endif
            </ul>
            <ul class="navbar-nav sidenav-toggler">
                <li class="nav-item">
                    <a class="nav-link text-center" id="sidenavToggler">
                        <i class="fa fa-fw fa-angle-left"></i>
                    </a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item connected-user">
                <i> </i>{{ Auth::user()->name }}
                </li>
                <li class="nav-item">

                   {!! Form::open(['route' => ['logout'], "method" => "POST"]) !!}
                        {{ csrf_field() }}
                        {!! Form::submit('Se deconnecter', ['class' => 'btn btn-default btn-link nav-link']) !!}
                    {!! Form::close() !!}
                </li>
            </ul>     
        </div>
    </nav>
    </header>
    
    @yield( "content" )

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
    {{ Html::script('js/main.js') }}
</body>
</html>