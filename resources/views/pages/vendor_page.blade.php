@extends('layouts.main')
@section('content')
@php
    $user_session_details = Session::get('user_session');
    $user_id = $user_session_details->id;
    $organizer_id = $user_session_details->organizer_id;
@endphp

{{-- <nav class="navbar bg-dark">
    <div class="container-fluid">
        <h2 class="navbar-text text-white" id="nav_text"> {{  Str::upper($vending_point_name) }}</h2>
        <a href="{{route('logout')}}">logout</a>
    </div>
</nav> --}}

<nav class="navbar navbar-expand-lg navbar-dark p-3 bg-dark" id="headerNav">
    <div class="container-fluid">
      <a class="navbar-brand d-block d-lg-none" href="#">
        <h6 class="navbar-text text-white"> {{ Str::upper($vending_point_name) }}</h6>
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class=" collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav mx-auto ">
          <li class="nav-item d-none d-lg-block">
            <a class="nav-link mx-2" href="#">
              <h2 class="navbar-text text-white"> {{ Str::upper($vending_point_name) }}</h2>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link mx-2 mt-4" href="{{route('logout')}}">logout</a>
          </li>
        </ul>
      </div>
    </div>
</nav>


    <div class="container" style="margin-top: 5rem !important">
        <div class="row mb-5">
            <div class="col-md-12">
                <h2 class="text-center">Choose Events</h2>
            </div>
        </div>

        <div class="row mb-5">
            @foreach ($all_selected_events as $events)
                <div class="col-md-3 mb-4" id="card_div">
                    <a href="{{ url('vendor_sales', $events->id) }}" id="card_link">
                        <div class="card" id="card">
                            <div class="card-body">
                                <h5 class="card-title mb-4">{{ $events->name }}</h5>
                                {{-- <p class="card-text text-muted">Tickets Sold: <span><span></p> --}}
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
        <div class="row mb-5">

        </div>

    </div>

    {{-- <div class="container" style="margin-top: 5rem !important">
        <div class="row">
            <div class="col-md-4">
            </div>
            <div class="col-md-4">
                <!-- <h4 class="title">User: {FIRSTNAME LAST NAME}</h4> -->
            </div>
            <div class="col-md-4">
            </div>
        </div>

        <form method="post" action="{{ route('subscribe') }}">
            @csrf
            <div class="row mb-4">
                <div class="col-md-4">
                </div>
                <div class="col-md-4">
                    <div class="form-group mb-3">
                        <label for="txt_name" class="form-label" id="label">Event Name</label>
                        <select class="form-select" aria-label="Default select example">
                            <option disabled selected>Select Event</option>
                            <option value="Rhythms">Rhythms</option>
                            <option value="Mozama Disco">Mozama Disco</option>
                            <option value="Bhim Concert">Bhim Concert</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                </div>
                <div class="col-md-2">
                    <label for="txt_name" class="form-label" id="label">Choose Ticket Type</label>
                </div>
                <div class="col-md-2">
                    <label for="txt_name" class="form-label" id="label">Quantity</label>
                </div>
                <div class="col-md-4">
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                </div>
                <div class="col-md-2 mb-3">
                    <div class="form-check">
                        <label for="txt_name" class="form-label" id="label"></label>
                        <input type="checkbox" class="form-check-input" id="terms" name="terms" value="Regular">
                        <label class="form-check-label" for="terms" id="label">Regular</label>
                    </div>
                </div>
                <div class="col-md-2 mb-3">
                    <input type="text" class="form-control" id="quantity" name="txt_name" >
                </div>
                <div class="col-md-4">
                </div>
            </div>
            <div class="row mb-4">
                <div class="col-md-4">
                </div>
                <div class="col-md-2">
                    <div class="form-check">
                        <label for="txt_name" class="form-label" id="label"></label>
                        <input type="checkbox" class="form-check-input" id="terms" name="terms" value="VIP">
                        <label class="form-check-label" for="terms" id="label">VIP</label>
                    </div>
                </div>
                <div class="col-md-2">
                    <input type="text" class="form-control" id="quantity" name="txt_name">
                </div>
                <div class="col-md-4">
                </div>
            </div>
            <div class="row mb-4">
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <div class="form-group mb-3">
                        <label for="txt_name" class="form-label" id="label">Mobile Number</label>
                        <input type="number" class="form-control" id="txt_name" name="txt_name">
                    </div>
                    <div class="mb-3">
                        <label for="txt_email" class="form-label" id="label">Email address</label>
                        <input type="email" class="form-control" id="txt_email" aria-describedby="emailHelp" name="txt_email">
                    </div>
                    <button type="submit" class="btn btn--veeticket" id="submit">Submit</button>
                </div>
                <div class="col-md-4"></div>
            </div>

        </form>
    </div> --}}

@endsection
