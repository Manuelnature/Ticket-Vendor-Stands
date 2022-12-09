@extends('layouts.admin_layout')
@section('content')

@php
    $user_session_details = Session::get('user_session');
    $user_id = $user_session_details->id;
    $organizer_id = $user_session_details->organizer_id;
@endphp

{{-- <nav class="navbar navbar-dark bg-dark">
    <div class="container-fluid">
        <div class="nav_inner">
            <h2 class="navbar-text text-white"> {{ Str::upper($organizer_name) }}</h2>
            <a class="logout" href="{{route('logout')}}">logout</a>
        </div>
      <span class="navbar-text text-white">
      </span>
    </div>
</nav> --}}

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
                <h2 class="text-center">My Events</h2>
            </div>
        </div>

        {{-- <div class="row mb-4">
            <div class="col-md-3"></div>
            <div class="col-md-6 text-center">
                <a href="{{ url('add_event') }}" class="btn btn-success">Add New Event</a>
                <a href="{{ url('vending_point') }}" class="btn btn-success">Add Vending Point</a>
            </div>
            <div class="col-md-3"></div>
        </div> --}}

        <div class="row mb-5">
            @foreach ($my_events as $events)
                <div class="col-md-3 mb-4" id="card_div">
                    <a href="{{ url('organizer_details', $events->id ) }}" id="card_link">
                        <div class="card" id="event_card">
                            <div class="card-body">
                                <h5 class="card-title mb-4">{{ Str::upper($events->name)}}</h5>
                                {{-- <p class="card-text text-muted">Tickets Sold: <span><span></p> --}}
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>


        {{-- <div class="row mb-5">
            @foreach (json_decode($my_events, true) as $events)
                <div class="col-md-3 mb-4" id="card_div">
                    <a href="#" id="card_link">
                        <div class="card" id="card">
                            <div class="card-body">
                                <h5 class="card-title mb-4">{{ $events['event_name']}}</h5>{{ $events['event_id']}}
                                <p class="card-text text-muted">Tickets Sold: {{ $events['total_tickets_sold'] }}<span><span></p>
                                <p class="card-text text-muted">Tickets Sold: {{ $events['total_amount'] }}<span><span></p>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div> --}}


        {{-- <div class="row mb-4">
            <div class="col-md-3">
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                      <h5 class="card-title">Card title</h5>
                      <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>
                      <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                      <a href="#" class="card-link">Card link</a>
                      <a href="#" class="card-link">Another link</a>
                    </div>
                  </div>
            </div>
        </div> --}}

        <div class="row mb-5">

        </div>

        {{-- <div class="row mb-4">
           <div class="col-md-12">
            <h2 class="text-center mb-5">Total Tickets Sold</h2>
            <table class="table table-striped">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Event Name</th>
                    <th scope="col">Organization</th>
                    <th scope="col">Vending Point</th>
                    <th scope="col">Tickets Sold</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th scope="row">1</th>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td>@mdo</td>
                    <td>@mdo</td>
                  </tr>
                </tbody>
              </table>
           </div>
        </div> --}}


    </div>



@endsection
