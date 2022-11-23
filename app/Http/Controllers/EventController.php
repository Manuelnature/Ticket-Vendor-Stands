<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Event;
use App\Models\VendingPoint;

class EventController extends Controller
{
    public function index(){

        // $organizer_id = $id;
        return view('pages.add_event');
    }

    public function assign_event($vending_point_id){
        $all_events = Event::all();

        $vending_point_details = VendingPoint::where('id', $vending_point_id)->get()[0];
        return view('pages.assign_event', compact('all_events', 'vending_point_details'));
    }


    public function assign_new_event(Request $request){
        // dd($request->all());
        $event_id = $request->get('txt_event_id');
        $vending_point_id = $request->get('vending_point_id');

        $get_event = Event::where('id', $event_id)->get();
        // dd($get_event);

        $previous_vending_points = array();
        $current_vending_point = array();
        $all_vending_points = array();
        $access_order = 0;

        if (count($get_event) > 0) {
            $json_object = json_decode($get_event, true);

            $selected_event = $json_object[0];
            $previous_vending_points = $selected_event['vending_points'];
            // dd( $previous_vending_points);
        }

        if ($previous_vending_points == null || empty($previous_vending_points)) {
            //=========== adding Id
            // $current_vending_point['id'] = $vending_point_id;
        //    array_push($all_vending_points, $current_vending_point);

            //=========== Without Id
           array_push($all_vending_points, $vending_point_id);
        }
       else{
        $all_vending_points = json_decode($previous_vending_points, true);

        //=========== Adding Id
        // $current_vending_point['id'] = $vending_point_id;
        // array_push($all_vending_points, $current_vending_point);

        //=========== Without Id
        array_push($all_vending_points, $vending_point_id);
        }

    //    dd($all_vending_points);

       $update_event = Event::find($event_id);
       $update_event->vending_points = $all_vending_points;
       $update_event->save();

       Alert::toast('Event asigned Successfully','success');
       return redirect('vending_point');

    }




    public function add_event(Request $request){
        // dd($request->all());
        try {
            $request->validate([
                'txt_event_name' => 'required',
                'txt_event_date' => 'required',
                // 'txt_ticket_type' => 'required',
                // 'txt_ticket_price' => 'required|numeric',
                ], [
                'txt_event_name.required' => 'Event name is required',
                'txt_event_date.required' => 'Event date is required',
                // 'txt_ticket_type.required' => 'Ticket type is required',
                // 'txt_ticket_price.required' => 'Ticket price is required',
                // 'txt_ticket_price.numeric' => 'Ticket price must be in numbers only',
            ]);

            $event_name = ucwords($request->get('txt_event_name'));
            $event_date = $request->get('txt_event_date');
            $organizer_id = $request->get('txt_organizer_id');

            $user_id = $request->get('txt_user_id');
            $ticket_type = $request->get('txt_ticket_type');
            $ticket_price = $request->get('txt_ticket_price');
            $ticket_quantity = $request->get('txt_ticket_quantity');

            $ticket_type_length = count($ticket_type);
            $all_ticks = array();

            for ($i=0; $i < $ticket_type_length; $i++) {
                $t_type = ucwords($ticket_type[$i]);
                $t_price = $ticket_price[$i];
                $t_quantity = $ticket_quantity[$i];
                array_push( $all_ticks, ['type' => $t_type, 'price'=> $t_price, 'quantity'=>$t_quantity]);
            }
            $all_tickets = json_encode($all_ticks);


            $add_event = new Event();
            $add_event->name = $event_name;
            $add_event->tickets = $all_tickets;
            $add_event->organizer_id = $organizer_id;
            $add_event->user_id = $user_id;
            $add_event->event_date = $event_date;
            $add_event->save();

            Alert::toast('New event added successfully','success');
            return redirect('organizer');
        }
        catch (exception $e) {
                echo 'Caught exception';
            }
    }
}
