@extends('templates.template')
@section('general')
    <div class="container" id="body-pd">
        <header class="header" id="header">
            <div class="header_toggle"> <i class='bx bx-menu' id="header-toggle"></i> </div>
            <div class="header_title">
                <h1>Oye cómo va</h1>
            </div>
            <div class="header_img"> <a class="dropdown-item" href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><img
                        src="{{ URL::asset('img/user.png') }}" alt=""></a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </header>
        <div class="l-navbar" id="nav-bar">
            <nav class="nav">
                <div> <a href="{{ route('home') }}" class="nav_logo"> <i class='bx bx-home nav_logo-icon'></i> <span
                            class="nav_logo-name">{{ Auth::User()->name }}</span> </a>
                    <div class="nav_list"> <a href="{{ route('workingArea') }}" class="nav_link active"> <i
                                class='bx bx-briefcase nav_icon'></i> <span class="nav_name">Working Area</span> </a> <a
                            href="{{ route('calendar') }}"class="nav_link"> <i
                                class='bx bx-calendar-exclamation nav_icon'></i> <span class="nav_name">Calendario</span>
                        </a> <a href="{{ route('courses') }}" class="nav_link"><i class='bx bx-folder nav_icon'></i> <span
                                class="nav_name">Cursos</span>
                        </a> <a href="#" class="nav_link"> <i class='bx bx-bar-chart-alt-2 nav_icon'></i> <span
                                class="nav_name">Estadísticas</span> </a> <a href="#" class="nav_link"> <i
                                class='bx bx-medal nav_icon'></i> <span class="nav_name">Logros</span> </a> <a
                            href="#" class="nav_link"> <i class='bx bx-user nav_icon'></i> <span
                                class="nav_name">Editar perfil</span> </a> </div>
                </div> <a class="nav_link" href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i
                        class='bx bx-log-out nav_icon'></i></a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </nav>
        </div>
        @yield('main')
        @yield('workingAreaActive')
        @yield('calendar')
    </div>
@endsection
