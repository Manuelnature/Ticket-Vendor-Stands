<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\User;
use App\Models\VendingPoint;
use App\Models\Event;
use App\Models\Sale;
use App\Models\Organizer;
use Session;
use Illuminate\Support\Str;
use DB;

class VendorController extends Controller
{
    public function index(){
        $user_session = Session::get('user_session');
        $user_id = $user_session->id;
        $vending_point_id = $user_session->vending_point_id;

        $all_events = Event::all();
        $all_selected_events = array();

        if (count($all_events) > 0) {
            foreach ($all_events as $event) {
                $vending_point_info = $event->vending_points;
                $event_id = $event->id;

                if ($vending_point_info != NULL || $vending_point_info != "") {
                    $all_vending_points = json_decode($vending_point_info);

                    if(in_array($vending_point_id, $all_vending_points)){
                        // dump('Got it');
                        // $selected_event = $event;
                        $selected_event = Event::where('id', $event_id)->get()[0];
                        // dump($selected_event);
                        array_push( $all_selected_events, $selected_event);
                    }
                }

            }
            // dump($all_selected_events);
        }

        $get_vending_point = VendingPoint::where('id', $vending_point_id)->get()[0];
        $vending_point_name = $get_vending_point->name;
        // dd($vending_point_name);

        return view('pages.vendor_page', compact('all_selected_events', 'vending_point_name'));
    }

    public function vendor_sales($id){
        $get_event = Event::where('id', $id)->get()[0];

        $user_session = Session::get('user_session');
        $user_id = $user_session->id;
        $vending_point_id = $user_session->vending_point_id;

        $get_vending_point = VendingPoint::where('id', $vending_point_id)->get()[0];
        $vending_point_name = $get_vending_point->name;

        return view('pages.vendor_sales', compact('get_event', 'vending_point_name'));
    }

    public function vending_point(){
        $user_session = Session::get('user_session');
        $user_id = $user_session->id;
        $organizer_id = $user_session->organizer_id;

        if ($organizer_id != NULL || $organizer_id != "") {
            $get_organizer = Organizer::where('id', $organizer_id)->get()[0];
            $organizer_name = $get_organizer->name;
        }
        else{
            $organizer_name = "";
        }
        // $get_organizer = Organizer::where('id', $organizer_id)->get()[0];
        // $organizer_name = $get_organizer->name;

        $all_users = User::all();
        $all_vending_point = VendingPoint::all();
        return view('pages.vending_point', compact('all_users', 'all_vending_point', 'organizer_name'));
    }

    public function add_vending_point(Request $request){
        try {
            $request->validate([
                'txt_name' => 'required',
                'txt_location' => 'required',
                // 'txt_user_id' => 'required',
                ], [
                'txt_name.required' => 'Location name is required',
                'txt_location.unique' => 'Location is required',
                // 'txt_user_id.required' => 'User name is required',
            ]);

            $name = ucwords($request->get('txt_name'));
            $location = ucwords($request->get('txt_location'));
            // $user_id = $request->get('txt_user_id');

                $add_v_point = new VendingPoint();
                $add_v_point->name = $name;
                $add_v_point->location = $location;
                // $add_v_point->user_id = $user_id;
                $add_v_point->save();

                Alert::toast('Vending Point Added','success');
                return redirect()->back();
        }
        catch (exception $e) {
                echo 'Caught exception';
        }
    }


    public function add_sales(Request $request){
        // dd($request->all());
        try {
            $user_session = Session::get('user_session');
            $username = $user_session->username;

            $event_id = $request->get('event_id');
            $vending_point_id = $request->get('vending_point_id');
            $ticket_type = $request->get('txt_ticket_type');
            $ticket_price = $request->get('txt_ticket_price');
            $ticket_total_quantity = $request->get('txt_ticket_total_quantity');
            $quantity = $request->get('txt_quantity');
            $phone_number = $request->get('txt_phone_number');
            $email = $request->get('txt_email');

            // dump($ticket_type);

            //===========  CALLING EVENT SALES INFO FUNCTION
            $event_sales_info = $this->get_event_sales_info($event_id, $vending_point_id);
            // dd($event_sales_info);

            $get_event = Event::find($event_id);
            $event_tickets = $get_event->tickets;

            $ticket_type_length = count($ticket_type);
            $ticket_price_length = count($ticket_price);
            // $ticket_price_length = count($ticket_price);
            $all_ticks = array();
            $total_amount = 0;


            if ($ticket_price_length  != $ticket_type_length) {

                for ($i=0; $i<$ticket_price_length; $i++) {
                    if ($quantity[0] == NULL) {
                        $first_type = $ticket_type[$i];
                        $ticket_type[0] = NULL;
                        $ticket_type[$i+1] = $first_type;
                        $t_type = $ticket_type[$i];
                        $t_price = $ticket_price[$i];
                        $t_quantity = $quantity[$i];
                        $original_total_quantity = $ticket_total_quantity[$i];

                        foreach ($event_sales_info as $ticket_sales) {
                            if ($ticket_sales['type'] == $t_type) {
                                $total_quantity_sold = $ticket_sales['total_quantity'] + $t_quantity;
                                if (($original_total_quantity - $total_quantity_sold) < 0) {
                                    Alert::warning('Warning!!', 'Quantity left for '.Str::upper($t_type).' ticket is less than quantity requested');
                                    return redirect()->back();
                                }
                            }
                        }

                        if ($t_type != NULL) {

                            $amount = (double)$t_price * (double)$t_quantity;

                            $total_amount = $total_amount + $amount;
                            array_push( $all_ticks, ['type' => ucwords($t_type), 'price'=> $t_price, 'quantity'=>$t_quantity, 'amount'=>$amount]);

                        }
                    }
                    else{
                        $ticket_price_length = $ticket_type_length;
                        // dump('ticket array '. $i);
                        $t_type = $ticket_type[$i];
                        // dump('ticket type array '.$t_type);
                        $t_price = $ticket_price[$i];
                        // dump('t_price array '.  $t_price);
                        $t_quantity = $quantity[$i];
                        // dump('t_quantity array '.  $t_quantity);
                        $original_total_quantity = $ticket_total_quantity[$i];

                        foreach ($event_sales_info as $ticket_sales) {
                            if ($ticket_sales['type'] == $t_type) {
                                $total_quantity_sold = $ticket_sales['total_quantity'] + $t_quantity;
                                if (($original_total_quantity - $total_quantity_sold) < 0) {
                                    Alert::warning('Warning!!', 'Quantity left for '.Str::upper($t_type).' ticket is less than quantity requested');
                                    return redirect()->back();
                                }
                            }
                        }

                        $amount = (double)$t_price * (double)$t_quantity;

                        $total_amount = $total_amount + $amount;
                        array_push( $all_ticks, ['type' =>ucwords($t_type), 'price'=> $t_price, 'quantity'=>$t_quantity, 'amount'=>$amount]);
                    }
                }
            }
            else {
                for ($i=0; $i < $ticket_type_length; $i++) {
                    $t_type = $ticket_type[$i];
                    $t_price = $ticket_price[$i];
                    $t_quantity = $quantity[$i];
                    $original_total_quantity = $ticket_total_quantity[$i];

                    foreach ($event_sales_info as $ticket_sales) {
                        if ($ticket_sales['type'] == $t_type) {
                            $total_quantity_sold = $ticket_sales['total_quantity'] + $t_quantity;
                            if (($original_total_quantity - $total_quantity_sold) < 0) {
                                Alert::warning('Warning!!', 'Quantity left for '.Str::upper($t_type).' ticket is less than quantity requested');
                                return redirect()->back();
                            }
                        }
                    }

                    $amount = (double)$t_price * (double)$t_quantity;

                    $total_amount = $total_amount + $amount;
                    array_push( $all_ticks, ['type' =>ucwords($t_type), 'price'=> $t_price, 'quantity'=>$t_quantity, 'amount'=>$amount]);
                }

            }
            // dd( $all_ticks);


            $all_tickets = json_encode($all_ticks);


            $add_sale = new Sale();
            $add_sale->event_id = $event_id;
            $add_sale->tickets = $all_tickets;
            $add_sale->total_amount = $total_amount;
            $add_sale->phone_number = $phone_number;
            $add_sale->vending_point_id = $vending_point_id;
            $add_sale->created_by = $username;
            $add_sale->save();

            Alert::toast('Sales recorded','success');
            return redirect('vendor_page');
        }
        catch (exception $e) {
                echo 'Caught exception';
            }
    }


    public function get_event_sales_info ($event_id, $vending_point_id){

        $get_event_sales_for_vending_point = Sale::my_event_sales_for_vending_point($event_id, $vending_point_id);
        // dump($get_event_sales_for_vending_point);

        $all_ticket_info = array();
        if (count($get_event_sales_for_vending_point) > 0 ) {
            $events_details = Event::where('id', $event_id)->get()[0];

            $event_tickets = json_decode($events_details->tickets);
            foreach ($event_tickets as $ticket_details) {
                $ticket_type_from_event = $ticket_details->type;

                $total_ticket_quantity = 0;
                $total_ticket_amount = 0;

                foreach (json_decode($get_event_sales_for_vending_point, true) as $event_v_point) {
                    $ticket_details =  json_decode($event_v_point['tickets']);

                    foreach ($ticket_details as $ticket) {
                        $ticket_type_from_sales = $ticket->type;

                        $amount = 0;
                        $quantity = 0;

                        if ($ticket_type_from_sales == $ticket_type_from_event) {

                           $ticket_price = $ticket->amount;
                           $ticket_quantity = $ticket->quantity;

                           $amount =  $amount + $ticket_price;
                           $quantity =  $quantity + $ticket_quantity;
                        //    dump('price from sales in if statement '.$ticket_price);
                        }
                        // dump($amount);
                        $total_ticket_amount =  $total_ticket_amount + $amount;
                        $total_ticket_quantity =  $total_ticket_quantity + $quantity;

                    }


                }
                array_push( $all_ticket_info, ['type' => $ticket_type_from_event, 'total_quantity'=> $total_ticket_quantity, 'total_amount'=>$total_ticket_amount]);

            }
            // $all_tickets_info = json_encode($all_ticket_info);
        }
        else{
            $events_details = Event::where('id', $event_id)->get()[0];
            // $all_tickets_info = "";
            $all_ticket_info = "";
        }

        return $all_ticket_info;
    }



    public function add_sales_working_well(Request $request){
        // dd($request->all());
        try {
            $user_session = Session::get('user_session');
            $username = $user_session->username;

            $event_id = $request->get('event_id');
            $vending_point_id = $request->get('vending_point_id');
            $ticket_type = $request->get('txt_ticket_type');
            $ticket_price = $request->get('txt_ticket_price');
            $ticket_total_quantity = $request->get('txt_ticket_total_quantity');
            $quantity = $request->get('txt_quantity');
            $phone_number = $request->get('txt_phone_number');
            $email = $request->get('txt_email');

            // dump($ticket_type);

            $get_event = Event::find($event_id);
            $event_tickets = $get_event->tickets;

            $ticket_type_length = count($ticket_type);
            $ticket_price_length = count($ticket_price);
            // $ticket_price_length = count($ticket_price);
            $all_ticks = array();
            $total_amount = 0;


            if ($ticket_price_length  != $ticket_type_length) {

                for ($i=0; $i<$ticket_price_length; $i++) {
                    if ($quantity[0] == NULL) {
                        $first_type = $ticket_type[$i];
                        $ticket_type[0] = NULL;
                        $ticket_type[$i+1] = $first_type;
                        $t_type = $ticket_type[$i];
                        $t_price = $ticket_price[$i];
                        $t_quantity = $quantity[$i];
                        $original_total_quantity = $ticket_total_quantity[$i];


                        if ($t_quantity > $original_total_quantity) {
                            Alert::warning('Warning!!', $t_type .' Quantity left is less than quantity requested');
                            return redirect()->back();
                        }

                        if ($t_type != NULL) {

                            $amount = (double)$t_price * (double)$t_quantity;

                            $total_amount = $total_amount + $amount;
                            array_push( $all_ticks, ['type' => ucwords($t_type), 'price'=> $t_price, 'quantity'=>$t_quantity, 'amount'=>$amount]);

                            // $total_ticket_quantity_left = $original_total_quantity - $t_quantity;

                            //=============== Updating Events table
                            // foreach (json_decode($event_tickets, true) as $ticket) {
                            //     dump('Tickets infooooooo');
                            //     dump($ticket);
                            //     if ($ticket['type'] == $t_type) {
                            //         $ticket['quantity'] =  $total_ticket_quantity_left;

                            //         $getddd = DB::table('tbl_events')
                            //             ->where('id', $event_id)
                            //             ->where('tickets->type', $t_type)
                            //             ->update([
                            //             'tickets->quantity' => $total_ticket_quantity_left
                            //         ]);
                            //         dump('From DBBBB');
                            //         // dd($getddd);
                            //     }
                            //     dump('New Tickets Quantity');
                            //     dump($ticket['quantity']);
                            // }
                        }
                    }
                    else{
                        $ticket_price_length = $ticket_type_length;
                        // dump('ticket array '. $i);
                        $t_type = $ticket_type[$i];
                        // dump('ticket type array '.$t_type);
                        $t_price = $ticket_price[$i];
                        // dump('t_price array '.  $t_price);
                        $t_quantity = $quantity[$i];
                        // dump('t_quantity array '.  $t_quantity);

                        $amount = (double)$t_price * (double)$t_quantity;

                        $total_amount = $total_amount + $amount;
                        array_push( $all_ticks, ['type' =>ucwords($t_type), 'price'=> $t_price, 'quantity'=>$t_quantity, 'amount'=>$amount]);
                    }
                }
            }
            else {
                for ($i=0; $i < $ticket_type_length; $i++) {
                    $t_type = $ticket_type[$i];
                    $t_price = $ticket_price[$i];
                    $t_quantity = $quantity[$i];

                    $amount = (double)$t_price * (double)$t_quantity;

                    $total_amount = $total_amount + $amount;
                    array_push( $all_ticks, ['type' =>ucwords($t_type), 'price'=> $t_price, 'quantity'=>$t_quantity, 'amount'=>$amount]);
                }

            }
            // dd( $all_ticks);


            $all_tickets = json_encode($all_ticks);


            $add_sale = new Sale();
            $add_sale->event_id = $event_id;
            $add_sale->tickets = $all_tickets;
            $add_sale->total_amount = $total_amount;
            $add_sale->phone_number = $phone_number;
            $add_sale->vending_point_id = $vending_point_id;
            $add_sale->created_by = $username;
            $add_sale->save();

            Alert::toast('Sales recorded','success');
            return redirect('vendor_page');
        }
        catch (exception $e) {
                echo 'Caught exception';
            }
    }


    public function add_sales_old_old(Request $request){
        if ($ticket_price_length  != $ticket_type_length) {
            // $first_type = $ticket_type[0];
            // $ticket_type[0] = 0;
            // $ticket_type[1] = $first_type;
            // dump($ticket_type[0]);
            // dd($ticket_type[1]);
            for ($i=0; $i<$ticket_price_length; $i++) {
                if ($quantity[0] == NULL) {
                    $first_type = $ticket_type[$i];
                    $ticket_type[0] = NULL;
                    $ticket_type[$i+1] = $first_type;
                    $t_type = $ticket_type[$i];
                    $t_price = $ticket_price[$i];
                    $t_quantity = $quantity[$i];
                    dump($t_type);
                    dump($t_price);
                    dump($t_quantity);

                    if ($t_type != NULL) {

                        $amount = (double)$t_price * (double)$t_quantity;

                        $total_amount = $total_amount + $amount;
                        array_push( $all_ticks, ['type' => ucwords($t_type), 'price'=> $t_price, 'quantity'=>$t_quantity, 'amount'=>$amount]);
                    }
                }
                else{
                    $ticket_price_length = $ticket_type_length;
                    dump('ticket array '. $i);
                    $t_type = trim($ticket_type[$i]);
                    dump('ticket type array '.$t_type);
                    $t_price = $ticket_price[$i];
                    dump('t_price array '.  $t_price);
                    $t_quantity = $quantity[$i];
                    dump('t_quantity array '.  $t_quantity);

                    $amount = (double)$t_price * (double)$t_quantity;

                    $total_amount = $total_amount + $amount;
                    array_push( $all_ticks, ['type' =>ucwords($t_type), 'price'=> $t_price, 'quantity'=>$t_quantity, 'amount'=>$amount]);
                }
            }
        }
        else {
            for ($i=0; $i < $ticket_type_length; $i++) {
                $t_type = $ticket_type[$i];
                $t_price = $ticket_price[$i];
                $t_quantity = $quantity[$i];

                $amount = (double)$t_price * (double)$t_quantity;

                $total_amount = $total_amount + $amount;
                array_push( $all_ticks, ['type' =>ucwords($t_type), 'price'=> $t_price, 'quantity'=>$t_quantity, 'amount'=>$amount]);
            }

        }
          // for ($i=0; $i < $ticket_type_length; $i++) {
            //     $t_type = ucwords($ticket_type[$i]);
            //     $t_price = $ticket_price[$i];
            //     $t_quantity = $quantity[$i];

            //     $amount = (double)$t_price * (double)$t_quantity;

            //     $total_amount = $total_amount + $amount;
            //     array_push( $all_ticks, ['type' => $t_type, 'price'=> $t_price, 'quantity'=>$t_quantity, 'amount'=>$amount]);
            // }


            // dump( $total_amount);
            // dd( $all_ticks);
    }
}
