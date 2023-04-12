@extends('templates.template')
@section('menu')
    <div class="container" id="body-pd">
        <header class="header" id="header">
            <div class="header_toggle"> <i class='bx bx-menu' id="header-toggle"></i> </div>
            <div class="header_title">OYE CÓMO VA</div>
            <div class="header_img"> <img src="{{ URL::asset('img/user.png') }}" alt=""> </div>
        </header>
        <div class="l-navbar" id="nav-bar">
            <nav class="nav">
                <div> <a href="#" class="nav_logo"> <i class='bx bx-timer nav_logo-icon'></i> <span
                            class="nav_logo-name">¿HORA?</span> </a>
                    <div class="nav_list"> <a href="#" class="nav_link active"> <i
                                class='bx bx-briefcase nav_icon'></i> <span class="nav_name">Working Area</span> </a> <a
                            href="#" class="nav_link"> <i class='bx bx-calendar-exclamation nav_icon'></i> <span
                                class="nav_name">Calendario</span> </a> <a href="#" class="nav_link"><i
                                class='bx bx-folder nav_icon'></i> <span class="nav_name">Cursos</span>
                        </a> <a href="#" class="nav_link"> <i class='bx bx-bar-chart-alt-2 nav_icon'></i> <span
                                class="nav_name">Estadísticas</span> </a> <a href="#" class="nav_link"> <i
                                class='bx bx-medal nav_icon'></i> <span class="nav_name">Logros</span> </a> <a
                            href="#" class="nav_link"> <i class='bx bx-user nav_icon'></i> <span
                                class="nav_name">Editar perfil</span> </a> </div>
                </div> <a href="#" class="nav_link"> <i class='bx bx-log-out nav_icon'></i> <span
                        class="nav_name">Sign out</span> </a>
            </nav>
        </div>
        @yield('main')
    </div>
@endsection
