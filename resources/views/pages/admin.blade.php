@extends('layouts.admin_layout')
@section('content')

@php
    $user_session_details = Session::get('user_session');
    $user_id = $user_session_details->id;
    $username = $user_session_details->username;
@endphp

    <div class="container" style="margin-top: 5rem !important">
        <div class="row mb-5">
            <div class="col-md-12">
                <h2 class="text-center">All Events</h2>
            </div>
        </div>

        {{-- <div class="row mb-4">
            <div class="col-md-3"></div>
            <div class="col-md-6 text-center">
                <a href="{{ url('add_event') }}" class="btn btn-success">Add New Event</a>
            </div>
            <div class="col-md-3"></div>
        </div> --}}

        <div class="row mb-5">
            @foreach ($all_events as $events)
                <div class="col-md-3 mb-4" id="card_div">
                    <a href="{{ url('event_details', $events->id ) }}" id="card_link">
                        <div class="card" id="event_card">
                            <div class="card-body">
                                <h5 class="card-title mb-4">{{ Str::upper($events->name)}}</h5>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>


        <div class="row mb-5">

        </div>


    </div>



@endsection
