@extends('layouts.admin_layout')
@section('content')


{{-- <nav class="navbar navbar-expand-lg navbar-dark p-3 bg-dark" id="headerNav">
    <div class="container-fluid">
      <a class="navbar-brand d-block d-lg-none" href="#">
        <h2 class="navbar-text text-white"> {{ Str::upper($organizer_name) }}</h2>
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class=" collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav mx-auto ">
            <li class="nav-item">
                <a class="nav-link mx-2 mt-4" href="{{ url('organizer') }}">My Events</a>
            </li>
          <li class="nav-item d-none d-lg-block">
            <a class="nav-link mx-2" href="#">
              <h2 class="navbar-text text-white"> {{ Str::upper($organizer_name) }}</h2>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link mx-2 mt-4" href="{{ url('organizer') }}">My Events</a>
         </li>
          <li class="nav-item">
            <a class="nav-link mx-2 mt-4" href="{{ url('vending_point') }}">Add Vending Point</a>
          </li>
          <li class="nav-item">
            <a class="nav-link mx-2 mt-4" href="{{route('logout')}}">logout</a>
          </li>
        </ul>
      </div>
    </div>
</nav> --}}

    <div class="container" style="margin-top: 5rem !important">
        <div class="row mb-5">
            <div class="col-md-12">
                <h2 class="text-center mb-4">{{ Str::upper($events_details->name) }}</h2>
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
                            <p class="card-text text-muted mb-4">Price Per Ticket: GH¢ {{ number_format($tickets['price'], 2) }}<span><span></p>
                            <p class="card-text text-muted">Total Quantity: {{ $tickets['quantity'] }} <span><span></p><br>
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
        </div>
    </div>

    <div class="container" style="margin-top: 5rem !important">
        <div class="row mb-3">
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
                        <h4 class="mb-4 text-center" style="color:#000">No vending point assigned yet !</h4>
                    </div>
                <div class="col-md-4 mb-4"></div>

            @endif

        </div>

        <div class="row mb-5">

        </div>




    </div>


@endsection
