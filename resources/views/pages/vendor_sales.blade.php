@extends('layouts.main')
@section('content')

@php
    $user_session_details = Session::get('user_session');
    $user_id = $user_session_details->id;
    $vending_point_id = $user_session_details->vending_point_id;
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
        <h5 class="navbar-text text-white"> {{ Str::upper($vending_point_name) }}</h5>
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class=" collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav mx-auto ">
          <li class="nav-item d-none d-lg-block">
            <a class="nav-link mx-2" href="#">
              <h5 class="navbar-text text-white mt-3"> {{ Str::upper($vending_point_name) }}</h5>
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
        <div class="row">
            <div class="col-md-4">
            </div>
            <div class="col-md-4">
                <h4 class="title text-center" >{{ Str::upper($get_event->name )}}</h4>
            </div>
            <div class="col-md-4">
            </div>
        </div>

        {{-- <form method="post" action="{{ route('add_sales') }}"> --}}
        <form method="post" action="https://virtualsolutionsgh.com/ticket_vendor/add_sales">
            @csrf
            <div class="row mb-4">
                <input type="hidden" id="event_id" name="event_id" value="{{ $get_event->id }}">
                <input type="hidden" id="vending_point_id" name="vending_point_id" value="{{ $vending_point_id }}">
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
            <div class="row mb-4">
                @foreach(json_decode($get_event->tickets, true) as $tickets)
                    <div class="col-md-4">
                    </div>
                    <div class="col-md-2 mb-3">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="txt_ticket_type" name="txt_ticket_type[]" value="{{ $tickets['type'] }}">
                            <label class="form-check-label" for="txt_ticket_type" id="label">{{ ucwords($tickets['type'])}}</label>
                        </div>
                    </div>
                    <div class="col-md-2 mb-3">
                        <input type="hidden" id="txt_ticket_price" name="txt_ticket_price[]" value="{{ $tickets['price'] }}">
                        <input type="hidden" id="txt_ticket_total_quantity" name="txt_ticket_total_quantity[]" value="{{ $tickets['quantity'] }}">
                        <input type="text" class="form-control" id="txt_quantity" name="txt_quantity[]">
                    </div>
                    <div class="col-md-4">
                    </div>
                @endforeach
            </div>

            {{-- <div class="row mb-4">
                <div class="col-md-4">
                </div>
                <div class="col-md-2">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="terms" name="terms" value="VIP">
                        <label class="form-check-label" for="terms" id="label">VIP</label>
                    </div>
                </div>
                <div class="col-md-2">
                    <input type="text" class="form-control" id="quantity" name="txt_name">
                </div>
                <div class="col-md-4">
                </div>
            </div> --}}

            <div class="row mb-4">
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <div class="form-group mb-3">
                        <label for="txt_phone_number" class="form-label" id="label">Mobile Number</label>
                        <input type="number" class="form-control" id="txt_phone_number" name="txt_phone_number">
                    </div>
                    <div class="mb-3">
                        <label for="txt_email" class="form-label" id="label">Email address</label>
                        <input type="email" class="form-control" id="txt_email" aria-describedby="emailHelp" name="txt_email">
                    </div>
                    <button type="submit" class="btn btn--veeticket" id="submit">Continue</button>
                </div>
                <div class="col-md-4"></div>
            </div>

        </form>
    </div>

@endsection
