<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Organizer;
use App\Models\Event;
use App\Models\VendingPoint;
use App\Models\Sale;
use Session;

class OrganizerController extends Controller
{
    public function index(){
        $user_session = Session::get('user_session');
        $user_id = $user_session->id;
        $organizer_id = $user_session->organizer_id;
        $all_organizers = Organizer::all();

        $my_events = Event::where('organizer_id', $organizer_id)->get();


        // $my_events = $this->get_ticket_info();

        $get_organizer = Organizer::where('id', $organizer_id)->get()[0];
        $organizer_name = $get_organizer->name;

        return view('pages.organizer', compact('all_organizers', 'my_events', 'organizer_name'));
    }


    public function get_ticket_info(){
        $user_session = Session::get('user_session');
        $user_id = $user_session->id;
        $all_organizers = Organizer::all();
        $my_events = Event::where('organizer_id', $user_id)->get();

        $all_ticks = array();
        foreach ($my_events as $events) {
            $event_id = $events->id;
            $get_event_from_sales = Sale::my_events_from_sales($event_id);
            $get_event_from_sales = $get_event_from_sales[0];
            dump($get_event_from_sales);
            $event_name = $get_event_from_sales->name;
            dump($event_name);


            $tickets_sold = $get_event_from_sales->sales_tickets;
            $tickets_sold = json_decode($tickets_sold);
            dump($tickets_sold);
            $ticket_array_length = count($tickets_sold);
            dump($ticket_array_length);

            $total_amount = 0;
            $total_quantity = 0;

            foreach ($tickets_sold as $ticket) {
                $ticket_type = $ticket->type;
                // $ticket_price = $ticket->amount;
                $quantity = $ticket->quantity;
                $ticket_amount = $ticket->amount;

                $total_quantity = $total_quantity + $quantity;
                $total_amount = $total_amount + $ticket_amount;
                dump($quantity);
            }
            dump( $total_quantity);
            dump( $total_amount);
            //     for ($i=0; $i < $ticket_array_length; $i++) {
            //         $t_type = $ticket_type[$i];

            //         $amount = (double)$t_price * (double)$t_quantity;
            //         dump($amount);
            //     }
            //         // $total_amount = $total_amount + $amount;
            array_push( $all_ticks, ['event_id' => $event_id, 'event_name' => $event_name, 'total_tickets_sold'=> $total_quantity, 'total_amount'=>$total_amount]);
        }

        $all_tickets = json_encode($all_ticks);
        return $all_tickets;
    }



    public function add_organizer(){
        $all_orgaizers = Organizer::all();

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

        return view('pages.add_organizer', compact('all_orgaizers', 'organizer_name'));
    }

    public function add_new_organizer(Request $request){
        // dd($request->all());
        try {
            $request->validate([
                'txt_organizer_name' => 'required',
                // 'txt_organizer_name' => 'required|regex:/^[a-zA-Z-\s]+$/',
                ], [
                // 'txt_organizer_name.regex' => 'Organizer Name is must be in letters only',
                'txt_organizer_name.required' => 'Organizer Name is required'
            ]);

            $organizer_name = ucwords($request->get('txt_organizer_name'));

            $add_organizer = new Organizer();
            $add_organizer->name = $organizer_name;
            $add_organizer->save();

            Alert::toast('Event Organizer registered successfully','success');
            return redirect()->back();
        }
        catch (exception $e) {
                echo 'Caught exception';
            }
    }



    public function organizer_details($event_id){
        $user_session = Session::get('user_session');
        $user_id = $user_session->id;
        $organizer_id = $user_session->organizer_id;
        $get_organizer = Organizer::where('id', $organizer_id)->get()[0];
        $organizer_name = $get_organizer->name;


        $events_details = Event::where('id', $event_id)->get();
        // dd($events_details);

        if (count($events_details) > 0) {
            $events_details  = $events_details[0];
            $vending_points_for_event = $events_details->vending_points;


            $all_vending_points = array();

            if ($vending_points_for_event != NULL || $vending_points_for_event != "") {

                foreach (json_decode($vending_points_for_event, true) as $vending_point) {
                    // dump($vending_point);
                    $vending_point_id = $vending_point;
                    $get_vending_point = VendingPoint::where('id', $vending_point_id)->get()[0];
                    // dump($get_vending_point);

                    $vending_point_name = $get_vending_point->name;
                    $vending_point_location = $get_vending_point->location;
                    // dd($vending_point_name);

                    array_push($all_vending_points, ['id' => $vending_point_id, 'name'=> $vending_point_name, 'location'=>$vending_point_location]);
                }
                $all_vending_points = json_encode($all_vending_points);

            }
            else{
                $all_vending_points = "";
            }

            // $all_vending_points = json_encode($all_vending_points);
            // dd($all_vending_points);

        }




        return view('pages.organizer_details', compact('organizer_name', 'events_details', 'all_vending_points'));
    }



}
