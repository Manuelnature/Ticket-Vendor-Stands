@extends('layouts.admin_layout')
@section('content')

@php
    $user_session_details = Session::get('user_session');
    $user_id = $user_session_details->id;
    // $organizer_id = $user_session_details->organizer_id;
@endphp

{{-- <nav class="navbar bg-dark">
    <div class="container-fluid">
        <h2 class="navbar-text text-white" id="nav_text"> {{ $organizer_id }}</h2>
    </div>
</nav> --}}



    <div class="container" style="margin-top: 5rem !important">
        <div class="row">
            <div class="col-md-4">
            </div>
            <div class="col-md-4">
                {{-- <h4 class="title">User: {FIRSTNAME LAST NAME}</h4> --}}
            </div>
            <div class="col-md-4">
            </div>
        </div>

        <form method="post" action="{{ route('add_new_event') }}">
            @csrf
            <div class="row mb-3">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        {{-- <input type="hidden" name="txt_organizer_id" value="{{ $organizer_id }}"> --}}
                        <input type="hidden" name="txt_user_id" value="{{ $user_id }}">
                        <label for="txt_event_name" class="form-label" id="label">Event Name</label>
                        <input type="text" class="form-control" id="txt_event_name" name="txt_event_name">
                    </div>
                    <span class="text-danger">@error('txt_event_name') {{ $message }} @enderror</span>
                </div>
                <div class="col-md-3"></div>
            </div>

            <div class="row mb-3">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label for="txt_event_date" class="form-label" id="label">Event Date</label>
                        <input type="date" class="form-control" id="txt_event_date" name="txt_event_date">
                    </div>
                    <span class="text-danger">@error('txt_event_date') {{ $message }} @enderror</span>
                </div>
                <div class="col-md-3"></div>
            </div>

            <div class="row mb-3">
                <div class="col-md-3"></div>
                <div class="col-md-2">
                    <div class="form-group mb-3">
                        <label for="txt_ticket_type" class="form-label" id="label">Ticket Type</label>
                        <input type="text" class="form-control" id="txt_ticket_type" name="txt_ticket_type[]">
                    </div>
                    <span class="text-danger">@error('txt_ticket_type') {{ $message }} @enderror</span>
                </div>
                <div class="col-md-2">
                    <div class="form-group mb-3">
                        <label for="txt_ticket_price" class="form-label" id="label">Price per Ticket</label>
                        <input type="number" class="form-control" id="txt_ticket_price" name="txt_ticket_price[]">
                    </div>
                    <span class="text-danger">@error('txt_ticket_price') {{ $message }} @enderror</span>
                </div>
                <div class="col-md-2">
                    <div class="form-group mb-3">
                        <label for="txt_ticket_quantity" class="form-label" id="label">Quantity</label>
                        <input type="number" class="form-control" id="txt_ticket_quantity" name="txt_ticket_quantity[]">
                    </div>
                    <span class="text-danger">@error('txt_ticket_quantity') {{ $message }} @enderror</span>
                </div>
                <div class="col-md-3"></div>
            </div>

            <div class="row" id="new_row">

            </div>

            {{-- <div class="row" id="new_row">
                <div class="col-md-3"></div>
                <div class="col-md-2 mb-4">
                    <div class="form-group mb-3" id="t_type">
                    </div>
                </div>
                <div class="col-md-2 mb-4">
                    <div class="form-group mb-3" id="t_price">
                    </div>
                </div>
                <div class="col-md-2 mb-4">
                    <div class="form-group mb-3" id="t_quantity">
                    </div>
                </div>
                <div class="col-md-3"></div>
            </div> --}}

            <div class="row mb-4" ><!--padding: 1px 6px 1px 3px    style="margin-top: -4rem !important"-->
                <div class="col-md-6"></div>
                <div class="col-md-3">
                    <button type="button" class="btn btn-success" style="margin-left:73%; font-size:10px; padding-top: -5px; padding-bottom:-2px; padding-left:2px; padding-right:1px" onclick="add()">Add Ticket Type</button>
                    {{-- <button id="button" type="button" value="Add" onclick="add()"> Add</button> --}}
                </div>
                <div class="col-md-3"></div>
            </div>

            <div class="row mb-4">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <button type="submit" class="btn btn--veeticket btn-block" id="submit">Continue</button>
                </div>
                <div class="col-md-3"></div>
            </div>
        </form>
    </div>

    <script>
        function add() {

        var main_row =   document.getElementById("new_row");
        // var main_row = document.createElement("div");
        // main_row.setAttribute("class", "row mb-4");

        var first_col = document.createElement("div");
        first_col.setAttribute("class", "col-md-3");

        var second_col = document.createElement("div");
        second_col.setAttribute("class", "col-md-2 mb-3");

        var t_type_div = document.createElement("div");
        t_type_div.setAttribute("class", "form-group mb-3");
        t_type_div.setAttribute("id", "t_type");

        var third_col = document.createElement("div");
        third_col.setAttribute("class", "col-md-2 mb-3");

        var t_price_div = document.createElement("div");
        t_price_div.setAttribute("class", "form-group mb-3");
        t_price_div.setAttribute("id", "t_price");

        var fouth_col = document.createElement("div");
        fouth_col.setAttribute("class", "col-md-2 mb-3");

        var t_quantity_div = document.createElement("div");
        t_quantity_div.setAttribute("class", "form-group mb-3");
        t_quantity_div.setAttribute("id", "t_quantity");

        var fifth_col = document.createElement("div");
        fifth_col.setAttribute("class", "col-md-3");


        // var new_row = document.getElementById("new_row").classList;
        // // new_row.remove('hidden')
        // new_row.add('mb-4')



        //Create Labels
        var t_type_label = document.createElement("Label");
        t_type_label.innerHTML = "Ticket Type";

        //Create an input type dynamically.
        var t_type = document.createElement("input");

        //Assign different attributes to the element.
        t_type.setAttribute("type", "text");
        t_type.setAttribute("value", "");
        t_type.setAttribute("name", "txt_ticket_type[]");
        t_type.setAttribute("class", "form-control mb-4");

        //Create Labels
        var t_price_label = document.createElement("Label");
        t_price_label.innerHTML = "Price per Ticket";

        //Create an input type dynamically.
        var t_price = document.createElement("input");

        //Assign different attributes to the element.
        t_price.setAttribute("type", "number");
        t_price.setAttribute("value", "");
        t_price.setAttribute("name", "txt_ticket_price[]");
        t_price.setAttribute("class", "form-control mb-4");

         //Create Labels
        var t_quantity_label = document.createElement("Label");
        t_quantity_label.innerHTML = "Quantity";

        //Create an input type dynamically.
        var t_quantity = document.createElement("input");

        //Assign different attributes to the element.
        t_quantity.setAttribute("type", "number");
        t_quantity.setAttribute("value", "");
        t_quantity.setAttribute("name", "txt_ticket_quantity[]");
        t_quantity.setAttribute("class", "form-control mb-4");


        // This is the div id, where new fields are to be added
        // var type = document.getElementById("t_type");
        // var price = document.getElementById("t_price");
        // var quantity = document.getElementById("t_quantity");

        t_type_div.appendChild(t_type_label);
        t_type_div.appendChild(t_type);

        t_price_div.appendChild(t_price_label);
        t_price_div.appendChild(t_price);


        t_quantity_div.appendChild(t_quantity_label);
        t_quantity_div.appendChild(t_quantity);



        second_col.innerHTML+= t_type_div.outerHTML;
        third_col.innerHTML+= t_price_div.outerHTML;
        fouth_col.innerHTML+= t_quantity_div.outerHTML;
        // listElement.appendChild(listItem);

        main_row.appendChild(first_col);
        main_row.appendChild(second_col);
        main_row.appendChild(third_col);
        main_row.appendChild(fouth_col);
        main_row.appendChild(fifth_col);


        }
    </script>

@endsection
