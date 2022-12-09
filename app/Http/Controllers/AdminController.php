<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Organizer;
use App\Models\Event;
use App\Models\VendingPoint;
use App\Models\Sale;
use Session;


class AdminController extends Controller
{
    public function index(){
        $all_events = Event::all();

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

        return view('pages.admin', compact('all_events', 'organizer_name'));
    }


    public function event_details($event_id){
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


        $events_details = Event::where('id', $event_id)->get();

        if (count($events_details) > 0) {
            $events_details  = $events_details[0];
            $vending_points_for_event = $events_details->vending_points;


            $all_vending_points = array();

            if ($vending_points_for_event != NULL || $vending_points_for_event != "") {

                foreach (json_decode($vending_points_for_event, true) as $vending_point) {
                    $vending_point_id = $vending_point;
                    $get_vending_point = VendingPoint::where('id', $vending_point_id)->get()[0];

                    $vending_point_name = $get_vending_point->name;
                    $vending_point_location = $get_vending_point->location;

                    array_push($all_vending_points, ['id' => $vending_point_id, 'name'=> $vending_point_name, 'location'=>$vending_point_location]);
                }
                $all_vending_points = json_encode($all_vending_points);

            }
            else{
                $all_vending_points = "";
            }


        }

        return view('pages.event_details', compact('events_details', 'all_vending_points', 'organizer_name'));
    }

}
