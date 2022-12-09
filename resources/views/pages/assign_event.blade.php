@extends('layouts.admin_layout')
@section('content')


{{-- <nav class="navbar navbar-expand-lg navbar-dark p-3 bg-dark" id="headerNav">
    <div class="container-fluid">
      <a class="navbar-brand d-block d-lg-none" href="#">
        <h2 class="navbar-text text-white"> {{ Str::upper($vending_point_details->name) }}</h2>
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class=" collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav mx-auto ">
          <li class="nav-item d-none d-lg-block">
            <a class="nav-link mx-2" href="#">
              <h2 class="navbar-text text-white"> {{ Str::upper($vending_point_details->name) }}</h2>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link mx-2 mt-4" href="{{route('logout')}}">logout</a>
          </li>
        </ul>
      </div>
    </div>
</nav> --}}

    <div class="container" style="margin-top: 5rem !important">
        <div class="row">
            <div class="col-md-4">
            </div>
            <div class="col-md-4">
                <h2 class="title text-center">{{ Str::upper($vending_point_details->name) }}</h2>
            </div>
            <div class="col-md-4">
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
            </div>
            <div class="col-md-4">
                <h4 class="title text-center">Assign an Event</h4>
            </div>
            <div class="col-md-4">
            </div>
        </div>

        {{-- <form method="post" action="{{ route('assign_new_event') }}"> --}}
        <form method="post" action="https://virtualsolutionsgh.com/ticket_vendor/assign_new_event">
            @csrf
            <div class="row mb-3">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <input type="hidden" name="vending_point_id" id="vending_point_id" value="{{ $vending_point_details->id }}">
                    <div class="form-group mb-3">
                        <label for="txt_event_id" class="form-label" id="label">Select Event</label>
                            <select class="form-select" aria-label="Default select example" name="txt_event_id">
                                <option disabled selected>Select Event</option>
                                @foreach($all_events as $event)
                                    <option value="{{ $event->id }}">{{ $event->name }}</option>
                                @endforeach

                            </select>
                    </div>
                    <span class="text-danger">@error('txt_event_id') {{ $message }} @enderror</span>
                </div>
                <div class="col-md-3"></div>
            </div>

            <div class="row mb-4">
                <div class="col-md-3"></div>
                {{-- <div class="col-md-3"></div> --}}
                <div class="col-md-6">
                    <button type="submit" class="btn btn--veeticket btn-block" id="submit">Continue</button>
                </div>
                <div class="col-md-3">
                </div>
            </div>

        </form>
    </div>




@endsection
