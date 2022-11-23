@extends('layouts.main')
@section('content')
<nav class="navbar bg-dark">
    <div class="container-fluid">
        <h2 class="navbar-text text-white" id="nav_text">  {{ $organizer_name }}</h2>
      {{-- <span class="navbar-text text-white">

      </span> --}}
    </div>
  </nav>

    <div class="container" style="margin-top: 5rem !important">
        <div class="row mb-5">
            <div class="col-md-12">
                <h2 class="text-center mb-4">{{ Str::upper($vending_point_details->name) }}</h2>
                <h4 class="text-center mb-4">{{ Str::upper($events_details->name) }}</h4>

                @if($all_tickets_info != NULL || $all_tickets_info != "")
                    <h4 class="text-center">Total Tickets Sold:
                        @php
                            $total_sold = 0;
                            // $total_amount = 0;
                            foreach (json_decode($all_tickets_info, true) as $tickets){
                                $total_sold = $total_sold + $tickets['total_quantity'];
                                // $total_amount = $total_amount + $tickets['total_amount'];
                            }
                            echo  $total_sold;
                        @endphp
                    </h4>

                    <h4 class="text-center">Total Amount:
                        @php
                            // $total_sold = 0;
                            $total_amount = 0;
                            foreach (json_decode($all_tickets_info, true) as $tickets){
                                // $total_sold = $total_sold + $tickets['total_quantity'];
                                $total_amount = $total_amount + $tickets['total_amount'];
                            }
                            echo 'GH¢ '.number_format($total_amount, 2);
                        @endphp
                    </h4>
                @else
                    <h4 class="text-center">No ticket sold here yet !!</h4>
                @endif

            </div>
        </div>

        <div class="row mb-5">
            {{-- <div class="col-md-3 mb-4" id="card_div">

            </div> --}}
            {{-- @foreach (json_decode($get_event_sales_for_vending_point->tickets, true) as $tickets)
            <div class="col-md-3 mb-4" id="card_div">
                <a href="#" id="card_link">
                    <div class="card" id="card">
                        <div class="card-body">
                            <h5 class="card-title mb-4">{{ Str::upper($tickets['type']) }}</h5>
                            <p class="card-text text-muted mb-4">Tickets Sold: <span><span></p>
                            <p class="card-text text-muted">Total Amount: <span><span></p>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach --}}

            @if ( $all_tickets_info != NULL || $all_tickets_info != "")
                @foreach (json_decode($all_tickets_info, true) as $tickets)
                    <div class="col-md-3 mb-4" id="card_div">
                        <a href="#" id="card_link">
                            <div class="card" id="card">
                                <div class="card-body">
                                    <h5 class="card-title mb-4">{{ Str::upper($tickets['type']) }}</h5>
                                    <p class="card-text text-muted mb-4">Tickets Sold: {{ $tickets['total_quantity'] }}<span><span></p>
                                    <p class="card-text text-muted">Total Amount: {{ $tickets['total_amount'] }}<span><span></p>

                                    @php
                                        foreach (json_decode($events_details->tickets, true) as $event_ticket){
                                            if ($event_ticket['type'] == $tickets['type']) {
                                                $quantity_left = $event_ticket['quantity'] - $tickets['total_quantity'];
                                                echo 'Quantity Left = '.$quantity_left ;
                                            }
                                        }
                                    @endphp
                                </div>

                            </div>
                        </a>
                    </div>
                @endforeach
            @endif
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


    @if ( $all_tickets_info != NULL || $all_tickets_info != "")
        <div class="container" style="margin-top: 3rem !important">
            <div class="row mb-4">
                <div class="col-md-12">
                    <h2 class="text-center mb-5">Location Details</h2>
                    <table id="example1" class="table table-striped" style="width:100%">
                        <thead>
                        <tr>
                            {{-- <th scope="col">#</th> --}}
                            <th scope="col">Event Name</th>
                            <th scope="col">Ticket Type</th>
                            <th scope="col">Quantity Sold</th>
                            <th scope="col">Amount</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach (json_decode($all_tickets_info, true) as $tickets)
                            <tr>
                                {{-- <th scope="row">1</th> --}}
                                <td>{{ $events_details->name }}</td>
                                <td>{{ Str::upper($tickets['type']) }}</td>
                                <td>{{ $tickets['total_quantity']  }}</td>
                                <td>{{ $tickets['total_amount'] }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                </div>
        </div>
    @endif



    <script>
        $(document).ready(function () {
            $('#example1').DataTable({
            "responsive": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "scrollX": true,
            });
        });
    </script>


@endsection
