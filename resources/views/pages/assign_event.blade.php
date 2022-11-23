@extends('layouts.main')
@section('content')
<nav class="navbar bg-dark">
    <div class="container-fluid">
        <h2 class="navbar-text text-white" id="nav_text"> ASSIGN AN EVENT {{ Str::upper($vending_point_details->name) }}</h2>
      {{-- <span class="navbar-text text-white">

      </span> --}}
    </div>
</nav>

    <div class="container" style="margin-top: 5rem !important">
        <div class="row">
            <div class="col-md-4">
            </div>
            <div class="col-md-4">
                <h4 class="title text-center">Assign an Event</h4>
            </div>
            <div class="col-md-4">
            </div>
        </div>

        <form method="post" action="{{ route('assign_new_event') }}">
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
                <div class="col-md-3"></div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn--veeticket btn-block" id="submit">Add</button>
                </div>
                <div class="col-md-3">
                </div>
            </div>

        </form>
    </div>




@endsection
