@extends('layouts.main')
@section('content')
<nav class="navbar bg-dark">
    <div class="container-fluid">
        <h2 class="navbar-text text-white" id="nav_text"> {{ $organizer_name }}</h2>
        <a href="{{route('logout')}}">logout</a>
      {{-- <span class="navbar-text text-white">

      </span> --}}
    </div>
</nav>

    <div class="container" style="margin-top: 5rem !important">
        <div class="row mb-5">
            <div class="col-md-12">
                <h2 class="text-center mb-4">{{ $events_details->name }}</h2>
                {{-- @foreach (json_decode($events_details->tickets, true) as $tickets)
                        <p>Ticket Type = {{ $tickets['type'] }} {{ $tickets['price'] }} {{ $tickets['quantity'] }}</p>

                @endforeach --}}
                <h4 class="text-center"> Tickets Details </h4>
            </div>
        </div>

        <div class="row mb-5">
            @foreach (json_decode($events_details->tickets, true) as $tickets)
            <div class="col-md-3 mb-4" id="card_div">
                <a href="#" id="card_link">
                    <div class="card" id="card">
                        <div class="card-body">
                            <h5 class="card-title mb-4">{{ Str::upper($tickets['type']) }}</h5>
                            <p class="card-text text-muted mb-4">Price Per Ticket: {{ $tickets['price'] }}<span><span></p>
                            <p class="card-text text-muted">Total Quantity: {{ $tickets['quantity'] }} <span><span></p>
                            <p class="card-text text-muted mb-3">Expected Amount:
                                    @php
                                        $expected_amount  = (double) $tickets['price'] * (double)$tickets['quantity'];
                                        echo 'Gh¢ '.number_format($expected_amount, 2);
                                    @endphp
                            </p>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach

            {{-- <div class="col-md-3 mb-4" id="card_div">
                <a href="#" id="card_link">
                    <div class="card" id="card">
                        <div class="card-body">
                            <h5 class="card-title mb-4">REGULAR</h5>
                            <p class="card-text text-muted mb-4">Tickets Sold: <span><span></p>
                            <p class="card-text text-muted">Total Amount: <span><span></p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-3 mb-4" id="card_div">

            </div> --}}
        </div>
    </div>

    <div class="container" style="margin-top: 5rem !important">
        <div class="row mb-5">
            <div class="col-md-12">
                <h2 class="text-center">Vending Points</h2>
            </div>
        </div>

        <div class="row mb-5">
            @if ($all_vending_points != NULL || $all_vending_points != "")
                @foreach (json_decode($all_vending_points, true) as $vending_points)
                    <div class="col-md-3 mb-4" id="card_div">
                        <a href="{{url('vending_point_details', [$vending_points['id'], $events_details->id]) }}" id="card_link">
                            <div class="card" id="card">
                                <div class="card-body">
                                    <h5 class="card-title mb-4">{{ $vending_points['name'] }}</h5>
                                    <p class="card-text text-muted"> {{ $vending_points['location'] }}<span><span></p>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            @else
                <div class="col-md-4 mb-4"></div>
                    <div class="col-md-4 mb-4" >
                        <h2 class="mb-4" style="color:#000">No vending point assigned yet</h2>
                    </div>
                <div class="col-md-4 mb-4"></div>

            @endif


            {{-- <div class="col-md-3 mb-4" id="card_div">
                <a href="#" id="card_link">
                    <div class="card" id="card">
                        <div class="card-body">
                            <h5 class="card-title mb-4">ACCRA MALL</h5>
                        <p class="card-text text-muted">Tickets Sold: <span><span></p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-3 mb-4" id="card_div">
                <a href="#" id="card_link">
                    <div class="card" id="card">
                        <div class="card-body">
                            <h5 class="card-title mb-4">BATSONA</h5>
                            <p class="card-text text-muted">Tickets Sold: <span><span></p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-3 mb-4" id="card_div">
                <a href="#" id="card_link">
                    <div class="card" id="card">
                        <div class="card-body">
                            <h5 class="card-title mb-4">PALCE MALL</h5>
                            <p class="card-text text-muted">Tickets Sold: <span><span></p>
                        </div>
                    </div>
                </a>
            </div> --}}
        </div>

        <div class="row mb-5">

        </div>




    </div>


@endsection
