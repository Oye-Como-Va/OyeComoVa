@extends('templates.general')
@section('main')
    <div class="container">
        <h1>Tus logros</h1>
        <div class="container d-flex justify-content-around">
        @foreach ($logros as $logro )

            <p>{{$logro->name}}</p>
            <p>{{$logro->description}}</p>
            <img src="{{ URL::asset($logro->image) }}" alt="image">


        @endforeach

    </div>

    </div>
@endsection
