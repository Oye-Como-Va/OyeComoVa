@extends('templates.general')

@section('main')
    <div class="workingArea">
        <div class="row">
            <div class="col-12 col-sm-4 mb-4 cardContainer">
                <!-- Card 1 -->
                <a href="{{ route('workingArea') }}">
                    <section class="card">
                        <div class="icon d-flex flex-column">
                            <img src="{{ URL::asset('img/briefcase.png') }}" class="svg" />
                            <p>Working Area</p>
                        </div>
                    </section>
                </a>
            </div>
            <div class="col-12 col-sm-4 mb-4 cardContainer">
                <!-- Card 2 -->
                <section class="card">
                    <div class="icon d-flex flex-column">
                        <img src="{{ URL::asset('img/calendar.png') }}" class="svg" />
                        <p>Calendario</p>
                    </div>
                </section>
            </div>
            <div class="col-12 col-sm-4 mb-4 cardContainer">
                <!-- Card 3 -->
                <section class="card">
                    <div class="icon d-flex flex-column">
                        <img src="{{ URL::asset('img/folder.png') }}" class="svg" />
                        <p>Mis cursos</p>
                    </div>
                </section>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-sm-4 mb-4 cardContainer">
                <!-- Card 4 -->
                <section class="card">
                    <div class="icon d-flex flex-column">
                        <img src="{{ URL::asset('img/barChart.png') }}" class="svg" />
                        <p>Estadísticas</p>
                    </div>
                </section>
            </div>
            <div class="col-12 col-sm-4 mb-4 cardContainer">
                <!--  5 -->
                <section class="card">
                    <div class="icon d-flex flex-column">
                        <img src="{{ URL::asset('img/medal.png') }}" class="svg" />
                        <p>Logros</p>
                    </div>
                </section>
            </div>
            <div class="col-12 col-sm-4 mb-4 cardContainer">
                <!--  6 -->
                <section class="card">
                    <div class="icon d-flex flex-column">
                        <img src="{{ URL::asset('img/userIcon.png') }}" class="svg" />
                        <p>Editar usuario</p>
                    </div>
                </section>
            </div>
        </div>
    </div>
    </div>
@endsection
