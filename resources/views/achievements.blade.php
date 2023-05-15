@extends('templates.general')
@section('main')
    <div class="container">

        <div class="mt-5 row">
            @foreach ($logros as $logro)
            <div class="mt-5 col-lg-6  col-sm-12 d-flex align-items-center justify-content-center flex-column">
                <h3 class="card-text colorCustom">{{ $logro->name }}</h3>


                        <div class="py-5">
                            <img class="rounded border border-dark" src="{{ URL::asset($logro->image) }}" alt="image">
                        </div>


                <p>{{ $logro->description }}</p>
                <p class="colorCustom2">{{ $logro->pivot->created_at }}</p>
                <hr class="hr">
                </div>
            @endforeach


        </div>
    </div>
@endsection
