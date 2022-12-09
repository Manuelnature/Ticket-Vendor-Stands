<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\VendingPoint;
use App\Models\Sale;
use App\Models\Organizer;
use Session;

class VendingPointController extends Controller
{


    public function vending_point_details($vending_point_id, $event_id){

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

        $get_event_sales_for_vending_point = Sale::my_event_sales_for_vending_point($event_id, $vending_point_id);
        // dump($get_event_sales_for_vending_point);

        $all_ticket_info = array();
        if (count($get_event_sales_for_vending_point) > 0 ) {
            $events_details = Event::where('id', $event_id)->get()[0];
            // dump($events_details);
            // dump(json_decode($events_details->tickets));


            $event_tickets = json_decode($events_details->tickets);
            foreach ($event_tickets as $ticket_details) {
                $ticket_type_from_event = $ticket_details->type;
                // dump('Ticket Type from event '.$ticket_type_from_event);

                // $total_price = 0;


                $total_ticket_quantity = 0;
                $total_ticket_amount = 0;
                // foreach ($get_event_sales_for_vending_point as $event_v_point) {
                foreach (json_decode($get_event_sales_for_vending_point, true) as $event_v_point) {
                    $ticket_details =  json_decode($event_v_point['tickets']);
                    // dump($ticket_details);

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


                // dump('Total Tickets Quantity  ====='.$total_ticket_quantity);
                // dump('Total Tickets ====='.$total_ticket_amount);


                array_push( $all_ticket_info, ['type' => $ticket_type_from_event, 'total_quantity'=> $total_ticket_quantity, 'total_amount'=>$total_ticket_amount]);

            }

            $all_tickets_info = json_encode($all_ticket_info);
        }
        else{
            $events_details = Event::where('id', $event_id)->get()[0];
            $all_tickets_info = "";
        }


        //  dd($all_tickets_info);
        // dd($all_tickets_info);

        // $get_event_sales_for_vending_point = Sale::my_event_sales_for_vending_point($event_id, $vending_point_id)[0];

        $vending_point_details = VendingPoint::where('id', $vending_point_id)->get()[0];


        // return view('pages.vending_point_details', compact('get_event_sales_for_vending_point', 'vending_point_details', 'events_details', 'all_tickets_info'));

        return view('pages.vending_point_details', compact('vending_point_details', 'events_details', 'all_tickets_info', 'organizer_name'));
    }










    public function vending_point_details_old_old($vending_point_id, $event_id){
        // dump($vending_point_id);
        // dump($event_id);

        // $get_event_sales_for_vending_point = Sale::where('event_id', $event_id)->where('vending_point_id',$vending_point_id)->get();

        $get_event_sales_for_vending_point = Sale::my_event_sales_for_vending_point($event_id, $vending_point_id);
        dump($get_event_sales_for_vending_point);

        $events_details = Event::where('id', $event_id)->get()[0];
        dump($events_details);
        // dump(json_decode($events_details->tickets));
        $all_ticket_info = array();

        $event_tickets = json_decode($events_details->tickets);
        foreach ($event_tickets as $ticket_details) {
            $ticket_type_from_event = $ticket_details->type;
            dump('Ticket Type from event '.$ticket_type_from_event);

            // $total_price = 0;


            $total_ticket_quantity = 0;
            $total_ticket_amount = 0;
            // foreach ($get_event_sales_for_vending_point as $event_v_point) {
            foreach (json_decode($get_event_sales_for_vending_point, true) as $event_v_point) {
                $ticket_details =  json_decode($event_v_point['tickets']);
                dump($ticket_details);
                // $total_ticket_amount = 0;
                foreach ($ticket_details as $ticket) {
                    $ticket_type_from_sales = $ticket->type;
                    // dump('type from sales '.$ticket_type_from_sales);
                    // dump('price from sales '.$ticket->price);

                    $amount = 0;
                    $quantity = 0;

                    if ($ticket_type_from_sales == $ticket_type_from_event) {

                       $ticket_price = $ticket->amount;
                       $ticket_quantity = $ticket->quantity;

                       $amount =  $amount + $ticket_price;
                       $quantity =  $quantity + $ticket_quantity;
                    //    dump('price from sales in if statement '.$ticket_price);
                    }
                    dump($amount);
                    $total_ticket_amount =  $total_ticket_amount + $amount;
                    $total_ticket_quantity =  $total_ticket_quantity + $quantity;
                    // dump($total_ticket_amount);

                    // dump('Total price for each ticket '.$ticket_type_from_sales.' is '. $f_amount);
                    // $total_price =  $total_price + $f_amount;
                }

                // $total_ticket_amount =  $total_ticket_amount + $f_amount;

                // dump('Total price for ==== '.$ticket_type_from_sales.' is '. $total_price);

                // array_push( $all_ticket_info, ['type' => $ticket_type_from_event, 'total_quantity'=> $total_ticket_quantity, 'total_amount'=>$total_ticket_amount]);

            }


            dump('Total Tickets Quantity  ====='.$total_ticket_quantity);
            dump('Total Tickets ====='.$total_ticket_amount);
            // dump('Total Tickets ====='.$total_ticket_amount);


            array_push( $all_ticket_info, ['type' => $ticket_type_from_event, 'total_quantity'=> $total_ticket_quantity, 'total_amount'=>$total_ticket_amount]);

        }

        $all_tickets_info = json_encode($all_ticket_info);

        // dump($all_tickets_info);

        // foreach ($get_event_sales_for_vending_point as $e_v_point) {
        //     $ticket =  $e_v_point->tickets;
        //     $ticket_details =  json_decode($e_v_point->tickets);
        //     $t_length = count( $ticket_details );

        //     foreach ($ticket_details as $ticket) {
        //         $ticket_type = $ticket->type;
        //         dump($ticket);
        //         dump($ticket_type);
        //     }
            // for ($i=0; $i < $t_length; $i++) {
            //     $t_type = $ticket[$i]->type;
            //     $t_quantity = $ticket[$i]->quantity;
            //     $t_amount = $ticket[$i]->amount;
            //     dump($t_type);
            //     dump($t_quantity);
            //     dump($t_amount);
            // }
            // dump($ticket);
            // dump($t_length);

        // }
        $get_event_sales_for_vending_point = Sale::my_event_sales_for_vending_point($event_id, $vending_point_id)[0];
            // dd($get_event_sales_for_vending_point->tickets);
        $vending_point_details = VendingPoint::where('id', $vending_point_id)->get()[0];
        // $events_details = Event::where('id', $event_id)->get()[0];
        // dd($vending_point_details);

        return view('pages.vending_point_details', compact('get_event_sales_for_vending_point', 'vending_point_details', 'events_details', 'all_tickets_info'));
    }
}
